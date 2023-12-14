@extends('layouts.main')
@section('content')
<div class="row pb-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header py-3">
                <h2>Ubah Profil Anda</h2>
            </div>
            <div class="card-body">
                <form class= "form-horizontal auth-form" action="{{ route('profile.update', ['id' => Crypt::encryptString($profile->id)]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <select class="js-example-basic-single form-control @error('role') is-invalid @enderror" style="width: 100%" id="role" name="role" hidden>
                            @foreach($role as $item)
                                <option value="{{ $item->id }}" {{ ($profile->hasRole($item->name)) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="text-danger">*Lengkapi profile anda</p>
                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                placeholder="Masukkan Nama Depan" value="{{ $profile->first_name }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                placeholder="Masukkan Nama Belakang" value="{{ $profile->last_name }}">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email"
                            placeholder="Masukkan Alamat Email" value="{{ $profile->email }}" hidden>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="no_personal">Nomor Telepon Personal</label>
                            <input type="text" class="form-control form-control-user @error('no_personal') is-invalid @enderror"
                                id="no_personal" name="no_personal" placeholder="Masukkan Nomor Telepon Personal" value="{{ $profile->no_personal }}">
                            @error('no_personal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_bisnis">Nomor Telepon Bisnis</label>
                            <input type="text" class="form-control form-control-user"
                                id="no_bisnis" placeholder="Nomor Telepon Bisnis" name="no_bisnis" value="{{ $profile->no_bisnis }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_bisnis">Kategori Bisnis</label>
                        <select class="form-control @error('kategori_bisnis_id') is-invalid @enderror" id="kategori_bisnis_id" name="kategori_bisnis_id">
                            <option selected disabled>Pilih Kategori Bisnis ..</option>
                            @foreach ($kategori_bisnis as $bisnis)
                                <option value="{{ $bisnis->id }}" {{  ($profile->kategori_bisnis_id == $bisnis->id) ? 'selected' : '' }}>{{ $bisnis->name }}</option>
                            @endforeach
                        </select>                            
                        @error('kategori_bisnis_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                placeholder="Masukkan Alamat" value="{{ $profile->alamat }}">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="link_website">Link Website</label>
                            <small class="text-danger"> *jika ada</small>
                            <input type="text" class="form-control form-control-user @error('link_website') is-invalid @enderror" id="link_website" name="link_website"
                                placeholder="Masukkan Link Website" value="{{ $profile->link_website }}">
                            @error('link_website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="affiliate_code">Kode Affiliasi</label>
                            <input type="text" class="form-control form-control-user @error('affiliate_code') is-invalid @enderror" id="affiliate_code" name="affiliate_code"
                                placeholder="" value="http://127.0.0.1:8000/biarpro/{{ $profile->affiliate_code }}" disabled>
                            @error('affiliate_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header py-3">
                <h2>Ubah Password</h2>
            </div>
            <div class="card-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Ulangi Password</label>
                            <input type="password" class="form-control form-control-user"
                                id="password-confirm" placeholder="Ulangi Password" name="password_confirmation">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
