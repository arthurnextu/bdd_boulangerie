<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = (string) $_POST['name'];
    $price = (float) $_POST['price'];
    $quantity = (int) $_POST['quantity'];

    echo "Quantité récupérée : " . $quantity . "<br>";
    var_dump($quantity);

    $conn = new mysqli("localhost", "root", "", "boulangerie_rose");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $verifiy = "SELECT name FROM pain WHERE name = ?";

    if ($stmt = $conn->prepare($verifiy)) {
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = "Le pain existe déjà.";
        } elseif ($quantity !== 0) {
            $_SESSION['error'] = "La quantité doit être égale à 0";
        } else {
            $stmt->close();

            // Préparer la requête d'insertion
            $sql = "INSERT INTO pain (name, price, quantity) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sdi", $name, $price, $quantity);

                if ($stmt->execute()) {
                    // Redirection après l'insertion réussie
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Erreur: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $_SESSION['error'] = "Erreur de préparation: " . $conn->error;
            }
        }
    } else {
        $_SESSION['error'] = "Erreur de préparation: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirection après l'insertion réussie
    header("Location: index.php");
}
?>