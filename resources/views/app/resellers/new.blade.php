@extends('app.layouts.app')

@section('title', 'resellers')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('resellers.create') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <div class="card-head pt-10">
            <h1 class="text-center text-primary">New Reseller</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Reseller Name..."
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
                        <label class="required form-label">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address..."
                            value="{{ old('address') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">GSM</label>
                        <input type="text" class="form-control" name="gsm" placeholder="Enter GSM..."
                            value="{{ old('gsm') }}" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone..."
                            value="{{ old('phone') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Contact Person</label>
                        <input type="text" class="form-control" name="contact_person" placeholder="Enter Contact Person..."
                            value="{{ old('contact_person') }}" required />
                    </div>
                </div>
            </div>

            <div class="form-group mt-5">
                <label class="form-label">Notes</label>
                <textarea class="form-control" name="notes" rows="4" placeholder="Enter any additional notes...">{{ old('notes') }}</textarea>
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
