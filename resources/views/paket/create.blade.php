@extends('layouts.main')
@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Tambah Paket</h2>
        <div class="card">
            <div class="card-body">
                <form class= "form-horizontal auth-form my-4" action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                    <!--end form-group-->
                    @csrf
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="nama_paket">Nama Paket</label>
                            <input type="text" class="form-control form-control-user @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket"
                                placeholder="Masukkan Nama Paket" value="{{ old('nama_paket') }}">
                            @error('nama_paket')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="image">Pilih Gambar</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                placeholder="Masukkan Nama Paket" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control form-control-user @error('harga') is-invalid @enderror" id="harga" name="harga"
                            placeholder="Masukkan Harga" value="{{ old('harga') }}">
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_paket">Jenis Paket</label>
                        <select class="form-control form-control-user @error('jenis_paket') is-invalid @enderror" id="jenis_paket" name="jenis_paket">
                            <label for="jenis_paket">Jenis Paket</label>
                            <option value="personal"{{ old('jenis_paket') === 'personal' ? ' selected' : '' }}>Personal</option>
                            <option value="bisnis"{{ old('jenis_paket') === 'bisnis' ? ' selected' : '' }}>Bisnis</option>
                        </select>
                        @error('jenis_paket')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="member">Member</label>
                        <input type="number" class="form-control form-control-user @error('member') is-invalid @enderror" id="member" name="member"
                            placeholder="Masukkan Jumlah Member" value="{{ old('member') }}">
                        @error('member')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="deskripsi">Deskripsi</label>
                            <input id="deskripsi" value="Editor content goes here" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                            <trix-editor input="deskripsi"></trix-editor>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="masa_aktif">Masa Aktif</label>
                            <input type="text" class="form-control form-control-user @error('masa_aktif') is-invalid @enderror" id="masa_aktif" name="masa_aktif"
                                placeholder="Masukkan Masa Aktif" value="{{ old('masa_aktif') }}">
                            @error('masa_aktif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="promo">Promo</label>
                        <select class="form-control form-control-user @error('promo') is-invalid @enderror" id="promo" name="promo">
                            <option selected disabled>Promo Paket ..</option>
                            <option value="1"{{ old('promo') === '1' ? ' selected' : '' }}>Iya</option>
                            <option value="0"{{ old('promo') === '0' ? ' selected' : '' }}>Tidak</option>
                        </select>
                        @error('promo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('paket.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
