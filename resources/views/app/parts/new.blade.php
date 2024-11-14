@extends('app.layouts.app')

@section('title', 'parts')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('parts.create') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <div class="card-head pt-10">
            <h1 class="text-center text-primary">New Part</h1>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-4">
                        <label class="required form-label">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : ''
                                }}>{{ ucwords($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="required form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Part Name..."
                            value="{{ old('name') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="required form-label">MCode</label>
                        <input type="text" class="form-control" name="mcode" placeholder="Enter MCode..."
                            value="{{ old('mcode') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="required form-label">Reseller</label>
                        <select class="form-control" id="reseller_id" name="reseller_id" required>
                            <option value="">Select Reseller</option>
                            @foreach ($resellers as $reseller)
                            <option value="{{ $reseller->id }}" {{ old('reseller_id')==$reseller->id ? 'selected' : ''
                                }}>{{ ucwords($reseller->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="required form-label">Reseller Barcode</label>
                        <input type="text" class="form-control" name="reseller_barcode"
                            placeholder="Enter Reseller Barcode..." value="{{ old('reseller_barcode') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="required form-label">Size</label>
                        <input type="number" class="form-control" name="size" placeholder="Enter Size..."
                            value="{{ old('size') }}" min="0" step="any" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="required form-label">Group</label>
                        <input type="text" class="form-control" name="group" placeholder="Enter Group..."
                            value="{{ old('group') }}" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-4">
                        <label class="required form-label">Gr/Pcs</label>
                        <input type="number" class="form-control" name="gr_pcs" placeholder="Enter Gr/Pcs..."
                            value="{{ old('gr_pcs') }}" min="0" step="any" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-4">
                        <label class="required form-label">Dollar/Gr</label>
                        <input type="number" class="form-control" name="dollar_gr" placeholder="Enter Dollar/Gr..."
                            value="{{ old('dollar_gr') }}" min="0" step="any" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-4">
                        <label class="required form-label">Dollar/Pcs</label>
                        <input type="number" class="form-control" name="dollar_pcs" placeholder="Enter Dollar/Pcs..."
                            value="{{ old('dollar_pcs') }}" min="0" step="any" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-4">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" />
                    </div>
                </div>
            </div>

            <!-- Stones Fields (Shown only when "Stone" is selected) -->
            <div id="stoneFields" class="optional-fields" style="display: none;">
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label">Stone Pack</label>
                            <input type="number" class="form-control" name="stone_pack"
                                placeholder="Enter Stone Pack..." min="0" step="any" value="{{ old('stone_pack') }}" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label">Stone Color</label>
                            <input type="text" class="form-control" name="stone_color"
                                placeholder="Enter Stone Color..." value="{{ old('stone_color') }}" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label">
                                Faceted
                                <input type="checkbox" class="form-check" name="faceted" {{ old('faceted') ? 'checked'
                                    : '' }} />

                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chains Fields (Shown only when "Chain" is selected) -->
            <div id="chainFields" class="optional-fields" style="display: none;">
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label">Thickness</label>
                            <input type="number" class="form-control" name="thickness" placeholder="Enter Thickness..."
                                min="0" step="any" value="{{ old('thickness') }}" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label">Gr/Dm</label>
                            <input type="number" class="form-control" name="gr_dm" placeholder="Enter Gr/Dm..." min="0"
                                step="any" value="{{ old('gr_dm') }}" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label class="form-label">
                                Role
                                <input type="checkbox" class="form-check" name="role" {{ old('role') ? 'checked' : ''
                                    }} />

                            </label>
                        </div>
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

<!-- JavaScript for Dynamic Fields -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryField = document.getElementById('category_id');
        const stoneFields = document.getElementById('stoneFields');
        const chainFields = document.getElementById('chainFields');

        categoryField.addEventListener('change', function () {
            const selectedText = categoryField.options[categoryField.selectedIndex].text.toLowerCase();

            stoneFields.style.display = selectedText === 'stone' ? 'block' : 'none';
            chainFields.style.display = selectedText === 'chain' ? 'block' : 'none';
        });
    });
</script>
@endsection