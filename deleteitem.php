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
