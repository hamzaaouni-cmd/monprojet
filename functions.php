<?php


function afficherCharacter($character){
    echo "<h2 style='text-align:center'>{$character['name']} (Forme de base)</h2>";
    echo "<div style='text-align:center; padding:10px;'>";
    echo "<img src='{$character['image']}' style='border-radius:30px; width: 200px; display:block; margin:auto;'><br>";
    echo "Description: {$character['description']}<br>";
    echo "KI de base: {$character['ki']}<br>";
    echo "KI Maximum: {$character['maxKi']}<br>";
    echo "Race: {$character['race']}<br>";
    echo "Genre: {$character['gender']}<br>";
    echo "Equipe: {$character['affiliation']}<br>";
    echo "Planète: {$character['originPlanet']['name']}<br>";
    echo "<a href='planet.php?id_planet={$character['originPlanet']['id']}' class='btn btn-primary'>Infos Planètes</a>";
    echo "</div>";
}
function afficherPlanet($planet,$width = '300px'){
    echo "<h1 style='text-align:center'>{$planet['name']}</h1>";
    echo "<div style='text-align:center; padding:10px;'>";
    echo "<img src='{$planet['image']}' style='border-radius:30px; width:{$width};'><br>";
    echo "Planète: {$planet['name']}<br>";
    echo "Description: {$planet['description']}<br>";
    echo "<p>Planète détruite: " . ($planet['isDestroyed'] ? "Oui" : "Non") . "</p>";
    echo "</div>";
}
?>

