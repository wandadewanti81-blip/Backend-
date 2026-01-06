<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $op = mysqli_real_escape_string($conn, $_POST['operation']);
    $res = mysqli_real_escape_string($conn, $_POST['result']);
    
    if ($op !== "" && isset($res)) {
        $query = "INSERT INTO history (operation, result) VALUES ('$op', '$res')";
        mysqli_query($conn, $query);
    }
}
?>