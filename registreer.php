<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
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
        color: #333;
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
        <h1>Registreer</h1>
    </header>
    <div class="container">
        <?php
        // Haalt de request method op
        $methodType = $_SERVER["REQUEST_METHOD"];

        //controleert of de method type post is en ofdat je de naam hebt
        if (($methodType == "POST") && (isset($_POST["naam"]))) {
            // Begin met try
            try {
                // Database informatie
                $host = "localhost";
                $user = "root";
                $pass = "root"; // "root" voor MAMP
                $database = "adoptie_centrum";

                //maak verbinding met de database
                $connectie = new mysqli($host, $user, $pass, $database);

                // Controleert of de connectie is gelukt en gooit een nieuwe exception
                if ($connectie->connect_error) {
                    throw new Exception($connectie->connect_error);
                }

                //voegt naam en wachtwoord toe aan de databse login
                $query = "INSERT INTO login(naam, wachtwoord) VALUES (?, ?)";
                //prepare de statement
                $statement = $connectie->prepare($query);

                //haal de naam op
                $postNaam = $_POST["naam"];
                //haal het wachtwoord op
                $postWachtwoord = $_POST["wachtwoord"];
                // Gebruik htmlspecialchars voor het beveiligen van je naam
                $veiligNaam = htmlspecialchars($postNaam);
                //hashed het wachtwoord zodat het anders in de databse staat
                $veiligWachtwoord = password_hash($postWachtwoord, PASSWORD_DEFAULT);

                // Koppel je naam aan een query
                $statement->bind_param("ss", $veiligNaam, $veiligWachtwoord);

                // Voer de query uit
                if (!$statement->execute()) {
                    // Als het niet werkt gooi je een nieuwe exception
                    throw new Exception($connectie->error);
                }
                //cookie die wordt gemaakt als de registratie is gelukt en voor 2 seconden blijft staan.
                setcookie("bericht", "Registratie gelukt", time()+2);

            // Catch
            } catch (Exception $e) {
                // Toont de foutmelding als die er is
                echo "oops: ". $e->getMessage();
            //fanally
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
                //als het registreren is gelukt wordt je doorgestuurd naar login.php
                header("location: login.php");
            }
        }
        ?>
        <!-- maak een form voor het invullen van je naam en wachtwoord -->
        <form action="registreer.php" method="post">
            <!-- label naam -->
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
            <input type="submit" value="registreer">
            <br>
        </form>
        <!-- Form voor een login knop -->
        <form action="login.php" method="get" style="margin-top: 10px;">
            <!-- Knop die je door stuurt naar login.php als je nog moet inloggen -->
            <input type="submit" value="Login">
        </form>
    </div>
    <footer>
        <!-- Zet er een klein tekstje met p in de footer -->
        <p>&copy; 2024 Dieren opvang</p>
        <!-- Sluit de footer -->
    </footer>
</body>
</html>
