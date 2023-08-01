<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Order;
use App\Models\Artikel;
use App\Models\TipeArtikel;
use App\Models\Invoice;
use App\Models\ItemInvoice;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikels = Artikel::with(['penulis', 'tipe_artikel'])->where('penulis_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        // dd($artikels);
        $tipe_artikels = TipeArtikel::get();
        
        $fee = Invoice::where('penulis_id', Auth::user()->id)->whereMonth('tanggal_klaim', date('m'))->whereYear('tanggal_klaim', date('Y'))->sum('nominal');
        $paid = Order::where('penulis_id', Auth::user()->id)->where('status', 'paid')->count();
        $onprogress = Order::where('penulis_id', Auth::user()->id)->whereNotIn('status', ['paid', 'done'])->count();
        $done = Order::where('penulis_id', Auth::user()->id)->where('status', 'done')->count();

        $invoice = [
            'paid' => Invoice::where('penulis_id', Auth::user()->id)->where('status', 'paid')->count(),
            'pending' => Invoice::where('penulis_id', Auth::user()->id)->where('status', 'pending')->count(),
        ];

        return view('penulis.dashboard', compact('artikels', 'tipe_artikels', 'fee', 'paid', 'onprogress', 'done', 'invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resubmit(Request $request)
    {
        // dd($request->all());
        $file = 'Article_'.Auth::user()->id.'_'.str_replace(' ', '_', $request->judul).'_'.time().'.'.$request->file('article')->getClientOriginalExtension();
		$article_destination = base_path().'/public/article';
	    $request->file('article')->move($article_destination, $file);

        try {
            $article = new Artikel();
            $article->penulis_id = Auth::user()->id;
            $article->judul = $request->judul;
            $article->file = $file;
            $article->tipe_artikel_id = $request->tipe_artikel_id;
            $article->status = 'submitted';
            $article->save();
        } catch (\Exception $e) {
            dd($e);
        }

        User::where('id', Auth::user()->id)
        ->update([
            'artikel' => Auth::user()->artikel + 1,
            'tanggal_artikel' => date("Y-m-d H:i:s")
        ]);

        return redirect()->back();
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
