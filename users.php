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
        <a href="users.php">Users</a>


    </div>


    <!-- Main content -->
    <!-- Main content -->
    <div class="content">

        <header class="d-flex justify-content-between align-items-center">
            <h1 class="h3">User Management</h1>
            <div>
                <button class="btn btn-danger" id="logoutBtn">Logout</button>
            </div>
        </header>

        <main>
            <div class="d-flex justify-content-end mb-2">

            </div>

            <div class="mt-3 mb-3">
                <label for="userSearch" class="form-label">Search Users</label>
                <input type="text" id="userSearch" class="form-control mb-3" placeholder="Search Users...">
            </div>

            <div class="table-responsive">
                <table id="userTableView" class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
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





    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



    <script>
        const userTableBody = document.querySelector('#userTableView tbody');

        async function loadUsers() {
            try {
                const res = await axios.get(`${API_BASE}/get-all-users`);
                const users = res.data.data;

                userTableBody.innerHTML = '';

                users.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>                   
                    <button class="btn btn-sm btn-danger deleteUserBtn" data-id="${user.id}">Delete</button>
                </td>
            `;
                    userTableBody.appendChild(row);
                });

                // Attach delete event listeners
                document.querySelectorAll('.deleteUserBtn').forEach(button => {
                    button.addEventListener('click', async (e) => {
                        const userId = e.target.getAttribute('data-id');

                        const confirmDelete = await Swal.fire({
                            title: 'Are you sure?',
                            text: "This user will be deleted permanently!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        });

                        if (confirmDelete.isConfirmed) {
                            try {
                                await axios.delete(`${API_BASE}/delete-user/${userId}`);
                                Swal.fire('Deleted!', 'User has been deleted.', 'success');
                                loadUsers(); // Refresh table
                            } catch (err) {
                                console.error(err);
                                Swal.fire('Error', 'Failed to delete user', 'error');
                            }
                        }
                    });
                });

            } catch (err) {
                console.error('Failed to load users:', err);
                Swal.fire('Error', 'Failed to load users', 'error');
            }
        }

        loadUsers();

        // Search filter
        document.getElementById('userSearch').addEventListener('input', (e) => {
            const filter = e.target.value.toLowerCase();
            Array.from(userTableBody.rows).forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const email = row.cells[1].textContent.toLowerCase();
                row.style.display = (name.includes(filter) || email.includes(filter)) ? '' : 'none';
            });
        });
    </script>
</body>



</html>