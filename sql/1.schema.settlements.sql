--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS settlement_types;
CREATE TABLE settlement_types (
	settlement_type_id TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL UNIQUE,
	`engine` VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS settlements;
CREATE TABLE settlements (
	settlement_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	application_id INT UNSIGNED NOT NULL,
	employee_id INT UNSIGNED,
	create_date DATE NOT NULL,
	settlement_total_id INT UNSIGNED NOT NULL,
	parts VARCHAR(255),
	amount NUMERIC(11,2) NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_settlement_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_settlements_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_settlement_settlement_totals_id` (settlement_total_id)
		REFERENCES settlement_totals(settlement_total_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS settlement_totals;
CREATE TABLE settlement_totals (
	settlement_total_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	employee_id INT UNSIGNED,
	create_date DATE NOT NULL,
	total NUMERIC(11,2) DEFAULT 0,
	tax NUMERIC(11,2) DEFAULT 0,
	CONSTRAINT FOREIGN KEY `fk_settlement_totals_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS settlement_applications;
CREATE TABLE settlement_applications (
	settlement_application_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	settlement_id INT UNSIGNED NOT NULL,
	application_id INT UNSIGNED NOT NULL,
	amount NUMERIC(11,2) NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_settlement_product_settlement_id` (settlement_id)
		REFERENCES settlements(settlement_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_settlement_product_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

SET FOREIGN_KEY_CHECKS = 1;
