<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="#">Users</a>

    </div>
    <!-- Main Content -->
    <div class="content">
        <header class="d-flex justify-content-between align-items-center">
            <h1 class="h3">Admin Dashboard</h1>
            <div>
                <button class="btn btn-outline-secondary me-2">Profile</button>
                <button class="btn btn-danger" id="logoutBtn">Logout</button>
            </div>
        </header>

        <main>
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Products</h5>
                            <p class="card-text fs-4">12</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text fs-4">45</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <h5 class="card-title">Orders</h5>
                            <p class="card-text fs-4">23</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body">
                            <h5 class="card-title">Stock Alerts</h5>
                            <p class="card-text fs-4">5</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links / Shortcuts -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">View Product</h5>
                            <button class="btn btn-primary" href="products.php">Go</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">View Users</h5>
                            <button class="btn btn-success" href="users.php">Go</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Orders</h5>
                            <button class="btn btn-warning">Go</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>


    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>