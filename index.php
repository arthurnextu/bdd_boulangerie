<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title> Stockage </title>
    </head>
    <body>
        <div class="header">
            <h1> Boulangerie Rose </h1>   
            
            <div class="navbar">
                <ul>
                    <li>    
                        <a href="index.php">Accueil</a>
                        <a href="produits.php">Produits</a>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>

        <?php
            $conn = new mysqli("localhost", "root", "", "boulangerie_rose");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);  
            } else {
                echo "Connected successfully";
            }

            
        session_start();
        if (isset($_SESSION['error'])) {
            echo "<div class='error_message'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<div class='success_message'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }

        $conn = new mysqli("localhost", "root", "", "boulangerie_rose");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>

        <div class="content">
            <div class="card">    
                <h2> Pain </h2>
                <form action="add_bread.php" method="post">
                    <input type="text" name="name" placeholder="Nom">
                    <input type="float" name="price" placeholder="Prix">
                    <input type="int" name="quantity" placeholder="Quantité"> <br>
                    <button type="submit">Ajouter</button>
                </form>
            </div>
    
            <div class="card_result">
                <?php
                    $sql = "SELECT * FROM pain";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='cards_result'>";

                            echo "<h2>" . $row["name"] . "</h2>";

                            echo "<ul>";
                            echo "<li>Prix: " . $row["price"] . "€</li>";
                            echo "<li>Quantité: " . $row["quantity"] . "</li>";
                            echo "</ul>";

                            echo "<div class='buttons'>";
                            echo "<form action='increment_bread_quantity.php' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                            echo "<button type='submit' name='decrement'> - </button>";
                            echo "</form>";

                            echo "<form action='increment_bread_quantity.php' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                            echo "<button type='submit' name='increment'> + </button>";
                            echo "</form>";
                            echo "</div>";

                            echo "</div>";
                        }
                    } else {
                        echo "0 results";
                    }
                ?>                
            </div>
                
            <div class="card">
                <h2> Viennoiserie </h2>
                <form action="add_viennoiserie.php" method="post">
                    <input type="text" name="name" placeholder="Nom">
                    <input type="text" name="price" placeholder="Prix">
                    <input type="text" name="quantity" placeholder="Quantité"> <br>
                    <button type="submit">Ajouter</button>
                </form>
            </div>
            
            <div class="card_result">
            <?php
                    $sql = "SELECT * FROM viennoiserie";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='cards_result'>";

                            echo "<h2>" . $row["name"] . "</h2>";

                            echo "<ul>";
                            echo "<li>Prix: " . $row["price"] . "€</li>";
                            echo "<li>Quantité: " . $row["quantity"] . "</li>";
                            echo "</ul>";

                            echo "<div class='buttons'>";
                            echo "<form action='increment_viennoiserie_quantity.php' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                            echo "<button type='submit' name='decrement'> - </button>";
                            echo "</form>";

                            echo "<form action='increment_viennoiserie_quantity.php' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                            echo "<button type='submit' name='increment'> + </button>";
                            echo "</form>";
                            echo "</div>";

                            echo "</div>";
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                ?>   
            </div>
        </div>

    </body>
</html>