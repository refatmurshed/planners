<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Money Receipt</title>

<style>

@page {
    margin: 5px;
}

body{
    font-family: DejaVu Sans, Arial, sans-serif;
    font-size:12px;
    color:#222;
    margin:0;
    padding:0;
}

.main-table{
    width:100%;
    border-collapse:collapse;
    border:2px solid #222;
}

.top-strip{
    background:#f57c00;
    height:8px;
}

.header-table{
    width:100%;
    border-collapse:collapse;
}

.logo{
    width:90px;
}

.company-title{
    font-size:22px;
    font-weight:bold;
    color:#f57c00;
    text-align:center;
}


.right-info{
    text-align:right;
    font-size:11px;
}

.receipt-title{
    background:#222;
    color:#fff;
    text-align:center;
    font-size:18px;
    font-weight:bold;
    /* padding:10px; */
    letter-spacing:2px;
}

.info-table{
    width:100%;
    border-collapse:collapse;
}

.info-table td{
    border:1px solid #ddd;
    padding:5px;
}

.label{
    font-weight:bold;
    color:#f57c00;
}

.data-table{
    width:100%;
    border-collapse:collapse;
}

.data-table td{
    border:1px solid #ddd;
    padding:5px;
}

.amount-box{
    background:#fff3e0;
    border:2px solid #f57c00;
    text-align:center;
    font-size:18px;
    font-weight:bold;
    color:#222;
    padding:8px;
}

.signature-table{
    width:100%;
    border-collapse:collapse;
    margin-top:5px;
}

.signature-table td{
    text-align:center;
    vertical-align:bottom;
}

.sign-img{
    height:60px;
}

.sign-line{
    border-top:1px solid #222;
    width:80%;
    margin:3px auto;
}

.footer{
    background:#222;
    color:#fff;
    text-align:center;
    padding:5px;
    font-size:10px;
}

.orange-row{
    background:#fff8f2;
}

</style>
</head>
<body>

<table class="main-table">

    <tr>
        <td colspan="3" class="top-strip"></td>
    </tr>

    <!-- Header -->

    <tr>
        <td colspan="3" style="padding:5px;">

            <table class="header-table">

                <tr>

                    <td width="20%">
                        <img src="{{ public_path('images/logo_fav.png') }}" class="logo">
                    </td>

                    <td width="50%">
                        <div class="company-title">
                            PLANNERS & DESIGNERS ASSOCIATION
                        </div>

                    </td>

                    <td width="30%" class="right-info">
                        Phone: 01791-155615<br>
                        Money Receipt System
                    </td>

                </tr>

            </table>

        </td>
    </tr>

    <!-- Receipt Title -->

    <tr>
        <td colspan="3" class="receipt-title">
            MONEY RECEIPT
        </td>
    </tr>

    <!-- Number / Date -->

    <tr class="orange-row">

        <td style="padding:5px;">
            <b>Receipt No:</b><br>
            MR-{{ date('YmdHis') }}
        </td>

        <td></td>

        <td style="padding:5px; text-align:right;">
            <b>Payment Date:</b><br>
            {{ $date }}
        </td>

    </tr>

    <!-- Member Info -->

    <tr>
        <td colspan="3">

            <table class="info-table">

                <tr>
                    <td width="25%" class="label">Received From</td>
                    <td>{{ $name }}</td>
                </tr>

                <tr>
                    <td class="label">Member ID</td>
                    <td>{{ $member_id }}</td>
                </tr>

                <tr>
                    <td class="label">Paid Months</td>
                    <td>{{ $months }}</td>
                </tr>

                <tr>
                    <td class="label">Amount In Words</td>
                    <td>{{ $in_words }}</td>
                </tr>

            </table>

        </td>
    </tr>

    <!-- Amount -->

    <tr>

        <td colspan="3" style="padding:5px;">

            <div class="amount-box">
                Total Amount Received : ৳ {{ number_format($amount,2) }}
            </div>

        </td>

    </tr>

    <!-- Declaration -->

    <tr>

        <td colspan="3" style="padding:8px; line-height:20px;">

            Received with thanks the subscription payment mentioned above on behalf of
            Planners & Designers Association.

        </td>

    </tr>

    <!-- Signatures -->

    <tr>

        <td colspan="3" style="padding:10px;">

            <table class="signature-table">

                <tr>

                    <td width="45%">

                        <img src="{{ public_path('images/receiver.jpg') }}" class="sign-img">

                        <div class="sign-line"></div>

                        <b>Received By</b>

                    </td>

                    <td width="10%"></td>

                    <td width="45%">

                        <img src="{{ public_path('images/auth_sign.jpg') }}" class="sign-img">

                        <div class="sign-line"></div>

                        <b>Authorized Signature</b>

                    </td>

                </tr>

            </table>

        </td>

    </tr>

    <!-- Footer -->

    <tr>

        <td colspan="3" class="footer">
            This is a computer generated money receipt.
        </td>

    </tr>

</table>

</body>
</html>