--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

ALTER TABLE `customer_old_products` CHANGE `create_date` `product_create_date` DATE;

ALTER TABLE `employees` ADD `access` CHAR(10) NOT NULL DEFAULT '0000000000'; 

ALTER TABLE `employees` ADD `super_admin` CHAR(1) NOT NULL DEFAULT '0'; 

DROP TABLE IF EXISTS news;
CREATE TABLE news (
	news_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	text TEXT,
	employee_id INT UNSIGNED NOT NULL,
	create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	active CHAR(1) NOT NULL DEFAULT 1,
	attachment VARCHAR(255),
	CONSTRAINT FOREIGN KEY `fk_news_employee_id` (employee_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

DROP TABLE IF EXISTS news_groups;
CREATE TABLE news_groups (
	news_group_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    news_id INT UNSIGNED NOT NULL,
	employee_group_id SMALLINT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY `fk_news_group_news_id` (news_id)
		REFERENCES news(news_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY `fk_news_group_employee_group_id` (employee_group_id)
		REFERENCES employee_groups(employee_group_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

ALTER TABLE `recruits` ADD `phone_number` VARCHAR(255) NOT NULL;
ALTER TABLE `recruits` ADD `verifier_id` INT UNSIGNED;

ALTER TABLE `recruits` ADD 
    CONSTRAINT FOREIGN KEY `fk_recruits_verifier_id` (verifier_id)
		REFERENCES employees(employee_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT;
