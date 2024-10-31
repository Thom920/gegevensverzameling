<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Afbeelding</title>
</head>
<body>
    <?php
    //start de sessie
    session_start();
    //controleert of je bent ingelogd, als niet bent ingelogd stuurt die je door naar login.php.
    if (!isset($_SESSION["login"])) {
        header("location:login.php");
        exit;
    }
    //maak een functie aan
    try{
    function deleteAfbeelding($id) {
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

        //maak een query aan
        $query = "DELETE FROM info WHERE id = ?";
        //prepare de statement
        $statement = $connectie->prepare($query);
        //koppel het id van de afbeelding aan het statement
        $statement->bind_param("i", $id);

        //voert de statement uit en controleert of het gelukt is
        if ($statement->execute()) {
            echo "Afbeelding verwijderd!";
        } else {
            //bericht dat wordt getoond als het niet is gelukt
            echo "Er is iets misgegaan: " . $statement->error;
        }
    }

    //controleert of het een post request is
    if ($_SERVER["REQUEST_METHOD"]) {
        //haalt het id van de afbeelding op
        $id = $_POST["id"];
        //roep de functie aan
        deleteAfbeelding($id);
        //na het verwijderen wordt je gelijk terug gestuurd naar lijst.php
        header("location:lijst.php");
        exit;
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
}
    ?>
</body>
</html>
