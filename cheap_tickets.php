<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Jegyek Budapestről</title>
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
            <div class="row align-items-center justify-content-between mb-5">
                <div class="col-md-5 p-5">
                    <h2 class="mb-5">Budapest? A legolcsóbb jegyeink</h2>
                    <h5 class="mb-5">Egy listát találhat azokról a szolgáltatókról, melyeknek (néhány) járata Budapestről vagy Budapestre közlekedik és az átlagnál olcsóbban férhet hozzá jegyekhez.</h5>
                </div>
                <div class="col-md">
                    <img src="assets/img/budapest.jpg" alt="Budapest" class="img-fluid rounded">
                </div>
            </div>
            <?php
            $routes = get_data_by_command("
            SELECT      jarat.szolgaltato, COUNT(*) AS number_of_routes
            FROM        jarat, varos AS honnan, varos AS hova
            WHERE       jarat.honnan_varos_id = honnan.varos_id AND jarat.hova_varos_id = hova.varos_id AND (honnan.varosnev = 'Budapest' OR hova.varosnev = 'Budapest')
            AND         EXISTS (SELECT jegy.ar FROM jegy WHERE jegy.jarat_id = jarat.jarat_id AND jegy.ar <= (SELECT AVG(jegy.ar) FROM jegy))
            GROUP BY    (jarat.szolgaltato)
            ORDER BY    jarat.szolgaltato ASC
            ");
            if ($routes === false) {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Sikertelen adatbázisművelet!
                    </div>';
            } else { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">Szolgáltató</th>
                                <th class="col">Járatok száma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($routes)) {
                                echo '<tr>';
                                echo '<td>' . $row['szolgaltato'] . '</td>';
                                echo '<td>' . $row['number_of_routes'] . '</td>';
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