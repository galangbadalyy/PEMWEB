<?php
session_start();
require_once '../models/Member.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $obj_member = new Member();
    $member = $obj_member->login($username, $password);

    if ($member) {
        // Simpan session
        $_SESSION['MEMBER'] = $member;
        header('location: ../index.php?hal=home');
        exit;
    } else {
        // Login gagal, kirim pesan error
        header('location: ../index.php?hal=login&error=1');
        exit;
    }
}