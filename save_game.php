<?php
include 'db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $player_move = $_POST['player_move'] ?? '';
    $comp_move = $_POST['comp_move'] ?? '';
    $result = $_POST['result'] ?? '';

    $stmt = $conn->prepare("INSERT INTO games (player_name, move, move_comp, result, time) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $player_move, $comp_move, $result);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
    $conn->close();
}
