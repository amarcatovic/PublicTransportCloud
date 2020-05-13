/* PROCEDURE */

USE PublicTransportCloud;

/* ---------------------------------------------------------------------------------------------------------------------------
													KORISNIK APLIKACIJE 
--------------------------------------------------------------------------------------------------------------------------- */
DELIMITER //
CREATE PROCEDURE `GetKorisnikeAplikacije` ()
BEGIN
	SELECT K.id_korisnik, K.ime, K.prezime, K.email, K.datumRodjenja, K.passwordHash, G.naziv grad, U.naziv uloga
    FROM Uloga U JOIN KorisnikAplikacije K 
    ON K.uloga_id = U.id_uloga JOIN Grad G
    ON K.grad_id = G.id_grad;
END//
DELIMITER;
DROP PROCEDURE GetKorisnikeAplikacije
CALL GetKorisnikeAplikacije()

DELIMITER //
CREATE PROCEDURE `GetKorisnikAplikacije` (_id INT)
BEGIN
	SELECT K.id_korisnik, K.ime, K.prezime, K.email, K.passwordHash, G.naziv Grad, U.naziv Uloga
    FROM Uloga U JOIN KorisnikAplikacije K 
    ON K.uloga_id = U.id_uloga JOIN Grad G
    ON K.grad_id = G.id_grad
    WHERE K.id_korisnik = _id;
END//
DELIMITER;
DROP PROCEDURE GetKorisnikAplikacije
CALL GetKorisnikAplikacije(26)

/* ---------------------------------------------------------------------------------------------------------------------------
														LOGIN 
--------------------------------------------------------------------------------------------------------------------------- */
DELIMITER //
CREATE PROCEDURE `Login` (_email NVARCHAR(100))
BEGIN
	SELECT K.id_korisnik, K.ime, K.prezime, K.email, K.passwordHash, K.grad_id, G.naziv Grad, U.naziv Uloga
    FROM Uloga U JOIN KorisnikAplikacije K 
    ON K.uloga_id = U.id_uloga JOIN Grad G
    ON K.grad_id = G.id_grad
    WHERE _email = K.email;
END//
DELIMITER;                           
DROP PROCEDURE Login;
CALL Login('amarzenica@gmail.com'); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
														DRŽAVA
--------------------------------------------------------------------------------------------------------------------------- */
DELIMITER //
CREATE PROCEDURE `GetDrzave` ()
BEGIN
	SELECT * FROM Drzava;
END//
DELIMITER;                           
DROP PROCEDURE GetDrzave;
CALL GetDrzave(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `NovaDrzava` (_drzava NVARCHAR(30))
BEGIN
	INSERT INTO Drzava(naziv) VALUES (_drzava);
END//
DELIMITER;                           
DROP PROCEDURE NovaDrzava;
CALL NovaDrzava("Austria"); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
															GRAD 
--------------------------------------------------------------------------------------------------------------------------- */
DELIMITER //
CREATE PROCEDURE `GetGradovi` ()
BEGIN
	SELECT * FROM Grad;
END//
DELIMITER;                           
DROP PROCEDURE GetGradovi;
CALL GetGradovi(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetGrad` (_id INT)
BEGIN
	SELECT * 
    FROM Grad
    WHERE id_grad = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetGrad;
CALL GetGrad(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													TIP PREVOZNIKA
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetTipovePrevoznika` ()
BEGIN
	SELECT * FROM TipPrevoznika;
END//
DELIMITER;                           
DROP PROCEDURE GetTipovePrevoznika;
CALL GetTipovePrevoznika(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetTipPrevoznika` (_id INT)
BEGIN
	SELECT * 
    FROM TipPrevoznika
    WHERE id_tip = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetTipPrevoznika;
CALL GetTipPrevoznika(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													PREVOZNIK
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetPrevoznike`()
BEGIN
	SELECT P.id_prevoznik, P.naziv, P.email, P.telefon, TP.id_tip, TP.naziv tip, G.id_grad, G.naziv grad
    FROM Prevoznik P JOIN Grad G 
    ON P.grad_id = G.id_grad JOIN TipPrevoznika TP
    ON P.tip_id = TP.id_tip;
END//
DELIMITER;                           
DROP PROCEDURE GetTipPrevoznika;
CALL GetTipPrevoznika(1); /* Primjer poziva */
 
DELIMITER //
CREATE PROCEDURE `GetPrevoznik` (_id INT)
BEGIN
	SELECT P.id_prevoznik, P.naziv, P.email, P.telefon, TP.id_tip, TP.naziv tip, G.id_grad, G.naziv grad
    FROM Prevoznik P JOIN Grad G 
    ON P.grad_id = G.id_grad JOIN TipPrevoznika TP
    ON P.tip_id = TP.id_tip
    WHERE P.id_prevoznik = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetPrevoznik;
CALL GetPrevoznik(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													PRODAJNO MJESTO
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetProdajnaMjesta`()
BEGIN
	SELECT PM.id_prodajnoMjesto, PM.naziv, PM.lat, PM.lng, PM.adresa, G.id_grad, G.naziv grad
    FROM ProdajnoMjesto PM JOIN Grad G
    ON PM.grad_id = G.id_grad;
END//
DELIMITER;                           
DROP PROCEDURE GetProdajnaMjesta;
CALL GetProdajnaMjesta(); /* Primjer poziva */
 
 DELIMITER //
CREATE PROCEDURE `GetProdajnoMjesto`(_id INT)
BEGIN
	SELECT PM.id_prodajnoMjesto, PM.naziv, PM.lat, PM.lng, PM.adresa, G.id_grad, G.naziv grad
    FROM ProdajnoMjesto PM JOIN Grad G
    ON PM.grad_id = G.id_grad
    WHERE PM.id_prodajnoMjesto = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetProdajnaMjesta;
CALL GetProdajnoMjesto(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													AUTOMOBIL
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetAutomobili`()
BEGIN
	SELECT *
    FROM Automobil;
END//
DELIMITER;                           
DROP PROCEDURE GetAutomobili;
CALL GetAutomobili(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetAutomobil`(_id CHAR(9))
BEGIN
	SELECT *
    FROM Automobil
    WHERE id_automobil = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetAutomobil;
CALL GetAutomobil('A11-M-395'); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													AUTOMOBIL
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetKorisnici`()
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, K.brojKartice, K.stanje
    FROM KorisnikAplikacije KA JOIN Korisnik K
    ON KA.id_korisnik = K.id_korisnik JOIN Grad G
    ON KA.grad_id = G.id_grad;
END//
DELIMITER;                           
DROP PROCEDURE GetKorisnici;
CALL GetKorisnici(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetKorisnik`(_id INT)
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, K.brojKartice, K.stanje
    FROM KorisnikAplikacije KA JOIN Korisnik K
    ON KA.id_korisnik = K.id_korisnik JOIN Grad G
    ON KA.grad_id = G.id_grad
    WHERE KA.id_korisnik = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetKorisnik;
CALL GetKorisnik(2); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetKorisnikByCard`(_card NVARCHAR(10))
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, K.brojKartice, K.stanje
    FROM KorisnikAplikacije KA JOIN Korisnik K
    ON KA.id_korisnik = K.id_korisnik JOIN Grad G
    ON KA.grad_id = G.id_grad
    WHERE K.brojKartice = _card;
END//
DELIMITER;                           
DROP PROCEDURE GetKorisnikByCard;
CALL GetKorisnikByCard('100002'); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `UpdateStanjeByCard`(_card NVARCHAR(10), _stanje FLOAT)
BEGIN
	UPDATE Korisnik
    SET stanje = stanje + _stanje
    WHERE brojKartice = _card;
END//
DELIMITER;                           
DROP PROCEDURE UpdateStanjeByCard;
CALL UpdateStanjeByCard('100002', -1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													BILETAR
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetBiletare`()
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, B.prodajnoMjesto_id, PM.naziv
    FROM KorisnikAplikacije KA JOIN Biletar B
    ON KA.id_korisnik = B.id_biletar JOIN Grad G
    ON KA.grad_id = G.id_grad JOIN ProdajnoMjesto PM
    ON B.prodajnoMjesto_id = PM.id_prodajnoMjesto;
END//
DELIMITER;                           
DROP PROCEDURE GetBiletare;
CALL GetBiletare(); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													BILETAR
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetRevizore`()
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, R.brojDozvole, R.prevoznik_id, P.naziv prevoznik
    FROM KorisnikAplikacije KA JOIN Revizor R
    ON KA.id_korisnik = R.id_revizor JOIN Grad G
    ON KA.grad_id = G.id_grad JOIN Prevoznik P
    ON P.id_prevoznik = R.prevoznik_id;
END//
DELIMITER;                           
DROP PROCEDURE GetRevizore;
CALL GetRevizore(); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													VOZAC
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetVozace`()
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, V.prevoznik_id, P.naziv prevoznik
    FROM KorisnikAplikacije KA JOIN Vozac V
    ON KA.id_korisnik = V.id_vozac JOIN Grad G
    ON KA.grad_id = G.id_grad JOIN Prevoznik P
    ON P.id_prevoznik = V.prevoznik_id;
END//
DELIMITER;                           
DROP PROCEDURE GetVozace;
CALL GetVozace(); /* Primjer poziva */