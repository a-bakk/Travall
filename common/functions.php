<?php

function navGen() {

    $tmp = basename($_SERVER['PHP_SELF'], ".php");

    $table_management = false;
    switch($tmp) {
        case "cities":
        case "routes":
        case "clients":
        case "tickets":
        case "bookings":
        case "contains": $table_management = true; break;
    }

    $query = false;
    switch ($tmp) {
        case "cheap_tickets":
        case "competition":
        case "dec_routes": $query = true; break;
    }

    echo "<nav class='navbar navbar-expand-lg bg-primary fw-bold text-uppercase py-1 fixed-top'>
        <div class='container'>
            <a href='index.php' class='navbar-brand text-white fs-2'>Travall</a>

            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navmenu'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navmenu'>
                <ul class='navbar-nav ms-auto'>
                    <li class='nav-item'>
                        <a href='index.php' class='nav-link text-white' " . ($tmp === "index" ? "style='color: darkblue !important;'" : "") . ">Főoldal</a>
                    </li>
                    <li class='nav-item dropdown my-auto mx-3'>
                        <a href='#' class='text-white dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false' style='text-decoration: none; " . ($table_management ? "color: darkblue !important;" : "") . "'>Táblakezelés</a>
                        <ul class='dropdown-menu'>
                            <li><a href='cities.php' class='dropdown-item nav-link'>Városok</a></li>
                            <li><a href='routes.php' class='dropdown-item nav-link'>Járatok</a></li>
                            <li><a href='clients.php' class='dropdown-item nav-link'>Ügyfelek</a></li>
                            <li><a href='tickets.php' class='dropdown-item nav-link'>Jegyek</a></li>
                            <li><a href='bookings.php' class='dropdown-item nav-link'>Foglalások</a></li>
                            <li><a href='contains.php' class='dropdown-item nav-link'>Tartalmazás</a></li>
                        </ul>
                    </li>
                    <li class='nav-item dropdown my-auto'>
                        <a href='#' class='text-white dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false' style='text-decoration: none; " . ($query ? "color: darkblue !important;" : "") . "'>Összetett lekérdezések, felhasználási példák</a>
                        <ul class='dropdown-menu'>
                            <li><a href='cheap_tickets.php' class='dropdown-item nav-link'>Olcsó jegyek Budapestről</a></li>
                            <li><a href='competition.php' class='dropdown-item nav-link'>Nyereményjáték</a></li>
                            <li><a href='dec_routes.php' class='dropdown-item nav-link'>Decemberi járatok megfelelő jegyárral</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>";

}

function open_connection() {
    $connection = mysqli_connect("localhost", "root", "") or die("Sikertelen adatbázis csatlakozás!");
    if (!mysqli_select_db($connection, "JEGYFOGLALAS")) return false;
    return $connection;
}

function get_data($tablename) {
    $connection = open_connection();
    if (!$connection) return false;
    try {
        $result = mysqli_query($connection, "SELECT * FROM " . $tablename);
        mysqli_close($connection);
        return $result;
    } catch (Exception) {
        mysqli_close($connection);
        return "";
    }
}

function get_data_by_command($sql) {
    $connection = open_connection();
    if (!$connection) return false;
    try {
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    } catch (Exception) {
        mysqli_close($connection);
        return false;
    }
}

function get_specific_data($tablename, $what) {
    $connection = open_connection();
    if (!$connection) return false;
    try {
        $result = mysqli_query($connection, "SELECT " . $what . " FROM " . $tablename);
        mysqli_close($connection);
        return $result;
    } catch (Exception) {
        mysqli_close($connection);
        return false;
    }
}

function list_routes() {
    $connection = open_connection();
    if (!$connection) return false;
    $sql = "SELECT  jarat.jarat_id, jarat.tipus, jarat.szolgaltato, jarat.ev, jarat.honap, jarat.nap,
                    honnan.varosnev AS honnan_nev, hova.varosnev AS hova_nev
                    FROM 
                    jarat INNER JOIN varos honnan ON jarat.honnan_varos_id = honnan.varos_id
                    INNER JOIN varos hova ON jarat.hova_varos_id = hova.varos_id;";
    try {
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    } catch (Exception) {
        mysqli_close($connection);
        return false;
    }
}

function list_tickets() {
    $connection = open_connection();
    if (!$connection) return false;
    $sql = "SELECT  jegy.jegy_id, jegy.ar, jegy.h_resz, jegy.h_szekszam, jegy.jarat_id,
                    jarat.jarat_id AS jarat_jarat_id, jarat.tipus, jarat.szolgaltato, jarat.ev, jarat.honap, jarat.nap,
                    honnan.varosnev AS honnan_nev, hova.varosnev AS hova_nev
                    FROM 
                    jegy INNER JOIN jarat ON jegy.jarat_id = jarat.jarat_id
                    INNER JOIN varos honnan ON jarat.honnan_varos_id = honnan.varos_id
                    INNER JOIN varos hova ON jarat.hova_varos_id = hova.varos_id;";
    try {
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    } catch (Exception) {
        mysqli_close($connection);
        return false;
    }
}

function list_contains() {
    $connection = open_connection();
    if (!$connection) return false;
    $sql = "SELECT  tartalmaz.foglalas_id, tartalmaz.jarat_id, foglalas.email, foglalas.l_ev, foglalas.l_honap, foglalas.l_nap, jarat.tipus, jarat.szolgaltato, jarat.ev, jarat.nap, jarat.honap, honnan.varosnev AS honnan_nev, hova.varosnev AS hova_nev
            FROM    tartalmaz, foglalas, jarat, varos AS honnan, varos AS hova
            WHERE   tartalmaz.foglalas_id = foglalas.foglalas_id AND tartalmaz.jarat_id = jarat.jarat_id AND jarat.honnan_varos_id = honnan.varos_id AND jarat.hova_varos_id = hova.varos_id";
    try {
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $result;
    } catch (Exception) {
        mysqli_close($connection);
        return false;
    }
}

function create_data($tablename, $what, $data) {
    $connection = open_connection();
    if (!$connection) return false;
    $values = "(";
    for ($i = 0; $i < count($data); $i++) {
        if (gettype($data[$i]) === "integer" || gettype($data[$i]) === "double") { // is_numeric()?
            $values = $values . $data[$i];
        }
        else {
            $values = $values . "'" . $data[$i] . "'";
        }
        if ($i !== count($data) - 1) $values = $values . ", ";
    }
    $values = $values . ")";
    $sql = "INSERT INTO " . $tablename . $what . " VALUES " . $values;
    try {
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        return true;
    }
    catch (Exception) {
        mysqli_close($connection);
        return false;
    }
}

function delete_data($tablename, $id_attr_name, $id) {
    $connection = open_connection();
    if (!$connection) return false;
    if (gettype($id) === "integer") {
        $sql = "DELETE FROM " . $tablename . " WHERE " . $id_attr_name . "=" . $id;
    } else {
        $sql = "DELETE FROM " . $tablename . " WHERE " . $id_attr_name . "=" . "'" . $id . "'";
    }
    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        return true;
    }
    else {
        mysqli_close($connection);
        return false;
    }
}

function delete_data_contains($foglalas_id, $jarat_id) {
    $connection = open_connection();
    if (!$connection) return false;
    if (is_numeric($foglalas_id) && is_numeric($jarat_id)) { // is_numeric() should also work
        $sql = "DELETE FROM tartalmaz WHERE foglalas_id=" . intval($foglalas_id) . " AND jarat_id=" . intval($jarat_id);
        if (mysqli_query($connection, $sql)) {
            mysqli_close($connection);
            return true;
        } else {
            mysqli_close($connection);
            return false;
        }
    } else {
        return false;
    }
}

function update_data($tablename, $id_attr_name, $id, $assoc_data) {
    $connection = open_connection();
    if (!$connection) return false;
    $set = "";
    foreach($assoc_data as $key => $val) {
        if ($val !== "") {
            if (gettype($val) === "integer" || gettype($val) === "double")
                $set = $set . $key . "=" . $val . ", ";
            else
                $set = $set . $key . "=" . "'" . $val . "'" . ", ";
        }
    }
    $set = rtrim($set, ", ");
    if (gettype($id) === "integer") {
        $sql = "UPDATE " . $tablename . " SET " . $set . " WHERE " . $id_attr_name . "=" . $id;
    } else {
        $sql = "UPDATE " . $tablename . " SET " . $set . " WHERE " . $id_attr_name . "=" . "'" . $id . "'";
    }
    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        return true;
    }
    else {
        mysqli_close($connection);
        return false;
    }
}

function update_data_contains($foglalas_id, $jarat_id, $in_foglalas_id, $in_jarat_id) {
    $connection = open_connection();
    if (!$connection) return false;
    $set = "";
    if ($in_foglalas_id !== "") {
        if (is_numeric($in_foglalas_id))
                $set = $set . "foglalas_id =" . intval($in_foglalas_id) . ", ";
    }
    if ($in_jarat_id !== "") {
        if (is_numeric($in_jarat_id))
                $set = $set . "jarat_id =" . intval($in_jarat_id) . ", ";
    }
    $set = rtrim($set, ", ");
    $sql = "UPDATE tartalmaz SET " . $set . " WHERE foglalas_id=" . $foglalas_id . " AND jarat_id=" . $jarat_id;
    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        return true;
    }
    else {
        mysqli_close($connection);
        return false;
    }
}

