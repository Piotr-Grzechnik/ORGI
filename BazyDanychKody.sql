--    1. TABELE
-- A. Baza użytkowników 

CREATE TABLE Uzytkownicy (
ID      int          Not Null AUTO_INCREMENT,
Nick    VARCHAR(20)  Not Null,
Haslo   VARCHAR(256) Not Null,
Email   VARCHAR(50)  Not Null,
PRIMARY KEY (ID)
);

/*
-- B. Baza wrzuconych rzeczy ( ile czego konkretnie kto wrzucił )
-- Dla każdego użytkownika będzie utworzona taka Baza tak aby
-- przechowywać jego rzeczy

-- *ID_USER*_Uploads
 CREATE TABLE uzytkownik (
ID          int          NOT NULL AUTO_INCREMENT,
NazwaPliku  VARCHAR(30)  NOT NULL,
Opis        VARCHAR(256) NOT NULL,
Tagi        VARCHAR(256) NOT NULL,
PRIMARY KEY (ID)
);
*/

-- B. v2 Baza wrzuconych rzeczy
-- Każda kategoria będzie przechowywana osobno
-- Tu będziemy mieli informację o:  
-- Kto co wrzucił i info o samym wrzucie
-- Przechowywane będą w folderach

-- Może dodać ile razy pobrane?
-- Zdjęcia maxymalna ilość tagów
CREATE TABLE {Zdjecia/Sluchowiska itp} (
ID          int          NOT NULL AUTO_INCREMENT,
ID_USER     int          NOT NULL, -- Osoba dodajaca
NazwaPliku  VARCHAR(30)  NOT NULL,
Opis        VARCHAR(256) NOT NULL, -- longtxt?
Tag         VARCHAR(40)  NOT NULL,
Tag1        VARCHAR(40) ,
Tag2        VARCHAR(40) ,
Tag3        VARCHAR(40) ,
Tag4        VARCHAR(40) ,
Tag5        VARCHAR(40) ,
PRIMARY KEY (ID),
FOREIGN KEY(ID_USER) REFERENCES Uzytkownicy(ID)
);


-- C. Baza zliczająca ogólne zasoby

CREATE TABLE suma (
Suma_wszystkiego int PRIMARY KEY,
Suma_fotografie int,
Suma_efekty int,
Suma_podklady int,
Suma_sluchowiska int,
Suma_reportaze int,
Suma_felietony int,
Suma_opowiadani int,
Suma_poezja int
);

--    2. ZAPYTANIA
-- A.  Użytkownicy którzy mają konkretny email 
SELECT * FROM user WHERE Email="."

-- B. Wstawianie nowego użytkownika

INSERT INTO `uzytkownik`
(`Nick`,`Haslo`,`Email`) 
VALUES 
('qusi','123','testemail')

"INSERT INTO 
`{$usersTable}`
(`{$loginCol}`,`{$passCol}`,`{$emailCol}`)           
VALUES 
('{$UserNick}','{$pass_hash}','{$UserEmail}')";

INSERT INTO uzytkownik 
(Nick, Haslo, Email) 
VALUES
('Tomek21', 'qwe123', 'axeblast99@gmail.om');