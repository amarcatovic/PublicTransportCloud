/* PROCEDURE */

USE PublicTransportCloud;

/* ---------------------------------------------------------------------------------------------------------------------------
													KORISNIK APLIKACIJE 
--------------------------------------------------------------------------------------------------------------------------- */
DELIMITER //
CREATE PROCEDURE `GetKorisnikeAplikacije` ()
BEGIN
	SELECT K.id_korisnik, K.ime, K.prezime, K.email, K.passwordHash, G.naziv Grad, U.naziv Uloga
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
