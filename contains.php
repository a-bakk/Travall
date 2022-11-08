<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Tartalmazás</title>
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
                <h2 class="mb-5 text-capitalize">Tartalmazás</h2>
            </div>
            <?php
            if (isset($_GET["missingdata"])) {
                echo '<div class="alert alert-danger text-center" role="alert">
                Hiányos adatok!
                </div>';
            }
            if (isset($_GET["exists"])) {
                echo '<div class="alert alert-danger text-center" role="alert">
                Ilyen rekord már létezik!
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
                            <input type="hidden" name="frompage" value="contains" />';
                            $bookings = get_data("foglalas");
                            if ($bookings === "") {
                                echo '<div class="alert alert-danger text-center" role="alert">
                                        Sikertelen adatbázisművelet!
                                    </div>';
                            }
                            echo '<div class="col-auto"><div class="row">';
                            echo '<div class="col-auto"><label for="foglalasCreate" class="form-label">Foglalás: </label></div>';
                            echo '<div class="col-auto"><select class="form-select" name="in_foglalas_id" id="foglalasCreate">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_assoc($bookings)) {
                                echo '<option value="' . $row['foglalas_id'] .'"> ' . $row['email'] . ' - ' . $row['l_ev'] . '/' . $row['l_honap'] . '/' . $row['l_nap'] . ' </option>';
                            }
                            echo '</select></div></div></div>';
                            mysqli_free_result($bookings);
                            $routes = list_routes();
                            if ($routes === "") {
                                echo '<div class="alert alert-danger text-center" role="alert">
                                        Sikertelen adatbázisművelet!
                                    </div>';
                            }
                            echo '<div class="col-auto"><div class="row">';
                            echo '<div class="col-auto"><label for="jaratCreate" class="form-label">Járat: </label></div>';
                            echo '<div class="col-auto"><select class="form-select" name="in_jarat_id" id="jaratCreate">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_assoc($routes)) {
                                echo '<option value="' . $row['jarat_id'] .'"> ' . $row['tipus'] . ': ' . $row['szolgaltato'] . ', ' . $row['ev'] . '/' . $row['honap'] . '/' . $row['nap'] . ', ' . $row['honnan_nev'] . ' - ' . $row['hova_nev'] . ' </option>';
                            }
                            echo '</select></div></div></div>';
                            mysqli_free_result($routes);
                        echo '
                        <div class="col-auto">
                            <input type="submit" class="btn btn-info" value="Elküldés" name="submitted" />
                        </div>
                    </form>
                </div>
            </div>';
            $contains = list_contains();
            if ($contains === "") {
                echo '<div class="alert alert-danger text-center" role="alert">
                        A tábla üres!
                    </div>';
            } else {
                if ($contains === false) {
                    echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen lekérés!
                    </div>';
                } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">foglalás</th>
                                <th class="col">járat</th>
                                <th class="col">törlés</th>
                                <th class="col">módosítás</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($contains)) {
                                echo '<tr>';
                                echo '<td>' . $row['email'] . ' - ' . $row['l_ev'] . '/' . $row['l_honap'] . '/' . $row['l_nap'] . '</td>';
                                echo '<td>' . $row['tipus'] . ': ' . $row['szolgaltato'] . ', ' . $row['ev'] . '/' . $row['honap'] . '/' . $row['nap'] . ', ' . $row['honnan_nev'] . ' - ' . $row['hova_nev'] . '</td>';
                                echo '<td><form method="POST" action="deleteitem.php">
                                <input type="hidden" name="frompage" value="contains" />
                                <input type="hidden" name="in_foglalas_id" value=' . $row['foglalas_id'] . ' />
                                <input type="hidden" name="in_jarat_id" value=' . $row['jarat_id'] . ' />
                                <input class="btn btn-secondary" type="submit" value="törlés" />
                                </form></td>
                                ';
                                echo '<td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modify' . $i . '">módosítás</button>
                                <div
                                    class="modal fade"
                                    id="modify' . $i . '"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"
                                    tabindex="-1"
                                    aria-labelledby="modifylabel' . $i . '"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modifylabel' . $i . '">Rekord módosítása</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="modifyitem.php" class="row gy-2 gx-3 align-items-center">
                                                    <input type="hidden" name="frompage" value="contains" />
                                                    <input type="hidden" name="foglalas_id" value=' . $row['foglalas_id'] . ' />
                                                    <input type="hidden" name="jarat_id" value=' . $row['jarat_id'] . ' />';
                                                    $bookings = get_data("foglalas");
                                                    if ($bookings === "") {
                                                        echo '<div class="alert alert-danger text-center" role="alert">
                                                                Sikertelen adatbázisművelet!
                                                            </div>';
                                                    }
                                                    echo '<div class="col-auto"><div class="row">';
                                                    echo '<div class="col-auto"><label for="foglalasModify" class="form-label">Foglalás: </label></div>';
                                                    echo '<div class="col-auto"><select class="form-select" name="in_foglalas_id" id="foglalasModify">';
                                                    echo '<option value="">...</option>';
                                                    while ($row = mysqli_fetch_assoc($bookings)) {
                                                        echo '<option value="' . $row['foglalas_id'] .'"> ' . $row['email'] . ' - ' . $row['l_ev'] . '/' . $row['l_honap'] . '/' . $row['l_nap'] . ' </option>';
                                                    }
                                                    echo '</select></div></div></div>';
                                                    mysqli_free_result($bookings);
                                                    $routes = list_routes();
                                                    if ($routes === "") {
                                                        echo '<div class="alert alert-danger text-center" role="alert">
                                                                Sikertelen adatbázisművelet!
                                                            </div>';
                                                    }
                                                    echo '<div class="col-auto"><div class="row">';
                                                    echo '<div class="col-auto"><label for="jaratModify" class="form-label">Járat: </label></div>';
                                                    echo '<div class="col-auto"><select class="form-select" name="in_jarat_id" id="jaratModify">';
                                                    echo '<option value="">...</option>';
                                                    while ($row = mysqli_fetch_assoc($routes)) {
                                                        echo '<option value="' . $row['jarat_id'] .'"> ' . $row['tipus'] . ': ' . $row['szolgaltato'] . ', ' . $row['ev'] . '/' . $row['honap'] . '/' . $row['nap'] . ', ' . $row['honnan_nev'] . ' - ' . $row['hova_nev'] . ' </option>';
                                                    }
                                                    echo '</select></div></div></div>';
                                                    mysqli_free_result($routes);
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
                                $i = $i + 1;
                            }
                            mysqli_free_result($contains);
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