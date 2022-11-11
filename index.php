<?php
include_once "common/functions.php";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Főoldal</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/img/icon.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>

    <?php
    include_once "common/header.php";
    ?>

    <section class="p-5">
        <div class="container text-center mb-5">
            <h2 class="text-capitalize">Travall (Busz, vasút, repülő helyfoglalás)</h2>
            <h6>Adatbázisok kötelező feladat</h6>
        </div>
        <div class="container mb-5">
            <h5 class="mb-3">Navigációs menü</h5>
            <p class="lead">A táblakezelés lenyíló menü alatt lehetséges az adatbázisban szereplő táblákhoz hozzáférni.</p>
            <p class="mb-3">
                Minden ide tartozó oldalon lehetőség van az általános CRUD műveletek elvégzéséhez. <br />
                Alapvetően minden oldal nyújt egy automatikus listázást a jelenlegi helyzetről. Az oldal tetején van lehetőség új rekordot felvinni,
                a szükséges mezők kitöltése után az Elküldés gombra kattintva.' Ha az nem ellenkezően van jelezve, minden mező kitöltése kötelező az
                adatfelvitelnél. Minden sor végére generálódik egy törlés és módosítás gomb, ezek biztosítják a lehetőséget az említett műveletek
                elvégzésére a megfelelő rekordokon. A törlésre kattintva automatikusan végbemegy a művelet. A módosítás egy formot jelenít meg,
                itt adhatóak meg az új értékek. Ezek a mezők már nem feltétlenül kötelezőek, lehetőség van csak néhány adat módosítására is.
                Miután új értékek lettek adva a kívánt mezőknek, az Elküldés gombbal véglegesíthető a tranzakció, a Vissza gombbal pedig
                vissza lehet lépni az oldalra.
            </p>
        <p class="lead">
            Az összetett lekérdezések, felhasználási példák lenyíló menü alatt lehetséges hozzáférni gyakorlatilag az összetett lekérdezéseket produkáló oldalakhoz.
        </p>
        <p class="mb-3">
        A kiválasztott felületre navigálva remélhetőleg gond nélkül végbemegy a tranzakció, ezek az oldalak nagyobb részben az eredményt tartalmazzák, illetve egy kevés filler contentet.
        Az utolsó előtti opció - Decemberi járatok megfelelő jegyárral - minimálisan interaktívabb, a megfelelő inputmezővel módosíthatunk a listázás eredményén.
        És végül egy kizárólag decemberre korlátozott jegykereső, melyen filterekkel lehet keresni azon járatok között, melyhez van az alkalmazásban jegy, ezekről tudható meg minden szükséges információt, például átlag jegyár, szolgáltató stb.
        </p>
        <h5 class="mb-3">Hiba esetén</h5>
        <p class="lead">Remélhetőleg nem dől össze teljesen az alkalmazás és a megfelelő hibaüzenettel tér vissza a felhasználó felé.</p>
        <p>Ha adatbázis problémába ütközik, akkor valószínüleg Sikertelen adatbázisművelet vagy Üres tábla szöveget jelez, hasonlóan jár el például hiányos/hibás adatokkal.</p>
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