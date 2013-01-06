--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS institutions;
CREATE TABLE institutions (
	institution_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS institution_products;
CREATE TABLE institution_products (
	institution_product_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	institution_id INT UNSIGNED NOT NULL,
	name VARCHAR(255) NOT NULL,
	active CHAR(1) NOT NULL DEFAULT 1,
	deleted CHAR(1) NOT NULL DEFAULT 0,
	CONSTRAINT FOREIGN KEY `fk_institution_products_institution_id` (institution_id)
		REFERENCES institutions(institution_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS instructions;
CREATE TABLE instructions (
	instruction_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS customer_old_products;
CREATE TABLE customer_old_products (
	customer_old_product_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	customer_id INT UNSIGNED NOT NULL,
	institution_id INT UNSIGNED NOT NULL,
	institution_product_id INT UNSIGNED NOT NULL,
	instruction_id INT UNSIGNED NOT NULL,
	insurance_sum NUMERIC(11,2),
	insurance_sum_nnw NUMERIC(11,2),
	insurance_sum_nkw NUMERIC(11,2),
	conclusion_date_start DATE NOT NULL,
	conclusion_date_end DATE,
	fee NUMERIC(11,2),
	premium_type_id TINYINT UNSIGNED,
	contribution NUMERIC(11,2) NOT NULL,
	amount NUMERIC(11,2),
	create_date DATE,
	description TEXT,
	policy_number VARCHAR(255),
	CONSTRAINT FOREIGN KEY `fk_customer_old_products_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
 	CONSTRAINT FOREIGN KEY `fk_customer_old_products_institution_id` (institution_id)
		REFERENCES institutions(institution_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_customer_old_products_institution_product_id` (institution_product_id)
		REFERENCES institution_products(institution_product_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_customer_old_products_instruction_id` (instruction_id)
		REFERENCES instructions(instruction_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_customer_odl_products_premium_type_id` (premium_type_id)
		REFERENCES premium_types(premium_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

SET FOREIGN_KEY_CHECKS = 1;
