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
    userId INT REFERENCES USERS (id),
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

/*USE SITE_WEB;

INSERT INTO ROLE (name)
VALUES ('standard'),
       ('modo'),
       ('admin');

USE SITE_WEB;

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
       ('Cloud Computing', 'Gestion et déploiement de services cloud');*/