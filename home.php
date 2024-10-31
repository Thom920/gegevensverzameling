<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    padding: 20px;
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

.welcome {
    text-align: center;
    padding: 50px 20px;
    background-color: #fff;
    border-radius: 10px;
    margin: 20px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 800px;
}

.welcome h2 {
    font-size: 32px;
    color: #8bc34a;
    margin-bottom: 20px;
}

.welcome p {
    font-size: 18px;
    color: #333;
    line-height: 1.5;
    margin-bottom: 20px;
}

.cta-button {
    display: inline-block;
    background-color: #8bc34a;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #7cb342;
}

.glow-on-hover {
    width: 220px;
    height: 50px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
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
    session_start();
        //controleert of je bent ingelogd, als niet bent ingelogd stuurt die je door naar login.php.
        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        }
        ?>
        <section class="welcome">
            <h2>Welkom bij de Dieren opvang</h2>
            <p>Wij bieden zorg en onderdak voor dieren in nood. Bekijk onze lijst van dieren die beschikbaar zijn voor adoptie en help ze een nieuw thuis te vinden.</p>
            <p>We nodigen je uit om een kijkje te nemen naar onze dieren of om vrijwilliger te worden.</p>


            <button class="glow-on-hover" type="button">Bekijk de dieren</button>

</section>
    </div>
</body>
</html>