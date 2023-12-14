@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tambah Kata Pembuka</h2>
        <div class="card">
            <div class="card-body">

                <form class= "form-horizontal auth-form my-4" action="{{ route('ref_kata_pembuka.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="js-example-basic-single form-control @error('kategori') is-invalid @enderror" id="kategori"  name="kategori" required>
                            <option selected disabled>Pilih kategori ..</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <span class="text-danger">{{$message}}</span> @enderror

                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="kata_pembuka" class="form-label">Kata Pembuka</label>
                        <input id="kata_pembuka"  type="text" name="kata_pembuka" class="form-control @error('kata_pembuka') is-invalid @enderror" placeholder="Masukkan Kata Pembuka">
                        @error('kata_pembuka') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('ref_kata_pembuka.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

