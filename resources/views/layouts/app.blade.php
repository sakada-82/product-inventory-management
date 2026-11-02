
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Inventory Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #172033;
            color: white;
            padding: 25px 16px;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            padding: 0 12px;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #aeb8ca;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2d3b55;
            color: white;
        }

        .sidebar a i {
            font-size: 18px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 18px 24px;
            border-radius: 14px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 20px 10px;
            }

            .brand {
                font-size: 0;
                padding: 0;
            }

            .brand i {
                font-size: 24px;
            }

            .sidebar a {
                justify-content: center;
                padding: 13px 5px;
            }

            .sidebar a span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="brand">
            <i class="bi bi-box-seam"></i>
            <span>Inventory</span>
        </div>

        <p class="text-uppercase small text-secondary px-3">
            Main Menu
        </p>

        <a href="{{ route('products.index') }}"
           class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="{{ request()->routeIs('products.*') && !request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="bi bi-box"></i>
            <span>Products</span>
        </a>

        <a href="{{ route('products.create') }}">
            <i class="bi bi-plus-circle"></i>
            <span>Add Product</span>
        </a>

        <hr class="border-secondary">

        <p class="text-uppercase small text-secondary px-3">
            Management
        </p>

        <a href="#">
            <i class="bi bi-bar-chart"></i>
            <span>Reports</span>
        </a>

        <a href="#">
            <i class="bi bi-gear"></i>
            <span>Settings</span>
        </a>

    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <div class="topbar">
            <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>

            <div>
                <i class="bi bi-person-circle fs-4 text-secondary"></i>
                <span class="ms-2">Admin</span>
            </div>
        </div>

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
