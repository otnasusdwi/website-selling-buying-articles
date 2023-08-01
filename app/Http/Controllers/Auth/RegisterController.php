<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artikel;
use App\Models\TipeArtikel;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Ramsey\Uuid\Uuid;
use File;

class RegisterController extends Controller
{
    public function penulis()
    {
        $tipe_artikels = TipeArtikel::get();
        return view('auth.penulis', compact('tipe_artikels'));
    }

    public function penulisStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'article' => ['required', 'mimes:pdf,doc,docx'],
            'judul' => ['required', 'string', 'max:255'],
            'no_telp' => 'required',
            'password' => 'required',
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 'registered';
            $user->role = 'penulis';
            $user->save();

            $file = 'Article_'.$user->id.'_'.str_replace(' ', '_', $request->judul).'_'.time().'.'.$request->file('article')->getClientOriginalExtension();
		    $article_destination = base_path().'/public/article';
		    $request->file('article')->move($article_destination, $file);

            $article = new Artikel();
            $article->penulis_id = $user->id;
            $article->judul = $request->judul;
            $article->file = $file;
            $article->tipe_artikel_id = $request->tipe_artikel_id;
            $article->status = 'submitted';
            // $article->artikel = 1;
            // $article->tanggal_artikel = date("Y-m-d H:i:s");
            $article->save();

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME)->with(['success' => 'Pendaftaran Penulis Berhasil!']);;

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
