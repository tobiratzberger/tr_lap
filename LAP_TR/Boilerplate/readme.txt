//Sammlung einiger Beispiel Funktionen
$order = getObjectByQuery($con,'select * from bestellung natural join (artikel, person) where bes_id = ? ', array($bestNr));

$persons = getListByQuery($con,"SELECT per_id, concat_ws(' ', per_vname,per_nname) FROM person");
$articles = getListByQuery($con,"SELECT art_id,art_name FROM versand.artikel");

$selectedPersonIndex = getIndexByKey($persons,$order->per_id);
$selectedArticleIndex = getIndexByKey($articles,$order->art_id);

buildOptionsByList($persons,$selectedPersonIndex);
buildOptionsByList($articles,$selectedArticleIndex);

executeQuery($con,"UPDATE bestellung SET per_id = ?, art_id= ?, bes_menge = ? WHERE bes_id = ?;", array($perId,$article,$amount,$bestNr));

executeQueryForOption($con,'SELECT bes_Id, bes_id from bestellung') ?>

//Leichte SQl Queries
INSERT INTO table_name (column1, column2, column3, ...)
    VALUES (value1, value2, value3, ...);

UPDATE table_name
    SET column1 = value1, column2 = value2, ...
    WHERE condition;

DELETE FROM table_name WHERE condition;


//SQL MAK
use fahrzeugverwaltung;

-- 1)
select count(zul_id) as "Anzahl der Zulassungen"
from zulassung;

-- 2)
select *
from kennzeichen as ken
	natural join zulassung as zul
where ken.ken_nr like "L%";

-- 3) a)
select her.her_marke as "Marke", zul.zul_motornr as "Motornummer"
from zulassung as zul
	inner join h_type as hty using (hty_id)
	inner join hersteller as her using (her_id)
where zul.zul_aktiv = 1;

-- 3) b)
select her.her_marke as "Marke", zul.zul_motornr as "Motornummer"
from zulassung as zul, h_type as hty, hersteller as her
where zul.hty_id = hty.hty_id
	and hty.her_id = her.her_id
	and zul.zul_aktiv = 1;

-- 4)
select her.her_id, her.her_marke
from hersteller as her
	left outer join h_type as hty using (her_id)
where hty.her_id is NULL;

-- 5)
select her.her_marke as "Hersteller"
from zulassung as zul
	right outer join h_type as hty using (hty_id)
	right outer join hersteller as her using (her_id)
where zul.hty_id is NULL;

-- 6)
select her.her_marke as "Marke", hty.hty_type as "Type", zul.zul_motornr as "Motornummer", zul.zul_fahrgestellnr as "FahrgestellNr", ken.ken_nr as "Kennzeichen"
from zulassung as zul
	left outer join h_type as hty using (hty_id)
	left outer join hersteller as her using (her_id)
	left outer join kennzeichen as ken using (ken_id)
order by her.her_marke asc, ken.ken_nr asc;

-- 7)
select concat_ws(" -> ", ken.ken_id, ken.ken_nr) as "ID - > Kennzeichen (nicht zugelassen)"
from kennzeichen as ken
	left outer join zulassung as zul using(ken_id)
where zul.ken_id is NULL;

-- 8)
select her.her_marke as "Marke", hty.hty_type as "Type", zul.zul_motornr as "Motornummer", zul.zul_fahrgestellnr as "FahrgestellNr", ken.ken_nr as "Kennzeichen"
from zulassung as zul
	natural join h_type as hty
	natural join hersteller as her
	natural join kennzeichen as ken
where zul.zul_aktiv = 1
order by her.her_marke asc, ken.ken_nr asc;

-- 9)
describe h_type;

-- 10)
show create table zulassung;

-- 11)
update zulassung
set zul_fahrgestellnr = "KKDJE1KD"
where zul_id = 1;