<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Afbeelding</title>
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
            background-color: #fff;
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
        form input[type="number"],
        form input[type="file"] {
            width: calc(100% - 22px); /* Adjust for padding and border */
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #8bc34a;
            border-radius: 5px;
            background-color: #f4f4f4;
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

        /* Image container styling */
        .image-container {
            display: flex;
            align-items: center;
            border: 2px solid #8bc34a;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fff; /* White background for contrast */
            border-radius: 10px;
        }

        .circuit-image {
            max-width: 300px;
            margin-right: 20px;
            border-radius: 10px; /* Rounded corners for images */
        }

        .circuit-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        /* Upload button styling */
        .upload-button {
            margin-top: 20px;
        }

        .upload-button form input[type="submit"] {
            background-color: #8bc34a;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 10px;
            font-size: 18px;
        }

        .upload-button form input[type="submit"]:hover {
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
        <h1>Bewerk</h1>
    </header>
    <!-- maak een div waar alles in komt -->
    <div class="container">
        <?php
        // Start de sessie
        session_start();
        //controleert of je al bent ingelogd
        if (!isset($_SESSION["login"])) {
            //als je niet bent ingelogd wordt door gestuurd naar login.php
            header("location:login.php");
            exit;
        }
        try{
            // Database informatie
            $host = "localhost";
            $user = "root";
            $pass = "root";
            $database = "adoptie_centrum";

            // Maak verbinding met de database
            $connectie = new mysqli($host, $user, $pass, $database);

            //controleert of de connectie is gelukt en geeft een error als het niet is gelukt.
            if ($connectie->connect_error) 
            {
                throw new Exception("connectie ging fout: " . $conn->connect_error);
            }

            // Controleer of het een POST request is en of je het id hebt
            if ($_SERVER["REQUEST_METHOD"]&& isset($_POST["id"])) {
                //haal het id op
                $id = $_POST["id"];
                //haal het type van de afbeelding op
                $mineType = $_FILES["afbeelding"]["type"];
                //haal de afbeelding op
                $binary = file_get_contents($_FILES["afbeelding"]["tmp_name"]);
                //haal de naam op
                $naam = $_POST["naam"];
                // Haal de nieuwe circuitlengte op
                $leeftijd = $_POST["leeftijd"];
                // Haal het nieuwe aantal rondes op
                $ras = $_POST["ras"];

                //query om afbeelding te updaten
                $query = "UPDATE info SET naam = ?, mineType = ?, afbeelding = ?, leeftijd = ?, ras = ? WHERE id = ?";
                //prepare de statement
                $statement = $connectie->prepare($query);
                // Koppel de variabelen aan de query
                $statement->bind_param("ssbisi", $naam, $mineType, $null, $leeftijd, $ras, $id);
                //stuur de data van de afbeelding
                $statement->send_long_data(2, $binary);

                // Voer de query uit en controleer of het lukt
                if ($statement->execute()) {
                    // doorgestuurd naar lijst.php
                    header("Location: lijst.php"); 
                    exit;
                } else {
                    //bericht dat wordt getoond als het niet lukt
                    echo "Er is iets misgegaan: " . $statement->error;
                }

            } else {
                //haal het id van de afbeelding op
                $id = $_GET["id"];
                //query om informatie van het circuit op te halen
                $query = "SELECT naam, mineType, leeftijd, ras FROM info WHERE id = ?";
                //prepare de statement
                $statement = $connectie->prepare($query);
                //koppel het id aan de query
                $statement->bind_param("i", $id);
                //execute de query
                $statement->execute();
                //koppel de uitkomst aan de query
                $statement->bind_result($naam, $mineType, $leeftijd, $ras);
                //haal de resultaten op
                $statement->fetch();
            }
        } catch (Exception $e) {
            // Toont de foutmelding als die er is
            echo "oops: ". $e->getMessage();
        } finally {
            //controleert of het statament nog bestaat
            if (isset($statement) && $statement) {
                //sluit het statement
                $statement->close();
            }
        
            //controleert of de connectie nog bestaat
            if (isset($connectie) && $connectie) {
                //sluit de connectie
                $connectie->close();
            }
        };
        ?>

        <!-- Maak een form waar je je gegevens kan invullen -->
        <form action="update_afbeelding.php" method="post" enctype="multipart/form-data">
            <!-- Verborgen input voor het id -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- label naam -->
            <label>Naam:</label>
            <br>
            <!-- input om je naam intevoeren -->
            <input type="text" name="naam" value="<?php echo htmlspecialchars($naam); ?>" required>
            <br>
            <!-- label circuit lengte (km) -->
            <label>Leeftijd:</label>
            <br>
            <!-- input om de lengte van het circuit in te vullen -->
            <input type="number" name="leeftijd" value="<?php echo htmlspecialchars($leeftijd); ?>" required>
            <br>
            <!-- label aantal rondes -->
            <label>Diersoort:</label>
            <br>
            <!-- input om het aantal rondes in te vullen -->
            <input type="text" name="ras" value="<?php echo htmlspecialchars($ras); ?>" required>
            <br>
            <!-- labal afbeelding -->
            <label>Afbeelding:</label>
            <br>
            <!-- input om een afbeelding te kiezen -->
            <input type="file" name="afbeelding" required>
            <br>
            <!-- input voor een submit knop -->
            <input type="submit" value="werk bij">
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
