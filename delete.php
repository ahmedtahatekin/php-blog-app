<?php
require_once __DIR__ . "/config/db.php";

if (isset($_POST['delete-id'])) {
    $id = $_POST['delete-id'];
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = :id");
    $stmt->execute([":id" => $id]);
}
header("Location: /");
exit;
