<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expression = $_POST['expression'];
    
    // Keamanan: Evaluasi matematika dasar
    // Untuk PHP native, kita bisa menggunakan eval() dengan filter ketat atau parser
    try {
        // Mengganti simbol visual ke operator matematika
        $cleanExpression = str_replace(['×', '÷'], ['*', '/'], $expression);
        
        // Menghitung hasil
        $result = eval("return $cleanExpression;");
        
        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO history (expression, result) VALUES (?, ?)");
        $stmt->bind_param("ss", $expression, $result);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'result' => $result]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Expression']);
    }
}
?>