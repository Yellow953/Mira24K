@extends('app.layouts.app')

@section('title', 'parts')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="container-fluid px-4 py-5">
    {{-- Centered Header --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-2">{{ $part->name }}</h1>
        <h2 class="h3 text-muted">Part Details</h2>
    </div>

    {{-- Content Grid --}}
    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-md-6">
            {{-- Basic Information Card --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h3 class="h5 mb-4">Basic Information</h3>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Category</span>
                            <span class="fw-medium">{{ $part->category ? $part->category->name : 'N/A' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Size</span>
                            <span class="fw-medium">{{ $part->size }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Weight (gr/pcs)</span>
                            <span class="fw-medium">{{ $part->gr_pcs }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Price ($/gr)</span>
                            <span class="fw-medium">${{ number_format($part->dollar_gr, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Price ($/pcs)</span>
                            <span class="fw-medium">${{ number_format($part->dollar_pcs, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Group</span>
                            <span class="fw-medium">{{ $part->group }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Mcode</span>
                            <span class="fw-medium">{{ $part->mcode }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stone Details Card --}}
            @if ($part->faceted !== null || $part->color)
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h3 class="h5 mb-4">Stone Details</h3>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Faceted</span>
                            <span class="fw-medium">{{ $part->faceted ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Color</span>
                            <span class="fw-medium">{{ $part->color }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Right Column --}}
        <div class="col-md-6">
            {{-- Reseller Information Card --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h3 class="h5 mb-4">Reseller Information</h3>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Reseller</span>
                            <span class="fw-medium">{{ $part->reseller ? $part->reseller->name : 'N/A' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Reseller Barcode</span>
                            <span class="fw-medium">{{ $part->reseller_barcode }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Card --}}
            @if($part->image)
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h3 class="h5 mb-4">Image</h3>
                    <div class="text-center">
                        <img src="{{ asset($part->image) }}"
                             alt="{{ $part->name }}"
                             class="img-fluid rounded-3"
                             style="max-height: 195px; object-fit: contain;">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
