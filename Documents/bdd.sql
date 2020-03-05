CREATE TABLE Utilisateurs(
   id INT AUTO_INCREMENT,
   email VARCHAR(50) NOT NULL UNIQUE,
   email_verified_at DATETIME,
   password VARCHAR(255),
   matricule CHAR(6),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   dateNaissance DATE,
   adresse VARCHAR(50),
   adresse2 VARCHAR(50),
   CP CHAR(5),
   ville VARCHAR(50),
   dateEmbauche DATETIME,
   remember_token DATETIME,
   created_at DATETIME,
   updated_at VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE Regions(
   id INT AUTO_INCREMENT,
   nomRegion VARCHAR(50),
   budgetGlobalAnnuel DECIMAL(13,2),
   utilisateurs_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(utilisateurs_id) REFERENCES Utilisateurs(id)
);

CREATE TABLE VisiteurMedicaux(
   id INT AUTO_INCREMENT,
   objectif TEXT,
   prime DECIMAL(13,2),
   avantages TEXT,
   budget DECIMAL(13,2),
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES Utilisateurs(id)
);

CREATE TABLE Composants(
   id INT AUTO_INCREMENT,
   nomComposant VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE FamilleMedicament(
   id INT AUTO_INCREMENT,
   nomFamille VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE Specialites(
   id INT AUTO_INCREMENT,
   nomSpecialite VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE Visite(
   id INT AUTO_INCREMENT,
   dateMission DATE,
   motif TEXT,
   bilan TEXT,
   created_at DATETIME,
   updated_at DATETIME,
   visiteurMedicaux_id INT NOT NULL,
   utilisateurs_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(visiteurMedicaux_id) REFERENCES VisiteurMedicaux(id),
   FOREIGN KEY(utilisateurs_id) REFERENCES Utilisateurs(id)
);

CREATE TABLE Responsables(
   id INT AUTO_INCREMENT,
   budgetAnnuel DECIMAL(13,2),
   PRIMARY KEY(id),
   FOREIGN KEY(id) REFERENCES VisiteurMedicaux(id)
);

CREATE TABLE IF NOT EXISTS visiteurBudgetHisto(
   id INT AUTO_INCREMENT,
   budget DECIMAL(13,2) NOT NULL,
   created_at DATETIME,
   visiteurMedicaux_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(visiteurMedicaux_id) REFERENCES VisiteurMedicaux(id)
);

CREATE TABLE Medicaments(
   numeroProduit VARCHAR(10),
   nomCommercial VARCHAR(50),
   effets TEXT,
   contreIndications TEXT,
   prixEchantillon DECIMAL(13,2),
   created_at VARCHAR(50),
   updated_at VARCHAR(50),
   familleMedicament_id INT NOT NULL,
   PRIMARY KEY(numeroProduit),
   FOREIGN KEY(familleMedicament_id) REFERENCES FamilleMedicament(id)
);

CREATE TABLE ActivitesComplementaires(
   id INT AUTO_INCREMENT,
   numeroOrdre VARCHAR(50),
   themeActivite VARCHAR(50),
   compteRendu TEXT,
   dateHeureActivité DATETIME,
   created_at DATETIME,
   updated_at DATETIME,
   responsables_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(responsables_id) REFERENCES Responsables(id)
);

CREATE TABLE EstPasser(
   utilisateurs_id INT,
   regions_id INT,
   dateDebut_ DATE,
   dateFin DATE,
   PRIMARY KEY(utilisateurs_id, regions_id),
   FOREIGN KEY(utilisateurs_id) REFERENCES Utilisateurs(id),
   FOREIGN KEY(regions_id) REFERENCES Regions(id)
);

CREATE TABLE Melange(
   numeroProduit VARCHAR(10),
   numeroProduit_1 VARCHAR(10),
   interaction TEXT,
   PRIMARY KEY(numeroProduit, numeroProduit_1),
   FOREIGN KEY(numeroProduit) REFERENCES Medicaments(numeroProduit),
   FOREIGN KEY(numeroProduit_1) REFERENCES Medicaments(numeroProduit)
);

CREATE TABLE Contient(
   numeroProduit VARCHAR(10),
   composants_id INT,
   quantite DOUBLE,
   PRIMARY KEY(numeroProduit, composants_id),
   FOREIGN KEY(numeroProduit) REFERENCES Medicaments(numeroProduit),
   FOREIGN KEY(composants_id) REFERENCES Composants(id)
);

CREATE TABLE Specialise(
   utilisateurs_id INT,
   specialites_id INT,
   diplome VARCHAR(50),
   coefPrescription DOUBLE,
   PRIMARY KEY(utilisateurs_id, specialites_id),
   FOREIGN KEY(utilisateurs_id) REFERENCES Utilisateurs(id),
   FOREIGN KEY(specialites_id) REFERENCES Specialites(id)
);

CREATE TABLE EstPresente(
   numeroProduit VARCHAR(10),
   visite_id INT,
   offert SMALLINT,
   PRIMARY KEY(numeroProduit, visite_id),
   FOREIGN KEY(numeroProduit) REFERENCES Medicaments(numeroProduit),
   FOREIGN KEY(visite_id) REFERENCES Visite(id)
);

CREATE TABLE Convier(
   utilisateurs_id INT,
   activitesComplementaires_id INT,
   PRIMARY KEY(utilisateurs_id, activitesComplementaires_id),
   FOREIGN KEY(utilisateurs_id) REFERENCES Utilisateurs(id),
   FOREIGN KEY(activitesComplementaires_id) REFERENCES ActivitesComplementaires(id)
);

CREATE TABLE Participe(
   utilisateurs_id INT,
   activitesComplementaires_id INT,
   PRIMARY KEY(utilisateurs_id, activitesComplementaires_id),
   FOREIGN KEY(utilisateurs_id) REFERENCES Utilisateurs(id),
   FOREIGN KEY(activitesComplementaires_id) REFERENCES ActivitesComplementaires(id)
);
