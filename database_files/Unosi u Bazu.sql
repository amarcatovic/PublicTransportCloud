USE PublicTransportCloud;

/* Uoga */
INSERT INTO Uloga(naziv) VALUES ('Admin');
INSERT INTO Uloga(naziv) VALUES ('Biletar');
INSERT INTO Uloga(naziv) VALUES ('Taxi');
INSERT INTO Uloga(naziv) VALUES ('Vozač');
INSERT INTO Uloga(naziv) VALUES ('Korisnik');
INSERT INTO Uloga(naziv) VALUES ('Revizor');
INSERT INTO Uloga(naziv) VALUES ('Penzioner');
INSERT INTO Uloga(naziv) VALUES ('Učenik');
INSERT INTO Uloga(naziv) VALUES ('Student');

insert into TipPrevoznika(naziv) VALUES ('Gradski Saobraćaj');
insert into TipPrevoznika(naziv) VALUES ('Međunarodni Saobraćaj');
insert into TipPrevoznika(naziv) VALUES ('Međugradski Saobraćaj');
insert into TipPrevoznika(naziv) VALUES ('Taxi');


INSERT INTO TipVozila(naziv) VALUES ('Autobus');
INSERT INTO TipVozila(naziv) VALUES ('Tramvaj');
INSERT INTO TipVozila(naziv) VALUES ('Trolejbus');
INSERT INTO TipVozila(naziv) VALUES ('Voz');
INSERT INTO TipVozila(naziv) VALUES ('Metro');
INSERT INTO TipVozila(naziv) VALUES ('Žičara');
INSERT INTO TipVozila(naziv) VALUES ('Trajekt');
INSERT INTO TipVozila(naziv) VALUES ('Taxi');

INSERT INTO IntervalRelacije(naziv) VALUES ('Svakih pola sata');
INSERT INTO IntervalRelacije(naziv) VALUES ('Svaki sat');
INSERT INTO IntervalRelacije(naziv) VALUES ('Svaka dva sata');
INSERT INTO IntervalRelacije(naziv) VALUES ('Dnevno');
INSERT INTO IntervalRelacije(naziv) VALUES ('Sedmično');
INSERT INTO IntervalRelacije(naziv) VALUES ('Charter');

INSERT INTO Drzava(naziv) VALUES ("Bosna i Hercegovina");
INSERT INTO Grad(naziv, drzava_id) VALUES ("Zenica", 1);

INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Bolnica', 44.207111, 17.923975, 'Crkvice', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Paviljon', 44.204585, 17.927269, 'Prve zeničke brigade', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Babina Rijeka', 44.198462, 17.925409, 'Prve zeničke brigade 11', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Ušće', 44.195423, 17.923027, 'Ušće', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Odmut', 44.194050, 17.918817, 'Bulevar Eze Arnautovića', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Sarajevska', 44.194369, 17.914931, 'Sarajevska bb', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Meokušnice', 44.196673, 17.909894, 'Sarajevska', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Carina', 44.201606, 17.904076, 'Branilaca Bosna', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Stadion', 44.206347, 17.906137, 'Aska Borića 23', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Autobuska Stanica 2', 44.208221, 17.911672, 'Bulevar Kralja Tvrtka ', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Blatuša', 44.211359, 17.914640, 'Blatuša ', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Autobuska Stanica', 44.209152, 17.911810, 'Bulevar Kralja Tvrtka ', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Stadion', 44.206965, 17.906680, 'Aska Borića 23', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Carina', 44.201019, 17.903954, 'Branilaca Bosna', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Dom Mladih', 44.196003, 17.911635, 'Sarajevska', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Odmut', 44.194673, 17.919099, 'Bulevar Eze Arnautovića', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Turbe', 44.194756, 17.921825, 'Ušće', 1, 1);
INSERT INTO Stanica(naziv, lat, lng, adresa, grad_id, tip_id) VALUES ('Babina Rijeka', 44.197782, 17.924944, 'Prve zeničke brigade 11', 1, 1);