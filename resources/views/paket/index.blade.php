@extends('layouts.main')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        {{-- <th scope="col">Deskripsi</th> --}}
                        <th scope="col">Masa Aktif</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paket as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->nama_paket }}</td>
                            <td><img src="{{ asset('storage/'. $row->image) }}" alt="gambar_artikel" width="100"></td>
                            <td>{{ $row->harga }}</td>
                            {{-- <td>{!! $row->deskripsi !!}</td> --}}
                            <td>{{ $row->masa_aktif }}</td>
                            <td>
                                @if($row->status == 0)
                                Belum di Publish
                                <a href="{{ route('paket.updateStatus', Crypt::encryptString($row->id)) }}" class="btn btn-secondary">
                                    <i class="fas fa-download"></i> <!-- Font Awesome Edit Icon -->
                                </a>
                                @else
                                Sudah di Publish
                                <a href="{{ route('paket.updateStatus', Crypt::encryptString($row->id)) }}" class="btn btn-success">
                                     <i class="fas fa-upload"></i> <!-- Font Awesome Edit Icon -->
                                </a>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown dropend">
                                    <a type="button" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('paket.edit', Crypt::encryptString($row->id)) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <form id="delete" action="{{ route('paket.destroy', $row->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
