<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <!-- Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ton appli !</title>
    </head>

    <body>
        <?php if($context->error): ?>
            <div id="flash_error" class="error">
                <?php echo "ERREUR: $context->error" ?>
            </div>
        <?php endif; ?>

        <?php if($context->info): ?>
            <div id="flash_info" class="info">
                <?php echo "INFO: $context->info" ?>
            </div>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" style="margin-left: 15px" href="monapplication.php">MobiCERI</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="monapplication.php?action=tripSearch">Recherche</a>
                </li>
            </ul>
        </nav>
        <?php if($context->getSessionAttribute('user_id')): ?>
        <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
        <?php endif; ?>

        <div id="page">
            <div id="page_maincontent" class="container-fluid">
                <?php include($template_view); ?>
            </div>
        </div>
    </body>

</html>
