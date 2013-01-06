--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

INSERT INTO agreement_types(`name`) VALUES
('zlecenie');

INSERT INTO employee_positions(`name`, `potencial`) VALUES
('rekrut', 1),
('tester', 0);

INSERT INTO employee_groups(`name`, `active`) VALUES
('nowy', 1);



INSERT INTO employees(`login`, `password`, `salt`, `email`, `active`, `firstname`, `lastname`, `agreement_type_id`, `employee_position_id`, `employee_group_id`) VALUES
('test', 'dea846c081227a2f326856a3027c366b3fb1926a', 'dbbecfb68536a689bb762c535d0912d6', "test@example.com", 0, 'Jan', 'Kowalski', 1, 2, 1);


INSERT INTO employees(`login`, `password`, `salt`, `email`, `active`, `firstname`, `lastname`, `agreement_type_id`, `employee_position_id`, `employee_group_id`) VALUES
('edymar', 'dea846c081227a2f326856a3027c366b3fb1926a', 'dbbecfb68536a689bb762c535d0912d6', "test2@example.com", 1, 'Edyta', 'Marszałek', 1, 2, 1);

INSERT INTO employee_addresses VALUES
(null, 1, "Królewska", "Kraków", "34-120", 6, "123456789", "12", "", 0),
(null, 1, "Karmelicka", "Kraków", "34-120", 6, "987654321", "12", "24b", 1);
