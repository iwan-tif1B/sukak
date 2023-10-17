@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Form Tambah Data Pasien</h6>
                    <form action="{{ route('m-layanan.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="namapasien" class="col-sm-2 col-form-label">Nama Layanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namapasien" name="nama_layanan">
                                @if ($errors->first('nama_layanan'))
                                    <small class="text-danger"> nama layanan Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggallahir" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tanggallahir" name="deskripsi_layanan">
                                @if ($errors->first('deskripsi_layanan'))
                                    <small class="text-danger"> keterangan Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('m-layanan.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
