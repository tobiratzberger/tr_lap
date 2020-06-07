<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: tsSearch.php
    */

    $showSearchResult = false;
    if(isset($_POST["tsSearchSent"])) {
        $showSearchResult = true;
    }
?>

<form method="post">
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="tsSearch">Titel des Theaterstück (auch Teile)</label>
            <input type="text" class="form-control" id="tsSearch" name="tsSearch" placeholder="z.B.: Ha">
        </div>
    </div>

    <button type="submit" name="tsSearchSent" class="btn btn-primary">Absenden</button>
</form>

<?php
    if($showSearchResult == true) {
        echo '<h5 class="display-5 mt-5">Theaterstück mit "' . $_POST["tsSearch"] . '" im Titel</h5>';
        $likeParam = '%' . $_POST["tsSearch"] . '%';

        executeQueryForTable($con, "select dra.dra_name as 'Drama',
gen.gen_name as 'Genre',
concat_ws(' ', per.per_vName, per.per_nName) as 'Autor',
DATE_FORMAT(MIN(eve.eve_termin), '%a, %d. %M %Y - %H:%i Uhr') as 'Erstaufführung' from theater.person as per
INNER JOIN theater.drama as dra ON per.per_id = dra.autor_id
right outer join theater.dramaevent as eve using(dra_id)
left outer join theater.genre as gen using (gen_id)
where dra.dra_name like ?
GROUP BY dra.dra_id;", array($likeParam));
    }
?>
