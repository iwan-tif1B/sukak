<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_petugas as petugas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DataPetugas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Manajemen Petugas";
        $data['data'] = petugas::all();
        return view('petugas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Manajemen Petugas";
        return view('petugas.add', $data);
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
            'nama_petugas'   => 'required',
            'departemen' => 'required',
            'jabatan' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = petugas::create([
            'nama_petugas'     => $request->nama_petugas,
            'jabatan'   => $request->jabatan,
            'departemen'   => $request->departemen,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'role'   => $request->role,
        ]);

        if ($post) {
            return redirect()->route('m-petugas.index')->with('success', 'Data Petugas Berhasil Ditambahkan');
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
        $data['title'] = "Manajemen Petugas";
        $data['data'] = petugas::where('id_petugas', $id)->first();
        return view('petugas.edit', $data);
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
            'nama_petugas'   => 'required',
            'departemen' => 'required',
            'jabatan' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fieldUpdate = [
            'nama_petugas'     => $request->nama_petugas,
            'jabatan'   => $request->jabatan,
            'departemen'   => $request->departemen,
            'username'   => $request->username,
            'role'   => $request->role,
        ];
        if (!empty($request->password)) {
            $fieldUpdate['password'] = Hash::make($request->password);
        }
        $post = petugas::where('id_petugas', $id)->update($fieldUpdate);

        if ($post) {
            return redirect()->route('m-petugas.index')->with('success', 'Data Petugas Berhasil Ditambahkan');
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
        $delete = petugas::findOrfail($id);
        $delete->delete();
        return redirect()->route('m-petugas.index')->with('success', 'Data Petugas Berhasil Ditambahkan');
    }
}
