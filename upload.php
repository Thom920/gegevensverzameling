<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Afbeelding</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
/* General styling */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4; /* Light background */
    color: #333; /* Darker text color for readability */
    margin: 0;
    padding: 0;
}

/* Header styling */
header {
    background-color: #8bc34a; /* A friendly green color */
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    margin: 0;
    font-size: 28px;
    color: #fff; /* White text */
}

header form {
    margin: 0;
}

header input[type="submit"] {
    background-color: #fff;
    color: #8bc34a;
    border: 1px solid #fff;
    padding: 5px 10px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

header input[type="submit"]:hover {
    background-color: #7cb342;
    color: #fff;
}

/* Container styling */
.container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - 80px); /* Adjust for header/footer height */
}

/* Form styling */
form {
    background-color: #fff; /* White background */
    padding: 20px;
    border: 1px solid #8bc34a;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="password"],
form input[type="number"],
form input[type="file"] {
    width: calc(100% - 22px); /* Adjust for padding and border */
    padding: 10px;
    margin: 5px 0 10px;
    border: 1px solid #8bc34a;
    border-radius: 5px;
    background-color: #f9f9f9;
    color: #333;
}

form input[type="submit"] {
    background-color: #8bc34a;
    color: #fff;
    border: none;
    padding: 10px 20px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 5px;
}

form input[type="submit"]:hover {
    background-color: #7cb342;
    color: #fff;
}

/* Footer styling */
footer {
    background-color: #8bc34a;
    padding: 10px 20px;
    text-align: center;
    position: absolute;
    bottom: 0;
    width: 100%;
    color: #fff; /* White text in the footer */
}

footer p {
    margin: 0;
    font-size: 14px;
}


</style>
<body>
    <header>
        <h1>Voeg dier toe</h1>
    </header>
    <!-- een div waar alles in komt -->
    <div class="container">
        <?php
        // Start de sessie
        session_start();
        //controleert of je bent ingelogd, als niet bent ingelogd stuurt die je door naar login.php.
        if (!isset($_SESSION["login"])) {
            header("location:login.php");
            exit;
        }

        //controleert of de method type post is
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $host = "localhost";
                $user = "root";
                $pass = "root";
                $database = "adoptie_centrum";
                
                $connectie = new mysqli($host, $user, $pass, $database);
                
                if ($connectie->connect_error) {
                    throw new Exception("connectie ging fout: " . $connectie->connect_error);
                }
        
                $mineType = $_FILES["afbeelding"]["type"];
                $binary = file_get_contents($_FILES["afbeelding"]["tmp_name"]);
                $naam = $_POST["naam"];
                $leeftijd = $_POST["leeftijd"];
                $ras = $_POST["ras"];
                
                $query = "INSERT INTO info (naam, leeftijd, ras, mineType, afbeelding) VALUES (?, ?, ?, ?, ?)";
                $statement = $connectie->prepare($query);
                $null = NULL; // Placeholder voor de BLOB data
                $statement->bind_param("sissb", $naam, $leeftijd, $ras, $mineType, $null);
                $statement->send_long_data(4, $binary);
                
                if ($statement->execute()) {
                    header("Location: lijst.php");
                    exit;
                } else {
                    echo "Er is iets misgegaan: " . $statement->error;
                }
            } catch (Exception $e) {
                echo "oops: ". $e->getMessage();
            } finally {
                if (isset($statement) && $statement) {
                    $statement->close();
                }
                if (isset($connectie) && $connectie) {
                    $connectie->close();
                }
            }
        }
        ?>
        <!-- Maak een form waar je je gegevens kan invullen -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <!-- label naam -->
            <label>Naam:</label>
            <br>
            <!-- input om je naam intevoeren -->
            <input type="text" name="naam" required>
            <br>
            <!-- label circuit lengte (km) -->
            <label>Leeftijd:</label>
            <br>
            <!-- input om de lengte van het circuit in te vullen -->
            <input type="number" name="leeftijd" required>
            <br>
            <!-- label aantal rondes -->
            <label>Diersoort:</label>
            <br>
            <!-- input om het aantal rondes in te vullen -->
            <input type="text" name="ras" required>
            <br>
            <!-- labal afbeelding -->
            <label>Afbeelding:</label>
            <br>
            <!-- input om een afbeelding te kiezen -->
            <input type="file" name="afbeelding" required>
            <br>
            <!-- input voor een submit knop -->
            <input type="submit" value="voeg toe">
            <br>
        </form>
    </div>
    <footer>
        <!-- Zet er een klein tekstje met p in de footer -->
        <p>&copy; 2024 Dieren opvang</p>
    <!-- Sluit de footer -->    
    </footer>
</body>
</html>