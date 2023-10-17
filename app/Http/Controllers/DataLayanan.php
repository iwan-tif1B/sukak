<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_layanan as Layanan;
use Illuminate\Support\Facades\Validator;

class DataLayanan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Manajemen Layanan";
        $data['data'] = Layanan::all();
        return view('layanan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Manajemen Layanan";
        return view('layanan.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required',
            'deskripsi_layanan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Layanan::create([
            'nama_layanan'   => $request->nama_layanan,
            'deskripsi_layanan' => $request->deskripsi_layanan,

        ]);

        if ($post) {
            return redirect()->route('m-layanan.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Kesalahan Server Data Tidak Tersimpan');
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
        $data['title'] = "Manajemen Layanan";
        $data['data'] = Layanan::where('id_layanan', $id)->first();
        return view('layanan.edit', $data);
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
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required',
            'deskripsi_layanan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Layanan::where('id_layanan', $id)->update([
            'nama_layanan'   => $request->nama_layanan,
            'deskripsi_layanan' => $request->deskripsi_layanan,

        ]);

        if ($post) {
            return redirect()->route('m-layanan.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Kesalahan Server Data Tidak Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Layanan::findOrfail($id);
        $delete->delete();
        return redirect()->route('m-layanan.index')->with('success', 'Data Petugas Berhasil Dihapus');
    }
}
