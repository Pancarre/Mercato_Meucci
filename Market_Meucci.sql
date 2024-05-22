-- Creazione della tabella Località
CREATE TABLE `Località` (
    CAP VARCHAR(10) PRIMARY KEY,
    citta VARCHAR(100),
    indirizzo VARCHAR(100)
);

INSERT INTO Località (CAP, citta, indirizzo) VALUES 
('50121', 'Firenze', 'Via Roma, 1'),
('50122', 'Firenze', 'Via Tornabuoni, 2'),
('50123', 'Firenze', 'Piazza Duomo, 3'),
('50124', 'Firenze', 'Lungarno Vespucci, 4'),
('50125', 'Firenze', 'Piazza della Signoria, 5'),
('56121', 'Pisa', 'Via Santa Maria, 6'),
('56122', 'Pisa', 'Lungarno Pacinotti, 7'),
('57121', 'Livorno', 'Via Grande, 8'),
('57122', 'Livorno', 'Piazza della Repubblica, 9'),
('58100', 'Grosseto', 'Corso Carducci, 10'),
('59100', 'Prato', 'Via Mazzini, 11'),
('51100', 'Pistoia', 'Via della Madonna, 12'),
('52100', 'Arezzo', 'Corso Italia, 13'),
('53036', 'Poggibonsi', 'Via della Repubblica, 14'),
('52025', 'Montevarchi', 'Via Roma, 15'),
('54033', 'Carrara', 'Via Carriona, 16'),
('55049', 'Viareggio', 'Passeggiata Marconi, 17'),
('55100', 'Lucca', 'Via Fillungo, 18'),
('53043', 'Chiusi', 'Piazza Duomo, 19'),
('53045', 'Montepulciano', 'Via di Voltaia, 20'),
('53047', 'Sarteano', 'Via del Teatro, 21'),
('53048', 'Sinalunga', 'Via Trento, 22'),
('53041', 'Asciano', 'Via Roma, 23'),
('53042', 'Chianciano Terme', 'Viale della Libertà, 24'),
('53040', 'Rapolano Terme', 'Via Terme San Giovanni, 25');

-- Creazione della tabella Classe
CREATE TABLE Classe (
    id_classe INT PRIMARY KEY AUTO_INCREMENT,
    classe VARCHAR(2),
    specialità VARCHAR(20)
);

INSERT INTO Classe (sezione, classe, specialità) VALUES 
('A', '1', 'Elettronica e elettrotecnica'),
('A', '2', 'Elettronica e elettrotecnica'),
('A', '3', 'Informatica e telecomunicazione'),
('A', '4', 'Meccanica e Logistica'),
('A', '5', 'Informatica e telecomunicazione'),
('B', '1', 'Meccanica e Logistica'),
('B', '2', 'Elettronica e elettrotecnica'),
('B', '3', 'Informatica e telecomunicazione'),
('B', '4', 'Elettronica e elettrotecnica'),
('B', '5', 'Meccanica e Logistica'),
('C', '1', 'Informatica e telecomunicazione'),
('C', '2', 'Meccanica e Logistica'),
('C', '3', 'Elettronica e elettrotecnica'),
('C', '4', 'Informatica e telecomunicazione'),
('C', '5', 'Meccanica e Logistica'),
('D', '1', 'Elettronica e elettrotecnica'),
('D', '2', 'Informatica e telecomunicazione'),
('D', '3', 'Meccanica e Logistica'),
('D', '4', 'Elettronica e elettrotecnica'),
('D', '5', 'Informatica e telecomunicazione'),
('E', '1', 'Meccanica e Logistica'),
('E', '2', 'Elettronica e elettrotecnica'),
('E', '3', 'Informatica e telecomunicazione'),
('E', '4', 'Meccanica e Logistica'),
('E', '5', 'Elettronica e elettrotecnica');

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
