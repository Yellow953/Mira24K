@extends('app.layouts.app')

@section('title', 'settings')

@section('content')
<div class="container px-4">
    <h2 class="mb-5 text-center">Gold</h2>
    <div class="row">
        <div class="col-md-4 my-auto">
            <div class="card">
                <img src="{{ asset('assets/images/gold.png') }}" alt="Gold" class="img-card gold">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-5 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-gold my-3">Current Gold Price</h3>
                        ${{ number_format($gold_price->value, 2) }}
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-gold my-3">Last Updated At</h3>
                        {{ $gold_price->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            <div class="card p-5 mb-5">
                <form action="{{ route('settings.update_profit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-5">
                                <label class="required form-label">Min Profit Per Gram (USD)</label>
                                <input type="number" class="form-control" name="min_gram_profit"
                                    placeholder="Enter Min Gram Profit..." min="0" step="any"
                                    value="{{ number_format($min_gram_profit, 2) }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-5">
                                <label class="required form-label">Max Profit Per Gram</label>
                                <input type="number" class="form-control" name="max_gram_profit"
                                    placeholder="Enter Max Gram Profit..." min="0" step="any"
                                    value="{{ number_format($max_gram_profit, 2) }}" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary">Update Profit Margins</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <br><br>

    <h2 class="mb-5 text-center">Parts Categories</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('assets/images/category_parts.png') }}" class="img-card">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-4 mb-5">
                <div class="new">
                    <form action="{{ route('settings.categories.parts.create') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="input-group d-flex align-items-center gap-3">
                            <input type="text" name="name" class="form-control name-field"
                                placeholder="Enter Category Name" required>

                            <input type="file" name="image" class="form-control">

                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card p-4 mb-5">
                <div class="categories">
                    <table class="w-100 table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr>
                                <th class="col-2"></th>
                                <th class="col-8 text-bold">Category</th>
                                <th class="col-2 text-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($parts_categories as $category)
                            <tr>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ asset($category->image) }}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{
                                                ucwords($category->name) }}</a>
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                </td>
                                <td class="d-flex justify-content-center border-0">
                                    <a href="{{ route('settings.categories.destroy', $category->id) }}"
                                        class="btn btn-icon btn-danger btn-sm show_confirm" data-toggle="tooltip"
                                        data-original-title="Delete Category">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Parts Categories Yet...</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <h2 class="mb-5 text-center">Products Categories</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('assets/images/category_products.png') }}" class="img-card">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-4 mb-5">
                <div class="new">
                    <form action="{{ route('settings.categories.products.create') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="input-group d-flex align-items-center gap-3">
                            <input type="text" name="name" class="form-control name-field"
                                placeholder="Enter Category Name" required>

                            <input type="file" name="image" class="form-control">

                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card p-4 mb-5">
                <div class="categories">
                    <table class="w-100 table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr>
                                <th class="col-2"></th>
                                <th class="col-8 text-bold">Category</th>
                                <th class="col-2 text-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products_categories as $category)
                            <tr>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ asset($category->image) }}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{
                                                ucwords($category->name) }}</a>
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                </td>
                                <td class="d-flex justify-content-center border-0">
                                    <a href="{{ route('settings.categories.destroy', $category->id) }}"
                                        class="btn btn-icon btn-danger btn-sm show_confirm" data-toggle="tooltip"
                                        data-original-title="Delete Category">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Products Categories Yet...</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <h2 class="mb-5 text-center">Backup</h2>
    <div class="row">
        <div class="col-md-4 my-auto">
            <div class="card">
                <img src="{{ asset('assets/images/backup.png') }}" alt="Backup" class="img-card">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-4 mb-5">
                <div class="import">
                    <h3 class="mb-4">Import Database</h3>
                    <form action="{{ route('settings.backup.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9 my-auto px-2">
                                <input type="file" name="file" required class="form-control" id="inputGroupFile">
                            </div>
                            <div class=" col-md-3 my-auto">
                                <button type="submit" class="text-center btn btn-primary btn-sm my-3">
                                    <i class="fas fa-upload mr-2"></i>
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card p-4 mb-5">
                <div class="export">
                    <h3 class="mb-4">Export Database</h3>
                    <a href="{{ route('settings.backup.export') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-download mr-2"></i>Export Backup
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection