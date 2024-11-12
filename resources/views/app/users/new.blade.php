@extends('app.layouts.app')

@section('title', 'users')

@section('content')
<div class="card">
    <form action="{{ route('users.create') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <div class="card-head pt-10">
            <h1 class="text-center text-primary">New User</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name..."
                            value="{{ old('name') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email..."
                            value="{{ old('email') }}" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password..."
                            required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Type Password Again..." required />
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