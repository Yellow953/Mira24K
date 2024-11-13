<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Mira24K</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url("{{ asset('assets/images/ring.jpg') }}");
            }
        </style>
        <!--end::Page bg image-->

        <!--begin::Authentication - Signup Welcome Message -->
        <div class="d-flex flex-column justify-content-start flex-column-fluid p-10" style="padding-left: 20px;">
            <!--begin::Content-->
            <div class="d-flex flex-column text-center my-auto">
                <!--begin::Wrapper-->
                <div class="card card-flush w-lg-500px py-5">
                    <div class="card-body">
                        <!--begin::Title-->
                        <h1 class="fw-bolder fs-2qx text-gray-900 mb-4">System Error</h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">Something went wrong! Please try again later.
                        </div>
                        <!--end::Text-->
                        <!--begin::Illustration-->
                        <div class="mb-11">
                            <img src="{{ asset('assets/media/auth/500-error.png') }}"
                                class="mw-100 mh-300px theme-light-show" alt="" />
                        </div>
                        <!--end::Illustration-->
                        <!--begin::Link-->
                        <div class="mb-0">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                        <!--end::Link-->
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Signup Welcome Message-->
    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>