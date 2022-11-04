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

if ($_POST["frompage"] === "routes") {
    $id = $_POST["in_jarat_id"];
    $tipus = $_POST["in_tipus"];
    $szolgaltato = $_POST["in_szolgaltato"];
    $ev = $_POST["in_ev"]; // validation must've been done already by form control for these values - nevertheless that could be overridden
    $honap = $_POST["in_honap"];
    $nap = $_POST["in_nap"];
    $honnan_varos_id = $_POST["in_honnan_varos_id"];
    $hova_varos_id = $_POST["in_hova_varos_id"];
    if (trim($tipus) === "" && trim($szolgaltato) === "" && trim($ev) === "" && trim($honap) === "" && trim($nap) === "" && trim($honnan_varos_id) === "" && trim($hova_varos_id) === "") {
        header("Location: routes.php?missingdata=true");
    } else {
        if (strlen($tipus) > 6 || strlen($szolgaltato) > 50) {
            header("Location: routes.php?invaliddata=true");
        } else {
            $assoc_data = ["tipus" => (trim($tipus) === "" ? "" : $tipus), "szolgaltato" => (trim($szolgaltato) === "" ? "" : $szolgaltato), "ev" => (trim($ev) === "" ? "" : $ev), "honap" => (trim($honap) === "" ? "" : $honap), "nap" => (trim($nap) === "" ? "" : $nap), "honnan_varos_id" => (trim($honnan_varos_id) === "" ? "" : $honnan_varos_id), "hova_varos_id" => (trim($hova_varos_id) === "" ? "" : $hova_varos_id),];
            if (update_data("jarat", "jarat_id", $id, $assoc_data)) {
                header("Location: routes.php?success=true");
            } else {
                header("Location: routes.php?dberror=true");
            }
        }
    }
}
