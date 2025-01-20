<?php
require_once 'functions.php';

$id = $_GET['id'] ?? null;

if ($id) {
    deletePost($id);
}

header('Location: index.php');
exit;