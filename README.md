# Projet Tiny House
Le site web dédié au projet Tiny House est conçu pour mettre en relation les adhérents, bénévoles et acteurs.
## Table des matières
- [Architecture](#architecture)
- [Dépendances](#dépendances)
- [Installation](#installation)
## Architecture
Le site web est construit en Html/Css et quelques scripts JavaScript pour le frontend, et Php/MySQL pour le backend.
## Dépendances

Pour lancer l'application, il est nécéssaire d'avoir un serveur web local qui supporte PHP, et une base de données MySQL.

Le plus simple est d'utiliser WAMP sur Windows ou MAMP sur MacOS, qui permet de configurer automatiquement tout ce dont l'application a besoin. Paramètrez juste le fichier root d'Apache à `./public`.

La plateforme sera disponnible à l'adresse http://localhost:8080 et pgAdmin à http://localhost:8081
## Installation

Ajouter PHP au chemin:
Pour MacOS (pour les terminaux qui utlise zsh, remplacer `~/.bashrc` par `~/.zshrc`) :
```ZSH
nano ~/.bashrc
export PATH=/Applications/MAMP/bin/php/php8.2.0/bin:$PATH
```
### Créer un fichier de connexion à la base de données
Il est nécéssaire de créer un fichier pour se connecter à la base de données MySQL. Il devra être dans le projet au chemin `./config/database.php`.
```PHP
<?php
class Database {
    private $host = "localhost";
    private $db_name = "<nom de votre schéma (base de données)>";
    private $username = "<nom de l'utilisateur MySQL (défault: root)>";
    private $password = "<mot de passe MySQL>";
    public $conn;

    public function dbConnect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}

```
### Initialiser la base de données
Créer la base données avec toutes les tables nécéssaires (un fichier `db.sql`est disponnible dans la racine du projet avec toutes les requêtes):
```SQL
CREATE TABLE USERS
(
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    registrationDate DATE NOT NULL,
    roleId INT REFERENCES ROLE (id)
);

CREATE TABLE POST
(
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    postDate DATE NOT NULL,
    userId INT REFERENCES USERS (id)
);

CREATE TABLE COMMENT
(
    id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    commentDate DATE NOT NULL,
    postId INT REFERENCES POST (id),
    userId INT REFERENCES USERS (id)
);

CREATE TABLE LIKES
(
    id SERIAL PRIMARY KEY,
    postId INT REFERENCES POST (id),
    userId INT REFERENCES USERS (id)
);

CREATE TABLE PARTICIPATION
(
    id SERIAL PRIMARY KEY,
    postId INT REFERENCES POST (id),
    userId INT REFERENCES USERS (id)
);

CREATE TABLE PROFILE
(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    contactInfo TEXT,
    description TEXT,
    showInDirectory BOOLEAN NOT NULL DEFAULT FALSE,
    userId INT REFERENCES USERS (id)
);

CREATE TABLE SKILL
(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE PROFILE_SKILL
(
    profileId INT REFERENCES PROFILE (id),
    skillId INT REFERENCES SKILL (id),
    PRIMARY KEY (profileId, skillId)
);

CREATE TABLE ROLE
(
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
```
### Rajouter des valeurs d'exemples pour les compétences
Les compétences devront être définies directement dans la base de données pour que les utilisateurs choisissent dans un profil.
```SQL
INSERT INTO SKILL (name, description)
VALUES ('Programmation', 'Compétences en programmation logicielle'),
       ('Design Web', 'Création et design de sites Web'),
       ('Analyse de données', 'Compétences en analyse et interprétation de données'),
       ('Gestion de projet', 'Compétences en gestion de projets et organisation'),
       ('Réseaux sociaux', 'Gestion et optimisation de présence sur les réseaux sociaux'),
       ('Marketing digital', 'Compétences en marketing digital et en ligne'),
       ('Intelligence artificielle', 'Connaissance en IA et apprentissage automatique'),
       ('Cybersécurité', 'Compétences en sécurité informatique et protection des données'),
       ('Développement mobile', 'Développement dapplications pour smartphones'),
       ('Cloud Computing', 'Gestion et déploiement de services cloud');
```
### Rajouter les 3 rôles de l'application
Les 3 rôles `standard`,`modo`et `admin` doivent être définis directement dans la base de données. Un admin (`ID 3`) ne peut être défini que dans la base de données dans la table `USERS` à la colonne `roleId` qui est la clé étrangère de la table `ROLE`.
```SQL
INSERT INTO ROLE (name)
VALUES ('standard'),
       ('modo'),
       ('admin');
```