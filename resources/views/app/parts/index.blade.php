@extends('app.layouts.app')

@section('title', 'parts')

@section('actions')
<a href="{{ route('parts.new') }}" class="btn btn-sm fw-bold btn-primary">
    New Part
</a>
<a href="{{ route('parts.export') }}" class="btn btn-sm fw-bold btn-primary">
    Export Parts
</a>
@endsection

@section('filter')
<!--begin::filter-->
<div class="filter border-0 px-0 px-md-3 py-4">
    <!--begin::Form-->
    <form action="{{ route('parts') }}" method="GET" enctype="multipart/form-data" class="form">
        @csrf
        <div class="pt-0 pt-3 px-2 px-md-4">
            <!--begin::Compact form-->
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <div class="position-relative w-md-400px me-md-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" class="form-control ps-10" name="name" value="{{ request()->query('name') }}"
                        placeholder="Search By Name..." />
                </div>
                <!--end::Input group-->
                <!--begin:Action-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-5 px-3 py-2 d-flex align-items-center">
                        <span class="mx-2">Search</span>
                        <i class="fas fa-search"></i>
                    </button>
                    <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse"
                        href="#kt_advanced_search_form">Advanced Search</a>
                    <button type="reset" class="btn text-danger clear-btn">Clear</button>
                </div>
                <!--end:Action-->
            </div>
            <!--end::Compact form-->
            <!--begin::Advance form-->
            <div class="collapse" id="kt_advanced_search_form">
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <div class="row g-8 mb-8">
                    <div class="col-md-12">
                        <label class="fs-6 form-label fw-bold text-dark">Group</label>
                        <input type="text" class="form-control" name="group" value="{{ request()->query('group') }}"
                            placeholder="Enter Group..." />
                    </div>
                </div>
            </div>
            <!--end::Advance form-->
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::filter-->
@endsection

@section('content')
<div class="container">
    <div class="card mb-5 mb-xl-8">
        @yield('filter')

        <div class="card-body pt-3">
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="text-center">
                            <th class="col-2 p-3">Name</th>
                            <th class="col-2 p-3">Size</th>
                            <th class="col-2 p-3">Weight</th>
                            <th class="col-2 p-3">Price (USD)</th>
                            <th class="col-2 p-3">Category</th>
                            <th class="col-2 p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parts as $part)
                        <tr>
                            <td>{{ $part->name }}</td>
                            <td>{{ $part->size }}</td>
                            <td>{{ $part->gr_pcs }}</td>
                            <td>{{ $part->dollar_pcs }}</td>
                            <td>{{ $part->group }}</td>
                            <td class="d-flex justify-content-end border-0">
                                <a href="{{ route('parts.edit', $part->id) }}"
                                    class="btn btn-icon btn-warning btn-sm me-1">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                <a href="{{ route('parts.destroy', $part->id) }}"
                                    class="btn btn-icon btn-danger btn-sm show_confirm" data-toggle="tooltip"
                                    data-original-title="Delete Part">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="6">
                                <div class="text-center">No Parts Found...</div>
                            </th>
                        </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="6">
                                {{ $parts->appends(['name' => request()->query('name'), 'group' =>
                                request()->query('group')])->links() }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection