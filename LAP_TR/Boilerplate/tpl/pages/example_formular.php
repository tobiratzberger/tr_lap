<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: ITL
    *   File: example-formular.php
    */

    //Wird beim absenden des Formular ausgeführt
    if(isset($_POST["send"])) {
        //Verarbeitung der Daten


        //Weiterleitung
        header('Location: ?view=ausgabe');
        die();
    }
?>

<!-- Beispiel Formular mit allen Input Typen die benötigt werden -->
<form method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="vname">Vorname</label>
            <input type="text" class="form-control" id="vname" name="vname" placeholder="Max" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nname">Nachname</label>
            <input type="text" class="form-control" id="nname" name="nname" placeholder="Mustermann" required>
        </div>
    </div>

    <div class="form-group">
        <label for="city">Stadt</label>
        <select id="city" name="city" class="form-control" required>
            <option selected disabled value="">Wählen Sie eine Stadt</option>
            <option value="Bregenz">Bregenz</option>
            <option value="Eisenstadt">Eisenstadt</option>
            <option value="Wien">Wien</option>
            <option value="St. Pölten">St. Pölten</option>
            <option value="Linz">Linz</option>
            <option value="Graz">Graz</option>
            <option value="Salzburg">Salzburg</option>
            <option value="Innsbruck">Innsbruck</option>
        </select>
    </div>

    <fieldset class="form-group">
        <legend class="col-form-label">Höchste Schulbildung</legend>
        <div class="custom-control custom-radio">
            <input type="radio" id="school1" name="school" value="HS" class="custom-control-input">
            <label class="custom-control-label" for="school1">Hauptschule</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="school2" name="school" value="BS" class="custom-control-input" checked="checked">
            <label class="custom-control-label" for="school2">Berufsschule</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="school3" name="school" value="HTL" class="custom-control-input">
            <label class="custom-control-label" for="school3">Höhrere Lehranstalt für Technische Berufe</label>
        </div>
    </fieldset>

    <fieldset class="form-group">
        <legend class="col-form-label">Hobbies</legend>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" id="hobbies1" name="hobbies[]" value="Turnen" class="custom-control-input" checked="checked">
            <label class="custom-control-label" for="hobbies1">Turnen</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" id="hobbies2" name="hobbies[]" value="Malen" class="custom-control-input">
            <label class="custom-control-label" for="hobbies2">Malen</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" id="hobbies3" name="hobbies[]" value="Schwimmen" class="custom-control-input" checked="checked">
            <label class="custom-control-label" for="hobbies3">Schwimmen</label>
        </div>
    </fieldset>

    <div class="form-group">
        <label for="readBooks">Gelesene Bücher</label>
        <select id="readBooks" name="readBooks[]" class="form-control" required multiple>
            <option value="HTML5 für Dummies">HTML5 für Dummies</option>
            <option value="Der Fänger im Roggen">Der Fänger im Roggen</option>
            <option value="Der Tag an dem ich cool wurde">Der Tag an dem ich cool wurde</option>
            <option value="PHP 7">PHP 7</option>
            <option value="Professionelles Onlinemarketing">Professionelles Onlinemarketing</option>
        </select>
    </div>

    <button type="submit" name="send" class="btn btn-primary">Absenden</button>
</form>