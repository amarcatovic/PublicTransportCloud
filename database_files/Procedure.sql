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
													KORISNIK
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

/* ---------------------------------------------------------------------------------------------------------------------------
													TAXI VOZAC
 ---------------------------------------------------------------------------------------------------------------------------*/
 SELECT * FROM TaxiVozac;
 
DELIMITER //
CREATE PROCEDURE `GetTaxiVozace`()
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, TV.prevoznik_id, TV.automobil_id, A.marka, A.model, A.boja, TV.brojTaxiDozvole
    FROM TaxiVozac TV JOIN KorisnikAplikacije KA
    ON KA.id_korisnik = TV.id_vozac JOIN Grad G
    ON KA.grad_id = G.id_grad JOIN Automobil A
    ON TV.automobil_id = A.id_automobil;
END//
DELIMITER;                           
DROP PROCEDURE GetTaxiVozace;
CALL GetTaxiVozace(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetTaxiVozac`(_id INT)
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, TV.prevoznik_id, TV.automobil_id, A.marka, A.model, A.boja, TV.brojTaxiDozvole
    FROM TaxiVozac TV JOIN KorisnikAplikacije KA
    ON KA.id_korisnik = TV.id_vozac JOIN Grad G
    ON KA.grad_id = G.id_grad JOIN Automobil A
    ON TV.automobil_id = A.id_automobil
    WHERE KA.id_korisnik = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetTaxiVozac;
CALL GetTaxiVozac(14); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetTaxiVozacaByRegistracija`(_registracija CHAR(9))
BEGIN
	SELECT KA.id_korisnik, KA.ime, KA.prezime, KA.email, KA.datumRodjenja, KA.grad_id, G.naziv grad, TV.prevoznik_id, TV.automobil_id, A.marka, A.model, A.boja, TV.brojTaxiDozvole
    FROM TaxiVozac TV JOIN KorisnikAplikacije KA
    ON KA.id_korisnik = TV.id_vozac JOIN Grad G
    ON KA.grad_id = G.id_grad JOIN Automobil A
    ON TV.automobil_id = A.id_automobil
    WHERE TV.automobil_id = _registracija;
END//
DELIMITER;                           
DROP PROCEDURE GetTaxiVozacaByRegistracija;
CALL GetTaxiVozacaByRegistracija('A54-A-321'); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													TIP VOZILA
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetTipoveVozila`()
BEGIN
	SELECT * FROM TipVozila;
END//
DELIMITER;                           
DROP PROCEDURE GetTipoveVozila;
CALL GetTipoveVozila(); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													VOZILO
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetVozila`()
BEGIN
	SELECT V.id_vozilo, V.kapacitet, V.naziv, V.tip_id, TV.naziv tip, V.prevoznik_id, P.naziv prevoznik 
    FROM Vozilo V JOIN TipVozila TV 
    ON V.tip_id = TV.id_tip JOIN Prevoznik P
    ON V.prevoznik_id = P.id_prevoznik;
END//
DELIMITER;                           
DROP PROCEDURE GetVozila;
CALL GetVozila(); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetVozilo`(_reg CHAR(9))
BEGIN
	SELECT V.id_vozilo, V.kapacitet, V.naziv, V.tip_id, TV.naziv tip, V.prevoznik_id, P.naziv prevoznik 
    FROM Vozilo V JOIN TipVozila TV 
    ON V.tip_id = TV.id_tip JOIN Prevoznik P
    ON V.prevoznik_id = P.id_prevoznik
    WHERE V.id_vozilo = _reg;
END//
DELIMITER;                           
DROP PROCEDURE GetVozilo;
CALL GetVozilo('E11-J-133'); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `VoziloUAktivnojLiniji`(_reg CHAR(9))
BEGIN
	SELECT COUNT(*) broj, L.id_linija
    FROM Linija L
    WHERE status = 'U toku' AND L.vozilo_id = _reg;
END//
DELIMITER;                           
DROP PROCEDURE VoziloUAktivnojLiniji;
CALL VoziloUAktivnojLiniji('E11-J-133'); /* Primjer poziva */


DELIMITER //
CREATE PROCEDURE `GetVozilaPrevoznika`(_prevoznik INT, _tip INT)
BEGIN
	SELECT V.id_vozilo, V.kapacitet, V.naziv
    FROM Vozilo V JOIN TipVozila TV 
    ON V.tip_id = TV.id_tip JOIN Prevoznik P
    ON V.prevoznik_id = P.id_prevoznik
    WHERE V.prevoznik_id = _prevoznik AND V.tip_id = _tip;
END//
DELIMITER;                           
DROP PROCEDURE GetVozilaPrevoznika;
CALL GetVozilaPrevoznika(2, 2); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `DaLiJeVoziloSlobodno`(_reg CHAR(9))
BEGIN
	SELECT COUNT(*) broj
    FROM Vozilo V JOIN VozacVozilo VV
    ON V.id_vozilo = VV.vozilo_id
    WHERE VV.datumRazduzenja IS NULL AND VV.vozilo_id = _reg;
END//
DELIMITER;                           
DROP PROCEDURE DaLiJeVoziloSlobodno;
CALL DaLiJeVoziloSlobodno('A15-J-669'); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													INTERVAL RELACIJE
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetIntervali`()
BEGIN
	SELECT I.id_interval, I.naziv
    FROM IntervalRelacije I;
END//
DELIMITER;                           
DROP PROCEDURE GetIntervali;
CALL GetIntervali(); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													STANICA
 ---------------------------------------------------------------------------------------------------------------------------*/
DELIMITER //
CREATE PROCEDURE `GetStanice`(_grad INT)
BEGIN
	SELECT *
    FROM Stanica
    WHERE grad_id = _grad;
END//
DELIMITER;                           
DROP PROCEDURE GetStanice;
CALL GetStanice(1); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetStanica`(_id INT)
BEGIN
	SELECT *
    FROM Stanica
    WHERE id_stanica = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetStanica;
CALL GetStanica(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													RELACIJA
 ---------------------------------------------------------------------------------------------------------------------------*/
SELECT * FROM Relacija;

DELIMITER //
CREATE PROCEDURE `GetRelacija`(_prevoznik INT)
BEGIN
	SELECT R.id_relacija, S1.naziv polaziste, S2.naziv odrediste, R.cijena, IR.naziv intervalRelacije, TV.naziv tipVozila  
    FROM Relacija R JOIN Stanica S1
    ON R.polaziste_id = S1.id_stanica JOIN Stanica S2
    ON R.odrediste_id = S2.id_stanica JOIN IntervalRelacije IR
    ON R.interval_id = IR.id_interval JOIN TipVozila TV 
    ON R.tipVozila_id = TV.id_tip JOIN PrevoznikRelacija RP
    ON R.id_relacija = RP.relacija_id
    WHERE RP.prevoznik_id = _prevoznik;
END//
DELIMITER;                           
DROP PROCEDURE GetRelacija;
CALL GetRelacija(3); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetSljedecaStanica`(_rel INT)
BEGIN
	SELECT R.polaziste_id 
	FROM Relacija R
    WHERE id_relacija = _rel;
END//
DELIMITER;                           
DROP PROCEDURE GetSljedecaStanica;
CALL GetSljedecaStanica(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													RELACIJA STANICA
 ---------------------------------------------------------------------------------------------------------------------------*/
SELECT * FROM RelacijaStanica;

DELIMITER //
CREATE PROCEDURE `GetStaniceZaRelaciju`(_relacija INT)
BEGIN
	SELECT S.naziv, S.lat, S.lng, S.adresa
    FROM RelacijaStanica RS JOIN Stanica S
    ON RS.stanica_id = S.id_stanica
    WHERE RS.relacija_id = _relacija
    ORDER BY RS.rb_stanice;
END//
DELIMITER;                           
DROP PROCEDURE GetStaniceZaRelaciju;
CALL GetStaniceZaRelaciju(3); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetStaniceNiz`(_relacija INT)
BEGIN
	SELECT RS.stanica_id, S.naziv
    FROM RelacijaStanica RS JOIN Stanica S
    ON RS.stanica_id = S.id_stanica
    WHERE RS.relacija_id = _relacija
    ORDER BY RS.rb_stanice;
END//
DELIMITER;                           
DROP PROCEDURE GetStaniceNiz;
CALL GetStaniceNiz(2); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													VOZAC VOZILO
 ---------------------------------------------------------------------------------------------------------------------------*/
select * from VozacVozilo;

/* ---------------------------------------------------------------------------------------------------------------------------
													NADOPUNE
 ---------------------------------------------------------------------------------------------------------------------------*/ 
DELIMITER //
CREATE PROCEDURE `GetNadopune`(_id INT)
BEGIN
	SELECT N.kolicina, PM.naziv poslovnica, G.naziv grad, N.datumNadopune
    FROM Nadopune N JOIN ProdajnoMjesto PM
    ON N.prodajnoMjesto_id = PM.id_prodajnoMjesto JOIN Grad G
    ON PM.grad_id = G.id_grad
    WHERE N.korisnik_id = _id
    ORDER BY N.datumNadopune DESC;
END//
DELIMITER;                           
DROP PROCEDURE GetNadopune;
CALL GetNadopune(1); /* Primjer poziva */

/* ---------------------------------------------------------------------------------------------------------------------------
													LINIJA
 ---------------------------------------------------------------------------------------------------------------------------*/ 
 select * from linija;
 select * from relacija;
DELIMITER //
CREATE PROCEDURE `GetAktivneLinije`(_grad INT, _tip INT)
BEGIN
	SELECT 
		L.id_linija,
		(SELECT naziv FROM Stanica WHERE id_stanica = R.polaziste_id) polaziste, 
        (SELECT naziv FROM Stanica WHERE id_stanica = R.odrediste_id) odrediste,
        L.planiraniPolazak,
        L.planiraniDolazak,
        S.naziv sljedecaStanica,
        R.cijena,
        TV.naziv tip,
        L.status        
    FROM Linija L JOIN Relacija R
    ON L.relacija_id = R.id_relacija JOIN Stanica S
    ON L.sljedecaStanica_id = S.id_stanica JOIN TipVozila TV
    ON R.tipVozila_id = TV.id_tip
    WHERE NOT L.status = 'Završen' AND S.grad_id = _grad AND TV.id_tip = _tip;
END//
DELIMITER;                           
DROP PROCEDURE GetAktivneLinije;
CALL GetAktivneLinije(1, 1); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetAktivnaLinija`(_id INT)
BEGIN
	SELECT 
		L.id_linija,
		(SELECT naziv FROM Stanica WHERE id_stanica = R.polaziste_id) polaziste, 
        (SELECT naziv FROM Stanica WHERE id_stanica = R.odrediste_id) odrediste,
        L.planiraniPolazak,
        L.planiraniDolazak,
        S.naziv sljedecaStanica,
        R.cijena,
        TV.naziv tip,
        L.status  
    FROM Linija L JOIN Relacija R
    ON L.relacija_id = R.id_relacija JOIN Stanica S
    ON L.sljedecaStanica_id = S.id_stanica JOIN TipVozila TV
    ON R.tipVozila_id = TV.id_tip
    WHERE L.id_linija = _id;
END//
DELIMITER;                           
DROP PROCEDURE GetAktivnaLinija;
CALL GetAktivnaLinija(1); /* Primjer poziva */

DELIMITER //
CREATE PROCEDURE `GetStaniceLinije`(_relacija INT)
BEGIN
	SELECT S.naziv, S.lat, S.lng
    FROM RelacijaStanica RS JOIN Stanica S
    ON RS.stanica_id = S.id_stanica
    WHERE RS.relacija_id = _relacija
    ORDER BY rb_stanice;
END//
DELIMITER;                           
DROP PROCEDURE GetStaniceLinije;
CALL GetStaniceLinije(1); /* Primjer poziva */ 

/* ---------------------------------------------------------------------------------------------------------------------------
													LINIJA PLACANJE
 ---------------------------------------------------------------------------------------------------------------------------*/ 
DELIMITER //
CREATE PROCEDURE `LinijaPlacena`(_korisnik INT, _linija INT)
BEGIN
	SELECT COUNT(*) broj
    FROM LinijaPlacanje
    WHERE korisnik_id = _korisnik AND linija_id = _linija;
		
END//
DELIMITER;                           
DROP PROCEDURE LinijaPlacena;
CALL LinijaPlacena(1, 1); /* Primjer poziva */


 
 