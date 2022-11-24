<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Seluruh Data Artikel
        $datas = Artikel::all();

        // Seluruh Data Kategori
        $datas2 = Kategori::all();
        
        return view('dashboard.artikel.table', [
            'artikels' => $datas,
            'kategoris' => $datas2
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
        // Memvalidasi inputan user
        $validate = $request->validate([
            'judul' => 'required',
            'foto' => 'required|image|max:10000',
            'isi' => 'required',
            'kategori_id' => 'required'
        ]);

        // Menyimpan foto ke folder artikel/foto
        $file = $request->file('foto')->store('artikel/foto');
        
        // Mengisi atribut foto, tanggal, dan user_id
        $validate['foto'] = $file;
        $validate['tanggal'] = Carbon::now();
        $validate['user_id'] = auth()->user()->id;

        // Membuat data pada database
        Artikel::create($validate);

        // Kembali ke halaman index artikel
        return redirect('artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        // Kondisi Jika user menginput gambar baru
        if(isset($request->foto)){
            // JIka gambar lama masih tersimpan distorage, maka akan dihapus
            if(fileExists($request->oldfoto)){
                unlink('storage/'.$request->oldfoto);
            }

            // Mengisi atribut data
            $data = $request->all();
            // Memvalidasi gambar
            $data = $request->validate([
                'foto' => 'image|max:10000',
            ]);

            // Menyimpan Gambar
            $file = $request->file('foto')->store('artikel/foto');

            // Mengisi atribut data
            $data['foto'] = $file;
            $data['tanggal'] = Carbon::now();
            $data['user_id'] = auth()->user()->id;

            // Mengupdate Data
            $artikel->update($data);
        }else{
            // Mengisi atribut data
            $data = $request->all();

            $data['tanggal'] = Carbon::now();
            $data['user_id'] = auth()->user()->id;

            // Mengupdate Data
            $artikel->update($data);
        }

        return redirect('artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        // Menghapus foto pada storage
        unlink('storage/'.$artikel->foto);

        // Menghapus data dari database
        $artikel->delete();

        return redirect('artikel');
    }
}
