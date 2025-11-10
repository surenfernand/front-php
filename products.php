<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS (includes Popper for modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="#">Users</a>

    </div>


    <!-- Main content -->
    <div class="content">

        <header class="d-flex justify-content-between align-items-center">
            <h1 class="h3">Product Management</h1>
            <div>
                <button class="btn btn-outline-secondary me-2">Profile</button>
                <button class="btn btn-danger">Logout</button>
            </div>
        </header>

        <main>
            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Add Product
                </button>
            </div>
            <div class="table-responsive">
                <table id="productTableView" class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JavaScript will insert rows here -->
                    </tbody>
                </table>
            </div>
        </main>


    </div>

    <?php include 'includes/footer.php'; ?>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addProductForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="productDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="productStock" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden field to store product ID -->
                        <input type="hidden" id="editProductId">

                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="editProductDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editProductPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductStock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="editProductStock" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



</body>

</html>