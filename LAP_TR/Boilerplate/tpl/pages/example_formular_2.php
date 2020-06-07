
    <h3>Bestellung ändern</h3>

<br>

<?php
if(isset($_POST['change']))
{
    $bestNr = $_POST['bestNr'];
    $order = getObjectByQuery($con,'select * from bestellung natural join (artikel, person) where bes_id = ? ', array($bestNr));

    $persons = getListByQuery($con,"SELECT per_id, concat_ws(' ', per_vname,per_nname) FROM person");
    $articles = getListByQuery($con,"SELECT art_id,art_name FROM versand.artikel");

    $selectedPersonIndex = getIndexByKey($persons,$order->per_id);
    $selectedArticleIndex = getIndexByKey($articles,$order->art_id);

    ?>
    <form action="" method="post">
        <label>Bestellnummer: </label>
        <label><?php echo $bestNr ?></label>

        <br>

        <label>Kunde: </label>
        <select name="customer">
            <?php
            $perList = getListByQuery($con,"SELECT per_id, concat_ws(' ', per_vname,per_nname) FROM person");

            // $index = array_search($order->per_id, $list);
            buildOptionsByList($persons,$selectedPersonIndex);
            //executeQueryForOption($con,"SELECT per_id, concat_ws(' ', per_vname,per_nname) FROM person", null, 2); ?>
        </select>

        <br>

        <label>Artikel: </label>
        <select name="artId">
            <?php
            buildOptionsByList($articles,$selectedArticleIndex);
            //executeQueryForOption($con,"SELECT art_id, art_name FROM artikel");
            ?>
        </select>

        <br>

        <label>Menge: </label>
        <input name="amount" required value="<?php echo $order->bes_menge ?>">
        <input name="bestNr" type="hidden" value="<?php echo $bestNr ?>">

        <br>

        <input type="submit" name="save" value="speichern">
    </form>
    <?php
}
else if(isset($_POST['save']))
{
    $article = $_POST['artId'];
    $perId = $_POST['customer'];
    $amount = $_POST['amount'];
    $bestNr = $_POST['bestNr'];

    executeQuery($con,"UPDATE bestellung SET per_id = ?, art_id= ?, bes_menge = ?
                        WHERE bes_id = ?;", array($perId,$article,$amount,$bestNr));

    echo 'Erfolgreich gespeichert!';
}
else
{
    ?>
    <form action="" method="post">
        <label>Bestellnummer: </label>
        <select name="bestNr">
            <?php executeQueryForOption($con,'SELECT bes_Id, bes_id from bestellung') ?>
        </select>

        <br>
        <br>
        <input type="submit" name="change" value="ändern">
    </form>
    <?php
}
?>