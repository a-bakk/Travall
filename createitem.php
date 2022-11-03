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
