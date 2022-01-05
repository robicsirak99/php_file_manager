A webalkalmazás egy Laravel keretrendszerben készült fájlkezelő.
Lehetővé teszi a felhasználók számára, hogy fájlokat tölthessenek fel és le, valamit szöveges fájlokat hozhassanak létre és szerkesszenek.
Bejelentkezés után a felhasználó láthatja a feltöltött fájljait, létrehozásuknak a dátumát, valamit a fájlok méretét.
A felhasználók fájlokat küldhetnek át egymásnak, amiről emailben értesítést kap a fogadó fél.
Egyéb funkcionalitások: kereső mező, rendezés, fájlok törlése, felhasználónév és jelszó módosítás.

-mysql adatbázist használ, aminek a beállításait a .env fájlban lehet módosítani
-az adatbázis táblákat az alkalmazás maga hozza létre a 'php artisan migrate' parancs segítségével, majd a 'php artisan serve' parnacs elindítja a szervert
-az emailek küldéshez mailtrap-et használ, aminek a beállításait szintén a .env fájlban lehet módosítani
