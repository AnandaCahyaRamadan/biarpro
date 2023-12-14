@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            @if (session('resent'))
            <div class="alert alert-success my-4" role="alert">
                {{ __('Verifikasi baru telah dikirimkan ke alamat email anda.') }}
            </div>
            @endif
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Verifikasi Email Anda</h1>
                                    <p class="mb-4">{{ __('Cek email anda untuk melihat kode verifikasi') }}
                                        {{ __('Jika kamu tidak menerima email') }}</p>
                                </div>
                                <form class="user" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Klik untuk permintaan lain
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route ('register') }}">Buat akun!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route ('login') }}">Sudah punya akun? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
