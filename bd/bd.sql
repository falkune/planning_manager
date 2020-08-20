#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: departements
#------------------------------------------------------------

CREATE TABLE departements(
        id_departement  Int  Auto_increment  NOT NULL ,
        nom_departement Varchar (50) NOT NULL
	,CONSTRAINT departements_PK PRIMARY KEY (id_departement)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: boutiques
#------------------------------------------------------------

CREATE TABLE boutiques(
        id_boutique    Int  Auto_increment  NOT NULL ,
        nom_boutique   Varchar (50) NOT NULL ,
        id_departement Int NOT NULL
	,CONSTRAINT boutiques_AK UNIQUE (nom_boutique)
	,CONSTRAINT boutiques_PK PRIMARY KEY (id_boutique)

	,CONSTRAINT boutiques_departements_FK FOREIGN KEY (id_departement) REFERENCES departements(id_departement) ON DELETE CASCADE
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: employes
#------------------------------------------------------------

CREATE TABLE employes(
        id_employe      Int  Auto_increment  NOT NULL ,
        nom_employe     Varchar (50) NOT NULL ,
        premom_employe  Varchar (100) NOT NULL ,
        adresse_employe Varchar (100) NOT NULL ,
        email_employe   Varchar (100) NOT NULL UNIQUE,
        tel_employe     Varchar (100) NOT NULL ,
        pswd            Varchar (50) DEFAULT "passer123",
        responsable     tinyint(1) DEFAULT '0' ,
        id_departement  Int NOT NULL
	,CONSTRAINT employes_PK PRIMARY KEY (id_employe)

	,CONSTRAINT employes_departements_FK FOREIGN KEY (id_departement) REFERENCES departements(id_departement) ON DELETE CASCADE
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Admins
#------------------------------------------------------------

CREATE TABLE Admins(
        id_admin Int  Auto_increment  NOT NULL ,
        login    Varchar (50) NOT NULL ,
        password Varchar (50) NOT NULL
	,CONSTRAINT Admins_PK PRIMARY KEY (id_admin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: plannings
#------------------------------------------------------------


CREATE TABLE plannings(
        id_planning    Int  Auto_increment  NOT NULL ,
        date_planning Date NOT NULL ,
        plage1         Varchar (50) DEFAULT "disponible",
        plage2         Varchar (50) DEFAULT "disponible",
        plage3         Varchar (50) DEFAULT "disponible",
        plage4         Varchar (50) DEFAULT "disponible",
        plage5         Varchar (50) DEFAULT "disponible",
        plage6         Varchar (50) DEFAULT "disponible",
        plage7         Varchar (50) DEFAULT "disponible",
        plage8         Varchar (50) DEFAULT "disponible",
        plage9         Varchar (50) DEFAULT "disponible",
        plage10        Varchar (50) DEFAULT "disponible",
        plage11        Varchar (50) DEFAULT "disponible",
        plage12        Varchar (50) DEFAULT "disponible",
        plage13        Varchar (50) DEFAULT "disponible",
        plage14        Varchar (50) DEFAULT "disponible",
        plage15        Varchar (50) DEFAULT "disponible",
        plage16        Varchar (50) DEFAULT "disponible",
        plage17        Varchar (50) DEFAULT "disponible",
        plage18        Varchar (50) DEFAULT "disponible",
        plage19        Varchar (50) DEFAULT "disponible",
        plage20        Varchar (50) DEFAULT "disponible",
        plage21        Varchar (50) DEFAULT "disponible",
        plage22        Varchar (50) DEFAULT "disponible",
        plage23        Varchar (50) DEFAULT "disponible",
        plage24        Varchar (50) DEFAULT "disponible",
        plage25        Varchar (50) DEFAULT "disponible",
        id_employe     Int NOT NULL ,
        shop           Int NOT NULL ,

	CONSTRAINT plannings_PK PRIMARY KEY (id_planning),

	CONSTRAINT plannings_employes_FK FOREIGN KEY (id_employe) REFERENCES employes(id_employe) ON DELETE CASCADE
)ENGINE=InnoDB;
