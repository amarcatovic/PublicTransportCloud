USE PublicTransportCloud;

/* Država */
INSERT INTO Drzava(naziv) VALUES ('Bosna i Hercegovina');
insert into Drzava (naziv) values ('Niger');
insert into Drzava (naziv) values ('Indonesia');
insert into Drzava (naziv) values ('France');
insert into Drzava (naziv) values ('China');
insert into Drzava (naziv) values ('United States');
insert into Drzava (naziv) values ('Uruguay');
insert into Drzava (naziv) values ('Portugal');
insert into Drzava (naziv) values ('Brazil');
insert into Drzava (naziv) values ('China');
insert into Drzava (naziv) values ('Belize');
insert into Drzava (naziv) values ('Malaysia');
insert into Drzava (naziv) values ('China');
insert into Drzava (naziv) values ('China');
insert into Drzava (naziv) values ('China');
insert into Drzava (naziv) values ('China');
insert into Drzava (naziv) values ('Indonesia');
insert into Drzava (naziv) values ('Poland');
insert into Drzava (naziv) values ('Russia');
insert into Drzava (naziv) values ('Canada');
insert into Drzava (naziv) values ('Bahamas');

/* Grad */
select * from grad;
INSERT INTO Grad(naziv, drzava_id) VALUES ('Zenica', 1);
INSERT INTO Grad(naziv, drzava_id) VALUES ('Sarajevo', 1);
INSERT INTO Grad(naziv, drzava_id) VALUES ('Paris', 4);
INSERT INTO Grad(naziv, drzava_id) VALUES ('Wuhan', 5);
INSERT INTO Grad(naziv, drzava_id) VALUES ('Toronto', 20);
INSERT INTO Grad(naziv, drzava_id) VALUES ('New York', 6);

/* Uoga */
select * from Uloga;
INSERT INTO Uloga(naziv) VALUES ('Admin');
INSERT INTO Uloga(naziv) VALUES ('Biletar');
INSERT INTO Uloga(naziv) VALUES ('Taxi');
INSERT INTO Uloga(naziv) VALUES ('Vozač');
INSERT INTO Uloga(naziv) VALUES ('Korisnik');
INSERT INTO Uloga(naziv) VALUES ('Revizor');

/* Korisnik Aplikacije */
SELECT * FROM korisnikaplikacije;
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Harris', 'Meatcher', 'hmeatcher0@nifty.com', '5823dec58ce88cd735fbe3faf31b79a5579c70f1', '1990-07-27 22:58:37', 4, 3);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Shanan', 'Ivanyutin', 'sivanyutin1@vimeo.com', 'df4e5325611aca1a435b95a90d3de8d1943a6682', '1989-04-11 22:44:51', 3, 5);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Harwilll', 'Iglesia', 'higlesia2@google.com', '0eb9fb58cb6ea5681eaf7cceec7367c24676819a', '1953-05-19 20:58:19', 5, 5);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Cliff', 'Posvner', 'cposvner3@exblog.jp', 'a973e48231135f64d8ec3fc44b32eed24ecde673', '1998-09-05 17:25:59', 5, 3);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Dina', 'Doudny', 'ddoudny4@abc.net.au', 'ac3e40a6fe1cc4d9ba1b3b295607a89093e6088b', '1976-02-11 23:36:52', 6, 6);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Rory', 'Salmons', 'rsalmons5@nsw.gov.au', '653a7d55002510878ecb73ca4c616817a9f39459', '1980-03-17 07:07:39', 2, 4);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Ronalda', 'Sleith', 'rsleith6@instagram.com', '6d7e4605005da2d79dd4ad6b4f8b9c1e7c386045', '1962-01-18 08:27:32', 5, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Darryl', 'Cowap', 'dcowap7@buzzfeed.com', 'b1eb18d098031c99e56d6e87263924e48f546d5f', '1982-12-07 04:12:58', 6, 6);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Kermie', 'Antonacci', 'kantonacci8@yelp.com', 'b2f96089539dd86f2b47df21d9c5061f12bbe20d', '2002-07-04 21:49:39', 6, 4);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Brewster', 'Tissington', 'btissington9@homestead.com', 'b6e788235f6608cb6ca902f753948e2d9a02b1f1', '1960-09-18 17:01:02', 3, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Jackson', 'Merrisson', 'jmerrissona@youku.com', '3a5565937a2a5445c292d7bf2b75395aa6a1bab2', '1963-05-03 19:56:07', 4, 5);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Janice', 'Keysall', 'jkeysallb@twitter.com', '989aa127be4ff87285be3efbb533b53d89e95ad8', '1968-10-27 18:07:25', 4, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Aurel', 'Chasmer', 'achasmerc@prlog.org', '945a04e035d9106a557daad2a8f7e6aba51ffe1f', '1951-08-26 06:39:38', 1, 6);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Ken', 'Gianiello', 'kgianiellod@fda.gov', '0bc025ebee80f1971b408d1cdfc1b696e647a4e4', '1951-07-27 15:00:09', 5, 3);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Sybil', 'MacCart', 'smaccarte@hostgator.com', '0d4039098dc96d1980f04bddcaf60f4f94176ee1', '1968-10-26 04:24:59', 4, 3);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Ari', 'Dowbakin', 'adowbakinf@netscape.com', '41f108c17a1868ec3a5e33c7d5244f93a4dd1d64', '1992-05-14 01:54:21', 5, 6);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Chrisse', 'Thunnerclef', 'cthunnerclefg@mysql.com', '3acc2c21e61b0aec793165dbe904960e5f496148', '1977-07-25 12:25:33', 6, 4);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Vivian', 'Bowen', 'vbowenh@newyorker.com', '326d5676de1bf3c73fb494a62fd26d502722e7ca', '1991-07-27 20:11:44', 5, 6);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Maddie', 'Eliet', 'melieti@artisteer.com', 'ae2ce0ab3b10fee1ee6fa3f3b3b598d15a0d5b8f', '2005-07-06 02:28:01', 3, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Gard', 'Emblin', 'gemblinj@acquirethisname.com', '0a0b27e3a10157e557550f04d88f7782d91f46dd', '1992-06-13 07:06:29', 5, 4);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Jeremias', 'Narup', 'jnarupk@illinois.edu', 'b0f72841051679986252e5307b4a70d46446a0bc', '1981-05-16 04:47:29', 1, 6);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Kerwinn', 'Reitenbach', 'kreitenbachl@themeforest.net', '50c94e8cf568468f0fee379c107a6e6f82f85b50', '1994-10-12 06:01:13', 2, 3);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Janice', 'Danbrook', 'jdanbrookm@hatena.ne.jp', 'de5cd850d0fe01986fbff70d8a9c1e473be322a4', '1953-03-30 04:10:04', 2, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Camella', 'Postance', 'cpostancen@pen.io', '8326406682421b294e25e92087573d856f7f2d80', '1981-02-15 22:36:52', 6, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Abbe', 'Ximenez', 'aximenezo@yellowbook.com', '501be7a826d9e649a7109d5a13ff33931ec15f00', '1973-03-01 02:54:19', 2, 2);
insert into KorisnikAplikacije (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id) values ('Amar', 'Ćatović', 'amarzenica@gmail.com', '$2y$10$hTcQ4qzY1JwQvgJUi8p9iuIfXeEKnpFA6Ff4BIzzRgv/mmj3lKk.C', '1998-03-17 18:45:19', 1, 1); /* amaramar */

insert into TipPrevoznika(naziv) VALUES ('Gradski Saobraćaj');
insert into TipPrevoznika(naziv) VALUES ('Međunarodni Saobraćaj');
insert into TipPrevoznika(naziv) VALUES ('Međugradski Saobraćaj');
insert into TipPrevoznika(naziv) VALUES ('Taxi');

insert into Prevoznik(naziv, email, telefon, passwordHash, tip_id, grad_id) 
values('Zenicatrans', 'zetrans@gmail.com', '+38761555555', '3gtrss8fdk94**/sd4wesdf', 1, 1);
insert into Prevoznik(naziv, email, telefon, passwordHash, tip_id, grad_id) 
values('Gras', 'gras@gmail.com', '+38762123456', '3gtrss8fdk94**/sd4wesdf', 1, 2);
insert into Prevoznik(naziv, email, telefon, passwordHash, tip_id, grad_id) 
values('Sarajevo Taxi', 'taxi@sarajevo.ba', '+38760116342', '3gtrss8fdk94**/sd4wesdf', 4, 2);
insert into Prevoznik(naziv, email, telefon, passwordHash, tip_id, grad_id) 
values('FlixBus', 'flix@bus.de', '+38760777333', '3gtrss8fdk94**/sd4wesdf', 2, 2);
insert into Prevoznik(naziv, email, telefon, passwordHash, tip_id, grad_id) 
values('Centrotrans', 'centrotrans@gmail.com', '+38760115555', '3gtrss8fdk94**/sd4wesdf', 3, 2);

INSERT INTO ProdajnoMjesto(naziv, lat, lng, adresa, grad_id) 
VALUES ('Centar', 44.199813, 17.909691, 'Trg Alije Izetbegovića', 1);
INSERT INTO ProdajnoMjesto(naziv, lat, lng, adresa, grad_id) 
VALUES ('Autobuska Stanica', 44.210116, 17.912022, 'Bulevar Kralja Tvrtka I', 1);
INSERT INTO ProdajnoMjesto(naziv, lat, lng, adresa, grad_id) 
VALUES ('Crkvice', 44.200630, 17.920434, 'Crkvice', 1);
INSERT INTO ProdajnoMjesto(naziv, lat, lng, adresa, grad_id) 
VALUES ('Autobuska Stanica', 43.858876, 18.397693, 'Put života 8', 2);
INSERT INTO ProdajnoMjesto(naziv, lat, lng, adresa, grad_id) 
VALUES ('Sarajevo City Center', 43.855333, 18.407649, 'Vrbanja 1', 2);

INSERT INTO Automobil(id_automobil, marka, model, boja) VALUES ('A12-A-345', 'Volfswagen', 'Polo', 'Crvena');
INSERT INTO Automobil(id_automobil, marka, model, boja) VALUES ('A54-A-321', 'Volfswagen', 'Golf', 'Crna');
INSERT INTO Automobil(id_automobil, marka, model, boja) VALUES ('M66-A-001', 'Renault', 'Megane', 'Plava');
INSERT INTO Automobil(id_automobil, marka, model, boja) VALUES ('A11-M-395', 'Audi', 'A4', 'Siva');

INSERT INTO Korisnik(id_korisnik, brojKartice, stanje) VALUES (1, '100000', 14.54);
INSERT INTO Korisnik(id_korisnik, brojKartice, stanje) VALUES (2, '100001', 11.89);
INSERT INTO Korisnik(id_korisnik, brojKartice, stanje) VALUES (3, '100002', 0);
INSERT INTO Korisnik(id_korisnik, brojKartice, stanje) VALUES (4, '100003', 0);
INSERT INTO Korisnik(id_korisnik, brojKartice, stanje) VALUES (5, '100004', 0.54);
INSERT INTO Korisnik(id_korisnik, brojKartice, stanje) VALUES (6, '100005', 4.14);

INSERT INTO Biletar(id_biletar, prodajnoMjesto_id) VALUES (7, 1);
INSERT INTO Biletar(id_biletar, prodajnoMjesto_id) VALUES (8, 2);

INSERT INTO Administracija(id_administrator, brojDozvole) VALUES(8, 'E53213');

INSERT INTO Revizor(id_revizor, prevoznik_id, brojDozvole) VALUES (9, 1, 'A111TTE');
INSERT INTO Revizor(id_revizor, prevoznik_id, brojDozvole) VALUES (10, 2, 'Z111TTE');

INSERT INTO Vozac(id_vozac, prevoznik_id) VALUES (11, 1);
INSERT INTO Vozac(id_vozac, prevoznik_id) VALUES (12, 2);

INSERT INTO TaxiVozac(id_vozac, automobil_id, brojTaxiDozvole, prevoznik_id)
VALUES (13, 'A12-A-345', 'TXI131', NULL);
INSERT INTO TaxiVozac(id_vozac, automobil_id, brojTaxiDozvole, prevoznik_id)
VALUES (14, 'A54-A-321', 'TXI190', 3);

INSERT INTO TipVozila(naziv) VALUES ('Autobus');
INSERT INTO TipVozila(naziv) VALUES ('Tramvaj');
INSERT INTO TipVozila(naziv) VALUES ('Trolejbus');
INSERT INTO TipVozila(naziv) VALUES ('Voz');
INSERT INTO TipVozila(naziv) VALUES ('Metro');
INSERT INTO TipVozila(naziv) VALUES ('Žičara');
INSERT INTO TipVozila(naziv) VALUES ('Trajekt');
INSERT INTO TipVozila(naziv) VALUES ('Taxi');

INSERT INTO Vozilo(id_vozilo, kapacitet, naziv, tip_id, prevoznik_id)
VALUES('E41-A-133', 60, 'Nissan', 1, 1);
INSERT INTO Vozilo(id_vozilo, kapacitet, naziv, tip_id, prevoznik_id)
VALUES('E11-J-133', 56, 'MAN', 1, 1);
INSERT INTO Vozilo(id_vozilo, kapacitet, naziv, tip_id, prevoznik_id)
VALUES('TR123', 100, 'T1', 2, 2);
INSERT INTO Vozilo(id_vozilo, kapacitet, naziv, tip_id, prevoznik_id)
VALUES('TR2', 100, 'T2', 2, 2);
INSERT INTO Vozilo(id_vozilo, kapacitet, naziv, tip_id, prevoznik_id)
VALUES('A15-J-669', 50, 'Volvo', 1, 2);

INSERT INTO IntervalRelacije(naziv) VALUES ('Svakih pola sata');
INSERT INTO IntervalRelacije(naziv) VALUES ('Svaki sat');
INSERT INTO IntervalRelacije(naziv) VALUES ('Svaka dva sata');
INSERT INTO IntervalRelacije(naziv) VALUES ('Dnevno');
INSERT INTO IntervalRelacije(naziv) VALUES ('Sedmično');
INSERT INTO IntervalRelacije(naziv) VALUES ('Charter');

INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Bolnica', 44.207111, 17.923975, 'Crkvice', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Paviljon', 44.204585, 17.927269, 'Prve zeničke brigade', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Babina Rijeka', 44.198462, 17.925409, 'Prve zeničke brigade 11', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Ušće', 44.195423, 17.923027, 'Ušće', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Odmut', 44.194050, 17.918817, 'Bulevar Eze Arnautovića', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Sarajevska', 44.194369, 17.914931, 'Sarajevska bb', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Meokušnice', 44.196673, 17.909894, 'Sarajevska', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Carina', 44.201606, 17.904076, 'Branilaca Bosna', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Stadion', 44.206347, 17.906137, 'Aska Borića 23', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Autobuska Stanica 2', 44.208221, 17.911672, 'Bulevar Kralja Tvrtka ', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Blatuša', 44.211359, 17.914640, 'Blatuša ', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Autobuska Stanica', 44.209152, 17.911810, 'Bulevar Kralja Tvrtka ', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Stadion', 44.206965, 17.906680, 'Aska Borića 23', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Carina', 44.201019, 17.903954, 'Branilaca Bosna', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Dom Mladih', 44.196003, 17.911635, 'Sarajevska', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Odmut', 44.194673, 17.919099, 'Bulevar Eze Arnautovića', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Turbe', 44.194756, 17.921825, 'Ušće', 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id) VALUES ('Babina Rijeka', 44.197782, 17.924944, 'Prve zeničke brigade 11', 1);

INSERT INTO Relacija(cijena, interval_id, tipVozila_id, polaziste_id, odrediste_id) VALUES(1, 2, 1, 2, 12);
INSERT INTO Relacija(cijena, interval_id, tipVozila_id, polaziste_id, odrediste_id) VALUES(1, 2, 1, 12, 2);

INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 2, 1);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 3, 2);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 4, 3);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 5, 4);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 6, 5);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 7, 6);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 8, 7);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 9, 8);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 10, 9);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 11, 10);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (2, 12, 11);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 12, 1);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 13, 2);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 14, 3);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 15, 4);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 16, 5);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 17, 6);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 18, 7);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 19, 8);
INSERT INTO RelacijaStanica(relacija_id, stanica_id, rb_stanice) VALUES (1, 2, 9);

INSERT INTO PrevoznikRelacija(prevoznik_id, relacija_id, datumUvodjenja) VALUES (1, 1, CURRENT_TIMESTAMP());
INSERT INTO PrevoznikRelacija(prevoznik_id, relacija_id, datumUvodjenja) VALUES (1, 2, CURRENT_TIMESTAMP());

select * from vozilo;
INSERT INTO VozacVozilo(vozac_id, vozilo_id, datumZaduzenja, datumRazduzenja) 
VALUES (11, 'A15-J-669', '2020-05-02 11:00:00', '2020-05-02 12:00:00');
INSERT INTO VozacVozilo(vozac_id, vozilo_id, datumZaduzenja, datumRazduzenja) 
VALUES (11, 'A15-J-669', CURRENT_TIMESTAMP(), NULL);

INSERT INTO Nadopune(korisnik_id, prodajnoMjesto_id, kolicina) VALUES (1, 1, 5);
INSERT INTO Nadopune(korisnik_id, prodajnoMjesto_id, kolicina) VALUES (1, 1, 1);


INSERT INTO Linija(vozac_id, vozilo_id, relacija_id, sljedecaStanica_id, planiraniDolazak)
VALUES (11, 'A15-J-669', 1, 13, '2020-05-12 11:55');
INSERT INTO Linija(vozac_id, vozilo_id, relacija_id, sljedecaStanica_id, planiraniPolazak, planiraniDolazak, status)
VALUES (11, 'A15-J-669', 2, 2, '2020-05-02 11:00:00', '2020-05-02 12:00:00', 'Završen');

INSERT INTO LinijaPlacanje(linija_id, korisnik_id, kolicina) VALUES (1, 1, 1);
INSERT INTO LinijaPlacanje(linija_id, korisnik_id, kolicina) VALUES (1, 2, 1);

INSERT INTO TaxiZahtjev(korisnik_id, lokacija, opis, vrijemeZahtjeva, vozac_id, vrijemeDolaska, ocjena, cijena, status)
VALUES (1, 'Crkvice', 'Kod studentskog doma na pjesackom', CURRENT_TIMESTAMP(), NULL, NULL, NULL, NULL, 'Na Čekanju');
INSERT INTO TaxiZahtjev(korisnik_id, lokacija, opis, vrijemeZahtjeva, vozac_id, vrijemeDolaska, ocjena, cijena, status)
VALUES (1, 'Odmut', 'Kod autobuske', '2020-05-05 11:14:11', 13, '2020-05-05 11:15:11', 5, 2.5, 'Završen');
INSERT INTO TaxiZahtjev(korisnik_id, lokacija, opis, vrijemeZahtjeva, vozac_id, vrijemeDolaska, ocjena, cijena, status)
VALUES (2, 'Carina', 'na autobuskoj', '2020-05-05 11:14:11', NULL, NULL, NULL, NULL, 'Na Čekanju');