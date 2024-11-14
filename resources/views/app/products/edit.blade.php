@extends('app.layouts.app')

@section('title', 'products')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        @method('PUT')

        <div class="card-head pt-10">
            <h1 class="text-center text-primary">Edit Product</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Product Title..."
                            value="{{ old('title', $product->title) }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Mcode</label>
                        <input type="text" class="form-control" name="mcode" placeholder="Enter Product Mcode..."
                            value="{{ old('mcode', $product->mcode) }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Karat</label>
                        <input type="number" step="0.01" class="form-control" name="karat" placeholder="Enter Karat..."
                            value="{{ old('karat', $product->karat) }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Weight</label>
                        <input type="number" step="0.01" class="form-control" name="weight" placeholder="Enter Weight..."
                            value="{{ old('weight', $product->weight) }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter Price..."
                            value="{{ old('price', $product->price) }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Compare Price</label>
                        <input type="number" step="0.01" class="form-control" name="compare_price"
                            placeholder="Enter Compare Price..." value="{{ old('compare_price', $product->compare_price) }}" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-5">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter Product Description...">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Category</label>
                        <select class="form-control" name="category_id" required>
                            <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Jewelry Model</label>
                        <select class="form-control" name="jewelry_model_id" required>
                            <option value="" disabled>Select Jewelry Model</option>
                            @foreach($jewelryModels as $jewelryModel)
                            <option value="{{ $jewelryModel->id }}" {{ old('jewelry_model_id', $product->jewelry_model_id) == $jewelryModel->id ? 'selected' : '' }}>
                                {{ $jewelryModel->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image" />
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="mt-3" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Secondary Image 1</label>
                        <input type="file" class="form-control" name="secondary_image_1" />
                        @if($product->secondary_image_1)
                        <img src="{{ asset('storage/' . $product->secondary_image_1) }}" alt="Secondary Image 1" class="mt-3" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Secondary Image 2</label>
                        <input type="file" class="form-control" name="secondary_image_2" />
                        @if($product->secondary_image_2)
                        <img src="{{ asset('storage/' . $product->secondary_image_2) }}" alt="Secondary Image 2" class="mt-3" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Secondary Image 3</label>
                        <input type="file" class="form-control" name="secondary_image_3" />
                        @if($product->secondary_image_3)
                        <img src="{{ asset('storage/' . $product->secondary_image_3) }}" alt="Secondary Image 3" class="mt-3" width="100">
                        @endif
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
