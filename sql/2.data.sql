--
-- MLM System
--
-- @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
-- @copyright 2012 Adrian Wądrzyk. All rights reserved.
--

INSERT INTO settlement_types(`name`, `engine`) VALUES
('klasyczny', 'classic'),
('incaso', 'incaso'),
('storno', 'storno'),
('procentowy', 'percent');

INSERT INTO shipment_types(`name`) VALUES
('do wniosku'),
('do polisy'),
('do odstąpienia');

INSERT INTO currency(`name`, `rate`) VALUES
('PLN', 1);

INSERT INTO states(`name`) VALUES
('Dolnośląskie'),
('Kujawsko-pomorskie'),
('Lubelskie'),
('Lubuskie'),
('Łódzkie'),
('Małopolskie'),
('Mazowieckie'),
('Opolskie'),
('Podkarpackie'),
('Podlaskie'),
('Pomorskie'),
('Śląskie'),
('Świętokrzyskie'),
('Warmińsko-mazurskie'),
('Wielkopolskie'),
('Zachodniopomorskie');

INSERT INTO premium_types (`name`, `period_in_months`) VALUES
('jednorazowy', 1),
('miesięczny', 1),
('kwartalny', 3),
('półroczny', 6),
('roczny', 12);

