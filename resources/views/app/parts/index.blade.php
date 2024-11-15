@extends('app.layouts.app')

@section('title', 'parts')

@section('actions')

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
                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Category</label>
                        <select class="form-select" name="category_id">
                            <option value="">Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request()->query('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Reseller</label>
                        <select class="form-select" name="reseller_id">
                            <option value="">Choose Reseller</option>
                            @foreach($resellers as $reseller)
                                <option value="{{ $reseller->id }}" {{ request()->query('reseller_id') == $reseller->id ? 'selected' : '' }}>
                                    {{ $reseller->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Size</label>
                        <input type="text" class="form-control" name="size" value="{{ request()->query('size') }}"
                            placeholder="Enter Size..." />
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Color</label>
                        <input type="text" class="form-control" name="color" value="{{ request()->query('color') }}"
                            placeholder="Enter Color..." />
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Group</label>
                        <input type="text" class="form-control" name="group" value="{{ request()->query('group') }}"
                            placeholder="Enter Group..." />
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Faceted</label>
                        <select class="form-select" name="faceted">
                            <option value="">Choose Option</option>
                            <option value="1" {{ request()->query('faceted') === '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ request()->query('faceted') === '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Thickness Range</label>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control" name="thickness_min"
                                value="{{ request()->query('thickness_min') }}" placeholder="Min" step="0.01" />
                            <input type="number" class="form-control" name="thickness_max"
                                value="{{ request()->query('thickness_max') }}" placeholder="Max" step="0.01" />
                        </div>
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
                <table class="table table-row-dashed table-row-gray-300 align-middle text-center gs-0 gy-4">
                    <thead>
                        <tr class="text-center">
                            <th class="col-2 text-bold p-3">Category</th>
                            <th class="col-2 text-bold p-3">Part</th>
                            <th class="col-2 text-bold p-3">Reseller</th>
                            <th class="col-2 text-bold p-3">MCode</th>
                            <th class="col-2 text-bold p-3">Size</th>
                            <th class="col-2 text-bold p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parts as $part)
                        <tr>
                            <td>{{ ucwords($part->category->name) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-45px me-5">
                                        <img src="{{ asset($part->image) }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{
                                            ucwords($part->name) }}</a>
                                    </div>
                                    <!--end::Name-->
                                </div>
                            </td>
                            <td>{{ ucwords($part->reseller->name) }}</td>
                            <td>{{ $part->mcode }}</td>
                            <td>{{ $part->size }}</td>
                            <td class="d-flex justify-content-end border-0">
                                <a href="{{ route('parts.show', $part->id) }}"
                                    class="btn btn-primary btn-sm" data-toggle="tooltip">
                                    <i class="fas fa-image"></i>
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
