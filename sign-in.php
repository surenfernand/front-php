<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

<div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
    <h3 class="text-center mb-3">Sign In</h3>
    <form id="loginForm">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" required placeholder="Enter email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" required placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign In</button>
        <p class="text-center mt-3">Don't have an account? <a href="sign-up.php">Sign Up</a></p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        // Example POST request to your API
        const res = await axios.post('/api/login', { email, password });
        Swal.fire('Success', 'Logged in successfully!', 'success').then(() => {
            window.location.href = 'dashboard.php';
        });
    } catch (err) {
        Swal.fire('Error', err.response?.data?.message || 'Login failed', 'error');
    }
});
</script>
</body>
</html>
