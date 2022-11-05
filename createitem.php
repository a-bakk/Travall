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
        header("Location: routes.php?missingdata=true"); // TODO: change above with empty()
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

if ($_POST["frompage"] === "clients") {
    $email = $_POST["in_email"];
    $vezeteknev = $_POST["in_vezeteknev"];
    $keresztnev = $_POST["in_keresztnev"];
    $telefonszam = $_POST["in_telefonszam"];

    if (trim($email) === "" || trim($vezeteknev) === "" || trim($keresztnev) === "" || trim($telefonszam) === "") {
        header("Location: clients.php?missingdata=true");
    } else {
        if (strlen($email) > 80 || strlen($vezeteknev) > 50 || strlen($keresztnev) > 50 || strlen($telefonszam) > 20) {
            header("Location: clients.php?invaliddata=true");
        } else {
            $what = "(email, vezeteknev, keresztnev, telefonszam)";
            $data = [$email, $vezeteknev, $keresztnev, $telefonszam];
            if (create_data("ugyfel", $what, $data)) {
                header("Location: clients.php?success=true");
            } else {
                header("Location: clients.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "tickets") {
    $ar = $_POST["in_ar"];
    $h_resz = $_POST["in_h_resz"];
    $h_szekszam = $_POST["in_h_szekszam"];
    $jarat_id = $_POST["in_jarat_id"];

    if (trim($ar) === "" || trim($jarat_id) === "") {
        header("Location: tickets.php?missingdata=true");
    } else {
        if (empty($h_resz) || empty($h_szekszam)) {
            if (strlen($h_resz) > 1) {
                $what = "(ar, jarat_id)";
                $data = [$ar, $jarat_id];
                if (create_data("jegy", $what, $data)) {
                    header("Location: tickets.php?success=true");
                } else {
                    header("Location: tickets.php?dberror=true");
                }
            } else {
                header("Location: tickets.php?invaliddata=true");
            }
        } else {
            $what = "(ar, h_resz, h_szekszam, jarat_id)";
            $data = [$ar, $h_resz, $h_szekszam, $jarat_id];
            if (create_data("jegy", $what, $data)) {
                header("Location: tickets.php?success=true");
            } else {
                header("Location: tickets.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "bookings") {
    $email = $_POST["in_email"];
    $l_ev = $_POST["in_l_ev"];
    $l_honap = $_POST["in_l_honap"];
    $l_nap = $_POST["in_l_nap"];

    if (trim($email) === "" || empty($l_ev) || empty($l_honap) || empty($l_nap)) {
        header("Location: bookings.php?missingdata=true");
    } else {
        if (strlen($email) > 80) {
            header("Location: bookings.php?invaliddata=true");
        } else {
            $what = "(email, l_ev, l_honap, l_nap)";
            $data = [$email, $l_ev, $l_honap, $l_nap];
            if (create_data("foglalas", $what, $data)) {
                header("Location: bookings.php?success=true");
            } else {
                header("Location: bookings.php?dberror=true");
            }
        }
    }
}

if ($_POST["frompage"] === "contains") {
    $foglalas_id = $_POST["in_foglalas_id"];
    $jarat_id = $_POST["in_jarat_id"];

    if (empty($foglalas_id) || empty($jarat_id)) {
        header("Location: contains.php?missingdata=true");
    } else {
        $exists = false;
        $contains = get_data("tartalmaz");
        while ($row = mysqli_fetch_assoc($contains)) {
            if ($foglalas_id == $row['foglalas_id'] && $jarat_id == $row['jarat_id'])
                $exists = true;
        }
        mysqli_free_result($contains);
        if ($exists) {
            header("Location: contains.php?exists=true");
        } else {
            $what = "(foglalas_id, jarat_id)";
            $data = [$foglalas_id, $jarat_id];
            if (create_data("tartalmaz", $what, $data)) {
                header("Location: contains.php?success=true");
            } else {
                header("Location: contains.php?dberror=true");
            }
        }
    }
} 