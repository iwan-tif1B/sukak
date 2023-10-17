<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\trx_registrasi as Registrasi;
use App\Models\master_layanan as layanan;
use App\Models\master_pasien as pasien;
use Illuminate\Support\Facades\Validator;
use Session;

class DataRegistrasi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Manajemen Registrasi";
        if (session()->get('user_role') == 1) {
            $data['data'] = Registrasi::select('trx_registrasis.*', 'master_pasiens.no_rekam_medis', 'master_pasiens.nama_pasien', 'master_pasiens.jenis_kelamin', 'master_pasiens.tanggal_lahir', 'master_layanans.nama_layanan', 'master_petugas.nama_petugas')
                ->join('master_pasiens', 'master_pasiens.id_pasien', '=', 'trx_registrasis.id_pasien')
                ->join('master_petugas', 'master_petugas.id_petugas', '=', 'trx_registrasis.id_petugas')
                ->join('master_layanans', 'master_layanans.id_layanan', '=', 'trx_registrasis.id_layanan')
                ->get();
        } else {
            $data['data'] = Registrasi::select('trx_registrasis.*', 'master_pasiens.no_rekam_medis', 'master_pasiens.nama_pasien', 'master_pasiens.jenis_kelamin', 'master_pasiens.tanggal_lahir', 'master_layanans.nama_layanan', 'master_petugas.nama_petugas')
                ->join('master_pasiens', 'master_pasiens.id_pasien', '=', 'trx_registrasis.id_pasien')
                ->join('master_petugas', 'master_petugas.id_petugas', '=', 'trx_registrasis.id_petugas')
                ->join('master_layanans', 'master_layanans.id_layanan', '=', 'trx_registrasis.id_layanan')
                ->where('trx_registrasis.id_petugas', '=', session()->get('uid')) //yang baru di tambahkan
                ->get();
        }

        return view('registrasi.index', $data);
    }

    function printview()
    {
        $data['data'] = Registrasi::select('trx_registrasis.*', 'master_pasiens.no_rekam_medis', 'master_pasiens.nama_pasien', 'master_pasiens.jenis_kelamin', 'master_pasiens.tanggal_lahir', 'master_layanans.nama_layanan', 'master_petugas.nama_petugas')
            ->join('master_pasiens', 'master_pasiens.id_pasien', '=', 'trx_registrasis.id_pasien')
            ->join('master_petugas', 'master_petugas.id_petugas', '=', 'trx_registrasis.id_petugas')
            ->join('master_layanans', 'master_layanans.id_layanan', '=', 'trx_registrasis.id_layanan')
            ->get();
        return view('registrasi.print', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Manajemen Registrasi";
        $data['jregis'] = ['Rawat jalan', 'UGD', 'Rawat Inap', 'ICU'];
        $data['jpembayaran'] = ['Umum', 'BPJS Kesehatan', 'Mandiri Inhealt', 'BNI Life'];
        $data['layanan'] = layanan::all();
        $data['datenow'] = Carbon::now();
        $data['no_regis'] = $this->noregistrasi();
        return view('registrasi.add', $data);
        // echo $data['no_regis'];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id_pasien == 0) {
            $validator = Validator::make($request->all(), [
                'no_rekam_medis'   => 'required',
                'nama_pasien' => 'required',
                'jenis_kelamin' => 'required',
                'tanggal_lahir' => 'required',
                'no_registrasi' => 'required',
                'jenis_registrasi' => 'required',
                'jenis_pembayaran' => 'required',
                'status_registrasi' => 'required',
                'id_layanan' => 'required',
                'waktu_mulai_layanan' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $paseins = pasien::create([
                'no_rekam_medis'   => $request->no_rekam_medis,
                'nama_pasien' => $request->nama_pasien,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);
            $last_id = pasien::latest()->first()->id_pasien;
            $trx = Registrasi::create([
                'id_pasien' => $last_id,
                'no_registrasi' => $request->no_registrasi,
                'jenis_registrasi' => $request->jenis_registrasi,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'status_registrasi' => $request->status_registrasi,
                'id_layanan' => $request->id_layanan,
                'waktu_mulai_layanan' => $request->waktu_mulai_layanan,
                'id_petugas' => $request->session()->get('uid')
            ]);

            if ($trx) {
                return redirect()->route('trx-registrasi.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
            }
        } else {
            $validator = Validator::make($request->all(), [
                'no_registrasi' => 'required',
                'jenis_registrasi' => 'required',
                'jenis_pembayaran' => 'required',
                'status_registrasi' => 'required',
                'id_layanan' => 'required',
                'waktu_mulai_layanan' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $trx = Registrasi::create([
                'id_pasien' => $request->id_pasien,
                'no_registrasi' => $request->no_registrasi,
                'jenis_registrasi' => $request->jenis_registrasi,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'status_registrasi' => $request->status_registrasi,
                'id_layanan' => $request->id_layanan,
                'waktu_mulai_layanan' => $request->waktu_mulai_layanan,
                'id_petugas' => $request->session()->get('uid')
            ]);

            if ($trx) {
                return redirect()->route('trx-registrasi.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
            }
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
    public function edit($id)
    {
        $data['title'] = "Manajemen Registrasi";
        $dataRegis = Registrasi::where('id_registrasi', $id)->first();
        $data['jregis'] = ['Rawat jalan', 'UGD', 'Rawat Inap', 'ICU'];
        $data['jpembayaran'] = ['Umum', 'BPJS Kesehatan', 'Mandiri Inhealt', 'BNI Life'];
        $data['layanan'] = layanan::all();
        $data['pasien'] = pasien::where('id_pasien', $dataRegis->id_pasien)->first();
        $data['regis'] = $dataRegis;
        return view('registrasi.edit', $data);
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
            'no_registrasi' => 'required',
            'jenis_registrasi' => 'required',
            'jenis_pembayaran' => 'required',
            'status_registrasi' => 'required',
            'id_layanan' => 'required',
            'waktu_mulai_layanan' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $trx = Registrasi::where('id_registrasi', $id)->update([
            'id_pasien' => $request->id_pasien,
            'no_registrasi' => $request->no_registrasi,
            'jenis_registrasi' => $request->jenis_registrasi,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'status_registrasi' => $request->status_registrasi,
            'id_layanan' => $request->id_layanan,
            'waktu_mulai_layanan' => $request->waktu_mulai_layanan,
            'waktu_selesai_layanan' => $request->waktu_selesai_layanan,
            'id_petugas' => $request->session()->get('uid')
        ]);

        if ($trx) {
            return redirect()->route('trx-registrasi.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
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
        $delete = Registrasi::findOrfail($id);
        $delete->delete();
        return redirect()->route('trx-registrasi.index')->with('success', 'Data Petugas Berhasil Dihapus');
    }

    function noregistrasi()
    {
        // Dapatkan dua digit terakhir dari tahun saat ini
        $tahun = Carbon::now()->format('y');

        // Dapatkan dua digit terakhir dari bulan saat ini
        $bulan = Carbon::now()->format('m');

        // Dapatkan dua digit terakhir dari tanggal saat ini
        $tanggal = Carbon::now()->format('d');

        // Dapatkan nomor urut terakhir dari database
        $nomorUrutTerakhir = Registrasi::whereDate('created_at', Carbon::today())
            ->max('no_registrasi');
        $newurut = substr($nomorUrutTerakhir, 6);
        // Jika tidak ada nomor urut sebelumnya, inisialisasi dengan 1
        if (!$newurut) {
            $newurut = 1;
        } else {
            // Jika ada nomor urut sebelumnya, tambahkan 1
            $newurut++;
        }

        // Format nomor urut dengan leading zeros
        $nomorUrutFormatted = sprintf("%04d", $newurut);


        // Gabungkan tahun, bulan, tanggal, dan nomor urut untuk membentuk nomor registrasi
        $nomorRegistrasi = $tahun . $bulan . $tanggal . $nomorUrutFormatted;

        return $nomorRegistrasi;
    }

    function closingvisite(Request $request, $id)
    {
        $trx = Registrasi::where('id_registrasi', $id)->update([
            'waktu_selesai_layanan' => Carbon::now(),
            'id_petugas' => $request->session()->get('uid')
        ]);

        if ($trx) {
            return redirect()->route('trx-registrasi.index')->with('success', 'Data Pasien Berhasil Ditambahkan');
        }
    }
}
