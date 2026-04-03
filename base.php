<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Site DBZ</title>
    <style>
        body {
            background-color: #272b33;
            color: #fbc02d;
            margin: 0;
        }
    </style>
</head>
<body>
<nav style="background-color: #FFFFFF; padding: 40px; text-align: center;">
    <a href="Acceuil.php">Accueil</a>
    <a href="index.php">Personnages</a>
    <a href="planet.php">Planètes</a>
    <a href="jeu.php">Jeu</a>

<form action="Acceuil.php" method="get" style="display: inline-block; margin-left: 20px;">
        <input type="text" name="search" placeholder="Entrez votre recherche" style="padding: 5px;"/>
        <button type="submit" style="padding: 5px;">Rechercher</button>
</form>
</nav>
</body>

