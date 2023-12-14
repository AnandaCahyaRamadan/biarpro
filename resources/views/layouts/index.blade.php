@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Beralih ke halaman utama</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Artikel
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikel_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-none">
                    <a href="{{ route('artikel.index') }}" class="btn btn-primary btn-sm">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>              
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Komisi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $komisi_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-none">
                    <a href="{{ route ('komisi.index') }}" class="btn btn-primary btn-sm">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>        
    </div>
@endsection