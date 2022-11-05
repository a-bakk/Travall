<?php

include_once("common/functions.php");

if ($_POST["frompage"] === "cities") {
    $id = $_POST["in_varos_id"];
    if (delete_data("varos", "varos_id", $id)) {
        header("Location: cities.php?success=true");
    } else {
        header("Location: cities.php?dberror=true");
    }
}

if ($_POST["frompage"] === "routes") {
    $id = $_POST["in_jarat_id"];
    if (delete_data("jarat", "jarat_id", $id)) {
        header("Location: routes.php?success=true");
    } else {
        header ("Location: routes.php?dberror=true");
    }
}

if ($_POST["frompage"] === "clients") {
    $email = $_POST["in_email"];
    if (delete_data("ugyfel", "email", $email)) {
        header("Location: clients.php?success=true");
    } else {
        header ("Location: clients.php?dberror=true");
    }
}

if ($_POST["frompage"] === "tickets") {
    $id = $_POST["in_jegy_id"];
    if (delete_data("jegy", "jegy_id", $id)) {
        header("Location: tickets.php?success=true");
    } else {
        header ("Location: tickets.php?dberror=true");
    }
}

if ($_POST["frompage"] === "bookings") {
    $id = $_POST["in_foglalas_id"];
    if (delete_data("foglalas", "foglalas_id", $id)) {
        header("Location: bookings.php?success=true");
    } else {
        header ("Location: bookings.php?dberror=true");
    }
}

if ($_POST["frompage"] === "contains") {
    $foglalas_id = $_POST["in_foglalas_id"];
    $jarat_id = $_POST["in_jarat_id"];
    if (delete_data_contains($foglalas_id, $jarat_id)) {
        header("Location: contains.php?success=true");
    } else {
        header ("Location: contains.php?dberror=true");
    }
}
