<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\TipeArtikel;
use Auth;
use File;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->type);
        if (Auth::user()->role == 'admin' && Auth::user()->type == 'finance') {
            $orders = Order::with(['user', 'tipe_artikel', 'harga', 'penulis', 'pembeli'])
            // ->whereIn('status', ['pending', 'paid', 'done'])
            ->whereIn('status', ['pending', 'paid'])
            ->orderBy('updated_at', 'DESC')
            ->get();
        }else{
            $orders = Order::with(['user', 'tipe_artikel', 'harga', 'penulis', 'pembeli'])
            ->whereIn('status_order', ['uploaded', 'rejected', 'done'])
            ->orderBy('updated_at', 'DESC')
            ->get();
        }
        
        // dd($orders);
        return view('admin.order.index', compact('orders'));
    }

    public function verifikasiPayment($id, $status)
    {
        // dd($status);
        if ($status == 'paid') {
            $tanggal_bayar = date('Y-m-d H:i:s');
        }else{
            $tanggal_bayar = NULL;
        }
        // dd($tanggal_bayar);
        Order::where('id', $id)->update([
            'note' => request()->note,
            'status' => $status,
            'tanggal_bayar' => $tanggal_bayar,
        ]);
        return redirect()->route('admin.order.verifikasi')->with(['success' => 'Status berhasil diubah menjadi '.ucwords($status).'!']);
    }

    public function verifikasiArtikel($id, $status)
    {
        if ($status == 'done') {
            $array = [
                'note' => request()->note,
                'status_order' => $status,
                'tanggal_selesai' => date('Y-m-d H:i:s')
            ];
        }else{
            $array = [
                'note' => request()->note,
                'status_order' => $status
            ];
        }
        Order::where('id', $id)->update($array);
        return redirect()->route('admin.order.verifikasi')->with(['success' => 'Status berhasil diubah menjadi '.ucwords($status).'!']);
    }

    public function indexArtikel()
    {
         $orders = Order::with(['user', 'tipe_artikel', 'harga', 'penulis', 'pembeli'])
        ->whereIn('status_order', ['overtime'])
        ->orderBy('deadline', 'ASC')
        ->get();

        return view('admin.artikel.index', compact('orders'));
    }

    public function editArtikel(Request $request)
	{
		$id = $request->id;
		$result = '<input type="hidden" name="id" value="'.$id.'">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="cars">File Artikel (pdf, doc, docx) :</label><br>
                <input type="file" name="file_artikel" required>
            </div>
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-space btn-default" onclick="hideUploadFile()">Batal</button>&nbsp;
                <button type="submit" class="btn btn-primary">UPLOAD</button>
            </div>
		</div>';
		// dd($result);
		return $result;
	}

    public function updateArtikel(Request $request)
    {
        $rules = [
            'file_artikel'  => 'required|mimes:pdf,doc,docx',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with(['warning' => 'File artikel harus pdf/doc/docx!']);
        }

        try {
            $file = 'File_Artikel'.$request->id.'_'.time().'.'.$request->file('file_artikel')->getClientOriginalExtension();
            $image = $request->file('file_artikel');
            $image->storeAs('public/article', $file);

            Order::where('id', $request->id)->update([
                'file_artikel'   => $file,
                'penulis_id'   => Auth::user()->id,
                'status_order' => 'done',
                'tanggal_selesai' => date("Y-m-d H:i:s"),
                'note' => NULL
            ]);
            return redirect()->back()->with(['success' => 'File artikel berhasil diupload!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
