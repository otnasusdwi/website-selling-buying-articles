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
use Auth;
use File;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $omset = Order::whereMonth('tanggal_order', date('m'))->whereYear('tanggal_order', date('Y'))->sum('harga');
        $fee = Order::whereMonth('tanggal_order', date('m'))->whereYear('tanggal_order', date('Y'))->sum('potongan');

        $order = [
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'onprogress' => Order::whereNotIn('status', ['paid', 'done', 'pending'])->count(),
            'done' => Order::where('status', 'done')->count(),
        ];

        $invoice = [
            'paid' => Invoice::where('status', 'paid')->count(),
            'pending' => Invoice::where('status', 'pending')->count(),
        ];
        // dd($fee);
        return view('admin.dashboard')->with([
            'omset' => $omset,
            'fee' => $fee,
            'order' => $order,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
