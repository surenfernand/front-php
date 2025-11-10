    const API_BASE = "http://127.0.0.1:8000/api";


       const tableBody = document.getElementById('productTable');

        async function loadProducts() {
            try {
                const response = await fetch(`${API_BASE}/products`); // API endpoint
                if (!response.ok) throw new Error('Network response was not ok');

                console.log('Response status:', response);

                const products = await response.json();
                tableBody.innerHTML = '';

                products.forEach((p, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
          <td>${p.name}</td>
          <td>${p.description}</td>
          <td>$${p.price}</td>
          <td>${p.stock_quantity}</td>
          <td>
            <button class="edit" onclick="editProduct(${index})">Edit</button>
            <button class="delete" onclick="deleteProduct(${index})">Delete</button>
          </td>
        `;
                    tableBody.appendChild(tr);
                });
            } catch (error) {
                console.error('Error loading products:', error);
                tableBody.innerHTML = '<tr><td colspan="5">Failed to load products.</td></tr>';
            }
        }

        function editProduct(index) {
            alert('Edit functionality not implemented yet.');
        }

        function deleteProduct(index) {
            alert('Delete functionality not implemented yet.');
        }

        // Load products on page load
        loadProducts();



          document.getElementById("addProductForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const name = document.getElementById("productName").value;
            const description = document.getElementById("productDescription").value;
            const price = parseFloat(document.getElementById("productPrice").value);
            const stock_qty = parseInt(document.getElementById("productStock").value);

            try {
                const res = await axios.post(`${API_BASE}/save-product`, {
                    name,
                    description,
                    price,
                    stock_qty
                });

                alert("Product added successfully!");
                console.log(res.data);

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById("addProductModal"));
                modal.hide();

                // Optionally refresh product table here
                loadProducts();

            } catch (err) {
                console.error(err);
                alert("Error: " + err.response?.data?.message || err.message);
            }
        });