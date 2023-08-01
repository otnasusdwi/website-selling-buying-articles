<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\TipeArtikel;
use App\Models\Invoice;
use App\Models\ItemInvoice;
use Auth;
use File;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $joblists = Order::with(['user', 'tipe_artikel', 'harga'])
        ->whereIn('status_order', ['done'])
        ->where('penulis_id', Auth::user()->id)
        ->where('klaim', 0)
        // ->whereMonth('tanggal_ambil', $month)
        // ->whereYear('tanggal_ambil', $year)
        ->orderBy('created_at', 'DESC')
        ->get();
        // dd($joblists);
        return view('penulis.payment.index', compact('joblists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function claim(Request $request)
    {
        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now()->startOfMonth();
        $month = (date('m')-1);
        $year = date('Y');

        $orders = Order::whereIn('status_order', ['done'])
        ->where('penulis_id', Auth::user()->id)
        ->where('klaim', 0)
        ->whereMonth('tanggal_ambil', $month)
        ->whereYear('tanggal_ambil', $year)
        ->orderBy('tanggal_ambil', 'DESC')
        ->get();

        $nominal = Order::with(['user', 'tipe_artikel', 'harga'])
        ->whereIn('status_order', ['done'])
        ->where('penulis_id', Auth::user()->id)
        ->where('klaim', 0)
        ->whereMonth('tanggal_ambil', $month)
        ->whereYear('tanggal_ambil', $year)
        ->sum('harga_penulis');

        // dd($orders);

        if (count($orders) > 0) {
            try {
                $invoice = new Invoice();
                $invoice->penulis_id = Auth::user()->id;
                $invoice->nominal = $nominal;
                $invoice->tanggal_klaim = date('Y-m-d H:i:s');
                $invoice->status = 'pending';
                $invoice->save();

                foreach ($orders as $key => $order) {
                    Order::where('id', $order->id)->update(['klaim' => '1']);

                    $item = new ItemInvoice();
                    $item->invoice_id = $invoice->id;
                    $item->order_id = $order->id;
                    $item->nominal = $order->harga_penulis;
                    $item->save();
                }

                return redirect()->route('penulis.invoice')->with(['success' => 'Invoice berhasil digenerate!']);
            } catch (\Exception $e) {
                dd($e);
            }
        }else{
            return redirect()->back()->with(['warning' => 'Tidak ada transaksi bulan lalu!']);
        }
    }

    public function invoice()
    {
        $invoices = Invoice::where('penulis_id', Auth::user()->id)
        ->orderBy('created_at', 'DESC')
        ->get();
        // dd($joblists);
        return view('penulis.payment.invoice', compact('invoices'));
    }


    public function invoiceDetail($id)
    {
        $invoice = Invoice::with(['penulis'])->where('id', $id)
        ->orderBy('created_at', 'DESC')
        ->first();

        $item_invoices = ItemInvoice::with(['order'])
        ->where('invoice_id', $id)
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('penulis.payment.detail', compact('invoice','item_invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
