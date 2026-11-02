
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Add New Product</h2>

    <a href="{{ route('products.index') }}"
       class="btn btn-secondary mb-3">
        Back
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku"
                   class="form-control"
                   value="{{ old('sku') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name"
                   class="form-control"
                   value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category"
                   class="form-control"
                   value="{{ old('category') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Unit Price ($)</label>
            <input type="number" name="price"
                   step="0.01" min="0.01"
                   class="form-control"
                   value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stock"
                   min="0"
                   class="form-control"
                   value="{{ old('stock', 0) }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Save Product
        </button>

    </form>

</div>

</body>
</html>
