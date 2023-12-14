@extends('layouts.main')
@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Tambah User</h2>
        <div class="card">
            <div class="card-body">

                <form class= "form-horizontal auth-form my-4" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(Auth::user()->hasRole('super-admin'))
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="js-example-basic-single form-control @error('role') is-invalid @enderror"
                            style="width: 100%" id="role" name="role" required>
                            @if(Auth::user()->hasRole('super-admin'))
                            <option selected disabled>Pilih Role ..</option>
                            @foreach($role as $item)
                                <option value="{{ $item->name }}" >{{ $item->name }}</option>
                            @endforeach
                            @else
                                <option selected value="{{ $role }}">{{ $role }}</option>
                            @endif
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    @endif
                    @if(Auth::user()->hasRole('contributor-pro'))
                    <div class="form-group" hidden>
                        <label for="role">Role</label>
                        <select class="js-example-basic-single form-control @error('role') is-invalid @enderror"
                            style="width: 100%" id="role" name="role" required>
                            @if(Auth::user()->hasRole('super-admin'))
                            <option selected disabled>Pilih Role ..</option>
                            @foreach($role as $item)
                                <option value="{{ $item->name }}" >{{ $item->name }}</option>
                            @endforeach
                            @else
                                <option selected value="{{ $role }}">{{ $role }}</option>
                            @endif
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    @endif
                    <!--end form-group-->
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="first_name">Nama Depan</label>
                            <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                placeholder="Masukkan Nama Depan" value="{{ old('first_name') }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="last_name">Nama Belakang</label>
                            <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                placeholder="Masukkan Nama Belakang" value="{{ old('last_name') }}">
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
                            placeholder="Masukkan Alamat Email" value="{{ old('email') }}">
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
                                id="no_personal" name="no_personal" placeholder="Masukkan Nomor Telepon Personal" value="{{ old('no_personal') }}">
                            @error('no_personal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="no_bisnis">Telepon Bisnis</label>
                            <input type="text" class="form-control form-control-user"
                                id="no_bisnis" placeholder="Masukkan Nomor Telepon Bisnis" name="no_bisnis" value="{{ old('no_bisnis') }}">
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('super-admin'))
                    <div class="form-group">
                        <label for="kategori_bisnis_id">Kategori Bisnis</label>
                        <select class="form-control @error('kategori_bisnis_id') is-invalid @enderror" id="kategori_bisnis_id" name="kategori_bisnis_id">
                            @if(Auth::user()->hasRole('super-admin'))
                            <option selected disabled>Pilih Kategori Bisnis ..</option>
                            @foreach ($kategori_bisnis as $bisnis)
                                <option value="{{ $bisnis->id }}" @if(old('kategori_bisnis_id') == $bisnis->id) selected @endif>{{ $bisnis->name }}</option>
                            @endforeach
                            @else
                                <option selected value="{{ $kategori_bisnis->id }}" @if(old('kategori_bisnis_id') == $kategori_bisnis->id) selected @endif>{{ $kategori_bisnis->name }}</option>
                            @endif
                        </select>                            
                        @error('kategori_bisnis_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
                    </div>
                    @endif
                    @if(Auth::user()->hasRole('contributor-pro'))
                    <div class="form-group" hidden>
                        <label for="kategori_bisnis_id">Kategori Bisnis</label>
                        <select class="form-control @error('kategori_bisnis_id') is-invalid @enderror" id="kategori_bisnis_id" name="kategori_bisnis_id">
                            @if(Auth::user()->hasRole('super-admin'))
                            <option selected disabled>Pilih Kategori Bisnis ..</option>
                            @foreach ($kategori_bisnis as $bisnis)
                                <option value="{{ $bisnis->id }}" @if(old('kategori_bisnis_id') == $bisnis->id) selected @endif>{{ $bisnis->name }}</option>
                            @endforeach
                            @else
                                <option selected value="{{ $kategori_bisnis->id }}" @if(old('kategori_bisnis_id') == $kategori_bisnis->id) selected @endif>{{ $kategori_bisnis->name }}</option>
                            @endif
                        </select>                            
                        @error('kategori_bisnis_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                placeholder="Masukkan Alamat" value="{{ old('alamat') }}">
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
                                placeholder="Masukkan Link Website" value="{{ old('link_Website') }}">
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
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
