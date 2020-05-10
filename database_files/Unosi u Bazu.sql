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