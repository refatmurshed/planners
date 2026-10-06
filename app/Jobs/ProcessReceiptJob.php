<?php

namespace App\Jobs;

use App\Models\Member;
use App\Models\Subscription;
use App\Models\Receipt;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessReceiptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId, $paidMonths, $paymentDate, $receiverId;

    public function __construct($userId, $paidMonths, $paymentDate, $receiverId)
    {
        $this->userId = $userId;
        $this->paidMonths = $paidMonths;
        $this->paymentDate = $paymentDate;
        $this->receiverId = $receiverId;
    }

    public function handle()
    {
        $member = Member::with('user')
            ->where('user_id', $this->userId)
            ->first();

        $lastSub = Subscription::where('user_id', $this->userId)
            ->latest()
            ->first();

        $monthlyAmount = $lastSub->amount ?? 0;
        $totalAmount = $monthlyAmount * count($this->paidMonths);

        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $inWords = ucfirst($f->format($totalAmount)) . ' Taka only';

        $pdf = Pdf::loadView('admin.slips.receipt', [
            'name' => $member->user->name ?? 'N/A',
            'member_id' => $member->member_code ?? 'N/A',
            'amount' => $totalAmount,
            'months' => implode(', ', $this->paidMonths),
            'date' => $this->paymentDate,
            'in_words' => $inWords
        ])->setPaper([0, 0, 595, 650]);

        $fileName = 'receipt_'.$this->userId.'_'.time().'.pdf';
        $filePath = public_path('receipts/'.$fileName);

        $pdf->save($filePath);

        Receipt::create([
            'user_id' => $this->userId,
            'member_id' => $member->member_code ?? null,
            'receipt_no' => 'R-' . time(),
            'payment_date' => $this->paymentDate,
            'months' => count($this->paidMonths),
            'monthly_amount' => $monthlyAmount,
            'total_amount' => $totalAmount,
            'paid_months' => implode(', ', $this->paidMonths),
            'pdf_file' => $fileName,
            'receipt_link' => asset('receipts/' . $fileName),
            'receiver' => $this->receiverId,
        ]);

        $user = User::find($this->userId);

        if ($user && $user->email) {
            Mail::raw('Your receipt is attached.', function ($message) use ($filePath, $user) {
                $message->to($user->email)
                        ->subject('Payment Receipt')
                        ->attach($filePath);
            });
        }
    }
}