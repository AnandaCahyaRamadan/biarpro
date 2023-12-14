@extends('layouts.main')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('artikel.create') }}" class="btn btn-primary mb-3">Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Artikel</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->judul }}</td>
                            <td>{!!$row->artikel!!}</td>
                            <td>
                                    <div class="dropdown dropend">
                                        <a type="button" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('artikel.export', $row->history) }}" class="dropdown-item">Export</a>
                                            </li>
                                            <li>
                                                <form id="delete" action="{{ route('artikel.clear', $row->history) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        Clear
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
