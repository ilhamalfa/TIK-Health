<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class biodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pergi ke halaman dashboard
        return view('dashboard.dashboard');
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
        // Mendeklarasikan atribut data beserta isinya
        $data['nama'] = $request->nama;
        $data['bb'] = $request->bb;
        $data['status'] = '';
        $data['hobi'] = strtok($request->hobi, ',');
        // atribut tb diubah menjadi M
        $data['tb'] = $request->tb/100;
        // Menghitung nilai BMI
        $data['bmi'] = $data['bb'] / ($data['tb'] * $data['tb']);

        // Pengecekan status bmi
        if($data['bmi'] < 18.5){
            $data['status'] = 'Kurus';
        }else if($data['bmi'] <= 22.9){
            $data['status'] = 'Normal';
        }else if($data['bmi'] <= 29.9){
            $data['status'] = 'Gemuk';
        }else if($data['bmi'] > 29.9){
            $data['status'] = 'Obesitas';
        }

        // Mendeklarasikan atribut class yang mana memanggil class konsultasi dengan parameter tahun dan status
        $class = new konsultasi($request->tahun, $data['status']);

        // Mengisi atribut data dengan hasil dari method dari class
        $data['umur'] = $class->hitungUmur();
        $data['konsul'] = $class->konsul();

        // dd($data);
        
        // Pergi ke halaman dashboard dengan membawa data
        return view('dashboard.dashboard', [
            'data' => $data
        ]);
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

// Kelas Umur
class umur{
    // Mendeklarrasikan atribut tahun dan status
    public $tahun;
    public $status;

    // Construct yang mana akan dijalankan terlebih dahulu
    public function __construct($tahun, $status)
    {
        $this->tahun = $tahun;
        $this->status = $status;
    }

    // Method hitungumur untuk menghitung umur
    public function hitungUmur(){
        return 2022 - $this->tahun;
    }
}

// class konsultasi turunan dari kelas umur
class konsultasi extends umur{
    // Method untuk mengecek umur apakah sudah dewasa atau tidak
    public function cekUmur(){
        if($this->hitungUmur() >= 17){
            return 'Dewasa';
        }else{
            return 'Belum Dewasa';
        }
    }

    // Method untuk mengecek apakah dapat mendapatkan konsultasi gratis
    public function konsul(){
        if($this->cekUmur() == 'Dewasa' && $this->status == 'Obesitas'){
            return 'Anda bisa mendapatkan Konsultasi gratis';
        }else{
            return 'Anda tidak bisa mendapatkan Konsultasi gratis';
        }
    }
}