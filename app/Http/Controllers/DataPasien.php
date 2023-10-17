<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_pasien as pasien;
use Illuminate\Support\Facades\Validator;

class DataPasien extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Pendaftaran Pasien";
        $data['data'] = pasien::all();
        return view('pasien.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $latestPatient = pasien::latest()->first();
        if ($latestPatient) {
            $latestNoRekamMedis = $latestPatient->no_rekam_medis;
            $parts = explode('-', $latestNoRekamMedis);
            $lastPart = intval(end($parts));

            // Increment the last part and format it with leading zeros
            $nextNoRekamMedis = sprintf('%02d-%02d-%02d-%02d', $parts[0], $parts[1], $parts[2], $lastPart + 1);
        } else {
            // If no patients exist yet, start with "00-00-00-01"
            $nextNoRekamMedis = '00-00-00-01';
        }
        $data['title'] = "Pendaftaran Pasien";
        $data['no_rek_medis'] = $nextNoRekamMedis;
        return view('pasien.add', $data);
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
            'no_rekam_medis'   => 'required',
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = pasien::create([
            'no_rekam_medis'   => $request->no_rekam_medis,
            'nama_pasien' => $request->nama_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        if ($post) {
            return redirect()->route('m-pasien.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Kesalahan Server Data Tidak Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $patients = pasien::where('id_pasien', $id)->first();

        return response()->json($patients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Pendaftaran Pasien";
        $data['data'] = pasien::where('id_pasien', $id)->first();
        return view('pasien.edit', $data);
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
            'no_rekam_medis'   => 'required',
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = pasien::where('id_pasien', $id)->update([
            'no_rekam_medis'   => $request->no_rekam_medis,
            'nama_pasien' => $request->nama_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        if ($post) {
            return redirect()->route('m-pasien.index')->with('success', 'Data Pasien Berhasil Diupdate');
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
        $delete = pasien::findOrfail($id);
        $delete->delete();
        return redirect()->route('m-pasien.index')->with('success', 'Data Petugas Berhasil Dihapus');
    }
    public function norekmedis()
    {
        $latestPatient = pasien::latest()->first();
        if ($latestPatient) {
            $latestNoRekamMedis = $latestPatient->no_rekam_medis;
            $parts = explode('-', $latestNoRekamMedis);
            $lastPart = intval(end($parts));

            // Increment the last part and format it with leading zeros
            $nextNoRekamMedis = sprintf('%02d-%02d-%02d-%02d', $parts[0], $parts[1], $parts[2], $lastPart + 1);
        } else {
            // If no patients exist yet, start with "00-00-00-01"
            $nextNoRekamMedis = '00-00-00-01';
        }

        return response()->json($nextNoRekamMedis);
    }

    function searchdata(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $patients = pasien::where('nama_pasien', 'ILIKE', '%' . $search . '%')
                ->orWhere('no_rekam_medis', 'ILIKE', '%' . $search . '%')
                ->get();
        } else {
            $patients = [];
        }

        return response()->json(['patients' => $patients]);
    }
}
