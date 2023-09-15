<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function webhook(Request $request)
    {
        $verif_hash = env('FLUTTERWAVE_VERIF_HASH');
        $headers_verif_hash = $request->header('verif-hash');

        $data = $request->data;
        $transaction_id = $data['id'];
        $invoice_number = $data['tx_ref'];

        if ($data['status'] == "successful")
        {
            if ($verif_hash == $headers_verif_hash)
            {

                $invoice = Invoice::where('invoice_number', $invoice_number)->first();

                if ($data['charged_amount'] >= $invoice->amount)
                {
                    Invoice::where('invoice_number', $invoice_number)->update([
                        'payment_reference' => $data['flw_ref'],
                        'payment_status' => 'successful',
                        'status' => 'paid',
                        'paid_at' => now(),
                        'transaction_id' => $transaction_id
                    ]);

                    return response('ok', 200);
                }
            }
        }
        else
        {
            Invoice::where('invoice_number', $invoice_number)->update([
                'payment_reference' => $data['flw_ref'],
                'payment_status' => $data['status'],
                'transaction_id' => $transaction_id
            ]);
            return response('ok', 200);
        }
    }
}
