<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ton appli !</title>
    </head>

    <script>
        window.displayAlerts = function (alerts) {
            Object.keys(alerts).forEach(function (key){
                $("#alerts").append(
                    "<div class='alert alert-" + alerts[key].class.toLowerCase() + " alert-dismissible mb-2' role='alert'>" +
                    "<span>" + alerts[key].type + ": " + alerts[key].message + "</span>"+
                    "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>" +
                    "</div>"
                );
            });
        }
    </script>

    <body>
        <div id="alerts" style="position: absolute; top: 64px; right: 8px; z-index: 100"></div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand ms-3" href="monApplication.php">MobiCERI</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="monApplication.php?action=tripSearch">Recherche</a>
                </li>
                <?php if($context->getSessionAttribute('userId')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="monApplication.php?action=userTrips">Mes réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monApplication.php">Proposer un voyage</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto me-3">
                <?php if($context->getSessionAttribute('userId')): ?>
                    <li class="nav-item">
                        <p class="navbar-text pb-0">
                            <span>Connecté en tant que:</span>
                            <span><?=$context->getSessionAttribute('userFirstName')?></span>
                            <span><?=$context->getSessionAttribute('userName')?></span>
                        </p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monApplication.php?action=logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="monApplication.php?action=login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monApplication.php?action=register">Inscription</a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>

        <div id="page">
            <div id="page_maincontent" class="container-fluid">
                <?php include($template_view); ?>
            </div>
        </div>
    </body>

</html>
