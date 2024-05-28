-- Creazione della tabella classe
CREATE TABLE classe (
    id_classe INT PRIMARY KEY AUTO_INCREMENT,
    classe VARCHAR(2),
    specialità VARCHAR(50)
);

INSERT INTO classe (classe, specialità) VALUES 
('1A', 'Elettronica e elettrotecnica'),
('2A', 'Elettronica e elettrotecnica'),
('3A', 'Informatica e telecomunicazione'),
('4A', 'Meccanica'),
('5A', 'Informatica e telecomunicazione'),
('1B', 'Meccanica'),
('2B', 'Elettronica e elettrotecnica'),
('3B', 'Informatica e telecomunicazione'),
('4B', 'Elettronica e elettrotecnica'),
('5B', 'Logistica'),
('1C', 'Informatica e telecomunicazione'),
('2C', 'Logistica'),
('3C', 'Elettronica e elettrotecnica'),
('4C', 'Informatica e telecomunicazione'),
('5C', 'Meccanica'),
('1D', 'Elettronica e elettrotecnica'),
('2D', 'Informatica e telecomunicazione'),
('3D', 'Meccanica'),
('4D', 'Elettronica e elettrotecnica'),
('5D', 'Informatica e telecomunicazione'),
('1E', 'Logistica'),
('2E', 'Elettronica e elettrotecnica'),
('3E', 'Informatica e telecomunicazione'),
('4E', 'Meccanica'),
('5E', 'Elettronica e elettrotecnica');

-- Creazione della tabella categoria
CREATE TABLE categoria (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(50),
    descrizione TEXT
);

INSERT INTO categoria (tipo, descrizione) VALUES
('telefonia', 'Prodotti relativi alla telefonia, come smartphone e accessori.'),
('videogiochi', 'Giochi per console o PC, inclusi titoli popolari e accessori.'),
('informatica', 'Hardware, software e accessori informatici per uso domestico o professionale.'),
('libri', 'Libri di vario genere, inclusi romanzi, saggi, e manuali.');

-- Creazione della tabella utente
CREATE TABLE utente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    eta INT,
    email VARCHAR(100),
    telefono VARCHAR(20),
    id_classe INT,
    FOREIGN KEY (id_classe) REFERENCES classe(id_classe)
);

-- Creazione della tabella annuncio
CREATE TABLE annuncio (
    id_annuncio INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    image VARCHAR(100),
    descrizione TEXT,
    stato_di_disponibilità VARCHAR(50),
    id_utente INT,
    id_categoria INT,
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utente) REFERENCES utente(id) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);

-- Creazione della tabella stato per le proposte
CREATE TABLE stato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

INSERT INTO stato (nome) VALUES ('In attesa'), ('Accettata'), ('Rifiutata');

-- Creazione della tabella proposta
CREATE TABLE proposta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_annuncio INT NOT NULL,
    id_utente INT NOT NULL,
    prezzo_proposto DECIMAL(10, 2) NOT NULL,
    data_proposta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_stato INT DEFAULT 1,
    descrizione TEXT,

    FOREIGN KEY (id_annuncio) REFERENCES annuncio(id_annuncio),
    FOREIGN KEY (id_utente) REFERENCES utente(id),
    FOREIGN KEY (id_stato) REFERENCES stato(id)
);

-- Creazione della tabella commenti
CREATE TABLE commenti (
    id_commenti INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(100),
    testo TEXT,
    id_utente INT,
    id_annuncio INT,
    FOREIGN KEY (id_utente) REFERENCES utente(id) ON DELETE SET NULL,
    FOREIGN KEY (id_annuncio) REFERENCES annuncio(id_annuncio) ON DELETE CASCADE
);
