<?php
session_start();
include_once '../koneksi.php';
include_once '../models/Member.php';

// 1. Tangkap request form
$uname = $_POST['username'];
$pass = $_POST['password'];

// 2. Simpan Ke sebuah array
$data = [
    $uname,
    $pass
];

// 3. Eksekusi tombol
$obj = new Member();
$rs = $obj->cekLogin($data);

// die ($rs);

if(!empty($rs)){ //-------sukses login----------
    $_SESSION['MEMBER'] = $rs;
    //landing page
    header('location:http:../index.php?hal=produk_list');
}
else{//-------gagal login----------
    echo '<script>alert("Username/Password Anda
            Salah!!!");history.go(-1);</script>';
}
?>