<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\TipeArtikel;
use App\Models\Log;
use Auth;
use File;

class JobListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = Log::where('penulis_id', Auth::user()->id)->pluck('order_id')->toArray();
        $joblists = Order::with(['user', 'tipe_artikel', 'harga'])
        ->whereNotIn('id', $log)
        ->where('status', 'paid')
        ->whereIn('status_order', ['pending', 'overtime'])
        ->orderBy('created_at', 'DESC')
        ->get();
        return view('penulis.joblist.index', compact('joblists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ambil(Request $request)
    {
        $order = Order::with(['log'])->where('id', $request->id)->first();
        if ($order->status == 'paid') {
            try {
                $now = date('Y-m-d H:i:s');
                $maxDate = date('Y-m-d H:i:s', strtotime($now. ' + 2 days'));
                $deadline = date('Y-m-d H:i:s', strtotime($now. ' + 7 days'));

                if (count($order->log) == 0) {
                    Order::where('id', $request->id)->update([
                        'penulis_id' => Auth::user()->id,
                        'status_order' => 'onprogress',
                        'tanggal_ambil' => $now,
                        'deadline' => $deadline,
                    ]);
                }else{
                    Order::where('id', $request->id)->update([
                        'penulis_id' => Auth::user()->id,
                        'status_order' => 'onprogress',
                        'tanggal_ambil' => $now,
                    ]);
                }

                $result = [
                    'status' => 'success',
                    'message' => "Job berhasil diambil!! Deadline pengerjaan artikel tanggal ".tgl_indo($maxDate)
                ];
                return response()->json($result);
                // return redirect()->route('penulis.progress');
            } catch (\Exception $e) {
                dd($e);
            }
        }else{
            $result = [
                'status' => 'warning',
                'message' => "Orderan belum Paid!!"
            ];
            return response()->json($result);
        }
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
