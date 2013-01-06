--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS partners;
CREATE TABLE partners (
	partner_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	description TEXT,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0,
	contact_person_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_producer_contact_person_id` (contact_person_id)
		REFERENCES contact_persons(contact_person_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS products;
CREATE TABLE products (
	product_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	partner_id INT UNSIGNED NOT NULL,
	name VARCHAR(255) NOT NULL,
	description TEXT,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0,
	currency_id SMALLINT UNSIGNED NOT NULL,
	settlement_type_id TINYINT UNSIGNED NOT NULL,
	contact_person_id INT UNSIGNED NOT NULL,
	product_type_id TINYINT UNSIGNED NOT NULL,
	seller_percent NUMERIC(11,2) NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_products_partner_id` (partner_id)
		REFERENCES partners(partner_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_products_currency_id` (currency_id)
		REFERENCES currency(currency_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_products_settlement_type_id` (settlement_type_id)
		REFERENCES settlement_types(settlement_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_products_contact_person_id` (contact_person_id)
		REFERENCES contact_persons(contact_person_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_products_product_type_id` (product_type_id)
		REFERENCES product_types(product_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS product_types;
CREATE TABLE product_types (
	product_type_id TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS product_settlement_percents;
CREATE TABLE product_settlement_percents (
	product_settlement_percent_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	product_id INT UNSIGNED NOT NULL,
	employee_position_id SMALLINT UNSIGNED NOT NULL,
	`value` NUMERIC(11,2) NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_product_settlement_percents_product_id` (product_id)
		REFERENCES products(product_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_product_settlement_percents_employee_position_id` (employee_position_id)
		REFERENCES employee_positions(employee_position_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS contact_persons;
CREATE TABLE contact_persons (
	contact_person_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	street VARCHAR(255),
	city VARCHAR(255),
	postcode CHAR(6),
	state_id TINYINT UNSIGNED NOT NULL,
	phone_number VARCHAR(15),
	email VARCHAR(255),
	position VARCHAR(255),
	active CHAR(1) NOT NULL DEFAULT 1,
	CONSTRAINT FOREIGN KEY `fk_contact_persons_state_id` (state_id)
		REFERENCES states(state_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS renouncements;
CREATE TABLE renouncements (
	renouncement_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	customer_id INT UNSIGNED NOT NULL,
	policy_number VARCHAR(255) NOT NULL,
	policy_create_date DATE NOT NULL,
	document_send_date DATE,
	CONSTRAINT FOREIGN KEY `fk_renouncemenets_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

SET FOREIGN_KEY_CHECKS = 1;
