@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Edit Role</h2>
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal auth-form my-4"
                    action="{{ route('role.update', ['id' => Crypt::encryptString($role->id)]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Role</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" placeholder="Masukkan Role">
                        <input id="guard_name" type="text" name="guard_name" value="web" hidden class="form-control">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('role.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

