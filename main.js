const API_BASE = "http://127.0.0.1:8000/api";

const tableElement = document.getElementById('productTableView');
let tableBody = null;

if (tableElement) {
    tableBody = tableElement.querySelector('tbody');
}

let products = [];

async function loadProducts() {
    try {
        // Show loading
        Swal.fire({
            title: 'Loading products...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const response = await fetch(`${API_BASE}/products`);
        if (!response.ok) throw new Error('Network response was not ok');

        products = await response.json();
        tableBody.innerHTML = '';

        products.forEach((p, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${p.name}</td>
                <td>${p.description}</td>
                <td>$${p.price}</td>
                <td>${p.stock_qty}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1" onclick="openEditProductModal(${index})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(${index})">Delete</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });

        Swal.close(); // close loading
    } catch (error) {
        console.error('Error loading products:', error);
        tableBody.innerHTML = '<tr><td colspan="5">Failed to load products.</td></tr>';
        Swal.fire('Error', 'Failed to load products', 'error');
    }
}


const addProductForm = document.getElementById("addProductForm");

if (addProductForm) {
    document.getElementById("addProductForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        const name = document.getElementById("productName").value;
        const description = document.getElementById("productDescription").value;
        const price = parseFloat(document.getElementById("productPrice").value);
        const stock_qty = parseInt(document.getElementById("productStock").value);

        try {
            Swal.fire({ title: 'Saving...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

            const res = await axios.post(`${API_BASE}/save-product`, { name, description, price, stock_qty });

            Swal.fire('Success', 'Product added successfully!', 'success');

            const modalEl = document.getElementById("addProductModal");
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            document.getElementById('productName').value = '';
            document.getElementById('productDescription').value = '';
            document.getElementById('productPrice').value = '';
            document.getElementById('productStock').value = '';

            loadProducts();
        } catch (err) {
            console.error(err);
            Swal.fire('Error', err.response?.data?.message || err.message, 'error');
        }
    });
}
function openEditProductModal(index) {
    const product = products[index];
    document.getElementById('editProductId').value = product.id;
    document.getElementById('editProductName').value = product.name;
    document.getElementById('editProductDescription').value = product.description;
    document.getElementById('editProductPrice').value = product.price;
    document.getElementById('editProductStock').value = product.stock_qty;

    const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
    editModal.show();
}


const editProductForm = document.getElementById("editProductForm");

if (editProductForm) {
    document.getElementById('editProductForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const id = document.getElementById('editProductId').value;
        const name = document.getElementById('editProductName').value;
        const description = document.getElementById('editProductDescription').value;
        const price = parseFloat(document.getElementById('editProductPrice').value);
        const stock = parseInt(document.getElementById('editProductStock').value);

        try {
            Swal.fire({ title: 'Updating...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

            await fetch(`${API_BASE}/update-product/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, description, price, stock_qty: stock })
            });

            Swal.fire('Success', 'Product updated successfully!', 'success');

            const editModalEl = document.getElementById('editProductModal');
            const editModal = bootstrap.Modal.getInstance(editModalEl);
            editModal.hide();

            loadProducts();
        } catch (err) {
            console.error('Update failed', err);
            Swal.fire('Error', 'Failed to update product', 'error');
        }
    });
}
// Delete product with confirmation
function confirmDelete(index) {
    const product = products[index];
    Swal.fire({
        title: `Delete "${product.name}"?`,
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                await fetch(`${API_BASE}/delete-product/${product.id}`, { method: 'DELETE' });
                Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                loadProducts();
            } catch (err) {
                console.error(err);
                Swal.fire('Error', 'Failed to delete product', 'error');
            }
        }
    });
}




document.getElementById('logoutBtn').addEventListener('click', async () => {
    const token = localStorage.getItem('token'); // get token first
    console.log('Logging out...', token);

    if (!token) {
        Swal.fire('Error', 'No token found, you are not logged in.', 'error');
        return;
    }

    try {
        await axios.post(`${API_BASE}/logout`, {}, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });

        localStorage.removeItem('token');

        Swal.fire('Logged out', 'You have been logged out successfully.', 'success')
            .then(() => {
                window.location.href = 'sign-in.php';
            });

    } catch (err) {
        console.error(err.response?.data || err);
        Swal.fire('Error', err.response?.data?.message || 'Logout failed', 'error');
    }
});
