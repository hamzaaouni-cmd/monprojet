<?php
include 'base.php';

$exclusions = [36,41,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62];

do {
    $id = rand(1, 78);
} while (in_array($id, $exclusions));

$url = "https://dragonball-api.com/api/characters/$id";
$urlAll = "https://dragonball-api.com/api/characters?limit=100";

$response = file_get_contents($url);
$responseAll = file_get_contents($urlAll);

echo "<div id='myDIV'>
<h2 style='text-align:center;'>Qui est-ce ?</h2>
<img id='targetImg' src='' style='border-radius:30px; width:200px; display:block; margin:auto;' /><br>

<input id='myInput' type='text' oninput='getInputValue()'>

<div id='displayText'></div>

<h3>Essais précédents :</h3>
<div id='triesContainer'></div>

</div>";

echo "<button onclick='miFunction()'>Indice</button>";

echo '<script>
let single = ' . $response . ';
let all = ' . $responseAll . ';
let tries = 0;
let maxTries = 10;

function miFunction() {
    alert("Indice : Race: " + (single.race || "Inconnue"));
}

function getInputValue() {
    let input = document.getElementById("myInput").value.toLowerCase();
    let perso = all.items;

    let result = perso.filter(function(el) {
        return el.name.toLowerCase().includes(input);
    });

    let container = document.getElementById("displayText");
    container.innerHTML = "";

    if (input.length > 0 && result.length > 0) {
        result.forEach(function (r) {
            let item = document.createElement("div");
            item.style.cursor = "pointer";

            item.innerHTML =
                "<img src=\'" + r.image + "\' style=\'width:175px;height:175px;object-fit:contain;display:block;\'>" +
                "<p>" + r.name + "</p>";

            item.onclick = function () {
                tries++;

                const triesContainer = document.getElementById("triesContainer");

                let attemptDiv = document.createElement("div");
                attemptDiv.style.border = "1px solid #ccc";
                attemptDiv.style.padding = "5px";
                attemptDiv.style.marginBottom = "5px";
                attemptDiv.style.display = "inline-block";

                let namcolor = r.name === single.name ? "green" : "red";
                let raceColor = r.race === single.race ? "green" : "red";
                let affColor = r.affiliation === single.affiliation ? "green" : "red";
                let genderColor = r.gender === single.gender ? "green" : "red";

                attemptDiv.innerHTML =
                    "<b>" + r.name + "</b><br>" +
                    "Nom: <span style=\'color:" + namcolor + "\'>" + (r.name || "Inconnue") + "</span><br>" +
                    "Race: <span style=\'color:" + raceColor + "\'>" + (r.race || "Inconnue") + "</span><br>" +
                    "Affiliation: <span style=\'color:" + affColor + "\'>" + (r.affiliation || "Inconnue") + "</span><br>" +
                    "Genre: <span style=\'color:" + genderColor + "\'>" + (r.gender || "Inconnu") + "</span>";

                triesContainer.appendChild(attemptDiv);

                if (r.name === single.name) {
                    alert("Bravo ! Tu as deviné le personnage !");
                    document.querySelector("#myDIV h2").innerText = single.name;
                    document.querySelector("#targetImg").src = single.image;
                } else if (tries >= maxTries) {
                    alert("Tu as utilisé tous tes essais ! Le personnage était " + single.name);
                } else {
                    alert("Ce n\'est pas le bon personnage. Essais restants : " + (maxTries - tries));
                }
            };

            container.appendChild(item);
        });
    }
}
</script>';
?>