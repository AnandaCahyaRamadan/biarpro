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
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Tanggal Kadaluwarsa</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayarans as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->user_id }}</td>
                            <td>{{ $row->tanggal_pembayaran }}</td>
                            <td>{{ $row->tanggal_kadaluwarsa }}</td>
                            <td>{{ $row->metode_pembayaran }}</td>
                            <td>{{ $row->total_pembayaran }}</td>
                            <td>{{ $row->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
