<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

    <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-3">Sign Up</h3>
        <form id="signupForm">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" required placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" required placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" required placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" required placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <p class="text-center mt-3">Already have an account? <a href="sign-in.php">Sign In</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const API_BASE = "http://127.0.0.1:8000/api";

        document.getElementById('signupForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                Swal.fire('Error', 'Passwords do not match', 'error');
                return;
            }

            try {
                Swal.fire({
                    title: 'Creating account...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                // Register user
                const registerRes = await axios.post(`${API_BASE}/register`, {
                    name,
                    email,
                    password
                });

                if (registerRes.status === 200) {
                    // Automatically log in after successful registration
                    const loginRes = await axios.post(`${API_BASE}/login`, {
                        email,
                        password
                    });
                    
                    localStorage.setItem('token', loginRes.data.access_token);
                    Swal.close();
                    if (loginRes.status === 200) {

                        Swal.fire('Success', 'Logged in successfully!', 'success').then(() => {
                            window.location.href = 'dashboard.php';
                        });
                    }
                }
            } catch (err) {
                Swal.close();
                Swal.fire('Error', err.response?.data?.message || 'Sign up failed', 'error');
            }
        });
    </script>
</body>

</html>