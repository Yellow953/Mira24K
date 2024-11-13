@extends('auth.app')

@section('content')
<!--begin::Form-->
<form class="form w-100" method="POST" action="{{ route('login') }}">
    @csrf

    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
        <!--end::Title-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <label for="email" class="form-label">Email</label>
        <!--begin::Email-->
        <input id="email" type="email" class="form-control bg-transparent @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <!--end::Email-->
    </div>
    <!--end::Input group=-->
    <div class="fv-row mb-3">
        <label for="password" class="form-label">Password</label>
        <!--begin::Password-->
        <input id="password" type="password" class="form-control bg-transparent @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <!--end::Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <div></div>
        <!--begin::Link-->
        <a href="{{ route('password.request') }}" class="link-primary">Forgot
            Password ?</a>
        <!--end::Link-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
            <!--begin::Indicator label-->
            <span class="indicator-label">Sign In</span>
            <!--end::Indicator label-->
        </button>
    </div>
    <!--end::Submit button-->
</form>
<!--end::Form-->
@endsection