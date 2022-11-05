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

if ($_POST["frompage"] === "clients") {
    $id = $_POST["in_email"];
    $vezeteknev = $_POST["in_vezeteknev"];
    $keresztnev = $_POST["in_keresztnev"];
    $telefonszam = $_POST["in_telefonszam"];

    if (trim($vezeteknev) === "" && trim($keresztnev) === "" && trim($telefonszam) === "") {
        header("Location: clients.php?missingdata=true");
    } else {
        if (strlen($vezeteknev) > 50 || strlen($keresztnev) > 50 || strlen($telefonszam) > 20) {
            header("Location: clients.php?invaliddata=true");
        } else {
            $assoc_data = ["vezeteknev" => (trim($vezeteknev) === "" ? "" : $vezeteknev), "keresztnev" => (trim($keresztnev) === "" ? "" : $keresztnev), "telefonszam" => (trim($telefonszam) === "" ? "" : $telefonszam)];
            if (update_data("ugyfel", "email", $id, $assoc_data)) {
                header("Location: clients.php?success=true");
            } else {
                header("Location: clients.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "tickets") {
    $id = $_POST["in_jegy_id"];
    $ar = $_POST["in_ar"];
    $h_resz = $_POST["in_h_resz"];
    $h_szekszam = $_POST["in_h_szekszam"];
    $jarat_id = $_POST["in_jarat_id"];

    if (empty($ar) && trim($h_resz) === "" && empty($h_szekszam) && empty($jarat_id)) {
        header("Location: tickets.php?missingdata=true");
    } else {
        if (strlen($h_resz) > 1) {
            header("Location: tickets.php?invaliddata=true");
        } else {
            $assoc_data = ["ar" => (empty($ar) ? "" : $ar), "h_resz" => (trim($h_resz) === "" ? "" : $h_resz), "h_szekszam" => (empty($h_szekszam) ? "" : $h_szekszam), "jarat_id" => (empty($jarat_id) ? "" : $jarat_id)];
            if (update_data("jegy", "jegy_id", $id, $assoc_data)) {
                header("Location: tickets.php?success=true");
            } else {
                header("Location: tickets.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "bookings") {
    $id = $_POST["in_foglalas_id"];
    $email = $_POST["in_email"];
    $l_ev = $_POST["in_l_ev"];
    $l_honap = $_POST["in_l_honap"];
    $l_nap = $_POST["in_l_nap"];

    if (trim($email) === "" && empty($l_ev) && empty($l_honap) && empty($l_nap)) {
        header("Location: bookings.php?missingdata=true");
    } else {
        if (strlen($email) > 80) {
            header("Location: bookings.php?invaliddata=true");
        } else {
            $assoc_data = ["email" => (trim($email) === "" ? "" : $email), "l_ev" => (empty($l_ev) ? "" : $l_ev), "l_honap" => (empty($l_honap) ? "" : $l_honap), "l_nap" => (empty($l_nap) ? "" : $l_nap)];
            if (update_data("foglalas", "foglalas_id", $id, $assoc_data)) {
                header("Location: bookings.php?success=true");
            } else {
                header("Location: bookings.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "contains") {
    $foglalas_id = $_POST["foglalas_id"];
    $jarat_id = $_POST["jarat_id"];
    $in_foglalas_id = $_POST["in_foglalas_id"];
    $in_jarat_id = $_POST["in_jarat_id"];

    if (empty($in_foglalas_id) && empty($in_jarat_id)) {
        header("Location: contains.php?missingdata=true");
    } else {
        if (update_data_contains($foglalas_id, $jarat_id, empty($in_foglalas_id) ? "" : $in_foglalas_id, empty($in_jarat_id) ? "" : $in_jarat_id)) {
            header("Location: contains.php?success=true");
        } else {
            header("Location: contains.php?dberror=true");
        }
    }
}
