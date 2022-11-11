<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Jegykereső</title>
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
                <h2 class="mb-5">Jegykereső (december)</h2>
            </div>
            <div class="row">
                <form method="POST" action="ticketfinder.php" class="row gy-2 gx-3 align-items-center">
                    <?php echo '
                    <div class="col-auto">
                        <input type="hidden" name="frompage" value="routes" />
                        <div class="row">
                        <div class="col-auto"><label for="typeCreate" class="form-label">Típus: </label></div>
                        <div class="col-auto"><select class="form-select" name="in_tipus" id="typeCreate">
                            <option value="">...</option>
                            <option value="repülő">repülő</option>
                            <option value="vonat">vonat</option>
                            <option value="busz">busz</option>
                        </select></div></div></div>';
                    ?>
                    <?php
                    echo '<div class="col-auto"><div class="row">';
                    echo '<div class="col-auto"><label for="fromWhere" class="form-label">Honnan: </label></div>';
                    echo '<div class="col-auto"><select class="form-select" name="in_honnan_varos_id" id="fromWhere">';
                    echo '<option value="">...</option>';
                    $create_citylist = get_specific_data("varos", "varos_id, varosnev");
                    if ($create_citylist === false) {
                        echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                        </div>';
                    }
                    while ($where_row = mysqli_fetch_assoc($create_citylist)) {
                        echo '<option value="' . $where_row['varos_id'] .'"> ' . $where_row['varosnev'] . ' </option>';
                    }
                    mysqli_free_result($create_citylist);
                    if ($create_citylist === false) {
                        echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                        </div>';
                    }
                    $create_citylist = get_specific_data("varos", "varos_id, varosnev");
                    echo '</select> </div> </div> </div>';
                    echo '<div class="col-auto"><div class="row">';
                    echo '<div class="col-auto"><label for="toWhere" class="form-label">Hova: </label></div>';
                    echo '<div class="col-auto"><select class="form-select" name="in_hova_varos_id" id="toWhere">';
                    echo '<option value="">...</option>';
                    while ($to_row = mysqli_fetch_assoc($create_citylist)) {
                        echo '<option value="' . $to_row['varos_id'] .'"> ' . $to_row['varosnev'] . ' </option>';
                    }
                    echo '</select> </div> </div> </div>';
                    mysqli_free_result($create_citylist);
                    ?>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-auto">
                                <label for="restvalue">2022. december </label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control" name="in_o_nap" placeholder="Nap" min = "1" step = "1" max = "31">
                            </div>
                            <div class="col-auto">
                                <label for="restvalue"> -tól/-től</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-auto">
                                <label for="restvalue">2022. december </label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control" name="in_v_nap" placeholder="Nap" min = "1" step = "1" max = "31">
                            </div>
                            <div class="col-auto">
                                <label for="restvalue"> -ig</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-info" value="Elküldés" name="submitted" />
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-warning" value="Filterek törlése" name="clear" />
                    </div>
                </form>
            </div>
            <?php
            $sql = "";
            if (!isset($_POST['submitted']) || isset($_POST['clear'])) {
                $sql = "
                SELECT      jarat.tipus, jarat.szolgaltato, jarat.ev, jarat.honap, jarat.nap, honnan.varosnev AS honnan_vnev, hova.varosnev AS hova_vnev, AVG(jegy.ar) AS avg_ticket_price, COUNT(jegy.ar) AS number_of_tickets
                FROM        jarat, varos AS honnan, varos AS hova, jegy
                WHERE       jarat.honnan_varos_id = honnan.varos_id AND jarat.hova_varos_id = hova.varos_id AND jegy.jarat_id = jarat.jarat_id
                AND         jarat.ev = 2022 AND jarat.honap = 12 AND jarat.nap BETWEEN 1 AND 31
                GROUP BY    jarat.jarat_id
                ORDER BY    jarat.nap ASC              
                ";
            }
            else {
                $tipus = $_POST['in_tipus'];
                $honnan_id = $_POST['in_honnan_varos_id'];
                $hova_id = $_POST['in_hova_varos_id'];
                $o_nap = $_POST['in_o_nap'];
                $v_nap = $_POST['in_v_nap'];
                if (empty(trim($tipus)) && empty($honnan_id) && empty($hova_id) && empty($o_nap) && empty($v_nap)) {
                    $sql = "
                    SELECT      jarat.tipus, jarat.szolgaltato, jarat.ev, jarat.honap, jarat.nap, honnan.varosnev AS honnan_vnev, hova.varosnev AS hova_vnev, AVG(jegy.ar) AS avg_ticket_price, COUNT(jegy.ar) AS number_of_tickets
                    FROM        jarat, varos AS honnan, varos AS hova, jegy
                    WHERE       jarat.honnan_varos_id = honnan.varos_id AND jarat.hova_varos_id = hova.varos_id AND jegy.jarat_id = jarat.jarat_id
                    AND         jarat.ev = 2022 AND jarat.honap = 12 AND jarat.nap BETWEEN 1 AND 31
                    GROUP BY    jarat.jarat_id
                    ORDER BY    jarat.nap ASC 
                    ";
                } else {
                    $sql = "
                    SELECT      jarat.tipus, jarat.szolgaltato, jarat.ev, jarat.honap, jarat.nap, honnan.varosnev AS honnan_vnev, hova.varosnev AS hova_vnev, AVG(jegy.ar) AS avg_ticket_price, COUNT(jegy.ar) AS number_of_tickets
                    FROM        jarat, varos AS honnan, varos AS hova, jegy
                    WHERE       jarat.honnan_varos_id = honnan.varos_id AND jarat.hova_varos_id = hova.varos_id AND jegy.jarat_id = jarat.jarat_id
                    AND         jarat.ev = 2022 AND jarat.honap = 12 AND jarat.nap BETWEEN 1 AND 31";
                    if (!empty(trim($tipus))) {
                        $sql = $sql . " AND jarat.tipus = " . "'" . $tipus . "'"; 
                    }
                    if (!empty($honnan_id)) {
                        $sql = $sql . " AND honnan.varos_id = " . $honnan_id;
                    }
                    if (!empty($hova_id)) {
                        $sql = $sql . " AND hova.varos_id = " . $hova_id;
                    }
                    if (!empty($o_nap)) {
                        $sql = $sql . " AND jarat.nap >= " . $o_nap;
                    }
                    if (!empty($v_nap)) {
                        $sql = $sql . " AND jarat.nap <= " . $v_nap;
                    }
                    $sql = $sql . " " .
                    "GROUP BY    jarat.jarat_id
                    ORDER BY    jarat.nap ASC";
                }
            }
            $routes = get_data_by_command($sql);
            if ($routes === false) {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                    </div>';
            } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">típus</th>
                                <th class="col">szolgáltató</th>
                                <th class="col">járat napja</th>
                                <th class="col">honnan</th>
                                <th class="col">hova</th>
                                <th class="col">átlag jegyár (euró)</th>
                                <th class="col">elérhető jegyek száma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($routes)) {
                                echo '<tr>';
                                echo '<td>' . $row['tipus'] . '</td>';
                                echo '<td>' . $row['szolgaltato'] . '</td>';
                                echo '<td>' . $row['ev'] . '/' . $row['honap'] . '/' . $row['nap'] . '</td>';
                                echo '<td>' . $row['honnan_vnev'] . '</td>';
                                echo '<td>' . $row['hova_vnev'] . '</td>';
                                echo '<td>' . number_format($row['avg_ticket_price'], 2, '.', '') . '</td>';
                                echo '<td>' . $row['number_of_tickets'] . '</td>';
                                echo '</tr>';
                            }
                            mysqli_free_result($routes);
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