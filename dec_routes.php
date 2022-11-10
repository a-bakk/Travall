<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Decemberi jegyek</title>
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
                <h2 class="mb-5">Találja meg az önnek megfelelő árú jegyet december 1-15. között</h2>
            </div>
            <div class="row">
                <form method="POST" action="dec_routes.php" class="row gy-2 gx-3 align-items-center">
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-auto">
                                <label for="restvalue">A jegy árának felső korlátja euróban kifejezve</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control" name="restrictive_value" placeholder="felső korlát"  id="restvalue" min="0" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-info" value="Elküldés" name="submitted" />
                    </div>
                </form>
            </div>
            <?php
            if (!isset($_POST['submitted'])) {
                $_POST['restrictive_value'] = 100.00;
            }
            $providers = get_data_by_command("
            SELECT      jarat.szolgaltato, COUNT(*) AS number_of_routes, jarat.tipus
            FROM        jarat
            WHERE       EXISTS (SELECT jegy.ar FROM jegy WHERE jegy.jarat_id = jarat.jarat_id AND jegy.ar <= " . $_POST["restrictive_value"] . " AND jarat.nap BETWEEN 1 AND 15 AND jarat.honap = 12 AND jarat.ev = 2022)
            GROUP BY    jarat.szolgaltato
            ");
            if ($providers === false) {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                    </div>';
            } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">típus</th>
                                <th class="col">szolgáltató</th>
                                <th class="col">járatok száma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($providers)) {
                                echo '<tr>';
                                echo '<td>' . $row['tipus'] . '</td>';
                                echo '<td>' . $row['szolgaltato'] . '</td>';
                                echo '<td>' . $row['number_of_routes'] . '</td>';
                                echo '</tr>';
                            }
                            mysqli_free_result($providers);
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