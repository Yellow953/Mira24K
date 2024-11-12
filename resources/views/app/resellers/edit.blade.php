@extends('app.layouts.app')

@section('title', 'users')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <div class="card-head pt-10">
            <h1 class="text-center text-primary">Edit User</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-5">
                        <label class="required form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name..."
                            value="{{ $user->name }}" required />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-5">
                        <label class="required form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email..."
                            value="{{ $user->email }}" required />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer pt-0">
            <div class="d-flex align-items-center justify-content-around">
                <button type="reset" class="btn btn-danger clear-btn">Clear</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection