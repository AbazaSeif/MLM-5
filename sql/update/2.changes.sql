ALTER TABLE `applications` CHANGE `investment_target` `investment_target` VARCHAR(255);

ALTER TABLE `trainings` ADD `employee_id` INT UNSIGNED;

CREATE TABLE `customer_history` (
	customer_history_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	customer_id INT UNSIGNED NOT NULL,
	`date` DATE,
	`info` TEXT,
	CONSTRAINT FOREIGN KEY `fk_customer_history_customer_id` (customer_id)
		REFERENCES customers(customer_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET="utf8";

ALTER TABLE `customer_history` ADD `instruction_id` INT UNSIGNED NOT NULL;
ALTER TABLE `customer_history` ADD 
    CONSTRAINT FOREIGN KEY `fk_recruits_instruction_id` (instruction_id)
		REFERENCES instructions(instruction_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT;
