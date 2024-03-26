FAIT AVEC WAMPSERVER <3

CREATE TABLE loginTable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(191) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('nomUtilisateur', 'hashedPasswordIci');
