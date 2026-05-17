<?php
session_start();
include_once '../koneksi.php';
include_once '../models/Study.php';

// CRUD hanya untuk user login
if (!isset($_SESSION['MEMBER'])) {
    header('Location: ../index.php?hal=login&error=1');
    exit;
}

$obj = new Study();
$proses = $_POST['proses'] ?? '';

$title = trim($_POST['title'] ?? '');
$institution = trim($_POST['institution'] ?? '');
$year = trim($_POST['year'] ?? '');
$description = trim($_POST['description'] ?? '');

switch ($proses) {
    case 'simpan':
        $obj->simpan([$title, $institution, $year, $description]);
        break;
    case 'ubah':
        $id = $_POST['idx'] ?? '';
        if (!empty($id)) {
            $obj->ubah([$title, $institution, $year, $description, $id]);
        }
        break;
    case 'hapus':
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            $obj->hapus($id);
        }
        break;
}

header('Location: ../index.php?hal=studies');
exit;

