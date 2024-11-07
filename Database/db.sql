-- Table UNIT
CREATE TABLE unit (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cost INT NOT NULL,
    url_img VARCHAR(255) NOT NULL
);

-- Table ORIGIN
CREATE TABLE origin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url_img VARCHAR(255) NOT NULL
);

-- Table de liaison UNITORIGIN
CREATE TABLE unitorigin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_unit VARCHAR(255) NOT NULL,
    id_origin INT NOT NULL,
    FOREIGN KEY (id_unit) REFERENCES unit(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_origin) REFERENCES origin(id) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO unit (id, name, cost, url_img) VALUES
('64b1a7e789f1d', 'Ahri', 2, 'https://rerollcdn.com/characters/Skin/12/Ahri.png'),
('64b1a7e78a01f', 'Akali', 2, 'https://rerollcdn.com/characters/Skin/12/Akali.png'),
('64b1a7e78a12c', 'Ashe', 1, 'https://rerollcdn.com/characters/Skin/12/Ashe.png'),
('64b1a7e78a23d', 'Bard', 3, 'https://rerollcdn.com/characters/Skin/12/Bard.png'),
('64b1a7e78a34a', 'Blitzcrank', 5, 'https://rerollcdn.com/characters/Skin/12/Blitzcrank.png');

INSERT INTO origin (name, url_img) VALUES
('Scholar', 'https://example.com/origin/scholar.png'),
('Warrior', 'https://example.com/origin/warrior.png'),
('Eldritch', 'https://example.com/origin/eldritch.png'),
('Shapeshifter', 'https://example.com/origin/shapeshifter.png'),
('Ravenous', 'https://example.com/origin/ravenous.png');

INSERT INTO unitorigin (id_unit, id_origin) VALUES
-- Associations pour Ahri
('64b1a7e789f1d', 1), -- Scholar
-- Associations pour Akali
('64b1a7e78a01f', 2), -- Warrior
-- Associations pour Ashe
('64b1a7e78a12c', 3), -- Eldritch
-- Associations pour Bard
('64b1a7e78a23d', 1), -- Scholar
('64b1a7e78a23d', 4), -- Shapeshifter
-- Associations pour Blitzcrank
('64b1a7e78a34a', 4), -- Shapeshifter
('64b1a7e78a34a', 5); -- Ravenous

