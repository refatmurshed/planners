@extends('admin.layout')

@section('content')

<style>
.form-box{
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    max-width:700px;
    margin:auto;
}

.form-box h3{
    margin-bottom:20px;
    text-align:center;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    font-weight:bold;
    display:block;
    margin-bottom:5px;
}

.form-control{
    width:100%;
    padding:8px;
    border:1px solid #ddd;
    border-radius:5px;
}

.btn-row{
    text-align:right;
    margin-top:20px;
}

.preview-box{
    background:#f8f8f8;
    padding:10px;
    border-radius:6px;
    font-size:13px;
}
</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Edit Receipt</h1>
</section>

<section class="content container-fluid">

<div class="form-box">

    <h3>Receipt Update</h3>

    <form method="POST" action="#">
        @csrf
        @method('PUT')

        <!-- MEMBER -->
        <div class="form-group">
            <label>Member Name</label>
            <input type="text" class="form-control"
                   value="{{ $receipt->user->name ?? '' }}" readonly>
        </div>

        <!-- MEMBER ID -->
        <div class="form-group">
            <label>Member ID</label>
            <input type="text" class="form-control"
                   value="{{ $receipt->member_id }}" readonly>
        </div>

        <!-- RECEIPT NO -->
        <div class="form-group">
            <label>Receipt No</label>
            <input type="text" class="form-control"
                   value="{{ $receipt->receipt_no }}" readonly>
        </div>

        <!-- PAYMENT DATE -->
        <div class="form-group">
            <label>Payment Date</label>
            <input type="date" class="form-control"
                   name="payment_date"
                   value="{{ $receipt->payment_date }}">
        </div>

        <!-- MONTHS -->
        <div class="form-group">
            <label>Months</label>
            <input type="text" class="form-control"
                   name="months"
                   value="{{ $receipt->months }}">
        </div>

        <!-- AMOUNT -->
        <div class="form-group">
            <label>Total Amount</label>
            <input type="text" class="form-control"
                   name="total_amount"
                   value="{{ $receipt->total_amount }}">
        </div>

        <!-- PDF PREVIEW -->
        <div class="form-group">
            <label>Current PDF</label>
            <div class="preview-box">
                @if($receipt->pdf_file)
                    <a href="{{ asset('receipts/'.$receipt->pdf_file) }}" target="_blank">
                        View Current Receipt
                    </a>
                @else
                    No PDF Found
                @endif
            </div>
        </div>

        <div class="btn-row">
            <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>

    </form>

</div>

</section>

</div>

@endsection