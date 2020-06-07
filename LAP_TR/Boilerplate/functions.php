<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: functions.php
    */

    /* Erstellt anhand einer SQL-Abfrage eine Tabelle */
    function executeQueryForTable($con, $query, $bindArray = null)
    {
        try {
            echo '<table class="table table-hover"><thead>';

            $table = $con->prepare($query);

            if($table == false)
                return $table;

            if($bindArray !== null)
            {
                for ($i = 0; $i < sizeof($bindArray);$i++){
                    $table->bindParam($i+1,$bindArray[$i]);
                }
            }

            $table->execute();

            try {
                echo '<tr>';
                /* Die Attribute "dynamisch" ausgeben */
                $anz = $table->columnCount();
                $meta = array();
                for ($i = 0; $i < $anz; $i++) {
                    echo '<th>' . $table->getColumnMeta($i) ['name'] . '</th>';
                }
                echo '</tr>';
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            echo '</tr></thead> <tbody>';

            try {
                while ($row = $table->fetch(PDO::FETCH_NUM)) {
                    echo '<tr>';
                    foreach ($row as $r) {
                        echo '<td>' . $r . '</td>';
                    }

                    echo '</tr>';
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            echo '</tbody> </table>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /* Erstellt anhand einer SQL-Abfrage die Option-Tags eines Select Elements */
    function executeQueryForOption($con, $query, $bindArray = null, $selectedIndex = null)
    {
        try
        {
            $make = $con->prepare($query);

            if($bindArray != null)
            {
                for ($i = 0; $i < $bindArray.sizeof();$i++){
                    $make->bindParam($i+1,$bindArray[$i]);
                }
            }

            $make->execute();

            echo $selectedIndex;

            $index = 0;
            while ($row = $make->fetch(PDO::FETCH_NUM)) {
                if($selectedIndex != null && $index === $selectedIndex) {
                    echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                } else {
                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                }

                $index++;
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /* Erstellt anhand einer Liste an Objekten die Option-Tags eines Select Elements */
    function buildOptionsByList($list, $selectedIndex = null)
    {
        try
        {
            $index = 0;
            foreach ($list as $item) {
                if($selectedIndex != null && $index === $selectedIndex) {
                    echo '<option value="' . $item[0] . '" selected>' . $item[1] . '</option>';
                } else {
                    echo '<option value="' . $item[0] . '">' . $item[1] . '</option>';
                }

                $index++;
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /* Führ die übergebene Query fachgerecht aus */
    function executeQuery($con, $query, $bindArray = null)
    {
        try
        {

            $make = $con->prepare($query);

            if($make == false)
                return $make;

            if($bindArray !== null)
            {
                for ($i = 0; $i < sizeof($bindArray);$i++){
                    $make->bindParam($i+1,$bindArray[$i]);
                }
            }

            $make->execute();

            return $make->fetchAll();

        }
        catch (Exception $e)
        {
            $e->getMessage();
        }
    }

    /* Liefert den Index eines Keys in einer Liste */
    function getIndexByKey($list, $key)
    {
        try
        {
            $index = 0;
            foreach ($list as $item)
            {
                if($item[0] === $key)
                    return $index;

                $index++;
            }

            return -1;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /* Liefert eine Liste an Objekten anhand der übergebenen Query */
    function getListByQuery($con, $query, $bindArray = null)
    {
        try
        {
            $make = $con->prepare($query);

            if($bindArray != null)
            {
                for ($i = 0; $i < sizeof($bindArray);$i++){
                    $make->bindParam($i+1,$bindArray[$i]);
                }
            }

            $make->execute();
            return $make->fetchAll();

            $rows = [];
            while ($row = $make->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /* Liefert das erste Objekt anhand einer Query */
    function getObjectByQuery($con, $query, $bindArray = null)
    {
        try
        {
            $make = $con->prepare($query);

            if($bindArray != null)
            {
                for ($i = 0; $i < sizeof($bindArray);$i++){
                    $make->bindParam($i+1,$bindArray[$i]);
                }
            }

            $make->execute();
            return $make->fetchObject();
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
