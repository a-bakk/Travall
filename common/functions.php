<?php

function navGen() {

    $tmp = basename($_SERVER['PHP_SELF'], ".php");

    echo "<nav class = 'navigation'>
    <div class = 'logo-main'><a href='index.php'><img class = 'icon' src='assets/img/banner.png' alt='trogair logo'></a>
    </div>
    <ul class = 'navlist'>" .
    "<li class = 'navelement'>" .
        "<a href='index.php'" . ($tmp === "index" ? " class='active'" : "") . ">Főoldal</a>" .
    "</li>" .
    "<li class = 'navelement'>" .
        "<a href='flights.php'" . ($tmp === "flights" ? " class='active'" : "") . ">Járatok</a>" .
    "</li>" .
    "<li class = 'navelement'>" .
        "<a href='cities.php'" . ($tmp === "cities" ? " class='active'" : "") . ">Városok</a>" .
    "</li>" .
    "<li class = 'navelement'>" .
        "<a href='booking.php'" . ($tmp === "booking" ? " class='active'" : "") . ">Foglalás</a>" .
    "</li>" .
    "<li class = 'navelement'>" .
        "<a href='clients.php'" . ($tmp === "clients" ? " class='active'" : "") . ">Ügyfelek</a>" . // admin priv required
    "</li>" .
    "<li class = 'navelement'>" .
        "<a href='contact.php'" . ($tmp === "contact" ? " class='active'" : "") . ">Kapcsolat</a>" .
    "</li>";

}