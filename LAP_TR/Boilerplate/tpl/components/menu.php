<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: menu.php
    */
?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Prüfarbeit Software - <?php echo $config->author; ?></h5>
    <nav class="my-2 my-md-0 mr-md-3">

        <?php
            $menu =  $config->menu;

            foreach ($menu as $key => $value) {
                echo '<a class="p-2 text-dark" href="?view=' . $key . '">' . $value . '</a>';
            }
        ?>
    </nav>
</div>