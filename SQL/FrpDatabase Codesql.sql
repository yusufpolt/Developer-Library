IF OBJECT_ID('Race','U') is not null drop table Race;
Create Table Race(
	RaceId int primary key identity,
	RaceName varchar(50),
);

Insert Into Race(RaceName) 
Values('Human'),('Elves'),('Orc'),('Dwarf')

Select * From Race

Go

IF OBJECT_ID('Class','U') is not null drop table Class;
Create Table Class(
	ClassId int primary key identity,
	ClassName varchar(50)
);

Insert Into Class(ClassName) 
values('Warrior'),('Archer'),('Wizard'),('Alchemist')
Select * From Class

Go

IF OBJECT_ID('Enemy','U') is not null drop table Enemy;
Create Table Enemy(
	EnemyId int primary key identity,
	EnemyName varchar(50),
	EnemyRace int,
	EnemyClass int,
	Constraint PK_EnemyClass Foreign Key (EnemyClass) References Class(ClassId),
	Constraint PK_EnemyRace Foreign Key (EnemyRace) References Race(RaceId)
);

Go

IF OBJECT_ID('Npc','U') is not null drop table Npc;
Create Table Npc(
	NpcId int primary key identity,
	NpcName varchar(50),
	NpcRace int,
	NpcClass int,
	Constraint PK_NpcClass Foreign Key (NpcClass) References Class(ClassId),
	Constraint PK_NpcRace Foreign Key (NpcRace) References Race(RaceId)
);

Go

IF OBJECT_ID('Roles','U') is not null drop table Roles;
Create Table Roles
(
	RoleId Int Identity Primary Key,
	RoleName Varchar(50),
	RoleCreatedDate Datetime Default GETDATE()
);

Go

IF OBJECT_ID('UserInRoles','U') is not null drop table UserInRoles;
Create Table UserInRoles
(
	RoleId Int,
	UserId Int,
	Constraint PK_RoleId Primary Key(RoleId,UserId)
);

Go

IF OBJECT_ID('RolesForms','U') is not null drop table RolesForms;
Create Table RolesForms
(
	Id Int Identity Primary Key,
	RoleId Int,
	FormName Varchar(50)
);

Go

IF OBJECT_ID('UserChoose','U') is not null drop table UserChoose;
Create Table UserChoose(
	UserChooseId int primary key identity,
	UserChooseRace int,
	UserChooseClass int,
	Constraint PK_UserChooseClass Foreign Key (UserChooseClass) References Class(ClassId),
	Constraint PK_UserChooseRace Foreign Key (UserChooseRace) References Race(RaceId)
);
Alter Table UserChoose Add CUserId int
Go

IF OBJECT_ID('UserRegister','U') is not null drop table UserRegister;
Create Table UserRegister(
	UserId int primary key identity,
	UserName varchar(50) unique,
	UserPassword varchar(20),
	FirstName varchar(50),
	LastName varchar(50),
	Email varchar(100),
	UChoose int,
	Constraint PK_UsersChoose Foreign Key (UChoose) References UserChoose(UserChooseId)
);

Insert Into UserRegister (UserName,UserPassword,FirstName,LastName,Email) values ('admin','1','Yusuf','Polat','yusufpolat@admin.com')
Select * From UserRegister

Alter Table UserChoose
Add Constraint FK_UIdChoose
Foreign Key (CUserId) References UserRegister(UserId);

Go

IF OBJECT_ID('Contact','U') is not null drop table Contact;
Create Table Contact(
	ContactId int primary key identity,
	FirstName Varchar(50),
	LastName Varchar(50),
	MessageText Varchar(500),
	CreatedDate Datetime Default GETDATE(),
	CityId Int,
	CountyId Int,
	Constraint FK_City 
	Foreign Key(CityId) 
	References Cities(CityId),
	Constraint FK_County 
	Foreign Key(CountyId) 
	References Counties(CountyId),
);

Go

IF OBJECT_ID('GameStory','U') is not null drop table GameStory;
Create Table GameStory(
	StoryId int primary key identity,
	StoryName varchar(100),
	StoryTopic varchar(max)
);

