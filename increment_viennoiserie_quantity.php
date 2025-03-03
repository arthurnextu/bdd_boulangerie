<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $conn = new mysqli("localhost", "root", "", "boulangerie_rose");
    if ($conn->connect_error) {
        $_SESSION['error'] = "Connection failed: " . $conn->connect_error;    }

    if (isset($_POST['increment'])) {
        $sql = "UPDATE viennoiserie SET quantity = quantity + 1 WHERE id = ?";
    } elseif (isset($_POST['decrement'])) {
        $sql = "UPDATE viennoiserie SET quantity = quantity - 1 WHERE id = ?";
    }

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        $_SESSION['error'] = "Erreur de préparation: " . $conn->error;
    }

    $conn->close();

    // Redirection vers l'index après la mise à jour
    header("Location: index.php");
    exit();
}
?>