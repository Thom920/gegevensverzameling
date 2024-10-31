<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
    /* General styling */
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4; /* Light background */
            color: #333; /* Darker text color for readability */
            margin: 0;
            padding: 0;
        }

        nav {
    display: flex;
    gap: 500px;
    position: relative;
    right: 50px;
}

nav a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

nav a:hover {
    background-color: #7cb342;
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

        /* Message styling */
        .message {
            background-color: #8bc34a; /* Matching green color */
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form styling */
        #form {
            background-color: #fff; /* White background for contrast */
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
            color: #333; /* Darker text for readability */
        }

        form input[type="text"],
        form input[type="password"] {
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
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #7cb342;
            color: #fff;
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

        #myDIV {
            margin: auto;
            border: 1px solid black;
            width: 1px;
            height: 1px;
            animation: mymove 5s infinite;
            position: relative;
            bottom: 30px;
        }

        img {
            width: 40px;
            height: 40px;
            position: relative;
            bottom: 20px;
            right: 20px;
        }

        @keyframes mymove {
            100% {transform: rotate(360deg);}
        }
    </style>
</head>
<body>
<header>
        <h1>inloggen</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="lijst.php">Dieren</a>
        </nav>
        <form action="logout.php" method="get" style="display:inline;">
            <input type="submit" value="Uitloggen">
        </form>
    </header>
    
    <div id="myDIV">
        <img src="logo.png" alt="Logo">
    </div>
    <!-- maak een div waar alles in komt -->
    <div class="container">
        <?php
        // Start de sessie
        session_start();
        // Haalt de request method op
        $methodType = $_SERVER["REQUEST_METHOD"];

        // Controleert of er een cookie bericht is
        if (isset($_COOKIE["bericht"])) {
            // Haalt het bericht op en stopt het in een variabele
            $bericht = $_COOKIE["bericht"];
            // Echo het bericht in een div met class message
            echo "<div class='message'>$bericht</div>";
            // Zorgt ervoor dat het bericht na 2 seconden verdwijnt
            setcookie("bericht", "", time()+2, "/");
        }

        // Controleert of de methodtype POST is en of de naam is ingevuld
        if ($methodType == "POST" && isset($_POST["naam"])) {
            // Begin met try
            try {
                // Database informatie
                $host = "localhost";
                $user = "root";
                $pass = "root"; // "root" voor MAMP
                $database = "adoptie_centrum";

                // Maak verbinding met de database
                $connectie = new mysqli($host, $user, $pass, $database);

                // Controleert of de connectie is gelukt en gooit een nieuwe exception
                if ($connectie->connect_error) {
                    throw new Exception("connectie ging fout: " . $connectie->connect_error);
                }

                // Selecteert alles dat in de database login staat en stopt het in een query
                $query = "SELECT * FROM login WHERE naam = ?";
                //prepare de statement
                $statement = $connectie->prepare($query);

                // Haal de naam op
                $postNaam = $_POST["naam"]; 
                // Haal het wachtwoord op
                $postWachtwoord = $_POST["wachtwoord"];
                // Gebruik htmlspecialchars voor het beveiligen van je naam
                $veilignaam = htmlspecialchars($postNaam);
                
                // Koppel je naam aan een query
                $statement->bind_param("s", $veilignaam);

                // Voer de query uit
                if (!$statement->execute()) {
                    // Als het niet werkt gooi je een nieuwe exception
                    throw new Exception($statement->error);
                }

                // Koppel variabelen aan de resultaten
                $statement->bind_result($id, $naam, $wachtwoord);

                // Standaard waarde voor databaseNaam zodat als het niet werkt je error ziet
                $databaseNaam = "<error>";
                // Standaard waarde voor databaseWachtwoord zodat als het niet werkt je error ziet
                $databaseWachtwoord = "<error>";
        
                // Loop voor de resultaten
                while ($statement->fetch()) {
                    // Zet naam in databaseNaam
                    $databaseNaam = $naam;
                    // Zet wachtwoord in databaseWachtwoord
                    $databaseWachtwoord = $wachtwoord;
                }
                
                // Controleer ofdat er een error is bij de databaseNaam
                if ($databaseNaam == "<error>") {
                    // Bericht voor als er een error is
                    echo "<div class='message'>geen gebruiker in de database</div>";
                    // Controleer ofdat het wachtwoord klopt
                } else if (!password_verify($postWachtwoord, $databaseWachtwoord)) {
                    // Bericht voor als je wachtwoord niet klopt
                    echo "<div class='message'>Slecht wachtwoord</div>";
                } else {
                    // Als je naam en wachtwoord kloppen wordt je ingelogd
                    // Nieuwe cookie voor het bericht login GELUKT! dat je voor 2 seconden ziet
                    setcookie("bericht", "Login GELUKT!", time() + 2, "/");
                    // Zet de databaseNaam in een sessie
                    $_SESSION["login"] = $databaseNaam;
                    // Zet de databaseId in een sessie
                    $_SESSION["login_id"] = $id;
                    // Zet de databaseNaam in een sessie
                    $_SESSION["login_name"] = $databaseNaam;
                    // Als het inloggen is gelukt wordt je gelijk door gestuurd naar lijst.php
                    header("Location: home.php");
                    exit();
                }
                // Catch
            } catch (Exception $e) {
                // Toont de foutmelding als die er is
                echo "<div class='message'>Er is iets misgegaan: " . $e->getMessage() . "</div>";
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
            }
        }
        ?>
        <!-- Maak een form waar je je gegevens kan invullen -->
        <form id="form" action="login.php" method="post">
            <!-- Label naam -->
            <label>Naam:</label>
            <br>
            <!-- Input veld waar je je naam moet invullen -->
            <input type="text" name="naam" required>
            <br>
            <!-- Label wachtwoord -->
            <label>Wachtwoord:</label>
            <br>
            <!-- Input veld waar je je wachtwoord moet invullen -->
            <input type="password" name="wachtwoord" required>
            <br>
            <!-- Submit knop -->
            <input type="submit" value="Login">
            <br>
        </form>
        <!-- Form voor een registreer knop -->
        <form action="registreer.php" method="get" style="margin-top: 10px;">
            <!-- Knop die je door stuurt naar registreer.php als je nog moet registreren -->
            <input type="submit" value="Registreer">
        </form>
    </div>
    <footer>
        <!-- Zet er een klein tekstje met p in de footer -->
        <p>&copy; 2024 Dieren opvang</p>
        <!-- Sluit de footer -->
    </footer>
</body>
</html>