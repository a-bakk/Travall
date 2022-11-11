<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Nyereményjáték</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/img/icon.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>

    <?php
    include_once "common/header.php";
    ?>

    <section class="p-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <h2 class="mb-5 text-capitalize">Nyereményjáték</h2>
                <h5 class="mb-5">Azok az ügyfelek, akik a legtöbb repülőutat foglalták 2022. november 1. - december. 24. között, automatikusan résztvesznek a nyereményjátékban!</h5>
            </div>
            <div class="row">
                <h5 class="mb-2">Leaderboard (csak az első három helyezett)</h5>
            </div>
            <?php
            $winners_list = get_data_by_command("
            SELECT      ugyfel.email, ugyfel.vezeteknev, ugyfel.keresztnev, ugyfel.telefonszam, COUNT(*) AS number_of_bookings
            FROM        tartalmaz, foglalas, jarat, ugyfel
            WHERE       tartalmaz.foglalas_id = foglalas.foglalas_id AND tartalmaz.jarat_id = jarat.jarat_id AND foglalas.email = ugyfel.email
            AND 	    jarat.tipus = 'repülő' AND foglalas.l_ev = 2022 AND ((foglalas.l_honap = 11 AND foglalas.l_nap BETWEEN 1 AND 30) OR (foglalas.l_honap = 12 AND foglalas.l_nap BETWEEN 1 AND 24))
            GROUP BY    foglalas.email
            ORDER BY    COUNT(*) DESC
            LIMIT       0, 3;
            ");
            if ($winners_list === false) {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                    </div>';
            } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">e-mail cím</th>
                                <th class="col">vezetéknév</th>
                                <th class="col">keresztnév</th>
                                <th class="col">telefonszám</th>
                                <th class="col">foglalások száma az adott időszakban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($winners_list)) {
                                echo '<tr>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['vezeteknev'] . '</td>';
                                echo '<td>' . $row['keresztnev'] . '</td>';
                                echo '<td>' . $row['telefonszam'] . '</td>';
                                echo '<td>' . $row['number_of_bookings'] . '</td>';
                                echo '</tr>';
                            }
                            mysqli_free_result($winners_list);
                            ?>
                        </tbody>
                    </table>
            <?php }
            ?>
        </div>
    </section>

    <?php
    include_once "common/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>

</body>

</html>