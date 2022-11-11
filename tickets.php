<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Jegyek</title>
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
                <h2 class="mb-5 text-capitalize">Jegyek</h2>
            </div>
            <?php
            $routes = list_routes();
            if ($routes === false) {
                echo '<div class="alert alert-danger text-center" role="alert">
                Sikertelen adatbázisművelet!
                </div>';
            }
            if (isset($_GET["missingdata"])) {
                echo '<div class="alert alert-danger text-center" role="alert">
                Hiányos adatok!
                </div>';
            }
            if (isset($_GET["invaliddata"])) {
                echo '<div class="alert alert-danger text-center" role="alert">
                A megadott adatok nem felelnek meg a követelményeknek!
                </div>';
            }
            if (isset($_GET["dberror"])) {
                echo '<div class="alert alert-danger text-center" role="alert">
                Sikertelen adatbázisművelet!
                </div>';
            }
            if (isset($_GET["success"])) {
                echo '<div class="alert alert-success text-center" role="alert">
                Sikeres művelet!
                </div>';
            }
            echo '
            <div class="row mb-5">
                <div class="col-md-auto">
                    <h5>Új rekord felvitele</h5>
                </div>
                <div class="col-md-auto">
                    <form method="POST" action="createitem.php" class="row gy-2 gx-3 align-items-center">
                        <div class="col-auto">
                            <input type="hidden" name="frompage" value="tickets" />
                            <input type="number" class="form-control" name="in_ar" placeholder="Az új jegy ára" min="0" step="0.01">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" name="in_h_resz" placeholder="Milyen részen? (Nem kötelező)">
                        </div>
                        <div class="col-auto">
                            <input type="number" class="form-control" name="in_h_szekszam" placeholder="Székszám? (Nem kötelező)" min="1" step="1">
                        </div>';
                        echo '<div class="col-auto"><label for="melyikJarat" class="form-label">Járat: </label></div>';
                        echo '<div class="col-auto"><select class="form-select" name="in_jarat_id" id="melyikJarat">';
                        echo '<option value="">...</option>';
                        while ($jarat_row = mysqli_fetch_assoc($routes)) {
                            echo '<option value="' . $jarat_row['jarat_id'] .'"> ' . $jarat_row['tipus'] . ': ' . $jarat_row['szolgaltato'] . ', ' . $jarat_row['ev'] . '/' . $jarat_row['honap'] . '/' . $jarat_row['nap'] . ', ' . $jarat_row['honnan_nev'] . ' - ' . $jarat_row['hova_nev'] . ' </option>';
                        }
                        mysqli_free_result($routes);
                        echo '</select> </div>';
                        echo '
                        <div class="col-auto">
                            <input type="submit" class="btn btn-info" value="Elküldés" name="submitted" />
                        </div>
                    </form>
                </div>
            </div>';
            $tickets = list_tickets();
            if ($tickets === false) {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                    </div>';
            } else {
                if ($tickets === false) {
                    echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen lekérés!
                    </div>';
                } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th class="col">jegy id</th> -->
                                <th class="col">ár</th>
                                <th class="col">rész (ha helyjegy)</th>
                                <th class="col">székszám (ha helyjegy)</th>
                                <th class="col">járat</th>
                                <th class="col">törlés</th>
                                <th class="col">módosítás</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($tickets)) {
                                echo '<tr>';
                                // echo '<td>' . $row['jegy_id'] . '</td>';
                                echo '<td>' . $row['ar'] . '</td>';
                                echo '<td>' . ($row['h_resz'] == "" ? "nincs" : $row['h_resz']) . '</td>';
                                echo '<td>' . (($row['h_szekszam'] == "" || $row['h_szekszam'] == 0) ? "nincs" : $row['h_szekszam']) . '</td>';
                                echo '<td>' . $row['tipus'] . ': ' . $row['szolgaltato'] . ', ' . $row['ev'] . '/' . $row['honap'] . '/' . $row['nap'] . ', ' . $row['honnan_nev'] . ' - ' . $row['hova_nev'] . '</td>';
                                echo '<td><form method="POST" action="deleteitem.php">
                                <input type="hidden" name="frompage" value="tickets" />
                                <input type="hidden" name="in_jegy_id" value=' . $row['jegy_id'] . ' />
                                <input class="btn btn-secondary" type="submit" value="törlés" />
                                </form></td>
                                ';
                                echo '<td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modify' . $row['jegy_id'] . '">módosítás</button>
                                <div
                                    class="modal fade"
                                    id="modify' . $row['jegy_id'] . '"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"
                                    tabindex="-1"
                                    aria-labelledby="modifylabel' . $row['jegy_id'] . '"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modifylabel' . $row['jegy_id'] . '">Rekord módosítása</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="modifyitem.php" class="row gy-2 gx-3 align-items-center">
                                                    <input type="hidden" name="frompage" value="tickets" />
                                                    <input type="hidden" name="in_jegy_id" value=' . $row['jegy_id'] . ' />
                                                    <div class="col-auto">
                                                        <input type="number" class="form-control" name="in_ar" placeholder="Új ár" min="0" step="0.01">
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="text" class="form-control" name="in_h_resz" placeholder="Milyen részen? (Nem kötelező)">
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="number" class="form-control" name="in_h_szekszam" placeholder="Székszám? (Nem kötelező)" min="1" step="1">
                                                    </div>';
                                                    $routes = list_routes();
                                                    echo '<div class="col-auto"><label for="melyikJarat_m" class="form-label">Járat: </label></div>';
                                                    echo '<div class="col-auto"><select class="form-select" name="in_jarat_id" id="melyikJarat_m">';
                                                    echo '<option value="">...</option>';
                                                    while ($jarat_row = mysqli_fetch_assoc($routes)) {
                                                        echo '<option value="' . $jarat_row['jarat_id'] .'"> ' . $jarat_row['tipus'] . ': ' . $jarat_row['szolgaltato'] . ', ' . $jarat_row['ev'] . '/' . $jarat_row['honap'] . '/' . $jarat_row['nap'] . ', ' . $jarat_row['honnan_nev'] . ' - ' . $jarat_row['hova_nev'] . ' </option>';
                                                    }
                                                    mysqli_free_result($routes);
                                                    echo '</select> </div>';
                                                    echo '<div class="col-auto">
                                                        <input type="submit" class="btn btn-info" value="Elküldés" name="submitted" />
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>';
                                echo '</tr>';
                            }
                            mysqli_free_result($tickets);
                            ?>
                        </tbody>
                    </table>
            <?php }
            }
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