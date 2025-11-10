<?php
// index.php
// Optionally, start a PHP session if needed
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const API_BASE = "http://127.0.0.1:8000/api"; // set your API base
        const token = localStorage.getItem('token');

        // Show SweetAlert loading
        Swal.fire({
            title: 'Loading Dashboard...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        if (!token) {
            // Not logged in, redirect
            Swal.close();
            window.location.href = 'sign-in.php';
        } else {
            // Verify token
            axios.get(`${API_BASE}/user`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(() => {
                Swal.close(); // close loading if token valid
            }).catch(() => {
                Swal.close();
                window.location.href = 'sign-in.php'; // redirect if token invalid
            });
        }
    </script>
</body>

</html>