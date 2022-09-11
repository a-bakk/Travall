<?php

function navGen() {

    $tmp = basename($_SERVER['PHP_SELF'], ".php");

    echo "<nav class='navbar navbar-expand-lg bg-primary fw-bold text-uppercase py-1 fixed-top'>
        <div class='container'>
            <a href='index.php' class='navbar-brand'><img src='assets/img/banner.png' alt='trogair logo' class='img-fluid' id='branding-logo'></a>

            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navmenu'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navmenu'>
                <ul class='navbar-nav ms-auto'>
                    <li class='nav-item'>
                        <a href='index.php' class='nav-link " . ($tmp === "index" ? " class='active'" : "") . " text-white'>Főoldal</a>
                    </li>
                    <li class='nav-item'>
                        <a href='flights.php' class='nav-link " . ($tmp === "flights" ? " class='active'" : "") . "  text-white'>Járatok</a>
                    </li>
                    <li class='nav-item'>
                        <a href='cities.php' class='nav-link " . ($tmp === "cities" ? " class='active'" : "") . "  text-white'>Városok</a>
                    </li>
                    <li class='nav-item'>
                        <a href='booking.php' class='nav-link " . ($tmp === "booking" ? " class='active'" : "") . "  text-white'>Foglalás</a>
                    </li>
                    <li class='nav-item'>
                        <a href='clients.php' class='nav-link " . ($tmp === "clients" ? " class='active'" : "") . "  text-white'>Ügyfelek</a>
                    </li>
                    <li class='nav-item'>
                        <a href='contact.php' class='nav-link " . ($tmp === "contact" ? " class='active'" : "") . "  text-white'>Kapcsolat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>";

}