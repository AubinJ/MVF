#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: MVF_User
#------------------------------------------------------------

CREATE TABLE MVF_User(
        Id_User Int  Auto_increment  NOT NULL ,
        Nom     Varchar (50) NOT NULL ,
        Prenom  Varchar (50) NOT NULL ,
        Adresse Varchar (80) NOT NULL ,
        Mdp     Varchar (255) NOT NULL ,
        Role    Bool NOT NULL ,
        RGPD    Date NOT NULL ,
        Email   Varchar (50) NOT NULL ,
        Tel     Int NOT NULL
	,CONSTRAINT MVF_User_AK UNIQUE (Email,Tel)
	,CONSTRAINT MVF_User_PK PRIMARY KEY (Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MVF_Place
#------------------------------------------------------------

CREATE TABLE MVF_Place(
        Id_Place     Int  Auto_increment  NOT NULL ,
        Nom_place    Varchar (255) NOT NULL ,
        Tarif_place  Float NOT NULL ,
        Date_place   Date NOT NULL ,
        Tarif_Reduit Bool NOT NULL
	,CONSTRAINT MVF_Place_PK PRIMARY KEY (Id_Place)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MVF_Nuit
#------------------------------------------------------------

CREATE TABLE MVF_Nuit(
        Id_nuit   Int  Auto_increment  NOT NULL ,
        Name_nuit Varchar (80) NOT NULL ,
        Prix_nuit Float NOT NULL
	,CONSTRAINT MVF_Nuit_PK PRIMARY KEY (Id_nuit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MVF_Reservation
#------------------------------------------------------------

CREATE TABLE MVF_Reservation(
        Id_reservation     Int  Auto_increment  NOT NULL ,
        Nombre_reservation Int NOT NULL ,
        Enfant_reservation Bool NOT NULL ,
        Luge_reservation   Int NOT NULL ,
        Casque_reservation Int NOT NULL ,
        Id_User            Int NOT NULL
	,CONSTRAINT MVF_Reservation_PK PRIMARY KEY (Id_reservation)

	,CONSTRAINT MVF_Reservation_MVF_User_FK FOREIGN KEY (Id_User) REFERENCES MVF_User(Id_User)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MVF_Avoir
#------------------------------------------------------------

CREATE TABLE MVF_Avoir(
        Id_nuit        Int NOT NULL ,
        Id_reservation Int NOT NULL ,
        Date           Date NOT NULL
	,CONSTRAINT MVF_Avoir_PK PRIMARY KEY (Id_nuit,Id_reservation)

	,CONSTRAINT MVF_Avoir_MVF_Nuit_FK FOREIGN KEY (Id_nuit) REFERENCES MVF_Nuit(Id_nuit)
	,CONSTRAINT MVF_Avoir_MVF_Reservation0_FK FOREIGN KEY (Id_reservation) REFERENCES MVF_Reservation(Id_reservation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MVF_Contenir
#------------------------------------------------------------

CREATE TABLE MVF_Contenir(
        Id_Place       Int NOT NULL ,
        Id_reservation Int NOT NULL
	,CONSTRAINT MVF_Contenir_PK PRIMARY KEY (Id_Place,Id_reservation)

	,CONSTRAINT MVF_Contenir_MVF_Place_FK FOREIGN KEY (Id_Place) REFERENCES MVF_Place(Id_Place)
	,CONSTRAINT MVF_Contenir_MVF_Reservation0_FK FOREIGN KEY (Id_reservation) REFERENCES MVF_Reservation(Id_reservation)
)ENGINE=InnoDB;

