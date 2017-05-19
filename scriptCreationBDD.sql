-- SCRIPT de création de la base de données MESGUEN --
-- Version 1.0 --
-- Par LEPREVOST Florentin --
-- 10 tables (Chauffeur, Exploitant, Tournée, Etape, Document, TypeDocument, Photo, Véhicule, Commune, Lieu) --
-- InnoDB --
-- UTF-8 --

-- Création de la table CHAUFFEUR --
CREATE TABLE IF NOT EXISTS CHAUFFEUR (
  /* -- Liste des champs de la table --
  CODE           TYPE(LONG)    COMPLEMENT */
  chauffeurID    integer(10)   NOT NULL AUTO_INCREMENT,
  chauffeurNOM   char(50)      DEFAULT NULL,
  chauffeurPRE   char(50)      DEFAULT NULL,
  chauffeurTEL   varchar(10)   DEFAULT NULL,
  chauffeurMAI   varchar(40)   DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (chauffeurID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table EXPLOITANT --
CREATE TABLE IF NOT EXISTS EXPLOITANT (
  /* -- Liste des champs de la table --
  CODE            TYPE(LONG)    COMPLEMENT */
  exploitantID    integer(10)   NOT NULL AUTO_INCREMENT,
  exploitantNOM   char(50)      DEFAULT NULL,
  exploitantPRE   char(50)      DEFAULT NULL,
  exploitantTEL   varchar(10)   DEFAULT NULL,
  exploitantMAI   varchar(40)   DEFAULT NULL,
  exploitantLOG   char(51)      DEFAULT NULL,
  exploitantMDP   varchar(15)   DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (exploitantID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table VEHICULE --
CREATE TABLE IF NOT EXISTS VEHICULE (
  /* -- Liste des champs de la table --
  CODE            TYPE(LONG)    COMPLEMENT */
  vehiculeIMM     varchar(9)    NOT NULL,
  vehiculeNOM     varchar(30)   DEFAULT NULL,

  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (vehiculeIMM)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table COMMUNE --
CREATE TABLE IF NOT EXISTS COMMUNE (
  /* -- Liste des champs de la table --
  CODE          TYPE(LONG)    COMPLEMENT */
  communeID     integer(10)   NOT NULL AUTO_INCREMENT,
  communeNOM    varchar(50)      DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (communeID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table TYPEDOCUMENT --
CREATE TABLE IF NOT EXISTS TYPEDOCUMENT (
  /* -- Liste des champs de la table --
  CODE              TYPE(LONG)    COMPLEMENT */
  typedocumentID    integer(10)   NOT NULL AUTO_INCREMENT,
  typedocumentLIB   char(30)      DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (typedocumentID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table LIEU --
CREATE TABLE IF NOT EXISTS LIEU (
  /* -- Liste des champs de la table --
  CODE        TYPE(LONG)    COMPLEMENT */
  lieuID      integer(10)   NOT NULL AUTO_INCREMENT,
  communeID   integer(10)   NOT NULL,
  lieuNOM     varchar(50)      DEFAULT NULL,
  lieuGPS     varchar(25)   DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (LIEUID),
  -- ETRANGERE --
  -- Lien entre LIEU et COMMUNE --
  CONSTRAINT FK_LIEU_COMMUNE
    FOREIGN KEY (communeID)
    REFERENCES COMMUNE(communeID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table TOURNEE --
CREATE TABLE IF NOT EXISTS TOURNEE (
  /* -- Liste des champs de la table --
  CODE         TYPE(LONG)    COMPLEMENT */
  tourneeID    integer(10)   NOT NULL AUTO_INCREMENT,
  chauffeurID  integer(10)   NOT NULL,
  exploitantID integer(10)   NOT NULL,
  vehiculeIMM  varchar(9)    NOT NULL,
  tourneeCOM   varchar(100)  DEFAULT NULL,
  tourneeDAT   datetime(6)   DEFAULT NULL,
  tourneePEC   char(3)      DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (tourneeID),
  -- ETRANGERE --
  -- Lien entre TOURNEE et CHAUFFEUR --
  CONSTRAINT FK_TOURNEE_CHAUFFEUR
    FOREIGN KEY (chauffeurID)
    REFERENCES CHAUFFEUR(chauffeurID),
  -- Lien entre TOURNEE et EXPLOITANT --
  CONSTRAINT FK_TOURNEE_EXPLOITANT
    FOREIGN KEY (exploitantID)
    REFERENCES EXPLOITANT(exploitantID),
  -- Lien entre TOURNEE et VEHICULE --
  CONSTRAINT FK_TOURNEE_VEHICULE
    FOREIGN KEY (vehiculeIMM)
    REFERENCES VEHICULE(vehiculeIMM)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table ETAPE --
CREATE TABLE IF NOT EXISTS ETAPE (
  /* -- Liste des champs de la table --
  CODE      TYPE(LONG)    COMPLEMENT */
  tourneeID integer(10)   NOT NULL,
  etapeID   integer(10)   NOT NULL,
  lieuID    integer(10)   NOT NULL,
  etapeHRD  datetime(6)   DEFAULT NULL,
  etapeHRF  datetime(6)   DEFAULT NULL,
  etapeHMI  datetime(6)   DEFAULT NULL,
  etapeHMA  datetime(6)   DEFAULT NULL,
  etapeNPL  integer(5)    DEFAULT NULL,
  etapeNPLE integer(5)    DEFAULT NULL,
  etapeNPC  integer(5)    DEFAULT NULL,
  etapeNPCE integer(5)    DEFAULT NULL,
  etapeCHE  integer(5)    DEFAULT NULL,
  etapeETA  varchar(10)      DEFAULT NULL,
  etapeCOM  varchar(100)  DEFAULT NULL,
  etapeVAL  varchar(30)      DEFAULT NULL,
  etapeKM   integer(10)   DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (etapeID),
  -- ETRANGERE --
  -- Lien entre ETAPE et TOURNEE --
  CONSTRAINT FK_ETAPE_TOURNEE
    FOREIGN KEY (tourneeID)
    REFERENCES TOURNEE(tourneeID),
  -- Lien entre ETAPE et LIEU --
  CONSTRAINT FK_ETAPE_LIEU
    FOREIGN KEY (lieuID)
    REFERENCES LIEU(lieuID)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8;


-- Création de la table LIEU --
CREATE TABLE IF NOT EXISTS LIEU (
  /* -- Liste des champs de la table --
  CODE        TYPE(LONG)    COMPLEMENT */
  lieuID      integer(10)   NOT NULL AUTO_INCREMENT,
  communeID   integer(10)   NOT NULL,
  lieuNOM     char(50)      DEFAULT NULL,
  lieuGPS     varchar(25)   DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (LIEUID),
  -- ETRANGERE --
  -- Lien entre LIEU et COMMUNE --
  CONSTRAINT FK_LIEU_COMMUNE
    FOREIGN KEY (communeID)
    REFERENCES COMMUNE(communeID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table DOCUMENT --
CREATE TABLE IF NOT EXISTS DOCUMENT (
  /* -- Liste des champs de la table --
  CODE            TYPE(LONG)    COMPLEMENT */
  documentID      integer(10)   NOT NULL AUTO_INCREMENT,
  tourneeID       integer(10)   NOT NULL,
  typedocumentID  integer(10)   NOT NULL,
  documentURL     varchar(50)   DEFAULT NULL,

  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (documentID),
  -- ETRANGERE --
  -- Lien entre DOCUMENT et TOURNEE --
  CONSTRAINT FK_DOCUMENT_TOURNEE
    FOREIGN KEY (tourneeID)
    REFERENCES TOURNEE(tourneeID),
  -- Lien entre DOCUMENT et TYPEDOCUMENT --
  CONSTRAINT FK_DOCUMENT_TYPEDOCUMENT
    FOREIGN KEY (typedocumentID)
    REFERENCES TYPEDOCUMENT(typedocumentID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;


-- Création de la table PHOTO --
CREATE TABLE IF NOT EXISTS PHOTO (
  /* -- Liste des champs de la table --
  CODE        TYPE(LONG)    COMPLEMENT */
  photoID     integer(10)   NOT NULL AUTO_INCREMENT,
  tourneeID   integer(10)   NOT NULL,
  etapeID     integer(10)   NOT NULL,
  photoURL    varchar(50)   DEFAULT NULL,
  
  -- Liste des clefs --
  -- PRIMAIRE --
  PRIMARY KEY (photoID),
  -- ETRANGERE --
  -- Lien entre PHOTO et TOURNEE --
  CONSTRAINT FK_PHOTO_TOURNEE
    FOREIGN KEY (tourneeID)
    REFERENCES TOURNEE(tourneeID),
  -- Lien entre PHOTO et ETAPE --
  CONSTRAINT FK_PHOTO_ETAPE
    FOREIGN KEY (etapeID)
    REFERENCES ETAPE(etapeID)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;