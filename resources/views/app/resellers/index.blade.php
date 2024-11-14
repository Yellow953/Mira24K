@extends('app.layouts.app')

@section('title', 'resellers')

@section('actions')
<a href="{{ route('resellers.new') }}" class="btn btn-sm fw-bold btn-primary">
    New Reseller
</a>
<a href="{{ route('resellers.export') }}" class="btn btn-sm fw-bold btn-primary">
    Export Resellers
</a>
@endsection


@section('filter')
<!--begin::filter-->
<div class="filter border-0 px-0 px-md-3 py-4">
    <form action="{{ route('resellers') }}" method="GET" enctype="multipart/form-data" class="form">
        @csrf
        <div class="pt-0 pt-3 px-2 px-md-4">
            <div class="d-flex align-items-center">
                <div class="position-relative w-md-400px me-md-2">
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" class="form-control ps-10" name="name" value="{{ request()->query('name') }}"
                        placeholder="Search By Name..." />
                </div>
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-5 px-3 py-2 d-flex align-items-center">
                        <span class="mx-2">Search</span>
                        <i class="fas fa-search"></i>
                    </button>
                    <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse"
                        href="#kt_advanced_search_form">Advanced Search</a>
                    <button type="reset" class="btn text-danger clear-btn">Clear</button>
                </div>
            </div>
            <div class="collapse" id="kt_advanced_search_form">
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <div class="row g-8 mb-8">
                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ request()->query('email') }}"
                            placeholder="Enter Email..." />
                    </div>
                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Contact Person</label>
                        <input type="text" class="form-control" name="contact_person" value="{{ request()->query('contact_person') }}"
                            placeholder="Enter Contact Person..." />
                    </div>

                    <div class="col-md-4">
                        <label class="fs-6 form-label fw-bold text-dark">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ request()->query('address') }}"
                            placeholder="Enter Address..." />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
                            <th class="col-2 p-3">Reseller</th>
                            <th class="col-2 p-3">Email</th>
                            <th class="col-2 p-3">Contact Person</th>
                            <th class="col-2 p-3">Address</th>
                            <th class="col-2 p-3">GSM</th>
                            <th class="col-2 p-3">Phone</th>

                            <th class="col-2 p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resellers as $reseller)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px me-5">
                                        <img alt="reseller" src="{{ asset('assets/images/default_profile.png') }}" />
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ ucwords($reseller->name) }}</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $reseller->email }}</td>
                            <td class="text-center">{{ $reseller->contact_person }}</td>
                            <td class="text-center">{{ $reseller->address }}</td>
                            <td class="text-center">{{ $reseller->gsm }}</td>
                            <td class="text-center">{{ $reseller->phone }}</td>

                            <td class="d-flex justify-content-end border-0">
                                <a href="{{ route('resellers.edit', $reseller->id) }}" class="btn btn-icon btn-warning btn-sm me-1">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                <a href="{{ route('resellers.destroy', $reseller->id) }}" class="btn btn-icon btn-danger btn-sm show_confirm"
                                    data-toggle="tooltip" data-original-title="Delete Reseller">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="8">
                                <div class="text-center">No Resellers Yet ...</div>
                            </th>
                        </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="8">
                                {{ $resellers->appends(['name' => request()->query('name'), 'email' => request()->query('email'), 'contact_person' => request()->query('contact_person'), 'address' => request()->query('address')])->links() }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
