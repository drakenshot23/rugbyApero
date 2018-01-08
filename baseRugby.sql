#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur 
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        numUtilisateur int (11) Auto_increment  NOT NULL ,
        typeGestionnaire   ENUM('parent', 'parenUtilisateur', 'presidentApero'),
        nom            Varchar (25) ,
        prenom         Varchar (25) ,
        mail           Varchar (50) ,
        mdp            Varchar (25) ,
        ville          Varchar (30) ,
        adresse        Varchar (75) ,
        CP             Int ,
        PRIMARY KEY (numUtilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Enfant
#------------------------------------------------------------

CREATE TABLE Enfant(
        numEnfant        int (11) Auto_increment  NOT NULL ,
        nom              Varchar (25) ,
        prenom           Varchar (25) ,
        age              Int ,
        telParent        Int ,
        mailParent       Varchar (40) ,
        libelleCategorie Varchar (30) ,
        numUtilisateur   Int ,
        PRIMARY KEY (numEnfant )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Stock
#------------------------------------------------------------

CREATE TABLE Stock(
        numStock   int (11) Auto_increment  NOT NULL ,
        qteProduit Int ,
        numProduit Int ,
        PRIMARY KEY (numStock )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: produit
#------------------------------------------------------------

CREATE TABLE produit(
        numProduit   int (11) Auto_increment  NOT NULL ,
        nomProduit   Varchar (25) ,
        prix         DECIMAL (15,3)  ,
        qteProduit   Float ,
        seuilRupture Int ,
        numCourse    Int ,
        PRIMARY KEY (numProduit )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Compte
#------------------------------------------------------------

CREATE TABLE Compte(
        numCompte      int (11) Auto_increment  NOT NULL ,
        dateCompte     Date ,
        montant        DECIMAL (15,3)  ,
        numUtilisateur Int ,
        numEnfant      Int ,
        PRIMARY KEY (numCompte )
)ENGINE=InnoDB;



#------------------------------------------------------------
# Table: Course
#------------------------------------------------------------

CREATE TABLE Course(
        numCourse      int (11) Auto_increment  NOT NULL ,
        montantCourse  DECIMAL (15,3)  ,
        dateCourse     Date ,
        numUtilisateur Int ,
        PRIMARY KEY (numCourse )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Composition
#------------------------------------------------------------

CREATE TABLE Composition(
        idComposition int (11) Auto_increment  NOT NULL ,
        numCompte     Int ,
        numProduit    Int ,
        PRIMARY KEY (idComposition )
)ENGINE=InnoDB;

ALTER TABLE Enfant ADD CONSTRAINT FK_Enfant_numUtilisateur FOREIGN KEY (numUtilisateur) REFERENCES Utilisateur(numUtilisateur);
ALTER TABLE Stock ADD CONSTRAINT FK_Stock_numProduit FOREIGN KEY (numProduit) REFERENCES produit(numProduit);
ALTER TABLE produit ADD CONSTRAINT FK_produit_numCourse FOREIGN KEY (numCourse) REFERENCES Course(numCourse);
ALTER TABLE Compte ADD CONSTRAINT FK_Compte_numUtilisateur FOREIGN KEY (numUtilisateur) REFERENCES Utilisateur(numUtilisateur);
ALTER TABLE Compte ADD CONSTRAINT FK_Compte_numEnfant FOREIGN KEY (numEnfant) REFERENCES Enfant(numEnfant);
ALTER TABLE Course ADD CONSTRAINT FK_Course_numUtilisateur FOREIGN KEY (numUtilisateur) REFERENCES Utilisateur(numUtilisateur);
ALTER TABLE Composition ADD CONSTRAINT FK_Composition_numCompte FOREIGN KEY (numCompte) REFERENCES Compte(numCompte);
ALTER TABLE Composition ADD CONSTRAINT FK_Composition_numProduit FOREIGN KEY (numProduit) REFERENCES produit(numProduit);
