<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Money Receipt</title>

<style>

body{
    font-family: DejaVu Sans, Arial, sans-serif;
    font-size:12px;
    color:#333;
    margin:0;
    padding:15px;
}

.receipt{
    width:700px;
    margin:0 auto;
    border:2px solid #0f4c81;
    border-radius:12px;
    overflow:hidden;
}

.header{
    background:#0f4c81;
    color:#fff;
    padding:15px;
}

.header-table{
    width:100%;
}

.logo{
    width:70px;
    height:70px;
}

.company{
    font-size:22px;
    font-weight:bold;
}

.subtitle{
    font-size:12px;
    margin-top:5px;
}

.receipt-title{
    text-align:right;
    font-size:18px;
    font-weight:bold;
}

.content{
    padding:20px;
}

.receipt-info{
    background:#f4f8fc;
    border:1px solid #d7e5f5;
    padding:10px;
    margin-bottom:15px;
}

.receipt-no{
    font-weight:bold;
    color:#0f4c81;
}

.info-table{
    width:100%;
    border-collapse:collapse;
}

.info-table td{
    padding:8px;
    border-bottom:1px solid #eee;
}

.label{
    width:150px;
    font-weight:bold;
    color:#0f4c81;
}

.amount-box{
    margin-top:15px;
    background:#eaf7ee;
    border:1px solid #28a745;
    padding:15px;
    border-radius:6px;
}

.amount{
    font-size:24px;
    font-weight:bold;
    color:#28a745;
}

.words{
    margin-top:8px;
    font-style:italic;
}

.month-box{
    margin-top:15px;
}

.month-title{
    background:#0f4c81;
    color:#fff;
    padding:8px;
    font-weight:bold;
}

.month-content{
    border:1px solid #ddd;
    padding:10px;
    line-height:22px;
}

.footer{
    margin-top:25px;
}

.signature-table{
    width:100%;
}

.sign{
    width:40%;
    text-align:center;
}

.sign-line{
    border-top:1px solid #000;
    margin-top:45px;
    padding-top:5px;
}

.bottom{
    margin-top:15px;
    text-align:center;
    font-size:10px;
    color:#777;
    border-top:1px dashed #ccc;
    padding-top:10px;
}

</style>
</head>

<body>

<div class="receipt">

    <!-- HEADER -->
    <div class="header">

        <table class="header-table">
            <tr>

                <td width="90">
                    <img
                        src="{{ public_path('images/logo_fav.png') }}"
                        class="logo">
                </td>

                <td>
                    <div class="company">
                        PLANNERS & DESIGNERS ASSOCIATION
                    </div>

                    <div class="subtitle">
                        Engineering • Planning • Design Professionals
                    </div>
                </td>

                <td align="right">
                    <div class="receipt-title">
                        MONEY RECEIPT
                    </div>
                </td>

            </tr>
        </table>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="receipt-info">

            <table width="100%">
                <tr>
                    <td>
                        <span class="receipt-no">
                            Receipt Date:
                        </span>
                        {{ $date }}
                    </td>

                    <td align="right">
                        <span class="receipt-no">
                            Subscription Payment
                        </span>
                    </td>
                </tr>
            </table>

        </div>

        <table class="info-table">

            <tr>
                <td class="label">Member Name</td>
                <td>{{ $name }}</td>
            </tr>

            <tr>
                <td class="label">Member ID</td>
                <td>{{ $member_id }}</td>
            </tr>

            <tr>
                <td class="label">Payment Date</td>
                <td>{{ $date }}</td>
            </tr>

        </table>

        <div class="month-box">

            <div class="month-title">
                Paid Subscription Months
            </div>

            <div class="month-content">
                {{ $months }}
            </div>

        </div>

        <div class="amount-box">

            <div>
                Total Received Amount
            </div>

            <div class="amount">
                Tk {{ number_format($amount,2) }}
            </div>

            <div class="words">
                In Words:
                {{ $in_words }}
            </div>

        </div>

        <div class="footer">

            <table class="signature-table">

                <tr>

                    <td class="sign">
                        <div class="sign-line">
                            Receiver Signature
                        </div>
                    </td>

                    <td></td>

                    <td class="sign">
                        <div class="sign-line">
                            Authorized Signature
                        </div>
                    </td>

                </tr>

            </table>

        </div>

        <div class="bottom">
            This is a computer generated money receipt.
            No manual signature is required.
        </div>

    </div>

</div>

</body>
</html>