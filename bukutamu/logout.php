<?php

session_start();

unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['nama_pengguna']);

session_destroy();
echo "<script>alert('Anda telah berhasil logout');
    document.location='index.php';
    </script>";