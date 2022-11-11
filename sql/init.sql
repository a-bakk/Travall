CREATE DATABASE JEGYFOGLALAS;

USE JEGYFOGLALAS;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE foglalas (
    foglalas_id     INT             NOT NULL AUTO_INCREMENT,
    email           VARCHAR(80)     NOT NULL,
    l_ev            DECIMAL(4)      NOT NULL,
    l_honap         DECIMAL(2)      NOT NULL,
    l_nap           DECIMAL(2)      NOT NULL,
    PRIMARY KEY (foglalas_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

CREATE TABLE jarat (
    jarat_id        INT             NOT NULL AUTO_INCREMENT,
    tipus           VARCHAR(6)      NOT NULL,
    szolgaltato     VARCHAR(50)     NOT NULL,
    ev              DECIMAL(12)     NOT NULL,
    honap           DECIMAL(2)      NOT NULL,
    nap             DECIMAL(2)      NOT NULL,
    honnan_varos_id INT             NOT NULL,
    hova_varos_id   INT             NOT NULL,
    PRIMARY KEY (jarat_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

CREATE TABLE jegy (
    jegy_id         INT             NOT NULL AUTO_INCREMENT,
    ar              FLOAT           NOT NULL,
    h_resz          char(1)         DEFAULT NULL,
    h_szekszam      DECIMAL(4)      DEFAULT NULL,
    jarat_id        INT             NOT NULL,
    PRIMARY KEY (jegy_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

CREATE TABLE tartalmaz (
    foglalas_id     INT             NOT NULL,
    jarat_id        INT             NOT NULL,
    PRIMARY KEY (foglalas_id, jarat_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

CREATE TABLE ugyfel (
    email           VARCHAR(80)     NOT NULL,
    vezeteknev      VARCHAR(50)     NOT NULL,
    keresztnev      VARCHAR(50)     NOT NULL,
    telefonszam     VARCHAR(20)     NOT NULL,
    PRIMARY KEY (email)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

CREATE TABLE varos (
    varos_id        INT             NOT NULL AUTO_INCREMENT,
    varosnev        VARCHAR(85)     NOT NULL,
    iranyitoszam    VARCHAR(10)     NOT NULL,
    orszag          VARCHAR(56)     NOT NULL,
    PRIMARY KEY (varos_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;


ALTER TABLE foglalas
ADD FOREIGN KEY (email) REFERENCES ugyfel(email) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE jarat
ADD FOREIGN KEY (honnan_varos_id) REFERENCES varos(varos_id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (hova_varos_id) REFERENCES varos(varos_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE jegy
ADD FOREIGN KEY (jarat_id) REFERENCES jarat(jarat_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE tartalmaz
ADD FOREIGN KEY (foglalas_id) REFERENCES foglalas(foglalas_id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (jarat_id) REFERENCES jarat(jarat_id) ON DELETE SET NULL ON UPDATE CASCADE;

INSERT INTO varos(varosnev, iranyitoszam, orszag) VALUES
    ('Budapest', '1007', 'Hungary'),
    ('Debrecen', '4000', 'Hungary'),
    ('Szeged', '6700', 'Hungary'),
    ('Győr', '9000', 'Hungary'),
    ('Szombathely', '9700', 'Hungary'),
    ('Kecskemét', '6000', 'Hungary'),
    ('Miskolc', '3500', 'Hungary'),
    ('Vienna', '1010', 'Austria'),
    ('Graz', '8010', 'Austria'),
    ('Salzburg', '5020', 'Austria'),
    ('Klagenfurt am Wörthersee', '9020', 'Austria'),
    ('Innsbruck', '6020', 'Austria'),
    ('Linz', '4020', 'Austria'),
    ('Zürich', '5000', 'Switzerland'),
    ('Bern', '3000', 'Switzerland'),
    ('Geneva', '1200', 'Switzerland'),
    ('Paris', '75000', 'France'),
    ('Lyon', '69000', 'France'),
    ('Toulouse', '39230', 'France'),
    ('Montpellier', '34000', 'France'),
    ('Lille', '59000', 'France'),
    ('Bordeaux', '33000', 'France'),
    ('Madrid', '28001', 'Spain'),
    ('Barcelona', '08001', 'Spain'),
    ('Valencia', '46001', 'Spain'),
    ('Sevilla', '41001', 'Spain'),
    ('Zaragoza', '50001', 'Spain'),
    ('Hamburg', '20038', 'Germany'),
    ('Munich', '80331', 'Germany'),
    ('Cologne', '50667', 'Germany'),
    ('Frankfurt', '60306', 'Germany'),
    ('Stuttgart', '70173', 'Germany'),
    ('London', 'EC1A', 'United Kingdom'),
    ('Birmingham', 'B1', 'United Kingdom'),
    ('Manchester', 'M1', 'United Kingdom'),
    ('Glasgow', 'G1', 'United Kingdom'),
    ('Leeds', 'LS1', 'United Kingdom'),
    ('Tokyo', '103-8686', 'Japan'),
    ('Berlin', '10115', 'Germany'),
    ('Rio de Janeiro', '20000-000', 'Brazil'),
    ('Denver', '80014', 'United States'),
    ('Helsinki', '00100', 'Finland'),
    ('Nairobi', '00521', 'Kenya'),
    ('Bogotá', '110110', 'Colombia'),
    ('Palermo', '90121', 'Italy'),
    ('Marseille', '13000', 'France');


INSERT INTO jarat(tipus, szolgaltato, ev, honap, nap, honnan_varos_id, hova_varos_id) VALUES
    ('repülő', 'Wizz Air', 2022, 12, 3, 1, 12),
    ('repülő', 'Wizz Air', 2022, 12, 8, 2, 20),
    ('repülő', 'Wizz Air', 2022, 12, 20, 10, 33),
    ('repülő', 'Wizz Air', 2022, 12, 29, 8, 17),
    ('repülő', 'Lufthansa', 2022, 12, 2, 31, 41),
    ('repülő', 'Lufthansa', 2022, 12, 17, 14, 35),
    ('repülő', 'Lufthansa', 2022, 12, 8, 39, 40),
    ('repülő', 'Air France', 2022, 12, 24, 20, 44),
    ('repülő', 'Air France', 2022, 12, 29, 42, 18),
    ('repülő', 'Air France', 2022, 12, 30, 38, 17),
    ('repülő', 'Ryan Air', 2022, 12, 3, 9, 36),
    ('repülő', 'Ryan Air', 2022, 12, 9, 24, 45),
    ('repülő', 'Austrian Airlines', 2022, 12, 15, 8, 11),
    ('repülő', 'KLM Royal Dutch Airlines', 2022, 12, 26, 22, 24),
    ('repülő', 'British Airways', 2022, 12, 30, 36, 16),
    ('repülő', 'Austrian Airlines', 2022, 12, 5, 1, 8),
    ('repülő', 'Austrian Airlines', 2022, 12, 12, 1, 8),
    ('repülő', 'Austrian Airlines', 2022, 12, 19, 1, 8),
    ('repülő', 'Eurowings', 2022, 12, 15, 30, 1),
    ('repülő', 'Eurowings', 2022, 12, 19, 1, 32),
    ('repülő', 'Swiss Airlines', 2022, 12, 28, 1, 38),
    ('vonat', 'MÁV Magyar Államvasutak', 2022, 12, 3, 3, 2),
    ('vonat', 'MÁV Magyar Államvasutak', 2022, 12, 6, 4, 5),
    ('vonat', 'MÁV Magyar Államvasutak', 2022, 12, 17, 7, 4),
    ('vonat', 'MÁV Magyar Államvasutak', 2022, 12, 27, 1, 8),
    ('vonat', 'ÖBB Österreichische Bundesbahnen', 2022, 12, 17, 9, 29),
    ('vonat', 'ÖBB Österreichische Bundesbahnen', 2022, 12, 28, 11, 12),
    ('vonat', 'Eurostar', 2022, 12, 15, 24, 30),
    ('busz', 'Flixbus', 2022, 12, 1, 27, 14),
    ('busz', 'Flixbus', 2022, 12, 4, 15, 20),
    ('busz', 'National Express', 2022, 12, 18, 35, 36),
    ('busz', 'Eurolines', 2022, 12, 27, 23, 32),
    ('busz', 'Volánbusz', 2022, 12, 4, 2, 7),
    ('busz', 'Volánbusz', 2022, 12, 13, 3, 1),
    ('busz', 'Volánbusz', 2022, 12, 19, 4, 2);

INSERT INTO ugyfel VALUES
    ('albertp24@citromail.hu', 'Pintér', 'Albert', '+3655832005'),
    ('b_martina1972@freemail.hu', 'Bakos', 'Martina', '+3655135914'),
    ('jakobsd12@gmail.com', 'Schmidt', 'Jakob', '+436600436863'),
    ('elinawby@yahoo.com', 'Winter', 'Elina', '+436609741144'),
    ('djoseph@gmail.co.uk', 'Doyle', 'Joseph', '1074586'),
    ('emayer452@mailbox.org', 'Mayer', 'Ella', '+4930066803607'),
    ('kbrandt@protonmail.com', 'Brandt', 'Käthe', '+4930809055802'),
    ('paulbonnet13@gmail.com', 'Bonnet', 'Paul', '+33937151515'),
    ('bastig65@pm.me', 'Gauthier', 'Bastien', '+33935559978'),
    ('l_margot39@bouygtel.fr', 'Lemaire', 'Margot', '+33938917095');

INSERT INTO jegy(ar, h_resz, h_szekszam, jarat_id) VALUES
    (59.2, 'F', 7, 1),
    (60.8, 'H', 3, 1),
    (59.7, 'B', 5, 1),
    (169.99, 'L', 2, 5),
    (278.13, 'C', 4, 9),
    (97.4, 'K', 1, 13),
    (97.4, 'K', 2, 13),
    (572.1, 'D', 6, 15),
    (3.4, 'A', 27, 23),
    (3.6, 'B', 11, 23),
    (7.2, 'C', 56, 24),
    (7.9, 'A', 32, 24),
    (23.98, 'F', 21, 26),
    (24.12, 'F', 46, 26),
    (36.49, NULL, NULL, 29),
    (37.14, NULL, NULL, 29),
    (29.12, NULL, NULL, 31),
    (6, NULL, NULL, 34),
    (6, NULL, NULL, 34),
    (7.14, NULL, NULL, 35),
    (8.12, NULL, NULL, 33),
    (65.99, 'C', 6, 16),
    (109.99, 'A', 2, 17),
    (34.28, 'H', 5, 18),
    (55.99, 'L', 4, 19),
    (230.18, 'E', 2, 20),
    (72.99, 'G', 6, 21);

INSERT INTO foglalas(email, l_ev, l_honap, l_nap) VALUES
    ('kbrandt@protonmail.com', 2022, 11, 28),
    ('kbrandt@protonmail.com', 2022, 11, 28),
    ('albertp24@citromail.hu', 2022, 11, 14),
    ('elinawby@yahoo.com', 2022, 12, 1),
    ('l_margot39@bouygtel.fr', 2022, 11, 22),
    ('l_margot39@bouygtel.fr', 2022, 11, 24),
    ('emayer452@mailbox.org', 2022, 12, 3),
    ('bastig65@pm.me', 2022, 11, 4),
    ('b_martina1972@freemail.hu', 2022, 11, 17),
    ('djoseph@gmail.co.uk', 2022, 11, 19),
    ('jakobsd12@gmail.com', 2022, 11, 23),
    ('paulbonnet13@gmail.com', 2022, 11, 25);

INSERT INTO tartalmaz VALUES
    (1, 1),
    (2, 3),
    (3, 5),
    (4, 17),
    (4, 9),
    (5, 13),
    (6, 18),
    (7, 20),
    (8, 23),
    (9, 25),
    (10, 28),
    (11, 29),
    (12, 27);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;