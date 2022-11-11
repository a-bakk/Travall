# Travall (Busz, vasút, repülő helyfoglalás)

## Adatbázisok kötelező feladat

### Navigációs menü

#### A táblakezelés lenyíló menü alatt lehetséges az adatbázisban szereplő táblákhoz hozzáférni.

Minden ide tartozó oldalon lehetőség van az általános CRUD műveletek elvégzéséhez.
Alapvetően minden oldal nyújt egy automatikus listázást a jelenlegi helyzetről. Az oldal tetején van lehetőség új rekordot felvinni,
a szükséges mezők kitöltése után az Elküldés gombra kattintva.' Ha az nem ellenkezően van jelezve, minden mező kitöltése kötelező az
adatfelvitelnél. Minden sor végére generálódik egy törlés és módosítás gomb, ezek biztosítják a lehetőséget az említett műveletek
elvégzésére a megfelelő rekordokon. A törlésre kattintva automatikusan végbemegy a művelet. A módosítás egy formot jelenít meg,
itt adhatóak meg az új értékek. Ezek a mezők már nem feltétlenül kötelezőek, lehetőség van csak néhány adat módosítására is.
Miután új értékek lettek adva a kívánt mezőknek, az Elküldés gombbal véglegesíthető a tranzakció, a Vissza gombbal pedig
vissza lehet lépni az oldalra.

#### Az összetett lekérdezések, felhasználási példák lenyíló menü alatt lehetséges hozzáférni gyakorlatilag az összetett lekérdezéseket produkáló oldalakhoz.

A kiválasztott felületre navigálva remélhetőleg gond nélkül végbemegy a tranzakció, ezek az oldalak nagyobb részben az eredményt tartalmazzák, illetve egy kevés filler contentet.
Az utolsó előtti opció - Decemberi járatok megfelelő jegyárral - minimálisan interaktívabb, a megfelelő inputmezővel módosíthatunk a listázás eredményén.
És végül egy kizárólag decemberre korlátozott jegykereső, melyen filterekkel lehet keresni azon járatok között, melyhez van az alkalmazásban jegy, ezekről tudható meg minden szükséges információt, például átlag jegyár, szolgáltató stb.

### Hiba esetén

Remélhetőleg nem dől össze teljesen az alkalmazás és a megfelelő hibaüzenettel tér vissza a felhasználó felé.
Ha adatbázis problémába ütközik, akkor valószínüleg Sikertelen adatbázisművelet vagy Üres tábla szöveget jelez, hasonlóan jár el például hiányos/hibás adatokkal.
