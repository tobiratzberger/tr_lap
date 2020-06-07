<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: home.php
    *   Description: Lists all Theatres
    */
?>

<h2>Willkommen im Theater der Zukunft</h2>
<b class="mt-5 mb-4 d-block">Wir zeigen und zeigten...</b>

<?php
    executeQueryForTable($con, "select dra.dra_id as 'Nr.', 
    dra.dra_name as 'Name des Stücks', 
    concat_ws(' ', per.per_vName, per.per_nName) as 'Autor',
    MIN(eve.eve_termin) as 'Erstaufführung' from person as per 
    INNER JOIN drama as dra ON per.per_id = dra.autor_id
    right outer join dramaevent as eve using(dra_id)
    GROUP BY dra.dra_id;");
?>