@extends('layouts.main')
@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Pembayaran ID</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($komisi as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->user_id }}</td>
                            <td>{{ $row->pembayaran_id }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>
                                 @if($row->status == 0)
                                Belum dicairkan
                                @if (Auth::user()->hasRole(['super-admin']))
                                <a href="{{ route('komisi.updateStatus', Crypt::encryptString($row->id)) }}" class="btn btn-success">
                                    <i class="fas fa-download"></i> <!-- Font Awesome Edit Icon -->
                                </a>
                                @endif
                                @else
                                Sudah dicairkan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
