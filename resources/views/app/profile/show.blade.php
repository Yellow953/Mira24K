@extends('app.layouts.app')

@section('title', 'profile')

@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xxl-8">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset('assets/images/default_profile.png') }}" alt="profile image" />
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{
                                            ucwords($user->name) }}</a>
                                        <a href="#">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                    <!--end::Name-->

                                </div>
                                <!--end::User-->

                            </div>
                            <!--end::Title-->

                            {{--
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                    <i class="fa fa-receipt"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="fs-2 fw-bold" data-kt-countup="true"
                                                    data-kt-countup-value="{{ $user->orders->count() }}">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-400">Orders</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                    <!--end::Stats-->
                                    */
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Stats--> --}}
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Navs-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                                href="#kt_tab_pane_1">Overview</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                                href="#kt_tab_pane_2">Edit Profile</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                                href="#kt_tab_pane_3">Change Password</a>
                        </li>
                    </ul>
                    <!--begin::Navs-->
                </div>
            </div>
            <!--end::Navbar-->

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                    <div class="card user-info-card p-8">
                        <h4 class="card-title mb-4">User Overview</h4>

                        <div class="user-info">
                            <div class="user-info-item d-flex justify-content-between align-items-center my-3">
                                <span class="fw-bold">Name:</span>
                                <span>{{ ucwords($user->name) }}</span>
                            </div>
                            <div class="user-info-item d-flex justify-content-between align-items-center my-3">
                                <span class="fw-bold">Email:</span>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    <div class="card user-info-card p-8">
                        <h4 class="card-title mb-4">Edit Profile</h4>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                            class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label class="required form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label class="required form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end my-3">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                    <div class="card user-info-card p-8">
                        <h4 class="card-title mb-4">Change Password</h4>
                        <form action="{{ route('profile.save_password') }}" method="POST" enctype="multipart/form-data"
                            class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label class="required form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" required />
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <label class="required form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end my-3">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br>

                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection