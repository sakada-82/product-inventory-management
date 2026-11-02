
@extends('layouts.app')

@section('title', 'Product Management')
@section('page-title', 'Inventory Dashboard')

@push('styles')
<style>
    .summary-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        transition: all .3s ease;
        box-shadow: 0 3px 12px rgba(0,0,0,.03);
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
    }

    .card-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .card-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .summary-card h3 {
        color: #172033;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .summary-card small {
        color: #94a3b8;
        font-size: 12px;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 13px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
    }

    .icon-box.blue {
        background: #e8f0ff;
        color: #2563eb;
    }

    .icon-box.green {
        background: #e3f9ed;
        color: #16a34a;
    }

    .icon-box.yellow {
        background: #fff5db;
        color: #d97706;
    }

    .icon-box.red {
        background: #ffe8eb;
        color: #e11d48;
    }

    .table-card {
        background: white;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 3px 12px rgba(0,0,0,.03);
    }

    .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 13px;
        white-space: nowrap;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
    }
</style>
@endpush

@section('content')

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card">
                <div class="card-content">
                    <div>
                        <p class="card-label">Total Products</p>
                        <h3>{{ $totalProducts }}</h3>
                        <small>Products in catalog</small>
                    </div>
                    <div class="icon-box blue">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card">
                <div class="card-content">
                    <div>
                        <p class="card-label">Total Value</p>
                        <h3>${{ number_format($totalValue, 2) }}</h3>
                        <small>Inventory valuation</small>
                    </div>
                    <div class="icon-box green">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card">
                <div class="card-content">
                    <div>
                        <p class="card-label">Low Stock Alert</p>
                        <h3>{{ $lowStock }}</h3>
                        <small>Products need restocking</small>
                    </div>
                    <div class="icon-box yellow">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card">
                <div class="card-content">
                    <div>
                        <p class="card-label">Out of Stock</p>
                        <h3>{{ $outOfStock }}</h3>
                        <small>Products unavailable</small>
                    </div>
                    <div class="icon-box red">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Product Table -->
    <div class="table-card">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h5 class="fw-bold mb-1">Product Management</h5>
                <small class="text-muted">Manage your inventory products</small>
            </div>

            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Add Product
            </a>

        </div>

        <!-- Search -->
        <form action="{{ route('products.index') }}"
              method="GET"
              class="mb-3">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search SKU, Product Name or Category..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Search
                </button>

                <a href="{{ route('products.index') }}"
                   class="btn btn-outline-secondary">
                    Reset
                </a>

            </div>

        </form>

        <p class="text-muted small">
            Total Results: {{ $products->count() }}
        </p>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Total Value</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>
                            <td class="fw-semibold">
                                {{ $product->sku }}
                            </td>

                            <td>{{ $product->name }}</td>

                            <td>{{ $product->category }}</td>

                            <td>
                                ${{ number_format($product->price, 2) }}
                            </td>

                            <td>{{ $product->stock }}</td>

                            <td class="fw-semibold">
                                ${{ number_format($product->price * $product->stock, 2) }}
                            </td>

                            <td>
                                @if($product->stock_status == 'In Stock')
                                    <span class="badge bg-success">
                                        In Stock
                                    </span>
                                @elseif($product->stock_status == 'Low Stock')
                                    <span class="badge bg-warning text-dark">
                                        Low Stock
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Out of Stock
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-2">

                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                No products found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection
