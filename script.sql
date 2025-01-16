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


INSERT INTO users (prenom, nom, phone, email, password, statut, id_role)
VALUES
('Sara', 'Benali', '0612345678', 'sara@youdemy.com', '$2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG', 'Actif', 2),
('Yassine', 'Ouahbi', '0611223344', 'yassine@youdemy.com', '$2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG', 'Actif', 2),
('Khalid', 'Zahraoui', '0698765432', 'khalid@youdemy.com', '$2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG', 'Actif', 3),
('Rim', 'Saidi', '0687654321', 'rim@youdemy.com', '$2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG', 'Actif', 3);


INSERT INTO categories (nom_categorie, description)
VALUES
('Développement Web', 'Cours sur les technologies web comme HTML, CSS, JavaScript.'),
('Développement Mobile', 'Cours sur les applications mobiles Android et iOS.'),
('Design UX/UI', 'Cours sur le design interactif et ergonomique.'),
('Base de Données', 'Cours sur la gestion et manipulation des bases de données.'),
('IA et Machine Learning', 'Cours sur les algorithmes d’intelligence artificielle.'),
('Langues', 'Cours pour apprendre de nouvelles langues.'),
('Bureautique', 'Cours sur l’utilisation des outils de bureautique.'),
('Sécurité Informatique', 'Cours sur les techniques de sécurisation des systèmes.');


INSERT INTO courses (titre, description, couverture, contenu, video, niveau, statut_cours, id_categorie, id_teacher)
VALUES
('HTML pour les débutants', 'Apprenez les bases de HTML.', 'course.png', 'Contenu détaillé du cours.', NULL, 'Facile', 'Approuvé', 1, 4),
('CSS Avancé', 'Approfondissez vos connaissances en CSS.', 'course.png', 'Contenu détaillé du cours.', NULL, 'Moyen', 'Approuvé', 1, 3),
('JavaScript Intermédiaire', 'Maîtrisez les concepts essentiels de JS.', 'course.png', NULL, 'video1.mp4', 'Moyen', 'Approuvé', 1, 4),
('Développement Mobile avec Flutter', 'Créez des apps cross-platform.', 'course.png', NULL, 'video2.mp4', 'Difficile', 'Approuvé', 2, 3),
('Bases de données MySQL', 'Comprendre les concepts des bases.', 'course.png', 'Contenu détaillé du cours.', NULL, 'Facile', 'Approuvé', 4, 4),
('Sécurité Réseaux', 'Sécurisez vos systèmes et vos réseaux.', 'course.png', NULL, 'video3.mp4', 'Difficile', 'En Attente', 8, 3),
('Python pour Machine Learning', 'Algorithmes et librairies.', 'course.png', NULL, 'video4.mp4', 'Difficile', 'Approuvé', 5, 4),
('Initiation à la bureautique', 'Maîtrisez Word et Excel.', 'course.png', 'Contenu détaillé du cours.', NULL, 'Facile', 'Approuvé', 7, 3),
('Langue Française', 'Cours pour perfectionner le français.', 'course.png', NULL, 'video5.mp4', 'Facile', 'Approuvé', 6, 4),
('UI Design', 'Créer des interfaces intuitives.', 'course.png', 'Contenu détaillé du cours.', NULL, 'Moyen', 'Approuvé', 3, 3);


INSERT INTO tags (nom_tag)
VALUES
('HTML'), ('CSS'), ('JavaScript'), ('MySQL'), ('Flutter'),
('Sécurité'), ('Python'), ('Machine Learning'), ('Excel'), ('Word'),
('Android'), ('iOS'), ('Design'), ('French'), ('UI/UX'),
('Algorithme'), ('SQL'), ('Web Development'), ('Database'), ('Bureautique');


INSERT INTO courses_tags (id_course, id_tag)
VALUES
(1, 1), (1, 19),
(2, 2), (2, 19),
(3, 3), (3, 19),
(4, 5), (4, 11),
(5, 4), (5, 17),
(6, 6), (6, 7),
(7, 7), (7, 8),
(8, 9), (8, 10),
(9, 14), (9, 18),
(10, 3), (10, 15);


INSERT INTO enrollments (id_course, id_student, avancement)
VALUES
(1, 2, 'En cours'), 
(2, 2, 'Terminé'),
(3, 2, 'En cours'),
(4, 3, 'En cours'),
(5, 3, 'Terminé'),
(6, 3, 'En cours');


UPDATE courses
SET contenu = 'HTML est un langage de balisage utilisé pour structurer le contenu des pages web. Ce cours pour débutants vous apprendra à utiliser les balises de base comme <p>, <h1> à <h6>, <div>, et bien plus encore. Vous découvrirez également les attributs et comment intégrer des liens, des images et des vidéos dans vos pages. Avec des exercices pratiques, vous serez capable de créer des pages web complètes en un rien de temps.'
WHERE id_course = 1;

UPDATE courses
SET contenu = 'Ce cours sur CSS avancé vous permettra de maîtriser les concepts comme le positionnement, les transitions, les animations et les media queries. Vous apprendrez à créer des designs responsives adaptés à toutes les tailles d’écran, et à utiliser des techniques modernes comme Flexbox et CSS Grid. Ce cours inclut des projets pratiques pour mettre vos compétences en application dans des situations réelles.'
WHERE id_course = 2;

UPDATE courses
SET contenu = 'JavaScript est un langage essentiel pour rendre les pages web interactives. Dans ce cours intermédiaire, nous explorons les concepts de base et avancés comme les fonctions, les objets, les événements et les promesses. Vous apprendrez également à manipuler le DOM et à créer des applications dynamiques grâce aux APIs. Ce cours est parfait pour ceux qui connaissent déjà les bases et souhaitent aller plus loin.'
WHERE id_course = 3;

UPDATE courses
SET contenu = 'Flutter est un framework puissant pour créer des applications mobiles multiplateformes. Ce cours vous guide à travers les bases de Flutter, les widgets, la navigation et l’intégration d’APIs. Vous apprendrez également à concevoir des interfaces utilisateur attrayantes et performantes pour Android et iOS. Des projets concrets vous permettront de mettre en pratique vos connaissances et de créer des applications impressionnantes.'
WHERE id_course = 4;

UPDATE courses
SET contenu = 'MySQL est un système de gestion de base de données relationnelle largement utilisé. Ce cours vous enseigne à créer, lire, mettre à jour et supprimer des données dans une base de données. Vous découvrirez également les relations entre les tables, les jointures, les sous-requêtes et l’optimisation des requêtes. Ce cours pratique est idéal pour les développeurs et administrateurs de bases de données.'
WHERE id_course = 5;

UPDATE courses
SET contenu = 'Dans ce cours sur la sécurité des réseaux, vous apprendrez à protéger vos données et vos systèmes contre les cybermenaces. Les sujets incluent le chiffrement, les pare-feu, la détection des intrusions et la gestion des vulnérabilités. Vous explorerez également les meilleures pratiques pour sécuriser les infrastructures et les applications réseau. Ce cours est indispensable pour les professionnels en cybersécurité.'
WHERE id_course = 6;

UPDATE courses
SET contenu = 'Python est un langage polyvalent et incontournable pour le Machine Learning. Ce cours couvre les bases de Python, les bibliothèques comme NumPy, Pandas, et Scikit-Learn, ainsi que les algorithmes de machine learning supervisé et non supervisé. Vous mettrez en pratique vos compétences en travaillant sur des projets réels comme la classification, la régression et l’analyse de données complexes.'
WHERE id_course = 7;

UPDATE courses
SET contenu = 'Apprenez les bases de la bureautique avec ce cours sur Microsoft Word et Excel. Vous découvrirez comment créer et formater des documents professionnels, utiliser des modèles, des graphiques et des tableaux. Sur Excel, vous apprendrez à manipuler des données, créer des formules et automatiser des tâches avec des macros. Ce cours est idéal pour améliorer votre productivité au travail ou dans vos études.'
WHERE id_course = 8;

UPDATE courses
SET contenu = 'Ce cours de langue française vous permettra de perfectionner votre niveau en grammaire, vocabulaire et expression orale. Avec des exercices interactifs et des situations de la vie quotidienne, vous apprendrez à écrire des textes cohérents, à améliorer votre prononciation et à enrichir votre vocabulaire. Ce cours est adapté à tous ceux qui souhaitent maîtriser la langue française.'
WHERE id_course = 9;

UPDATE courses
SET contenu = 'Dans ce cours de UI Design, vous apprendrez à concevoir des interfaces utilisateur intuitives et attrayantes. Les sujets abordés incluent les principes de design, la hiérarchie visuelle, la théorie des couleurs et la typographie. Vous travaillerez sur des projets pratiques pour créer des wireframes, des prototypes interactifs et des designs responsifs adaptés aux différentes tailles d’écran.'
WHERE id_course = 10;



-- DROP DATABASE youdemy ;

-- Password Admin : Test123@

-- $2y$10$JO0u6o/YPazqktVyHUdvXOMGkLZCleV7ukpI55tRvM7IjmMpvL2zG