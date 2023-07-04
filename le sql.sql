create database odk;
use odk;
create table apprenant(
  matricule VARCHAR(6),
  nom VARCHAR(100),
  prenom VARCHAR(100),
  age INT,
  dateNaissance DATE,
  email VARCHAR(100),
  telephone VARCHAR(20),
  photo BLOB,
  promotion varchar(10),
  anneeCertification INT,
);