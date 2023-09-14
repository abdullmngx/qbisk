<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
        }
        .header
        {
            margin-bottom: 20px;
        }
        .title
        {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        .title h5
        {
            color: red;
        }
        table
        {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td
        {
            border: 1px solid black;
        }
        th, td
        {
            padding: 2px;
        }
        th {
            text-transform: uppercase;
        }
        .foot
        {
            margin-top: 20px;
        }
        .text-center
        {
            text-align: center;
        }
        table.borderless, table.borderless td, table.borderless th
        {
            border: none;
        }
        .logo
        {
            text-align: center;
        }
        .logo img
        {
            width: 100px;
            height: 100px;
        }
        .mb-5  {
            margin-bottom: 30px;
        }

        .text-sm {
            font-size: 10px;
        }

        .text-grey {
            color: gray;
        }
        @page{
        margin-top: 100px;
      }
      header{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 60px;
        margin-top: -60px;
      }
    </style>
</head>
<body>
    <div class="text-center mb-5">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/logo.jpg'))) }}" width="150">

        <h1>Queen Bege International School, Queens' Ville Kuta</h1>
        <h4>{{ $invoice->session_name }} Academic Session</h4>
        <h6>Payment Invoice</h6>
    </div>

    <div class="mb-5">
        <h4>Student Info</h4>
        <table>
            <tr>
                @if ($invoice->owner_type == 'applicant')
                    <td>Application Number: {{ $invoice->owner->application_number }}</td>
                @else
                    <td>Admission Number: {{ $invoice->owner->admission_number }}</td>
                @endif
                <td>Name: {{ ucwords($invoice->owner->full_name) }}</td>
            </tr>
            <tr>
                <td>Class: {{ strtoupper($invoice->form_name) }}</td>
                <td>Term: {{ ucfirst($invoice->term_name) }}</td>
            </tr>
        </table>
    </div>

    <div class="mb-5">
        <div class="table-responsive mb-4">
            <table class="table table-striped">
                <thead>
                    <th>S/N</th>
                    <th>Item Description</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>{{ $invoice->invoice_type }}</td>
                        <td>{{ number_format($invoice->amount,2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Total: {{ number_format($invoice->amount,2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><span style="color: {{ $invoice->status=='paid' ? 'green' :'red' }}">{{ $invoice->status }}</span> <br><br> <span class="text-small text-sm text-grey">{{ $invoice->status=='paid' ? 'Paid at ' . $invoice->paid_at : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
