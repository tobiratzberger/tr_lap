<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: spChange.php
    */

    $showDramaDateCreation = false;
    $showAllDramaEventDates = false;
    if(isset($_POST["selectedDramaId"])) {
        $selectedDramaName = getObjectByQuery($con, "select dra_name from drama where dra_id = ?", array($_POST["selectedDramaId"]))->dra_name;
    }

    if(isset($_POST["dramaSelected"])) {
        $showDramaDateCreation = true;
    } else if (isset($_POST["dramaDatesCreated"])){
        $showDramaDateCreation = false;
        try {
            $dramaDatesToCreate = array();
            for ($i = 1; $i <= $_POST["howManyDates"]; $i++) {
                $tmpDate = date("Y-m-d H:i:s", strtotime($_POST["Datum_". $i])) . "<br>";
                /* echo $tmpDate; */
                executeQuery($con, 'INSERT INTO dramaevent (eve_termin, dra_id) VALUES (?, ?) ', array($tmpDate, $_POST["selectedDramaId"]));
            }

            $dramaDateCreationSuccessful = true;
            $showAllDramaEventDates = true;
        } catch (Exception $e) {
            $dramaDateCreationSuccessful = false;
            $dramaDateCreationError = $e->getMessage();
        }
    }
    
    if(isset($dramaDateCreationSuccessful)) {
        if ($dramaDateCreationSuccessful == true) {
            echo '<div class="alert alert-success">Es konnten alle Termine für das Theaterstück "' . $selectedDramaName . '" erstellt werden!</div>';
        } else if($dramaDateCreationSuccessful == false) {
            echo '<div class="alert alert-danger">' . $dramaDateCreationError . '</div>';
        }
    }
?>

<form method="post">
    <?php
        if(!$showDramaDateCreation && !$showAllDramaEventDates) {
            echo '<fieldset class="form-group">';
                echo '<legend class="col-form-label">';
                    echo '<h4>Spielplan erfassen</h4>';
                echo '</legend>';
                echo '<div class="form-group">';
                    echo '<label for="selectedDramaId">Drama auswählen</label>';
                    echo '<select class="form-control" id="selectedDramaId" name="selectedDramaId">';

                        $draObjects = getListByQuery($con, "select * from drama order by dra_id asc");
                        buildOptionsByList($draObjects);

                    echo '</select>';
                echo '</div>';
                echo '<div class="form-group">';
                    echo '<label for="howManyDates">Anzahl der Aufführungen</label>';
                    echo '<input type="number" class="form-control" id="howManyDates" name="howManyDates" min="1" max="99" required autocomplete="off">';
                echo '</div>';
            echo '</fieldset>';
            echo '<button type="submit" name="dramaSelected" class="btn btn-primary">Theaterstück auswählen</button>';
        }
    ?>

    <?php
        if($showDramaDateCreation) {
            echo '<input type="hidden" name="selectedDramaId" value="' . $_POST["selectedDramaId"] . '">';
            echo '<input type="hidden" name="howManyDates" value="' . $_POST["howManyDates"] . '">';
            echo '<fieldset class="form-group">';
                echo '<legend class="col-form-label">';
                    echo '<h4>Spielplan für ' . $selectedDramaName . ' erfassen</h4>';
                echo '</legend>';

                for ($i = 1; $i <= $_POST["howManyDates"]; $i++) {
                    echo '
                        <div class="form-group">
                            <label for="Datum_'. $i .'">'. $i .'. Datum</label>
                            <input type="text" class="form-control datetimepicker" id="Datum_'. $i .'" name="Datum_'. $i .'" required autocomplete="off">
                        </div>
                    ';
                }

            echo '</fieldset>';
            echo '<button type="submit" name="dramaDatesCreated" class="btn btn-primary">Termine für Theaterstück erstellen</button>';
        }
    ?>

    <?php
        if($showAllDramaEventDates) {
            echo '<h4 class="mb-5spCreate.php">Theaterstück: ' . $selectedDramaName . '</h4>';
            executeQueryForTable($con, "select eve_termin as 'Aufführungen' from dramaevent where dra_id = ?", array($_POST["selectedDramaId"]));
        }
    ?>
</form>
