@extends('app.layouts.app')

@section('title', 'products')

@section('actions')
<a href="{{ route('products.new') }}" class="btn btn-sm fw-bold btn-primary">
    New Product
</a>
<a href="{{ route('products.export') }}" class="btn btn-sm fw-bold btn-primary">
    Export Products
</a>
@endsection

@section('filter')
<!--begin::filter-->
<div class="filter border-0 px-0 px-md-3 py-4">
    <form action="{{ route('products') }}" method="GET" enctype="multipart/form-data" class="form">
        @csrf
        <div class="pt-0 pt-3 px-2 px-md-4">
            <div class="d-flex align-items-center">
                <div class="position-relative w-md-400px me-md-2">
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control ps-10" name="title" value="{{ request()->query('title') }}"
                        placeholder="Search By Title..." />
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
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Category Name</label>
                        <select name="category_id" class="form-select">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ request()->query('category_id') == $category->id ?
                                'selected' : '' }}>{{ucwords($category->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">MCode</label>
                        <input type="text" class="form-control" name="mcode" value="{{ request()->query('mcode') }}"
                            placeholder="Search By MCode..." />
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Karat</label>
                        <input type="number" class="form-control" name="karat" value="{{ request()->query('karat') }}"
                            placeholder="Search By Karat..." />
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Weight</label>
                        <input type="number" class="form-control" name="weight" value="{{ request()->query('weight') }}"
                            placeholder="Search By Weight..." />
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Min Price</label>
                        <input type="number" class="form-control" name="min_price"
                            value="{{ request()->query('min_price') }}" placeholder="Min Price..." />
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Max Price</label>
                        <input type="number" class="form-control" name="max_price"
                            value="{{ request()->query('max_price') }}" placeholder="Max Price..." />
                    </div>
                    <div class="col-md-12">
                        <label class="fs-6 form-label fw-bold text-dark">Description</label>
                        <textarea name="description" rows="3" class="form-control"
                            value="{{ request()->query('description') }}"
                            placeholder="Search By Description"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                            <th class="col-2 p-3">Category</th>
                            <th class="col-2 p-3">Product</th>
                            <th class="col-1 p-3">MCode</th>
                            <th class="col-1 p-3">Karat</th>
                            <th class="col-1 p-3">Weight (g)</th>
                            <th class="col-1 p-3">Price</th>
                            <th class="col-2 p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ ucwords($product->category->name) }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="product-img">
                                        <img src="{{ asset($product->image) }}" class="img-fluid">
                                    </div>
                                    <div class="product-title">
                                        {{ ucwords($product->title) }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->mcode }}</td>
                            <td>{{ $product->karat }}</td>
                            <td>{{ $product->weight }}</td>
                            <td>{{ $product->price }}</td>
                            <td class="d-flex justify-content-end border-0">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-icon btn-warning btn-sm me-1">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                <a href="{{ route('products.destroy', $product->id) }}"
                                    class="btn btn-icon btn-danger btn-sm show_confirm" data-toggle="tooltip"
                                    data-original-title="Delete Product">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="9">
                                <div class="text-center">No Products Yet ...</div>
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="9">
                                {{ $products->appends(request()->query())->links() }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection