//Procédure stockée : Génération matricule & insertion dateEmbauche

DELIMITER |
CREATE PROCEDURE generer_matricule(IN id INT, IN dateEmbauche DATETIME)
BEGIN
    
    SELECT @varNom := nom FROM utilisateurs WHERE utilisateurs.id = id;
    SELECT @varPrenom := prenom FROM utilisateurs WHERE utilisateurs.id = id;
    SELECT @varDate := dateNaissance FROM utilisateurs WHERE utilisateurs.id = id;
    
    UPDATE utilisateurs
    SET utilisateurs.matricule = Upper(CONCAT(LEFT(@varNom, 2), LEFT(@varPrenom,2), CONCAT(RIGHT(YEAR(@varDate), 2))) )
    WHERE utilisateurs.id = id;

END |

//Trigger : Mettre prenom 1ere lettre Majuscule et nom complet Majuscule

CREATE TRIGGER setUpperCase BEFORE INSERT ON utilisateurs
FOR EACH ROW 
SET 
NEW.prenom = CONCAT(UPPER(LEFT(NEW.prenom, 1)), SUBSTRING(NEW.prenom, 2)), 
NEW.nom = UPPER(NEW.prenom)

//Vue : Liste des employées et de leur régions passée