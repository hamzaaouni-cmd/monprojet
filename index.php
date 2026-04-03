<?php
include 'functions.php';
include 'base.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $url = "https://dragonball-api.com/api/characters/$id";

    $response = @file_get_contents($url);
    if ($response === FALSE) {
        die("Erreur lors de l'appel à l'API");
    }

    $character = json_decode($response, true);

    afficherCharacter($character);

    if (isset($character['transformations']) && !empty($character['transformations'])) {
        echo "<h2 style='text-align:center;'>Transformations</h2>";
        echo "<div style='display:flex; flex-wrap:wrap; justify-content:center; gap:20px;'>";

        $i = 0;
        foreach ($character['transformations'] as $transformation) {
            echo "<div style='width:220px; border:1px solid #ccc; padding:10px; text-align:center; background:#f8f8f8; border-radius:10px;'>";

            echo "<div style='width:200px; height:250px; margin:auto; background:#f8f8f8; display:flex; align-items:center; justify-content:center; border-radius:20px; overflow:hidden;'>";
            echo "<img src='{$transformation['image']}' style='max-width:100%; max-height:100%; object-fit:contain;'>";
            echo "</div><br>";

            echo ($i + 1) . ". {$transformation['name']}<br>";
            echo "Ki: {$transformation['ki']}<br>";
            echo "</div>";

            $i++;
            if ($i % 5 == 0) {
                echo "<div style='flex-basis:100%; height:0;'></div>";
            }
        }

        echo "</div>";
    }

} else {
    $url = "https://dragonball-api.com/api/characters?limit=100";
    $response = @file_get_contents($url);

    if ($response === FALSE) {
        die("Erreur lors de l'appel à l'API pour les personnages.");
    }

    $data = json_decode($response, true);
    $characters = isset($data['items']) ? $data['items'] : [];

    echo "<h2 style='text-align:center;'>Liste de tous les personnages</h2>";
    echo "<div style='display:flex; flex-wrap:wrap; justify-content:center; gap:20px;'>";

    $i = 0;
    foreach ($characters as $character) {
        echo "<div style='width:200px; border:1px solid #ccc; padding:10px; text-align:center; background:#f8f8f8; border-radius:10px;'>";

        echo "<div style='width:175px; height:250px; margin:auto; display:flex; align-items:center; justify-content:center; border-radius:20px; overflow:hidden;'>";
        echo "<img src='{$character['image']}' style='max-width:100%; max-height:100%; object-fit:contain;'>";
        echo "</div><br>";
        echo "<h3>{$character['name']}</h3>";
        echo "<a href='index.php?id={$character['id']}' class='btn btn-primary'>Infos Personnages</a>";
        echo "</div>";

        $i++;
        if ($i % 4 == 0) {
            echo "<div style='flex-basis:100%; height:0;'></div>";
        }
    }
    echo "</div>";
}
?>