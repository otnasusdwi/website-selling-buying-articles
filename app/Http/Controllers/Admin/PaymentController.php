<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\TipeArtikel;
use App\Models\Invoice;
use App\Models\ItemInvoice;
use App\Models\Fee;
use Auth;
use File;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with(['penulis'])->orderBy('created_at', 'DESC')
        ->get();
        // dd($joblists);
        return view('admin.payment.invoice', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoiceDetail($id)
    {
        $invoice = Invoice::with(['penulis'])->where('id', $id)
        ->orderBy('created_at', 'DESC')
        ->first();

        $item_invoices = ItemInvoice::with(['order'])
        ->where('invoice_id', $id)
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('admin.payment.detail', compact('invoice','item_invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paidInvoice(Request $request)
    {
        // dd($request->all());
        try {
            $file = 'BuktiTF_'.$request->id.'_'.time().'.'.$request->file('bukti_tf')->getClientOriginalExtension();
            $image = $request->file('bukti_tf');
            $image->storeAs('public/buktitf', $file);

            Invoice::where('id', $request->id)
            ->update([
                'bukti_tf'  => $file,
                'status'    => 'paid'
            ]);
            return redirect()->route('admin.invoice')->with(['success' => 'Berhasil upload bukti transfer!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fee()
    {
        $fee = Fee::first();
        return view('admin.fee.index', compact('fee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function feeUpdate(Request $request)
    {
        // dd($request->all());
        Fee::where('id', $request->id)
        ->update([
            'prosentase'  => $request->prosentase,
        ]);
        return redirect()->route('admin.fee')->with(['success' => 'Berhasil update prosentase!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}