<?php
session_start();
require_once('config.php');

if(isset($_POST['reference_num'])){
    $reference_num = $_POST['reference_num'];

    $query = "SELECT * FROM conslutation_message_table WHERE references_num = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $reference_num);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No message found']);
    }
} else {
    echo json_encode(['error' => 'Reference number not provided']);
}
?>
