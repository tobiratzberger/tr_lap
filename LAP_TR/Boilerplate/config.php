<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: config.php
    */

    return (object) array(
        'author' => 'Tobias Ratzberger',
        'database' => array(
            'server'=>"localhost",
            'user'=>"root",
            'pwd'=>"",
            'db'=>"theater"
        ),
        'menu' => array(
            'home'=>"Startseite",
            'spCreate'=>"Spielplan erfassen",
            'tsSearch'=>"Theaterstück suchen"
        )
    );