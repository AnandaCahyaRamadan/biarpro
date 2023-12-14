@extends('layouts.main')
@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Edit Paket</h2>
        <div class="card">
            <div class="card-body">
                <form class= "form-horizontal auth-form my-4" action="{{ route('paket.update', ['id' => Crypt::encryptString($paket->id)]) }}" method="POST" enctype="multipart/form-data">
                    <!--end form-group-->
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket</label>
                        <div class="mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket"
                                placeholder="Masukkan Nama Paket" value="{{ $paket->nama_paket }}">
                            @error('nama_paket')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Pilih Gambar</label>
                        <div class="mb-3 mb-sm-0">
                            @if($paket->image)
                            <img src="{{ asset('storage/' . $paket->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                placeholder="Masukkan Nama Paket" value="{{ $paket->image }}"  onchange="previewImage()">
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
                            placeholder="Masukkan Harga" value="{{ $paket->harga }}">
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_paket">Jenis Paket</label>
                        <select class="form-control form-control-user @error('jenis_paket') is-invalid @enderror" id="jenis_paket" name="jenis_paket">
                            <option selected disabled>Pilih Jenis ..</option>
                            <option value="personal" {{ $paket->jenis_paket == 'personal' ? ' selected' : '' }}>Personal</option>
                            <option value="bisnis" {{ $paket->jenis_paket == 'bisnis' ? ' selected' : '' }}>Bisnis</option>
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
                            placeholder="Masukkan Jumlah Member" value="{{ $paket->member }}">
                        @error('member')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="deskripsi">Deskripsi</label>
                            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi',$paket->deskripsi )}}">
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
                                placeholder="Masukkan Masa Aktif" value="{{ $paket->masa_aktif }}">
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
                            <option value="1" {{ $paket->promo == '1' ? ' selected' : '' }}>Iya</option>
                            <option value="0" {{ $paket->promo ==  '0' ? ' selected' : '' }}>Tidak</option>
                        </select>
                        @error('promo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('paket.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
  }
   
}
</script>
