<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\TipeArtikel;
use Ramsey\Uuid\Uuid;
use Auth;
use File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['user', 'tipe_artikel', 'harga'])
        ->where('pembeli_id', Auth::user()->id)
        ->where('status_order', 'pending')
        ->whereIn('status', ['paid', 'pending'])
        ->orderBy('created_at', 'DESC')
        ->get();
        // dd($orders);
        return view('pembeli.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipe_artikels = TipeArtikel::get();
        return view('pembeli.order.order', compact('tipe_artikels'));
    }

    public function pricing($tipe_artikel_id)
    {
        $pricing = Harga::where('tipe_artikel_id', $tipe_artikel_id)->get();
        return response()->json($pricing);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $prosentase = prosentase();
            $potongan = $request->harga * $prosentase;

            $order = new Order();
            $order->judul = $request->judul;
            $order->tipe_artikel_id = $request->tipe_artikel_id;
            $order->harga_id = $request->harga_id;
            $order->pembeli_id = Auth::user()->id;
            $order->tanggal_order = date('Y-m-d H:i:s');
            $order->harga = $request->harga;
            $order->prosentase = $prosentase;
            $order->potongan = $potongan;
            $order->harga_penulis = $request->harga - $potongan;
            $order->status = 'pending';
            $order->save();

            return redirect()->route('pembeli.artikel')->with(['success' => 'Berhasil order artikel!']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
	{
		$id = $request->id;
		$result = '<input type="hidden" name="id" value="'.$id.'">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="cars">File Bukti Transfer (jpg, jpeg, png):</label><br>
                <input type="file" name="bukti_tf" required>
            </div>
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-space btn-default" onclick="hideUploadTF()">Batal</button>&nbsp;
                <button type="submit" class="btn btn-primary">UPLOAD</button>
            </div>
		</div>';
		// dd($result);
		return $result;
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'bukti_tf' => ['required', 'mimes:jpg,jpeg,png'],
        ]);
        // dd($request);
        try {
            $file = 'BuktiTF_'.$request->id.'_'.time().'.'.$request->file('bukti_tf')->getClientOriginalExtension();
            $image = $request->file('bukti_tf');
            $image->storeAs('public/buktitf', $file);

            Order::where('id', $request->id)
            ->update([
                'bukti_tf'  => $file,
            ]);
            return redirect()->route('pembeli.artikel')->with(['success' => 'Berhasil upload bukti transfer!']);;
        } catch (\Exception $e) {
            dd($e);
        }
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
