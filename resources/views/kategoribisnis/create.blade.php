@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tambah Kategori Bisnis</h2>
        <div class="card">
            <div class="card-body">

                <form class= "form-horizontal auth-form my-4" action="{{ route('kategoribisnis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori Bisnis</label>
                        <input id="name"  type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Kategori Bisnis">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('kategoribisnis.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

