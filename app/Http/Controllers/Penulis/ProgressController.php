<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\TipeArtikel;
use Auth;
use File;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $joblists = Order::with(['user', 'tipe_artikel', 'harga'])
        ->whereNotIn('status_order', ['pending'])
        ->where('penulis_id', Auth::user()->id)
        ->orderBy('created_at', 'DESC')
        ->get();
        // dd($joblists);
        return view('penulis.progress.index', compact('joblists'));
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
    public function edit(Request $request)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
                'status_order' => 'uploaded',
                'note' => NULL
            ]);
            return redirect()->back()->with(['success' => 'File artikel berhasil diupload!']);
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
