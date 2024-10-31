<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afbeeldingen</title>
    <link rel="stylesheet" href="stylee.css">
</head>
<style>
/* General styling */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Header styling */
header {
    background-color: #8bc34a;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
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

header h1 {
    margin: 0;
    font-size: 28px;
    color: #fff;
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
}

/* Image grid styling */
.image-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

/* Image container styling */
.image-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 2px solid #8bc34a;
    padding: 10px;
    background-color: #fff;
    border-radius: 10px;
    width: calc(33.33% - 20px); /* Set width of image containers */
    box-sizing: border-box;
}

/* Media query for smaller screens */
@media (max-width: 768px) {
    .image-container {
        width: calc(50% - 20px); /* On tablets, show 2 items per row */
    }
}

@media (max-width: 480px) {
    .image-container {
        width: 100%; /* On small screens or mobile, show 1 item per row */
    }
}

.circuit-image {
    width: 100%; /* Neemt de volledige breedte van de container in */
    height: 200px; /* Beperkt de hoogte van de afbeelding */
    object-fit: cover; /* Zorgt ervoor dat de afbeelding wordt bijgesneden om te passen */
    border-radius: 10px;
    padding-top: 20px;
}

.circuit-details p {
    margin: 5px 0;
    font-size: 16px;
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
    text-align: center;
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
    position: relative;
    width: 100%;
    color: #fff;
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



@keyframes mymove {
    100% {transform: rotate(360deg);}
}

img {
    width: 40px;
    height: 40px;
    position: relative;
    bottom: 20px;
    right: 20px;
}

.btn:link,
.btn:visited {
    text-decoration: none;
    display: inline-block;
    border-radius: 100px;
    transition: all .2s;
    position: absolute;
    bottom: -15px;
    font-size: 15px;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.btn:active {
    transform: translateY(-1px);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.btn::after {
    content: "";
    display: inline-block;
    height: 100%;
    width: 100%;
    border-radius: 100px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    transition: all .4s;
}

.btn-white::after {
    background-color: #fff;
}

.btn:hover::after {
    transform: scaleX(1.4) scaleY(1.6);
    opacity: 0;
}

.btn-animated {
    animation: moveInBottom 5s ease-out;
    animation-fill-mode: backwards;
}

@keyframes moveInBottom {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }

    100% {
        opacity: 1;
        transform: translateY(0px);
    }
}

</style>
<body>
    <header>
        <h1>Dieren opvang</h1>
        <nav>
            

            <div class="text-box">
                <a href="home.php" class="btn btn-white btn-        animate">Home</a>
            </div>

            <div class="text-box">
                <a href="lijst.php" class="btn btn-white btn-        animate">Dieren</a>
            </div>
        </nav>
        <form action="logout.php" method="get" style="display:inline;">
            <input type="submit" value="Uitloggen">
        </form>
    </header>
    
    <div id="myDIV">
        <img src="logo.png" alt="Logo">
    </div>

    <div class="container">
        <?php
        //start de sessie
        session_start();
        //controleert of je bent ingelogd, als niet bent ingelogd stuurt die je door naar login.php.
        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        }
        try{
            //database informatie
            $host = "localhost";
            $user = "root";
            $pass = "root";
            $database = "adoptie_centrum";

            //maak verbinding met de database
            $connectie = new mysqli($host, $user, $pass, $database);

            //controleert of de connectie is gelukt en geeft een error als het niet is gelukt.
            if ($connectie->connect_error) {
                throw new Exception("connectie ging fout: " . $connectie->connect_error);
            }

            //haalt de gegevens op en stopt ze in een query
            $query = "SELECT id, naam, leeftijd, ras, MineType, afbeelding FROM info";
            //prepare de statement
            $statement = $connectie->prepare($query); 
            // voert het statement uit
            $statement->execute(); 
            // Koppel variabelen aan de resultaten
            $statement->bind_result($id, $naam, $leeftijd, $ras, $mineType, $afbeelding);

            //maakt een div
            echo '<div class="image-grid">';

            //loop om alles te echoen
            while ($statement->fetch()) {
                //afbeelding naar base64
                $base64 = base64_encode($afbeelding);
                //div voor de afbeelding
                echo '<div class="image-container">';
                //afbeelding
                echo "<img src='data:$mineType;base64,$base64' class='circuit-image'/>";
                //div voor alle informatie
                echo '<div class="circuit-details">';
                //echo de informatie die jij eerder hebt ingevuld
                echo "<p>Naam: $naam</p>";
                echo "<p>Leeftijd: $leeftijd</p>";
                echo "<p>diersoort: $ras </p>";
                //sluit de div
                echo '</div>';
                //form om alles te verwijderen
                echo '<form action="delete_afbeelding.php" method="post" style="display:inline;">';
                //input hidden om het id mee te geven
                echo "<input type='hidden' name='id' value='$id'>";
                //verwijder knop
                echo '<input type="submit" value="adopteer">';
                //sluit de form
                echo '</form>';
                //form om te updaten
                echo '<form action="update_afbeelding.php" method="get" style="display:inline;">';
                // input hidden om het id mee te geven
                echo "<input type='hidden' name='id' value='$id'>";
                //update knop
                echo '<input type="submit" value="bewerk">';
                //sluit de form
                echo '</form>';
                //sluit de div
                echo '</div>';
            }

            //sluit de div
            echo '</div>';
        }
        // Catch
        catch (Exception $e) {
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
        }
        
        ?>
        <!-- maak een nieuwe div aan om een nieuw circuit up te loaden -->
        <div class="upload-button">
            <!-- maak een form aan -->
            <form action="upload.php" method="get">
                <!-- een knop die je door stuurt naar upload.php -->
                <input type="submit" value="voeg dier toe">
                <!-- sluit de form -->
            </form>
            <!-- sluit de div -->
        </div>
        <!-- sluit de div -->
    </div>
    <!-- maak een footer aan -->
    <footer>
        <!-- zet er een klein tekstje met p in de footer -->
        <p>&copy; 2024 Dieren opvang</p>
        <!-- sluit de footer -->
    </footer>
</body>
</html>
