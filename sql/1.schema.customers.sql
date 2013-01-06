--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS customer_statuses;
CREATE TABLE customer_statuses (
	customer_status_id TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
	customer_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	email VARCHAR(255),
	male ENUM('M', 'K') NOT NULL,
	birth_date DATE,
	birth_city VARCHAR(255),
	identity_card VARCHAR(10),
	pesel VARCHAR(15),
	nip VARCHAR(15),
	regon VARCHAR(14),
	phone_number VARCHAR(255),
	cell_phone_number VARCHAR(255),
	employee_id INT UNSIGNED NOT NULL,
	customer_status_id TINYINT UNSIGNED NOT NULL,
	recommending_person VARCHAR(255) NOT NULL,
	date_of_last_analysis DATE NOT NULL,
	number_of_last_analysis VARCHAR(255),
	create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0,
	customer_group_id SMALLINT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_customers_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_customers_customer_status_id` (customer_status_id)
		REFERENCES customer_statuses(customer_status_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_customers_customer_group_id` (customer_group_id)
		REFERENCES customer_groups(customer_group_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS customer_addresses;
CREATE TABLE customer_addresses (
	customer_address_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	customer_id INT UNSIGNED NOT NULL,	
	street VARCHAR(255),
	house_number VARCHAR(10),
	flat_number VARCHAR(10),	
	city VARCHAR(255),
	postcode CHAR(6),
	state_id TINYINT UNSIGNED NOT NULL,	
	address_type TINYINT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_customer_address_book_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_customer_address_book_state_id` (state_id)
		REFERENCES states(state_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT		
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS customer_documents;
CREATE TABLE customer_documents (
	customer_document_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	customer_id INT UNSIGNED NOT NULL,
	document_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_customer_documents_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_customer_documents_document_id` (document_id)
		REFERENCES documents(document_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS customer_groups;
CREATE TABLE customer_groups (
	customer_group_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS credit_types;
CREATE TABLE credit_types (
	credit_type_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS customer_credits;
CREATE TABLE customer_credits (
	customer_credit_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	customer_id INT UNSIGNED NOT NULL,
	credit_type_id SMALLINT UNSIGNED NOT NULL,
	bank VARCHAR(255) NOT NULL,
	margin NUMERIC(11,2) NOT NULL,
	rrso NUMERIC(11,2) NOT NULL,
	amount NUMERIC(11,2) NOT NULL,
	currency_id SMALLINT UNSIGNED NOT NULL,
	currency_rate NUMERIC(11,2),
	installment NUMERIC(11,2),
	conclusion_date_start DATE NOT NULL,
	period_in_months TINYINT UNSIGNED NOT NULL,
	balance NUMERIC(11,2),
	balance_date DATE,
	cost_of_repayment NUMERIC(11,2),
	CONSTRAINT FOREIGN KEY `fk_customer_credits_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_customer_credits_credit_type` (credit_type_id)
		REFERENCES credit_types (credit_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_customer_credits_currency_id` (currency_id)
		REFERENCES currency(currency_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

SET FOREIGN_KEY_CHECKS = 1;
