<?php
    /*
    *   Author: Tobias Ratzberger
    *   Subject: Prüfarbeit Software (PHP / MySQL)
    *   File: index.php
    */

    $config = include('./config.php');
?>

<!DOCTYPE>
<html>
    <head>
        <title>Prüfarbeit Software -- <?php echo $config->author; ?></title>
        <meta name="description" content="Prüfarbeit Software zur Überprüfung der PHP / SQL Kenntnisse">
        <meta name="keywords" content="4aITI, Tobias, Ratzberger, WiFi, Linz, Lehrabschlussprüfung, LAP, Programmierung, Coding, PHP, MySQL">
        <meta name="author" content="<?php echo $config->author; ?>">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="./assets/css/custom.css" rel="stylesheet">
        <link href="./assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- Functions / View Definition -->
        <?php
            include('./tpl/components/database.php');
            include('./functions.php');

            if(isset($_GET["view"])) {
                $view = $_GET["view"];
            } else {
                header('Location: ?view=home');
                die();
            }
        ?>

        <!-- Navigation -->
        <?php include('./tpl/components/menu.php'); ?>

        <div class="px-3 py-3 pt-md-5 pb-md- mx-auto text-center">
            <h1 class="display-4"><?php echo $config->menu[$view]; ?></h1>
        </div>

        <!-- Loading Views -->
        <div class="container px-3 py-3 pt-md-5 pb-md-5">
            <?php
                if(isset($view)) {
                    include('./tpl/pages/' . $view . '.php');
                }
            ?>
        </div>

        <!-- Footer -->
        <?php include('./tpl/components/footer.php'); ?>

        <!-- Loading Third-Party JS-Libs -->
        <script src="./assets/js/jquery-3.4.1.slim.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="./assets/js/locales/bootstrap-datetimepicker.de.js"></script>
        <script src="./assets/js/moment.min.js"></script>
        <script src="./assets/js/locales/de-at.js"></script>

        <!-- Initialising Datepicker Component -->
        <script>
            $(".datetimepicker").datetimepicker({
                format: "dd.mm.yyyy hh:ii",
                autoclose: true,
                startDate: moment().add(30, 'm').format("DD.MM.YYYY HH:mm")
            });
        </script>
    </body>
</html>