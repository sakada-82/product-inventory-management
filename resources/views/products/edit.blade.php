
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Product</h2>

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

    <form action="{{ route('products.update', $product->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku"
                   class="form-control"
                   value="{{ old('sku', $product->sku) }}">
        </div>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name"
                   class="form-control"
                   value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category"
                   class="form-control"
                   value="{{ old('category', $product->category) }}">
        </div>

        <div class="mb-3">
            <label>Unit Price ($)</label>
            <input type="number" name="price"
                   step="0.01" min="0.01"
                   class="form-control"
                   value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label>Stock Quantity</label>
            <input type="number" name="stock"
                   min="0"
                   class="form-control"
                   value="{{ old('stock', $product->stock) }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Update Product
        </button>

    </form>

</div>

</body>
</html>
