-- -----------------------------------------------------
-- Schema db_softwareversion
-- -----------------------------------------------------
create schema if not exists `db_softwareversion` default character 
set 
  utf8;
use `db_softwareversion`;


-- -----------------------------------------------------
-- Tabelle client_contactperson (Ansprechpersonen der jeweiligen Firma)
-- -----------------------------------------------------
drop 
  table if exists `db_softwareversion`.`client_contactperson`;
create table if not exists `db_softwareversion`.`client_contactperson` (
  `clco_id` int not null auto_increment, 
  `clco_fname` varchar(45) not null, 
  `clco_lname` varchar(45) not null, 
  `clco_mail` varchar(45) not null, 
  `clco_tel` varchar(45) not null, 
  primary key (`clco_id`)
);


-- -----------------------------------------------------
-- Tabelle software_client (Kunden / Firmen der Software)
-- -----------------------------------------------------
drop 
  table if exists `db_softwareversion`.`software_client`;
create table if not exists `db_softwareversion`.`software_client` (
  `socl_id` int not null auto_increment, 
  `socl_bez` varchar(45) not null, 
  `socl_street` varchar(45) not null, 
  `socl_streetnr` int not null, 
  `socl_plz` int not null, 
  `socl_city` varchar(45) not null, 
  `clco_id` int null, 
  primary key (`socl_id`), 
  index `fk_software_client_client_contactperson1_idx` (`clco_id` asc), 
  constraint `fk_software_client_client_contactperson1` foreign key (`clco_id`) references `db_softwareversion`.`client_contactperson` (`clco_id`) on delete no action on 
  update 
    no action
);


-- -----------------------------------------------------
-- Tabelle software_version (Software)
-- -----------------------------------------------------
drop 
  table if exists `db_softwareversion`.`software_version`;
create table if not exists `db_softwareversion`.`software_version` (
  `sove_id` int not null auto_increment, 
  `sove_bez` varchar(45) not null, 
  `sove_versionnr` varchar(16) not null, 
  `sove_desc` varchar(45) not null, 
  `sove_release` datetime not null, 
  `sove_supportend` datetime not null, 
  `sove_active` tinyint not null, 
  `socl_id` int not null, 
  primary key (`sove_id`), 
  index `fk_software_version_software_client_idx` (`socl_id` asc), 
  constraint `fk_software_version_software_client` foreign key (`socl_id`) references `db_softwareversion`.`software_client` (`socl_id`) on delete no action on 
  update 
    no action
);


-- -----------------------------------------------------
-- Demodaten der Ansprechpersonen
-- -----------------------------------------------------
start transaction;
use `db_softwareversion`;
insert into `db_softwareversion`.`client_contactperson` (
  `clco_id`, `clco_fname`, `clco_lname`, 
  `clco_mail`, `clco_tel`
) 
values 
  (
    default, 'Wolfgang', 'Koppenberger', 
    'office@kfz-koppenberger.at', '+43 664 88 22 65 76'
  );
insert into `db_softwareversion`.`client_contactperson` (
  `clco_id`, `clco_fname`, `clco_lname`, 
  `clco_mail`, `clco_tel`
) 
values 
  (
    default, 'Tobias', 'Ratzberger', 't.ratzberger@ris.at', 
    '+43 664 88 22 65 73'
  );
commit;


-- -----------------------------------------------------
-- Demodaten der Kunden / Firmen
-- -----------------------------------------------------
start transaction;
use `db_softwareversion`;
insert into `db_softwareversion`.`software_client` (
  `socl_id`, `socl_bez`, `socl_street`, 
  `socl_streetnr`, `socl_plz`, `socl_city`, 
  `clco_id`
) 
values 
  (
    default, 'KFZ Koppenberger', 'Ennserstraße', 
    37, 4400, 'Steyr', 1
  );
insert into `db_softwareversion`.`software_client` (
  `socl_id`, `socl_bez`, `socl_street`, 
  `socl_streetnr`, `socl_plz`, `socl_city`, 
  `clco_id`
) 
values 
  (
    default, 'RIS GmbH', 'Im Stadtgut Zone A', 
    1, 4400, 'Steyr', 2
  );
commit;


-- -----------------------------------------------------
-- Demodaten der Softwareversionen
-- -----------------------------------------------------
start transaction;
use `db_softwareversion`;
insert into `db_softwareversion`.`software_version` (
  `sove_id`, `sove_bez`, `sove_versionnr`, 
  `sove_desc`, `sove_release`, `sove_supportend`, 
  `sove_active`, `socl_id`
) 
values 
  (
    default, 'Rechnungsprogramm', '1.1.0', 
    'Rechnungsprogramm für KFZ Werkstätten', 
    '2020-01-25', '2024-12-31', true, 
    1
  );
insert into `db_softwareversion`.`software_version` (
  `sove_id`, `sove_bez`, `sove_versionnr`, 
  `sove_desc`, `sove_release`, `sove_supportend`, 
  `sove_active`, `socl_id`
) 
values 
  (
    default, 'Kundenverwaltung', '1.1.2', 
    'Kundendatenverwaltung (DSGVO Konform)', 
    '2020-01-12', '2025-12-31', true, 
    2
  );
insert into `db_softwareversion`.`software_version` (
  `sove_id`, `sove_bez`, `sove_versionnr`, 
  `sove_desc`, `sove_release`, `sove_supportend`, 
  `sove_active`, `socl_id`
) 
values 
  (
    default, 'Schauraumsoftware', '0.0.9', 
    'Software um Produkte im Schauraum auf Bildschirmen zu präsentieren', 
    '2019-06-29', '2021-12-31', true, 
    2
  );
insert into `db_softwareversion`.`software_version` (
  `sove_id`, `sove_bez`, `sove_versionnr`, 
  `sove_desc`, `sove_release`, `sove_supportend`, 
  `sove_active`, `socl_id`
) 
values 
  (
    default, 'Fernsteuerung', '4.3.1', 
    'Ermöglicht die Fernsteuerung von Netzwerkinternen Computern', 
    '2016-01-14', '2019-12-31', false, 
    2
  );
commit;