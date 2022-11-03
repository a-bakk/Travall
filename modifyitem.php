<?php

include_once("common/functions.php");

if ($_POST["frompage"] === "cities") {
    $id = $_POST["in_varos_id"];
    $varosnev = $_POST["in_varosnev"];
    $iranyitoszam = $_POST["in_iranyitoszam"];
    $orszag = $_POST["in_orszag"];

    if (trim($varosnev) === "" && trim($iranyitoszam) === "" && trim($orszag) === "") {
        header("Location: cities.php?missingdata=true");
    } else {
        if (strlen($varosnev) > 85 || strlen($iranyitoszam) > 10 || strlen($orszag) > 56) {
            header("Location: cities.php?invaliddata=true");
        } else {
            $assoc_data = ["varosnev" => (trim($varosnev) === "" ? "" : $varosnev), "iranyitoszam" => (trim($iranyitoszam) === "" ? "" : $iranyitoszam), "orszag" => (trim($orszag) === "" ? "" : $orszag)];
            if (update_data("varos", "varos_id", $id, $assoc_data)) {
                header("Location: cities.php?success=true");
            } else {
                header("Location: cities.php?dberror=true");
            }
        }
    }
}