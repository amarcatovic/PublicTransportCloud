drop database PublicTransportCloud;

CREATE DATABASE PublicTransportCloud;
USE PublicTransportCloud;

/* 1 */
CREATE TABLE Drzava(
	id_drzava INT AUTO_INCREMENT,
    naziv NVARCHAR(30) NOT NULL,
    CONSTRAINT PK_drzava PRIMARY KEY (id_drzava)
);

/* 2 */
CREATE TABLE Grad(
	id_grad INT AUTO_INCREMENT,
    naziv NVARCHAR(30) NOT NULL,
    drzava_id INT NOT NULL,
    CONSTRAINT PK_drzava PRIMARY KEY (id_grad),
    CONSTRAINT FK_grad_drzava FOREIGN KEY (drzava_id) REFERENCES Drzava(id_drzava)
);

/* 3 */
CREATE TABLE Uloga(
	id_uloga INT AUTO_INCREMENT,
    naziv NVARCHAR(30) NOT NULL,
    CONSTRAINT PK_uloga PRIMARY KEY (id_uloga)
);

/* 4 */
CREATE TABLE KorisnikAplikacije(
	id_korisnik INT auto_increment,
    ime NVARCHAR(30) NOT NULL,
    prezime NVARCHAR(30) NOT NULL,
    email NVARCHAR(100) NOT NULL UNIQUE,
    passwordHash NVARCHAR(256) NOT NULL,
    datumRodjenja DATETIME NOT NULL,
    grad_id INT NOT NULL,
    uloga_id INT NOT NULL,
	CONSTRAINT PK_KorisnikApp PRIMARY KEY (id_korisnik),
    CONSTRAINT FK_korisnik_grad FOREIGN KEY (grad_id) REFERENCES Grad(id_grad),
    CONSTRAINT FK_korisnik_uloga FOREIGN KEY (uloga_id) REFERENCES Uloga(id_uloga)
);

/* 5 */
CREATE TABLE TipPrevoznika(
	id_tip INT AUTO_INCREMENT,
    naziv NVARCHAR(50) NOT NULL,
    CONSTRAINT FK_TipPrevoznika PRIMARY KEY (id_tip)
);

/* 6 */
CREATE TABLE Prevoznik(
	id_prevoznik INT AUTO_INCREMENT,
    naziv NVARCHAR(50) NOT NULL,
    email NVARCHAR(100) NOT NULL,
    telefon NVARCHAR(20) NOT NULL,
    passwordHash NVARCHAR(256) NOT NULL,
    tip_id INT NOT NULL,
    grad_id INT NOT NULL,
    CONSTRAINT PK_Prevoznik PRIMARY KEY (id_prevoznik),
    CONSTRAINT FK_Prevoznik_TipPrevoznika FOREIGN KEY (tip_id) REFERENCES TipPrevoznika(id_tip),
    CONSTRAINT FK_Prevoznik_Grad FOREIGN KEY (grad_id) REFERENCES Grad(id_grad)
);

/* 7 */
CREATE TABLE ProdajnoMjesto(
	id_prodajnoMjesto INT AUTO_INCREMENT,
    naziv NVARCHAR(30) NOT NULL,
    lat FLOAT(10, 6) NOT NULL,
	lng FLOAT(10, 6) NOT NULL,
    adresa NVARCHAR(50) NOT NULL,
    grad_id INT NOT NULL,
    CONSTRAINT PK_ProdajnoMjesto PRIMARY KEY (id_prodajnoMjesto),
    CONSTRAINT FK_prodajnomjesto_grad FOREIGN KEY (grad_id) REFERENCES Grad(id_grad)
);

/* 8 */
CREATE TABLE Automobil(
	id_automobil CHAR(9),
    marka NVARCHAR(20) NOT NULL,
    model NVARCHAR(20) NOT NULL,
    boja NVARCHAR(20) NOT NULL,
    CONSTRAINT PK_Automobil PRIMARY KEY (id_automobil)
);

/* 9 */
CREATE TABLE Korisnik(
	id_korisnik INT,
    brojKartice NVARCHAR(10) NOT NULL,
    stanje FLOAT(5, 2) NOT NULL DEFAULT '0.00',
    CONSTRAINT PK_Korisnik PRIMARY KEY (id_korisnik),
    CONSTRAINT FK_Korisnik_KorisnikApp FOREIGN KEY (id_korisnik) REFERENCES KorisnikAplikacije(id_korisnik)
);

/* 10 */
CREATE TABLE Biletar(
	id_biletar INT,
    prodajnoMjesto_id INT NOT NULL,
    CONSTRAINT PK_Biletar PRIMARY KEY (id_biletar),
    CONSTRAINT FK_Biletar_KorisnikApp FOREIGN KEY (id_biletar) REFERENCES KorisnikAplikacije(id_korisnik),
    CONSTRAINT FK_Biletar_Prevoznik FOREIGN KEY (prodajnoMjesto_id) REFERENCES ProdajnoMjesto(id_prodajnoMjesto)
);

/* 11 */
CREATE TABLE Administracija(
	id_administrator INT,
    brojDozvole NVARCHAR(10) NOT NULL,
    CONSTRAINT PK_Administracija PRIMARY KEY (id_administrator),
    CONSTRAINT FK_Administracija_Biletar FOREIGN KEY (id_administrator) REFERENCES Biletar(id_biletar)
);

/* 12 */
CREATE TABLE Revizor(
	id_revizor INT,
    prevoznik_id INT NOT NULL,
    brojDozvole NVARCHAR(10) NOT NULL,
    CONSTRAINT PK_Revizor PRIMARY KEY (id_revizor),
    CONSTRAINT FK_Revizor_KorisnikApp FOREIGN KEY (id_revizor) REFERENCES KorisnikAplikacije(id_korisnik),
    CONSTRAINT FK_Revizor_Prevoznik FOREIGN KEY (prevoznik_id) REFERENCES Prevoznik(id_prevoznik)
);

/* 13 */
CREATE TABLE Vozac(
	id_vozac INT,
    prevoznik_id INT NOT NULL,
    CONSTRAINT PK_Vozac PRIMARY KEY (id_vozac),
    CONSTRAINT FK_Vozac_KorisnikApp FOREIGN KEY (id_vozac) REFERENCES KorisnikAplikacije(id_korisnik),
    CONSTRAINT FK_Vozac_Prevoznik FOREIGN KEY(prevoznik_id) REFERENCES Prevoznik(id_prevoznik)
);

/* 14 */
CREATE TABLE TaxiVozac(
	id_vozac INT,
    prevoznik_id INT,
    automobil_id CHAR(9) NOT NULL,
    brojTaxiDozvole NVARCHAR(20) NOT NULL,
    CONSTRAINT PK_TaxiVozac PRIMARY KEY (id_vozac),
    CONSTRAINT FK_TaxiVozac_KorisnikApp FOREIGN KEY (id_vozac) REFERENCES KorisnikAplikacije(id_korisnik),
    CONSTRAINT FK_TaxiVozac_Prevoznik FOREIGN KEY(prevoznik_id) REFERENCES Prevoznik(id_prevoznik),
    CONSTRAINT FK_TaxiVozac_Automobil FOREIGN KEY(automobil_id) REFERENCES Automobil(id_automobil)
);

/* 15 */
CREATE TABLE TipVozila(
	id_tip INT AUTO_INCREMENT,
    naziv NVARCHAR(20) NOT NULL,
    CONSTRAINT PK_TipVozila PRIMARY KEY (id_tip)
);

/* 16 */
CREATE TABLE Vozilo(
	id_vozilo CHAR(9),
    kapacitet INT NOT NULL,
    naziv NVARCHAR(30) NOT NULL,
    tip_id INT NOT NULL,
    prevoznik_id INT NOT NULL,
    CONSTRAINT PK_Vozilo PRIMARY KEY (id_vozilo),
    CONSTRAINT FK_Vozilo_TipVozila FOREIGN KEY (tip_id) REFERENCES TipVozila(id_tip),
    CONSTRAINT FK_Vozilo_Prevoznik FOREIGN KEY (prevoznik_id) REFERENCES Prevoznik(id_prevoznik)
);

/* 17 */
CREATE TABLE IntervalRelacije(
	id_interval INT AUTO_INCREMENT,
    naziv NVARCHAR(20) NOT NULL,
    opis NVARCHAR(500),
    CONSTRAINT FK_interval PRIMARY KEY (id_interval)
);

/* 18 */
CREATE TABLE Stanica(
	id_stanica INT AUTO_INCREMENT,
    naziv NVARCHAR(30) NOT NULL,
    lat FLOAT(10, 6) NOT NULL,
	lng FLOAT(10, 6) NOT NULL,
    adresa NVARCHAR(50) NOT NULL,
    grad_id INT NOT NULL,
    CONSTRAINT PK_Stanica PRIMARY KEY (id_stanica),
    CONSTRAINT FK_stanica_grad FOREIGN KEY (grad_id) REFERENCES Grad(id_grad)
);

/* 19 */
CREATE TABLE Relacija(
	id_relacija INT AUTO_INCREMENT,
    polaziste_id INT NOT NULL,
    odrediste_id INT NOT NULL,
    cijena FLOAT(3,2) NOT NULL,
    interval_id INT NOT NULL,
    tipVozila_id INT NOT NULL,
    CONSTRAINT PK_Relacija PRIMARY KEY (id_relacija),
    CONSTRAINT FK_relacija_stanica01 FOREIGN KEY (polaziste_id) references Stanica(id_stanica),
    CONSTRAINT FK_relacija_stanica02 FOREIGN KEY (odrediste_id) references Stanica(id_stanica),
    CONSTRAINT FK_Relacija_TipRelacije FOREIGN KEY (interval_id) REFERENCES IntervalRelacije(id_interval),
    CONSTRAINT FK_Relacija_TipVozila FOREIGN KEY (tipVozila_id) REFERENCES TipVozila(id_tip)
);

ALTER TABLE Relacija
MODIFY cijena FLOAT(7,2) NOT NULL;

/* 20 */
CREATE TABLE RelacijaStanica(
	relacija_id INT,
    stanica_id INT,
    rb_stanice INT NOT NULL,
    CONSTRAINT PK_RelacijaStanica PRIMARY KEY (relacija_id, stanica_id),
    CONSTRAINT FK_RS_Relacija FOREIGN KEY (relacija_id) REFERENCES Relacija(id_relacija),
    CONSTRAINT FK_RS_Stanica FOREIGN KEY (stanica_id) REFERENCES Stanica(id_stanica)
);

/* 21 */
CREATE TABLE PrevoznikRelacija(
	prevoznik_id INT,
    relacija_id INT,
    datumUvodjenja DATETIME,
    CONSTRAINT PK_PrevoznikRelacija PRIMARY KEY (prevoznik_id, relacija_id, datumUvodjenja),
    CONSTRAINT FK_PR_Prevoznik FOREIGN KEY (prevoznik_id) REFERENCES Prevoznik(id_prevoznik),
	CONSTRAINT FK_PR_Relacija FOREIGN KEY (relacija_id) REFERENCES Relacija(id_relacija)
);

/* 22 */
CREATE TABLE VozacVozilo(
	vozac_id INT,
    vozilo_id CHAR(9),
    datumZaduzenja DATETIME,
    datumRazduzenja DATETIME DEFAULT NULL,
    CONSTRAINT PK_VozacVozilo PRIMARY KEY (vozac_id, vozilo_id, datumZaduzenja),
    CONSTRAINT FK_VV_Vozac FOREIGN KEY (vozac_id) REFERENCES Vozac(id_vozac),
    CONSTRAINT FK_VV_Vozilo FOREIGN KEY (vozilo_id) REFERENCES Vozilo(id_vozilo)
);

/* 23 */
CREATE TABLE Nadopune(
	korisnik_id INT,
    prodajnoMjesto_id INT,
    datumNadopune DATETIME DEFAULT CURRENT_TIMESTAMP,
    kolicina FLOAT(100,2) NOT NULL,
    CONSTRAINT PK_Nadopune PRIMARY KEY (korisnik_id, prodajnoMjesto_id, datumNadopune),
    CONSTRAINT FK_Nadopune_Korisnik FOREIGN KEY (korisnik_id) REFERENCES Korisnik(id_korisnik),
    CONSTRAINT FK_Nadopune_ProdajnoMjesto FOREIGN KEY (prodajnoMjesto_id) REFERENCES ProdajnoMjesto(id_prodajnoMjesto)
);

/* 24 */
CREATE TABLE Linija(
	id_linija INT AUTO_INCREMENT,
    vozac_id INT NOT NULL,
    vozilo_id CHAR(9) NOT NULL,
    relacija_id INT NOT NULL,
    sljedecaStanica_id INT NOT NULL,
    planiraniPolazak DATETIME DEFAULT CURRENT_TIMESTAMP,
    planiraniDolazak DATETIME NOT NULL,
    status NVARCHAR(100) DEFAULT 'U toku',
    CONSTRAINT PK_Linija PRIMARY KEY (id_linija),
    CONSTRAINT FK_Linija_Vozac FOREIGN KEY (vozac_id) REFERENCES Vozac(id_vozac),
    CONSTRAINT FK_Linija_Vozilo FOREIGN KEY (vozilo_id) REFERENCES Vozilo(id_vozilo),
    CONSTRAINT FK_Linija_Relacija FOREIGN KEY (relacija_id) REFERENCES Relacija(id_relacija),
    CONSTRAINT FK_Linija_Stanica FOREIGN KEY (sljedecaStanica_id) REFERENCES Stanica(id_stanica)
);

/* 25 */
CREATE TABLE LinijaPlacanje(
	linija_id INT,
    korisnik_id INT,
    vrijemePlacanja DATETIME DEFAULT current_timestamp,
    kolicina FLOAT(3,2),
    CONSTRAINT PK_LinijaPlacanje PRIMARY KEY (linija_id, korisnik_id, vrijemePlacanja),
    CONSTRAINT FK_LinijaPlacanje_Linija FOREIGN KEY (linija_id) REFERENCES Linija(id_linija),
    CONSTRAINT FK_LinijaPlacanje_Korisnik FOREIGN KEY (korisnik_id) REFERENCES Korisnik(id_korisnik)
);

/* 26 */
CREATE TABLE TaxiZahtjev(
	id_zahtjev INT AUTO_INCREMENT,
    korisnik_id INT,
    lokacija NVARCHAR(30) NOT NULL,
    opis NVARCHAR(500) NOT NULL,
    vrijemeZahtjeva DATETIME DEFAULT CURRENT_TIMESTAMP,
    vozac_id INT DEFAULT NULL,
    vrijemeDolaska DATETIME DEFAULT NULL,
    ocjena TINYINT DEFAULT NULL,
    cijena FLOAT(4,2) DEFAULT NULL,
    status NVARCHAR(30) DEFAULT 'Na Čekanju',
    CONSTRAINT PK_TaxiZahtjev PRIMARY KEY (id_zahtjev),
    CONSTRAINT FK_TZ_Korisnik FOREIGN KEY (korisnik_id) REFERENCES Korisnik(id_korisnik),
    CONSTRAINT FK_TZ_TaxiVozac FOREIGN KEY (vozac_id) REFERENCES TaxiVozac(id_vozac)
);