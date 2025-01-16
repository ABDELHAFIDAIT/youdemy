CREATE DATABASE IF NOT EXISTS youdemy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE youdemy ;

CREATE TABLE roles (
	id_role INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE users (
	id_user INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(20) NOT NULL,
	nom VARCHAR(20) NOT NULL,
    photo VARCHAR(255) DEFAULT 'user.png',
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_inscription DATE DEFAULT CURRENT_DATE,
    statut ENUM('Actif','En Attente','Bloqué'),
    id_role INT NOT NULL,
    FOREIGN KEY (id_role) REFERENCES roles(id_role) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE categories (
	id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE courses (
	id_course INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    couverture VARCHAR(255) NOT NULL,
    contenu TEXT,
    video VARCHAR(255),
    niveau ENUM('Facile','Moyen','Difficile') NOT NULL,
    date_publication DATE DEFAULT CURRENT_DATE,
    statut_cours ENUM('Approuvé','En Attente','Refusé') DEFAULT 'En Attente',
    id_categorie INT NOT NULL,
    id_teacher INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_teacher) REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tags (
	id_tag INT AUTO_INCREMENT PRIMARY KEY,
    nom_tag VARCHAR(30) NOT NULL
);

CREATE TABLE courses_tags (
	id_tag INT NOT NULL,
    id_course INT NOT NULL,
    PRIMARY KEY(id_tag,id_course),
    UNIQUE(id_tag,id_course),
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_course) REFERENCES courses(id_course) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE enrollments (
    id_course INT NOT NULL,
    id_student INT NOT NULL,
	date_enrolement DATE DEFAULT CURRENT_DATE,
    avancement ENUM('En cours','Terminé') DEFAULT 'En cours',
    PRIMARY KEY(id_student,id_course),
    UNIQUE(id_student,id_course),
    FOREIGN KEY (id_course) REFERENCES courses(id_course) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_student) REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO roles(label)
VALUES ('Admin'),
       ('Etudiant'),
       ('Enseignant');

INSERT INTO users(prenom,nom,phone,email,password,statut,id_role)
VALUES ('Ahmed','Alami','0691766935','admin@youdemy.com','$2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG','Actif',1);

-- DROP DATABASE youdemy ;

-- Password Admin : Test123@

-- $2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG