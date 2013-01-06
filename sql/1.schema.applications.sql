--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS application_statuses;
CREATE TABLE application_statuses (
	application_status_id TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	active CHAR(1) NOT NULL DEFAULT 1,
	taken_to_settle CHAR(1) NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS applications;
CREATE TABLE applications (
	application_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inner_number VARCHAR(50) NOT NULL,
	outer_number VARCHAR(50) NOT NULL,
	description TEXT,
	application_status_id TINYINT UNSIGNED NOT NULL,
	customer_id INT UNSIGNED NOT NULL,
	employee_id INT UNSIGNED NOT NULL,
	seller_id INT UNSIGNED,
	partner_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	insurance_sum NUMERIC(11,2),
	premium_type_id TINYINT UNSIGNED,
	premium NUMERIC(11,2),
	amount NUMERIC(11,2) NOT NULL,
	alert CHAR(1) DEFAULT 0,
	settlement_type_id TINYINT UNSIGNED NOT NULL,
	currency_id SMALLINT UNSIGNED NOT NULL,
	currency_rate NUMERIC(11,2) DEFAULT 1,
	create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	investment_target VARCHAR(255) NOT NULL,
	conclusion_date_start DATE NOT NULL,
	conclusion_date_end DATE,
	margin NUMERIC(11,2),
	cost_of_repayment NUMERIC(11,2),
	settled CHAR(1) NOT NULL DEFAULT 0,
	CONSTRAINT FOREIGN KEY `fk_applications_application_status_id` (application_status_id)
		REFERENCES application_statuses(application_status_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_seller_id` (seller_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_partner_id` (partner_id)
		REFERENCES partners(partner_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_product_id` (product_id)
		REFERENCES products(product_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_premium_type_id` (premium_type_id)
		REFERENCES premium_types(premium_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_settlment_type_id` (settlement_type_id)
		REFERENCES settlement_types(settlement_type_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT FOREIGN KEY `fk_applications_currency_id` (currency_id)
		REFERENCES currency(currency_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS application_documents;
CREATE TABLE application_documents (
	application_document_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	application_id INT UNSIGNED NOT NULL,
	document_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_application_documents_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_application_documents_document_id` (document_id)
		REFERENCES documents(document_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS application_shipments;
CREATE TABLE application_shipments (
	application_shipment_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	application_id INT UNSIGNED NOT NULL,
	shipment_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_application_shipments_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_application_shipment_shipment_id` (shipment_id)
		REFERENCES shipments(shipment_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS policy;
CREATE TABLE policy (
	policy_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	application_id INT UNSIGNED NOT NULL,
	outer_number VARCHAR(50),
	create_date DATE,
	end_date DATE,
	delivery_date DATE,
	pop_place VARCHAR(255),
	pop_return_date DATE,
	CONSTRAINT FOREIGN KEY `fk_policy_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS application_settlements;
CREATE TABLE application_settlements (
	application_settlement_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	application_id INT UNSIGNED NOT NULL,
	configuration TEXT NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_application_settlements_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS application_percents;
CREATE TABLE application_percents (
	application_percent_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	application_id INT UNSIGNED NOT NULL,
	employee_id INT UNSIGNED NOT NULL,
	for_seller CHAR(1) NOT NULL DEFAULT 0,
	percent NUMERIC(11,2) NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_application_percents_application_id` (application_id)
		REFERENCES applications(application_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_application_percents_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

SET FOREIGN_KEY_CHECKS = 1;
