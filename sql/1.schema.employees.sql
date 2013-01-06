--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS agreement_types;
CREATE TABLE agreement_types (
	agreement_type_id TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL UNIQUE,
	tax CHAR(1) NOT NULL DEFAULT 0,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
	employee_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(50) UNIQUE,
	password CHAR(40),
	salt CHAR(32),
	email VARCHAR(255) NOT NULL UNIQUE,	
	last_login DATETIME DEFAULT '0000-00-00 00:00:00',
	firstname VARCHAR(50) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	description TEXT,
	phone_number VARCHAR(255),
	cell_phone_number VARCHAR(255),
	parent_employee_id INT UNSIGNED,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0,
	agreement_type_id TINYINT UNSIGNED,
	agreement_number VARCHAR(255),
	agreement_start_date DATE,
	agreement_end_date DATE,
	company_name VARCHAR(255),
	student_card_expiration_date DATE,
	birth_date DATE,
	birth_city VARCHAR(255),
	mother_name VARCHAR(255),
	father_name VARCHAR(255),
	identity_card VARCHAR(10),
	pesel VARCHAR(15),
	nip CHAR(10),
	regon VARCHAR(14),
	employee_position_id SMALLINT UNSIGNED NOT NULL,
	bank_name VARCHAR(255),
	bank_account VARCHAR(26),
	create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	recommending_person VARCHAR(255),
	employee_group_id SMALLINT UNSIGNED,
	CONSTRAINT FOREIGN KEY `fk_employees_parent_employee_id` (parent_employee_id) 
		REFERENCES employees (employee_id) 
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_employees_agreement_type_id` (agreement_type_id)
		REFERENCES agreement_types(agreement_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_employees_employee_position_id` (employee_position_id)
		REFERENCES employee_positions(employee_position_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_employees_employee_group_id` (employee_group_id)
		REFERENCES employee_groups(employee_group_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Engine=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS recruits;
CREATE TABLE recruits (
	recruit_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL UNIQUE,	
	firstname VARCHAR(50) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	description TEXT,
	parent_employee_id INT UNSIGNED,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0,
	employee_position_id SMALLINT UNSIGNED NOT NULL,
	create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	recommending_person VARCHAR(255),
	CONSTRAINT FOREIGN KEY `fk_employees_parent_employee_id` (parent_employee_id) 
		REFERENCES employees (employee_id) 
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_employees_employee_position_id` (employee_position_id)
		REFERENCES employee_positions(employee_position_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS recruit_documents;
CREATE TABLE recruit_documents (
	recruit_document_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	recruit_id INT UNSIGNED NOT NULL,
	document_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_recruit_documents_recruit_id` (recruit_id)
		REFERENCES recruits(recruit_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_recruit_documents_document_id` (document_id)
		REFERENCES documents(document_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employee_positions;
CREATE TABLE employee_positions (
	employee_position_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1,
	potencial CHAR(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employee_addresses;
CREATE TABLE employee_addresses (
	employee_address_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	employee_id INT UNSIGNED NOT NULL,	
	street VARCHAR(255),
	city VARCHAR(255),
	postcode CHAR(6),	
	state_id TINYINT UNSIGNED NOT NULL,
	phone_number VARCHAR(15),
	house_number VARCHAR(10),
	flat_number VARCHAR(10),	
	address_type TINYINT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_employee_address_book_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_employee_address_book_state_id` (state_id)
		REFERENCES states(state_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT	
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employee_privileges;
CREATE TABLE employee_privileges (
	employee_privilege_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	employee_id INT UNSIGNED NOT NULL,
	module TINYINT UNSIGNED NOT NULL,
	`access` TINYINT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_employee_privileges` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employee_documents;
CREATE TABLE employee_documents (
	employee_document_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	employee_id INT UNSIGNED NOT NULL,
	document_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_employee_documents_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_employee_documents_document_id` (document_id)
		REFERENCES documents(document_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employee_groups;
CREATE TABLE employee_groups (
	employee_group_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS trainings;
CREATE TABLE trainings (
	training_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	description TEXT,
	active CHAR(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS employee_trainings;
CREATE TABLE employee_trainings (
	employee_training_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	employee_id INT UNSIGNED NOT NULL,
	training_id INT UNSIGNED NOT NULL,
	create_date DATE NOT NULL,
	mark NUMERIC(5,2) NOT NULL,
	examiner_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_employee_trainnings_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_employee_trainings_training_id` (training_id)
		REFERENCES trainings(training_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_employee_trainnings_examiner_id` (examiner_id)
		REFERENCES employees(employee_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

SET FOREIGN_KEY_CHECKS = 1;
