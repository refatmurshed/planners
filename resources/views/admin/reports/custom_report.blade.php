@extends('admin.layout')

@section('content')

<style>
th, td {
    text-align: center;
    font-size: 13px;
    border: 1px solid #000;
    padding: 6px;
}

.paid { color: green; font-weight: bold; }
.due { color: red; font-weight: bold; }

.total-col {
    font-weight: bold;
    background: #f2f2f2;
}
</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Custom Report</h1>
</section>

<section class="content container-fluid">

<div class="box box-solid">
<div class="box-body">

<!-- FILTER -->
<form method="GET" style="margin-bottom:15px; display:flex; gap:10px;">

    <input type="month" name="start" value="{{ $start }}" class="form-control" required>

    <input type="month" name="end" value="{{ $end }}" class="form-control" required>

    <button class="btn btn-primary">Generate</button>

    <button type="button" class="btn btn-success" onclick="printReport()">
        Print PDF
    </button>

</form>

<!-- PRINT CONTENT -->
<div id="printArea">

<div style="text-align:center; margin-bottom:15px;">
    <img src="{{ asset('images/logo.png') }}" style="height:60px;"><br>
    <h3>PLANNERS & DESIGNERS ASSOCIATION</h3>
    <small>{{ $start }} to {{ $end }}</small>
</div>

@if(!empty($months))

<table style="width:100%; border-collapse:collapse;">

<thead>
<tr>
    <th>Month</th>
    <th>Paid</th>
    <th>Due</th>
</tr>
</thead>

<tbody>

@foreach($months as $month)
<tr>
    <td>{{ \Carbon\Carbon::parse($month)->format('M Y') }}</td>
    <td class="paid">{{ $data[$month]['paid'] ?? 0 }}</td>
    <td class="due">{{ $data[$month]['due'] ?? 0 }}</td>
</tr>
@endforeach

</tbody>

<tfoot>
<tr>
    <th>Total</th>
    <th class="total-col paid">{{ $grandPaid }}</th>
    <th class="total-col due">{{ $grandDue }}</th>
</tr>
</tfoot>

</table>

@endif

</div>

</div>
</div>

</section>

</div>

<!-- 🔥 PRINT SCRIPT (MAIN FIX) -->
<script>
function printReport() {

    let content = document.getElementById('printArea').innerHTML;

    let printWindow = window.open('', '', 'width=1000,height=700');

    printWindow.document.write(`
        <html>
        <head>
            <title>Report</title>
            <style>
                body { font-family: Arial; }

                table {
                    width:100%;
                    border-collapse: collapse;
                }

                th, td {
                    border:1px solid black;
                    padding:6px;
                    text-align:center;
                    font-size:12px;
                }

                .paid { color: green; font-weight:bold; }
                .due { color: red; font-weight:bold; }

                @page {
                    size: A4 landscape;
                    margin: 10mm;
                }
            </style>
        </head>
        <body>
            ${content}
        </body>
        </html>
    `);

    printWindow.document.close();

    printWindow.focus();

    setTimeout(function(){
        printWindow.print();
        printWindow.close();
    }, 500);
}
</script>

@endsection
