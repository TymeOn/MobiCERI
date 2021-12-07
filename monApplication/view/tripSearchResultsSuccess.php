<h4>Résultats de votre recherche (<?=$context->startCity?> - <?=$context->endCity?>): </h4>

<?php if (count($context->trips) <= 0): ?>

    <p class="fst-italic">Pas de voyages disponibles pour les paramètres saisis...</p>

<?php else: ?>

    <div class="d-flex flex-wrap">
        <?php foreach($context->trips as $t): ?>
            <div class="card m-2" style="width: 12rem;">
                <div class="card-header">
                    <span class="fw-bold"><?=$t->nbplace?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                    <span class="float-end"><?=$t->trajet->depart?> - <?=$t->trajet->arrivee?></span>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="card-text text-end fw-bold d-inline"><?=$t->heureDepart?>h</h2>
                        </div>
                        <div class="col-6">
                            <h2 class="card-text text-start d-inline"><?=$t->tarif?>€</h2>
                        </div>
                    </div>
                    <footer class="blockquote-footer mt-1 mb-0"><?=$t->conducteur->prenom?> <?=$t->conducteur->nom?></footer>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif ?>

<script>
    var alerts = JSON.parse('<?=json_encode($context->alerts);?>');
    window.displayAlerts(alerts);
</script>
