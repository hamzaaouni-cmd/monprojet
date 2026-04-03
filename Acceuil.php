<?php
include 'functions.php';
include 'base.php';

if (isset($_GET['search'])) {

    $search = trim($_GET['search']);

    if (empty($search)) {
        echo "<h2>Veuillez entrer une recherche.</h2>";
        exit;
    }

    $urlCharacter = "https://dragonball-api.com/api/characters?name=$search";
    $urlPlanet = "https://dragonball-api.com/api/planets?name=$search";

    $responseCharacter = @file_get_contents($urlCharacter);
    $responsePlanet    = @file_get_contents($urlPlanet);

    $characters = $responseCharacter ? json_decode($responseCharacter, true) : [];
    $planets    = $responsePlanet ? json_decode($responsePlanet, true) : [];

    if (array_key_exists('items', $planets)) {
        $planets = $planets['items'];
    }

    $data = array_merge($characters, $planets);

    if (count($data) > 0) {
        echo "Nombre résultat pour '" . htmlspecialchars($search) . "' : " . count($data) . "<br>";
    } else {
        echo "Pas de résultat";
        exit;
    }

    echo "<div style='display:flex; flex-wrap:wrap; justify-content:center; gap:20px;'>";

    foreach ($data as $object) {
        echo "<div style='width:200px; border:1px solid #ccc; padding:10px; text-align:center; background:#f8f8f8; border-radius:10px;'>";

        echo "<div style='width:175px; height:250px; margin:auto; display:flex; align-items:center; justify-content:center; border-radius:20px; overflow:hidden;'>";
        echo "<img src='{$object['image']}' style='max-width:100%; max-height:100%; object-fit:contain;'>";
        echo "</div><br>";

        echo "<h3>{$object['name']}</h3>";

        if (isset($object['race'])) {
            echo "<a href='index.php?id={$object['id']}' class='btn btn-primary'>Infos Personnages</a>";
        } else {
            echo "<a href='planet.php?id_planet={$object['id']}' class='btn btn-primary'>Infos Planètes</a>";
        }

        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<h2>Entrez votre recherche</h2>";
}
?>