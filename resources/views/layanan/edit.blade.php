@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Form Edit Data Pasien</h6>
                    <form action="{{ route('m-layanan.update',$data->id_layanan) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <label for="no_rekam_medis" class="col-sm-2 col-form-label">Nama Layanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_rekam_medis" name="nama_layanan"
                                     value="{{ $data->nama_layanan }}">
                                @if ($errors->first('nama_layanan'))
                                    <small class="text-danger"> Nama Layanan Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="namapasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namapasien" name="deskripsi_layanan" value="{{ $data->deskripsi_layanan }}">
                                @if ($errors->first('deskripsi_layanan'))
                                    <small class="text-danger"> nama pasien Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('m-petugas.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
