<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Money Receipt</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: DejaVu Sans, Arial, sans-serif;
    background:#f5f5f5;
    padding:30px 30px,30px,0px;
}

.receipt{
    width:900px;
    margin:auto;
    background:#fff;
    border:1px solid #ddd;
    position:relative;
    overflow:hidden;
}

/* HEADER */
.top-bar{
    height:55px;
    display:flex;
}

.top-left{
    width:38%;
    background:#003f67;
    position:relative;
}

.top-left:after{
    content:'';
    position:absolute;
    right:-35px;
    top:0;
    border-top:55px solid #003f67;
    border-right:35px solid transparent;
}

.top-right{
    flex:1;
    background:#f39c12;
}

.header{
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.logo-box{
    max-width:180px;
}

.logo{
    max-width:180px;
}


.tagline{
    margin-top:5px;
    font-size:12px;
    color:#666;
}

.title{
    text-align:center;
    flex:1;
}

.title h1{
    font-size:30px;
    color:#18314f;
    letter-spacing:2px;
}

.contact{
    margin-top:5px;
    font-size:14px;
    color:#555;
}

.company{
    width:270px;
    text-align:left;
}

.company h4{
    margin-bottom:6px;
}

.company p{
    font-size:13px;
    line-height:1.5;
}

.no-date{
    display:flex;
    justify-content:space-between;
    padding:0 30px 15px;
    font-size:18px;
}

.line-text{
    display:inline-block;
    border-bottom:1px dotted #999;
    min-width:180px;
}

.orange-line{
    height:8px;
    background:#f39c12;
}

/* BODY */
.content{
    padding-top:20px;
    padding-left:20px;
    padding-right:20px;
    padding-bottom:10px;
}

.row{
    margin-bottom:10px;
    font-size:16px;
}

.dotted{
    border-bottom:1px dotted #999;
    display:inline-block;
    width:75%;
    height:22px;
    vertical-align:bottom;
}

.dotted-small{
    border-bottom:1px dotted #999;
    display:inline-block;
    width:200px;
    height:22px;
    vertical-align:bottom;
}

.amount-box{
    display:flex;
    justify-content:space-between;
    margin-top:10px;
}

.amount-left{
    font-size:20px;
    font-weight:bold;
}

.amount-value{
    display:inline-block;
    min-width:220px;
    border:2px solid #ddd;
    text-align:center;
    padding:8px;
}

.signatures{
    display:flex;
    justify-content:space-between;
    margin-top:80px;
}

.sign-box{
    text-align:center;
    width:250px;
}

.sign-line{
    border-top:1px dotted #999;
    margin-bottom:8px;
}

/* FOOTER */
.footer{
    height:10px;
    display:flex;
    margin-top:5px;
}

.footer-left{
    flex:1;
    background:#f39c12;
    position:relative;
}

.footer-left:after{
    content:'';
    position:absolute;
    right:-35px;
    top:0;
    border-bottom:60px solid #f39c12;
    border-right:35px solid transparent;
}

.footer-right{
    width:35%;
    background:#003f67;
}
</style>
</head>

<body>

<div class="receipt">

    <div class="top-bar">
        <div class="top-left"></div>
        <div class="top-right"></div>
    </div>

    <div class="header">

<div class="logo-box">
    <img src="{{ asset('images/logo_fav.png') }}" class="logo" alt="Logo">

    <div class="tagline">
        YOUR TAGLINE
    </div>
</div>

        <div class="title">
            <h1>MONEY RECEIPT</h1>
            <div class="contact">
                ☎️ 01791-155615 &nbsp;&nbsp; ✉️ info@example.com
            </div>
        </div>

        <div class="company">
            <h4>Planners & Designers Association</h4>
            <p>
                Mymensingh, Bangladesh<br>
                Road 01, House 10<br>
            </p>
        </div>

    </div>

    <div class="no-date">
        <div>
            <strong>NO :</strong>
            <span class="line-text">MR-2025-001</span>
        </div>

        <div>
            <strong>Date :</strong>
            <span class="line-text">25-May-2026</span>
        </div>
    </div>

    <div class="orange-line"></div>

    <div class="content">

        <div class="row">
            Received from: <span class="dotted">Md. Refat Murshed</span>
        </div>

        <div class="row">
            Months: 
            <span class="dotted">January 2026 to March 2026</span>
        </div>

        <div class="row">
            Amount: 
            <span class="dotted-small">200.00 BDT</span>

            &nbsp;&nbsp;&nbsp;&nbsp;

            Total Amount: 
            <span class="dotted-small">600.00 BDT</span>
        </div>

        <div class="row">
            In word: 
            <span class="dotted">Six Hundred Taka Only</span>
        </div>     

        <div class="amount-box">

            <div class="amount-left">
                Amount =
                <span class="amount-value">
                    ৳ 5,000
                </span>
            </div>

        </div>

        <div class="signatures">

            <div class="sign-box">
                <div class="sign-line"></div>
                Received By
            </div>

            <div class="sign-box">
                <div class="sign-line"></div>
                Authorized Signature
            </div>

        </div>

    </div>

    <div class="footer">
        <div class="footer-left"></div>
        <div class="footer-right"></div>
    </div>

</div>

</body>
</html>