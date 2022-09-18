<?php
    include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Kapcsolat</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/img/icon.png"/>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    
    <?php
        include_once "common/header.php";
    ?>

    <section class="p-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md">
                    <h2 class="text-center mb-4">Cégadatok</h2>
                    <ul class="list-group list-group-flush lead">
                        <li class="list-group-item">
                            <span class="fw-bold">Main Location: </span> 50 Main Street Boston MA
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Main Location: </span> 50 Main Street Boston MA
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Main Location: </span> 50 Main Street Boston MA
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Main Location: </span> 50 Main Street Boston MA
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    <div id = "map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d487.7505173147974!2d20.146654816044297!3d46.24757206557199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4744886ffd180d6f%3A0x30f85d1d5e79483d!2sSzeged%2C%20Aradi%20v%C3%A9rtan%C3%BAk%20tere%2C%206720!5e0!3m2!1shu!2shu!4v1663506609355!5m2!1shu!2shu" width="700" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        include_once "common/footer.php";
    ?>

  </body>
</html>

</body>
</html>