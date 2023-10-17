@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Form Edit Data Pasien</h6>
                    <form action="{{ route('m-pasien.update',$data->id_pasien) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <label for="no_rekam_medis" class="col-sm-2 col-form-label">No Rekam Medis</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_rekam_medis" name="no_rekam_medis"
                                    readonly value="{{ $data->no_rekam_medis }}">
                                @if ($errors->first('no_rekam_medis'))
                                    <small class="text-danger"> No Rekam Medis Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="namapasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namapasien" name="nama_pasien" value="{{ $data->nama_pasien }}">
                                @if ($errors->first('nama_pasien'))
                                    <small class="text-danger"> nama pasien Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jenis_kelamin" id="jeniskelamin" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" {{ ($data->jenis_kelamin == 'laki-laki' ? 'selected':'') }}>Laki Laki</option>
                                    <option value="perempuan" {{ ($data->jenis_kelamin == 'perempuan' ? 'selected':'') }}>Perempuan</option>
                                </select>
                                @if ($errors->first('jenis_kelamin'))
                                    <small class="text-danger"> Jenis Kelamin Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggallahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggallahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                                @if ($errors->first('tanggal_lahir'))
                                    <small class="text-danger"> Tanggal Lahir Tidak Boleh Kosong</small>
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
