<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Foglalások</title>
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
                <h2 class="mb-5 text-capitalize">Foglalások</h2>
            </div>
            <?php
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
            ?>
            <div class="row mb-5">
                <div class="col-md-auto">
                    <h5>Új rekord felvitele</h5>
                </div>
                <div class="col-md-auto">
                    <form method="POST" action="createitem.php" class="row gy-2 gx-3 align-items-center">
                        <div class="col-auto">
                            <input type="hidden" name="frompage" value="bookings" />
                            <input type="text" class="form-control" name="in_email" placeholder="Foglaló e-mail címe">
                        </div>
                        <div class="col-auto">
                            <input type="number" class="form-control" name="in_l_ev" placeholder="Év" min = "1" step = "1">
                        </div>
                        <div class="col-auto">
                            <input type="number" class="form-control" name="in_l_honap" placeholder="Hónap" min = "1" step = "1" max = "12">
                        </div>
                        <div class="col-auto">
                            <input type="number" class="form-control" name="in_l_nap" placeholder="Nap" min = "1" step = "1" max = "31">
                        </div>
                        <div class="col-auto">
                            <input type="submit" class="btn btn-info" value="Elküldés" name="submitted" />
                        </div>
                    </form>
                </div>
            </div>
            <?php
            $bookings = get_data("foglalas");
            if ($bookings === "") {
                echo '<div class="alert alert-danger text-center" role="alert">
                        A tábla üres!
                    </div>';
            } else {
                if ($bookings === false) {
                    echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen lekérés!
                    </div>';
                } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">foglalás id</th>
                                <th class="col">e-mail</th>
                                <th class="col">év</th>
                                <th class="col">hónap</th>
                                <th class="col">nap</th>
                                <th class="col">törlés</th>
                                <th class="col">módosítás</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($bookings)) {
                                echo '<tr>';
                                echo '<td>' . $row['foglalas_id'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['l_ev'] . '</td>';
                                echo '<td>' . $row['l_honap'] . '</td>';
                                echo '<td>' . $row['l_nap'] . '</td>';
                                echo '<td><form method="POST" action="deleteitem.php">
                                <input type="hidden" name="frompage" value="bookings" />
                                <input type="hidden" name="in_foglalas_id" value=' . $row['foglalas_id'] . ' />
                                <input class="btn btn-secondary" type="submit" value="törlés" />
                                </form></td>
                                ';
                                echo '<td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modify' . $row['foglalas_id'] . '">módosítás</button>
                                <div
                                    class="modal fade"
                                    id="modify' . $row['foglalas_id'] . '"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"
                                    tabindex="-1"
                                    aria-labelledby="modifylabel' . $row['foglalas_id'] . '"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modifylabel' . $row['foglalas_id'] . '">Rekord módosítása</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="modifyitem.php" class="row gy-2 gx-3 align-items-center">
                                                    <input type="hidden" name="frompage" value="bookings" />
                                                    <input type="hidden" name="in_foglalas_id" value=' . $row['foglalas_id'] . ' />
                                                    <div class="col-auto">
                                                        <input type="text" class="form-control" name="in_email" placeholder="Új e-mail"/>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="number" class="form-control" name="in_l_ev" placeholder="Év" min = "1" step = "1">
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="number" class="form-control" name="in_l_honap" placeholder="Hónap" min = "1" step = "1" max = "12">
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="number" class="form-control" name="in_l_nap" placeholder="Nap" min = "1" step = "1" max = "31">
                                                    </div>
                                                    <div class="col-auto">
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
                            }
                            mysqli_free_result($bookings);
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