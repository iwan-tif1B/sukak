@extends('layouts.main')
@section('content')
    <style>
        li.myitem:hover {
            background-color: #ccc;
            /* Warna latar belakang saat dihover */
            cursor: pointer;
            /* Mengubah ikon kursor menjadi tangan saat dihover */
        }
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="row ">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Form Ubah Data Pasien</h6>

                    <form action="{{ route('trx-registrasi.update', $regis->id_registrasi) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <fieldset>
                            <legend>Data Pasien</legend>
                            <input type="hidden" name="id_pasien" value="{{ $pasien->id_pasien }}" id="id_pasien">
                            <div class="row mb-3">
                                <label for="no_rekam_medis" class="col-sm-2 col-form-label">No Rekam Medis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_rekam_medis" name="no_rekam_medis"
                                        readonly value="{{ $pasien->no_rekam_medis }}">
                                    @if ($errors->first('no_rekam_medis'))
                                        <small class="text-danger"> No Rekam Medis Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="namapasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namapasien" name="nama_pasien"
                                        value="{{ $pasien->nama_pasien }}" disabled>
                                    @if ($errors->first('nama_pasien'))
                                        <small class="text-danger"> nama pasien Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_kelamin" id="jeniskelamin" class="form-control" disabled>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki"
                                            {{ $pasien->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki Laki</option>
                                        <option value="perempuan"
                                            {{ $pasien->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @if ($errors->first('jenis_kelamin'))
                                        <small class="text-danger"> Jenis Kelamin Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggallahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggallahir" name="tanggal_lahir"
                                        disabled value="{{ $pasien->tanggal_lahir }}">
                                    @if ($errors->first('tanggal_lahir'))
                                        <small class="text-danger"> Tanggal Lahir Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Data Registrasi Pelayanan</legend>
                            <div class="row mb-3">
                                <label for="waktu_registrasi" class="col-sm-2 col-form-label">Waktu Registrasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="waktu_registrasi" name="waktu_registrasi"
                                        readonly value="{{ $regis->created_at }}">
                                    @if ($errors->first('waktu_registrasi'))
                                        <small class="text-danger"> Waktu Registrasi Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="no_registrasi" class="col-sm-2 col-form-label">No Registasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_registrasi" name="no_registrasi"
                                        value="{{ $regis->no_registrasi }}" readonly>
                                    @if ($errors->first('no_registrasi'))
                                        <small class="text-danger"> No Registrasi Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_registrasi" class="col-sm-2 col-form-label">Jenis Registrasi</label>
                                <div class="col-sm-10">
                                    <select name="jenis_registrasi" class="form-control" id="">
                                        <option value="">Pilih Jenis registrasi</option>
                                        @foreach ($jregis as $value)
                                            <option {{ ($regis->jenis_registrasi == $value ? 'selected':'') }} value="{{ $value }}">{{ $value }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->first('jenis_registrasi'))
                                        <small class="text-danger"> Jenis Registrasi Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_registrasi" class="col-sm-2 col-form-label">Jenis Pembayaran</label>
                                <div class="col-sm-10">
                                    <select name="jenis_pembayaran" class="form-control" id="">
                                        <option value="">Pilih Pembayaran</option>
                                        @foreach ($jpembayaran as $value)
                                            <option {{ ($regis->jenis_pembayaran == $value ? 'selected':'') }} value="{{ $value }}">{{ $value }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->first('jenis_pembayaran'))
                                        <small class="text-danger"> Jenis pembayaran Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_registrasi" class="col-sm-2 col-form-label">Status Registrasi</label>
                                <div class="col-sm-10">
                                    <select name="status_registrasi" id="" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option {{ ($regis->status_registrasi == 'Aktif' ? 'selected':'') }} value="Aktif">Aktif</option>
                                        <option {{ ($regis->status_registrasi == 'Tutup Kunjungan' ? 'selected':'') }} value="Tutup Kunjungan">Tutup Kunjungan</option>
                                    </select>
                                    @if ($errors->first('jenis_registrasi'))
                                        <small class="text-danger"> Status Registrasi Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jenis_registrasi" class="col-sm-2 col-form-label">Jenis Pelayanan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_layanan">
                                        <option value="">Pilih Layanan</option>
                                        @foreach ($layanan as $index => $rows)
                                            <option {{ ($regis->id_layanan == $rows->id_layanan ? 'selected':'') }} value="{{ $rows->id_layanan }}">{{ $rows->nama_layanan }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->first('jenis_registrasi'))
                                        <small class="text-danger"> Jenis Pelayanan Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="mulai_layanan" class="col-sm-2 col-form-label">Waktu Mulai Pelayanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mulai_layanan"
                                        name="waktu_mulai_layanan" value="{{ $regis->waktu_mulai_layanan }}">
                                    @if ($errors->first('waktu_mulai_layanan'))
                                        <small class="text-danger"> Waktu Mulai Layanan Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="waktu_selesai_layanan" class="col-sm-2 col-form-label">Waktu Selesai
                                    Pelayanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="waktu_selesai_layanan"
                                        name="waktu_selesai_layanan" value="{{ $regis->waktu_selesai_layanan }}">
                                    @if ($errors->first('waktu_selesai_layanan'))
                                        <small class="text-danger"> Jenis Registrasi Tidak Boleh Kosong</small>
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('trx-registrasi.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#mulai_layanan,#waktu_selesai_layanan').datetimepicker({
                format: 'Y-m-d H:i', // Date and time format
            });
            $('#searchInput').on('input', function() {
                let search = $(this).val();
                let results = $('#searchResults');
                if (search == '') {
                    $('#searchResults li').remove();
                    return;
                }
                $.ajax({
                    url: '{{ route('searchdata') }}',
                    type: 'GET',
                    data: {
                        search: search
                    },
                    success: function(data) {
                        $('#searchResults li').remove();
                        let patients = data.patients;

                        if (patients.length > 0) {
                            patients.forEach(function(patient) {
                                results.append(
                                    `<li class="list-group-item myitem additem" data-id="` +
                                    patient.id_pasien + `">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span>No Rekam Medis : ` + patient.no_rekam_medis + ` </span><br>
                                            <span>Nama Pasien : ` + patient.nama_pasien + `</span><br>
                                            <span>Tanggal Lahir : ` + patient.tanggal_lahir + `</span>
                                        </div>
                                    </div>
                                </li>`);
                            });
                        } else {
                            results.append(`<li class="list-group-item">
                                    <button class="btn btn-primary w-100 m-2 newdata" type="button">Buat Data Pasien</button>
                                </li>`);
                        }
                    }
                });
            });

            $('#searchResults').on('click', '.newdata', function() {
                $('#namapasien,#jeniskelamin,#tanggallahir').removeAttr('disabled')
                $.ajax({
                    type: "GET",
                    url: "{{ route('norekmedis') }}",
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        $('#searchInput').val('')
                        $('#searchResults li').remove();
                        $('#no_rekam_medis').val(response);
                        $('#id_pasien').val('0')
                    }
                });
            });

            $('#searchResults').on('click', '.additem', function() {
                let uid = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ url('DataPasien') }}/" + uid,
                    dataType: "JSON",
                    success: function(response) {
                        $('#id_pasien').val(response.id_pasien)
                        $('#no_rekam_medis').val(response.no_rekam_medis)
                        $('#namapasien').val(response.nama_pasien)
                        $('#jeniskelamin').val(response.jenis_kelamin)
                        $('#tanggallahir').val(response.tanggal_lahir)
                    }
                });
            });
        });
    </script>
@endsection
