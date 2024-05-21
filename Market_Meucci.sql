-- Creazione della tabella Località
CREATE TABLE `Località` (
    CAP VARCHAR(10) PRIMARY KEY,
    citta VARCHAR(100)
);

-- Creazione della tabella Classe
CREATE TABLE Classe (
    id_classe INT PRIMARY KEY AUTO_INCREMENT,
    sezione VARCHAR(3),
    classe VARCHAR(1),
    specialità VARCHAR(20)
);

-- Creazione della tabella Categoria
CREATE TABLE Categoria (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(50),
    descrizione TEXT
);

-- Creazione della tabella Utente
CREATE TABLE Utente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    eta INT,
    email VARCHAR(100),
    telefono VARCHAR(20),
    classe INT,
    CAP VARCHAR(10),
    FOREIGN KEY (classe) REFERENCES Classe(id_classe),
    FOREIGN KEY (CAP) REFERENCES `Località`(CAP)
);

-- Creazione della tabella Annuncio
CREATE TABLE Annuncio (
    id_annuncio INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    image BLOB,
    descrizione TEXT,
    stato_di_disponibilità VARCHAR(50),
    id_utente INT,
    id_categoria INT,
    FOREIGN KEY (id_utente) REFERENCES Utente(id) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria)
);

-- Creazione della tabella Proposta
CREATE TABLE Proposta (
    id_proposta INT PRIMARY KEY AUTO_INCREMENT,
    prezzo DECIMAL(10, 2),
    descrizione TEXT,
    id_utente INT,
    id_annuncio INT,
    FOREIGN KEY (id_utente) REFERENCES Utente(id) ON DELETE CASCADE,
    FOREIGN KEY (id_annuncio) REFERENCES Annuncio(id_annuncio) ON DELETE CASCADE
);

-- Creazione della tabella Commenti
CREATE TABLE Commenti (
    id_commenti INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(100),
    testo TEXT,
    id_utente INT,
    id_annuncio INT,
    FOREIGN KEY (id_utente) REFERENCES Utente(id) ON DELETE SET NULL,
    FOREIGN KEY (id_annuncio) REFERENCES Annuncio(id_annuncio) ON DELETE CASCADE
);
