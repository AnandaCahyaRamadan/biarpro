@extends('layouts.main')
@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Edit User</h2>
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal auth-form my-4" action="{{ route('user.update', ['id' => Crypt::encryptString($user->id)]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="js-example-basic-single form-control @error('role') is-invalid @enderror" style="width: 100%" id="role" name="role" required>
                            @foreach($role as $item)
                                <option value="{{ $item->id }}" {{ ($user->hasRole($item->name)) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-sm-0">
                            <label for="first_name">Nama Depan</label>
                            <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                placeholder="Masukkan Nama Depan" value="{{ $user->first_name }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mb-sm-0">
                            <label for="last_name">Nama Belakang</label>
                            <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                placeholder="Masukkan Nama Belakang" value="{{ $user->last_name }}">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email"
                            placeholder="Masukkan Alamat Email" value="{{ $user->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="no_personal">Telepon Personal</label>
                            <input type="text" class="form-control form-control-user @error('no_personal') is-invalid @enderror"
                                id="no_personal" name="no_personal" placeholder="Masukkan Nomor Telepon Personal" value="{{ $user->no_personal }}">
                            @error('no_personal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="no_bisnis">Telepon Bisnis</label>
                            <input type="text" class="form-control form-control-user"
                                id="no_bisnis" placeholder="Nomor Telepon Bisnis" name="no_bisnis" value="{{ $user->no_bisnis }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori_bisnis_id">Kategori Bisnis</label>
                        <select class="form-control @error('kategori_bisnis_id') is-invalid @enderror" id="kategori_bisnis_id" name="kategori_bisnis_id">
                            <option selected disabled>Pilih Kategori Bisnis ..</option>
                            @foreach ($kategori_bisnis as $bisnis)
                                <option value="{{ $bisnis->id }}" {{  ($user->kategori_bisnis_id == $bisnis->id) ? 'selected' : '' }}>{{ $bisnis->name }}</option>
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
                                placeholder="Masukkan Alamat" value="{{ $user->alamat }}">
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
                            <input type="text" class="form-control form-control-user @error('link_website') is-invalid @enderror" id="link_website" name="link_website"
                                placeholder="Masukkan Link Website" value="{{ $user->link_website }}">
                            @error('link_website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="password">Re-Password</label>
                            <input type="password" class="form-control form-control-user"
                                id="password-confirm" placeholder="Ulangi Password" name="password_confirmation">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
