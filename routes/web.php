<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\EventCostingController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\MemberPanelController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:1'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/members_list', [MemberController::class, 'members_list'])->name('admin.members_list');    
    Route::get('/admin/add_member', [MemberController::class, 'add_member'])->name('admin.add_member');

    // Due subscription list
    Route::get('/admin/due_subscriptions', [SubscriptionController::class, 'due_subscription'])->name('admin.due_subscriptions');
    
        // pending subscription list
    Route::get('/admin/pending_subscriptions', [SubscriptionController::class, 'pending_subscription'])->name('admin.pending_subscriptions');
    
    // Paid subscription list
    Route::get('/admin/paid_subscriptions', [SubscriptionController::class, 'paid_subscription'])->name('admin.paid_subscriptions');

    Route::get('/admin/subscription/slip/{id}', [SubscriptionController::class, 'generateSlip'])
    ->name('subscription.slip');
    
    //Route::post('/admin/subscription/pay/{id}', [SubscriptionController::class, 'pay'])->name('admin.subscription.pay');
    Route::post('/admin/subscription/pay', [SubscriptionController::class, 'paySubscription'])->name('subscription.pay');
    Route::get('/admin/subscription/due-list/{user_id}', [SubscriptionController::class, 'dueList']);
    Route::post('/admin/subscription/pay', [SubscriptionController::class, 'paySubscription'])->name('subscription.pay');
    
    // collect subsceiption page
    Route::get('/admin/collect_payment', [SubscriptionController::class, 'collect_payment'])->name('admin.collect_payment');    

// receipt
Route::get('/admin/subscription-receipts', [SubscriptionController::class, 'receiptIndex'])->name('subscription.receipts');

Route::get('/admin/subscription-receipts/{id}', [SubscriptionController::class, 'receiptShow']);

Route::get('/admin/subscription-receipts/{id}/edit', [SubscriptionController::class, 'receiptEdit']);

// receipt preview
Route::get('/admin/receipt_preview', [SubscriptionController::class, 'receipt_preview'])
    ->name('admin.receipt_preview');


    // Events list
    Route::get('/admin/events_list', [EventController::class, 'events_list'])->name('admin.events_list');    


    Route::get('/admin/users_list', [UserController::class, 'users_list'])->name('admin.users_list');

    Route::get('/admin/users/create', [UserController::class, 'adminCreate'])->name('admin.users_create');

    Route::post('/admin/users/store', [UserController::class, 'adminStore'])->name('admin.users_store');

    Route::post('/admin/users/approve/{id}', [UserController::class, 'approve'])->name('admin.users_approve');
    Route::get('/admin/users/pending', [AdminController::class, 'pendingUsers']);

    Route::get('/admin/subscription/settings', [SettingsController::class, 'view_subs_settings'])->name('admin.subscription.settings');
    Route::get('/admin/subscription/settings/edit', [SettingsController::class, 'edit_subs_settings'])->name('admin.subscription.settings.edit');

    Route::post('/admin/subscription/settings/update', [SettingsController::class, 'update_subs_settings'])->name('admin.subscription.settings.update');
    
    // Report
    Route::get('/admin/reports/subscription', [ReportController::class, 'fullSubscriptionReport'])->name('report.subscription');
    // Custom report
    Route::get('/admin/reports/custom_sub_report', [ReportController::class, 'custom_sub_report'])
    ->name('report.sub_custom');

    // EXPORT ROUTE (next step use korbo)
    Route::get('/admin/reports/subscription/export/{year}', [ReportController::class, 'exportExcel'])->name('report.subscription.export');
    // monthly subscription report
    Route::get('/admin/reports/monthly', [ReportController::class, 'monthlyReport'])->name('report.monthly');
    // member wise subscription report
    Route::get('/admin/reports/member', [ReportController::class, 'memberReport'])->name('report.member');
    // custom report
    Route::get('/admin/reports/custom', [ReportController::class, 'customReport'])->name('report.custom');

    //event Report
    Route::get('/admin/reports/event', [ReportController::class, 'eventReport'])->name('report.event');



    // EVENT LIST
    Route::get('/admin/events', [EventController::class, 'event_list'])->name('event.list');

    // EVENT CREATE PAGE
    Route::get('/admin/events/create', [EventController::class, 'add'])->name('event.create');

    // STORE EVENT
    Route::post('/admin/events/store', [EventController::class, 'store'])->name('event.store');


    // REGISTRATION CREATE PAGE (ADMIN)
Route::get('/admin/events/register', [EventRegistrationController::class, 'create'])
    ->name('event.register.page');

// STORE REGISTRATION (PENDING DEFAULT)
Route::post('/admin/events/register/store', [EventRegistrationController::class, 'store'])
    ->name('event.register.store');

// MANAGE + APPROVE PAGE
Route::get('/admin/events/registrations/manage', [EventRegistrationController::class, 'manage'])
    ->name('event.reg.manage');

// APPROVE PAYMENT
Route::post('/admin/events/registrations/approve/{id}', [EventRegistrationController::class, 'approve'])
    ->name('event.reg.approve');
// Event Costing list
Route::get('/admin/events/costing/list', [EventCostingController::class, 'index'])->name('event.costing.list');
    // Event Costing Add
Route::get('/admin/events/costing/add', [EventCostingController::class, 'create'])->name('event.costing.add');

Route::post('/admin/events/costing/store', [EventCostingController::class, 'store'])->name('event.costing.store');
// Event Costing Approve
Route::post('/admin/events/costing/approve/{id}', [EventCostingController::class, 'approve'])->name('event.costing.approve');

// Sponsor
Route::get('/admin/sponsors_list', [SponsorController::class, 'sponsors_list'])->name('admin.sponsors_list');

Route::get('/admin/sponsors/add', [SponsorController::class, 'sponsors_add'])->name('admin.sponsors_add');

Route::post('/admin/sponsors/store', [SponsorController::class, 'sponsors_store'])->name('admin.sponsors_store');

// Acounts view
Route::get('/admin/accounts/report', [AccountsController::class, 'report'])->name('admin.accounts.report');

});





Route::get('/dashboard', function () {
    return view('member.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/member-basic-update', [ProfileController::class, 'basicUpdate'])
    ->name('member.basic.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// various pages
Route::middleware(['auth', 'verified'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {

    Route::get('/dashboard', function () {
            return view('member.dashboard');
        })->name('dashboard');

    Route::get('/my-subscription', [MemberPanelController::class, 'subscription'])
        ->name('my.subscription');


    Route::get('/my-registration', [MemberPanelController::class, 'registration'])
        ->name('my.registration');

    });

require __DIR__.'/auth.php';
