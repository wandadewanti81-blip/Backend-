<?php
// Gunakan path absolut untuk keamanan
require_once realpath(dirname(__FILE__) . '/../config/database.php');

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Koneksi gagal']);
    exit;
}

$query = "SELECT * FROM history ORDER BY created_at DESC LIMIT 10";
$result = mysqli_query($conn, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>