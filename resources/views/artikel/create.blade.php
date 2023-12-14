@extends('layouts.main')
@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Tambah Artikel</h2>
        <div class="card">
            <div class="card-body">

                <form class="form-horizontal auth-form my-4" action="{{ route('artikel.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="target">Target</label>
                        <select class="js-example-basic-single form-control @error('target') is-invalid @enderror"
                            id="target" name="target" required style="width: 100%">
                            <option>Pilih Target ..</option>
                            <option value="1">Provinsi</option>
                            <option value="2">Kabupaten</option>
                        </select>
                    </div>
                    <!--end form-group-->
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="js-example-basic-single form-control @error('provinsi') is-invalid @enderror"
                            style="width: 100%" id="provinsi" name="provinsi" required>
                            <option>Pilih Provinsi ..</option>
                            @foreach($provinces as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end form-group-->

                    <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <select class="js-example-basic-single form-control @error('kabupaten') is-invalid @enderror"
                            style="width: 100%" id="kabupaten" name="kabupaten">
                            <option selected disabled>Pilih Kabupaten ..</option>
                        </select>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" class="form-control @error('kategori') is-invalid @enderror"   name="kategori" required>
                            <option >Pilih Kategori ..</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <span class="text-danger">{{$message}}</span> @enderror

                    </div><!--end form-group-->
                    <div class="mb-3">
                        <label for="judul" class="form-label ">Judul</label>
                        <input id="judul" type="text" name="judul"
                            class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul">
                        @error('judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if(Auth::user()->hasRole(['super-admin','admin','contributor-pro']))
                    <div class="mb-3">
                        <label for="keyword" class="form-label">Keyword</label>
                        <input id="keyword" type="text" name="keyword"
                            class="form-control @error('keyword') is-invalid @enderror" placeholder="Masukkan Keyword">
                        @error('keyword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="kata_pembuka" class="form-label">Kata Pembuka</label>
                        <input id="kata_pembuka"  value="" type="text" name="kata_pembuka" class="form-control @error('kata_pembuka') is-invalid @enderror" placeholder="Masukkan Kata Pembuka" >
                        @error('kata_pembuka')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="artikel" class="form-label ">Artikel</label>
                        <textarea id="artikel" type="text" name="artikel"
                            class="form-control @error('artikel') is-invalid @enderror" rows="5" placeholder="Masukkan Artikel"></textarea>
                        @error('artikel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if(Auth::user()->hasRole(['super-admin','admin','contributor-pro']))
                    <div class="mb-3">
                        <label for="keyword_tanya" class="form-label ">Keyword Tanya</label>
                        <input id="keyword_tanya" type="text" name="keyword_tanya"
                            class="form-control" placeholder="Masukkan Keyword Tanya">
                    </div>
                    <div class="mb-3">
                        <label for="keyword_terkait" class="form-label ">Keyword Terkait</label>
                        <input id="keyword_terkait" type="text" name="keyword_terkait"
                            class="form-control" placeholder="Masukkan Keyword Terkait">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="spin" id="flexCheckDefault">
                        <label class="form-check-label mb-3" for="flexCheckDefault">
                            Spin Artikel
                        </label>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Generate Artikel</button>
                    <a href="{{ route('artikel.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.js-example-basic-single').select2();
        }, 0);
    });

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $('#target').on('change', function () {
            var target = $(this).val();

            if (target == '1') { // Target = Provinsi
                $('#provinsi').closest('.form-group').show();
                $('#kabupaten').closest('.form-group').hide();
            } else if (target == '2') { // Target = Kabupaten
                $('#provinsi').closest('.form-group').show();
                $('#kabupaten').closest('.form-group').show();
            } else {
                $('#provinsi').closest('.form-group').hide();
                $('#kabupaten').closest('.form-group').hide();
            }
        });

        $('#provinsi').on('change', function () {
            $.ajax({
                type: "POST",
                url: "{{ route('getKabupaten') }}",
                data: {
                    id: $(this).val()
                },
                success: function (response) {
                    console.log(response);
                    $('#kabupaten').empty();
                    $('#kabupaten').append(
                        '<option disabled selected>Pilih kabupaten ..</option>'
                    )
                    $.each(response, function (id, data) {
                        $('#kabupaten').append(new Option(data.name, data.id))
                    })
                },
                error: function (data) {
                    console.log('error', data);
                }
            });
        });

        // Inisialisasi tampilan berdasarkan pilihan target saat halaman dimuat
        var initialTarget = $('#target').val();
        if (initialTarget == '1') {
            $('#provinsi').closest('.form-group').show();
            $('#kabupaten').closest('.form-group').hide();
        } else if (initialTarget == '2') {
            $('#provinsi').closest('.form-group').show();
            $('#kabupaten').closest('.form-group').show();
        } else {
            $('#provinsi').closest('.form-group').hide();
            $('#kabupaten').closest('.form-group').hide();
        }

        // $('.js-example-basic-single').select2();

        var kategoriSelect = document.getElementById('kategori');
        var kataPembukaInput = document.getElementById('kata_pembuka');
        var judulInput = document.getElementById('judul');
        var keywordInput = document.getElementById('keyword');
        var keywordTerkaitInput = document.getElementById('keyword_terkait');

        kategoriSelect.addEventListener('change', function() {
            var selectedKategoriId = kategoriSelect.value;
            $.ajax({
                    type: "POST",
                    url: "{{ route('getKatapembuka') }}",
                    data: { id: $(this).val() },
                    success: function (response) {
                        console.log(response[0].kata_pembuka);
                        kataPembukaInput.value = response[0].kata_pembuka;
                    },
                    error: function (data) {
                        console.log('error', data);
                    }
            });
           
        });
        // judulInput.addEventListener('change', function() {
        //     var selectedJudul = judulInput.value;
        //     keywordTerkaitInput.value = selectedJudul;
        //     keywordInput.value = selectedJudul;
        // });
    });

</script>
