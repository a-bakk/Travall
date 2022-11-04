<?php

include_once("common/functions.php");

if ($_POST["frompage"] === "cities") {
    $varosnev = $_POST["in_varosnev"];
    $iranyitoszam = $_POST["in_iranyitoszam"];
    $orszag = $_POST["in_orszag"];

    if (trim($varosnev) === "" || trim($iranyitoszam) === "" || trim($orszag) === "") {
        header("Location: cities.php?missingdata=true");
    } else {
        if (strlen($varosnev) > 85 || strlen($iranyitoszam) > 10 || strlen($orszag) > 56) {
            header("Location: cities.php?invaliddata=true");
        } else {
            $what = "(varosnev, iranyitoszam, orszag)";
            $data = [$varosnev, $iranyitoszam, $orszag];
            if (create_data("varos", $what, $data)) {
                header("Location: cities.php?success=true");
            } else {
                header("Location: cities.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "routes") {
    $tipus = $_POST["in_tipus"];
    $szolgaltato = $_POST["in_szolgaltato"];
    $ev = $_POST["in_ev"]; // validation must've been done already by form control for these values - nevertheless that could be overridden
    $honap = $_POST["in_honap"];
    $nap = $_POST["in_nap"];
    $honnan_varos_id = $_POST["in_honnan_varos_id"];
    $hova_varos_id = $_POST["in_hova_varos_id"];

    if (trim($tipus) === "" || trim($szolgaltato) === "" || trim($ev) === "" || trim($honap) === "" || trim($nap) === "" || trim($honnan_varos_id) === "" || trim($hova_varos_id) === "") {
        header("Location: routes.php?missingdata=true");
    } else {
        if (strlen($tipus) > 6 || strlen($szolgaltato) > 50) {
            header("Location: routes.php?invaliddata=true");
        } else {
            $what = "(tipus, szolgaltato, ev, honap, nap, honnan_varos_id, hova_varos_id)";
            $data = [$tipus, $szolgaltato, $ev, $honap, $nap, $honnan_varos_id, $hova_varos_id];
            if (create_data("jarat", $what, $data)) {
                header("Location: routes.php?success=true");
            } else {
                header("Location: routes.php?dberror=true");
            }
        }
    }
}
