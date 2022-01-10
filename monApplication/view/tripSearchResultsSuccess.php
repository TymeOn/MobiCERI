<h4>Résultats de votre recherche (<?=$context->startCity?> - <?=$context->endCity?>): </h4>

<?php if (count($context->trips) <= 0): ?>

    <p class="fst-italic">Pas de voyages disponibles pour les paramètres saisis...</p>

<?php else: ?>

    <div class="row justify-content-center">
        <?php foreach($context->trips as $t): ?>
            <div class="card mb-3" style="width: 70%;">
                <div class="card-body row">
                    <div class="col-10">
                        <h2 class="card-title"><?=$t['info']['title']?></h2>
                        <p class="card-text fst-italic"><?= $t['info']['connections'] != '' ? 'Par: ' . $t['info']['connections'] : 'Trajet direct' ?></p>
                    </div>

                    <div class="col-2 text-center">
                        <div class="row text-white bg-primary rounded">
                            <span class="card-text fs-2 fw-bold"><?=$t['info']['price']?>€</span>
                        </div>
                        <div class="row">
                            <a class="mt-2" data-bs-toggle="collapse" href="#collapseDetail<?=$t['info']['id']?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Voir +
                            </a>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseDetail<?=$t['info']['id']?>">
                    <?php foreach($t['path'] as $p): ?>
                        <div class="row card-body">
                            <span class="col-1"></span>
                            <span class="col-1">N°<?=$p->id?></span>
                            <span class="col-2 fw-bold"><?=$p->trajet->depart?> - <?=$p->trajet->arrivee?></span>
                            <span class="col-1"><?=$p->heureDepart?>h</span>
                            <span class="col-1">
                                <span><?=$p->nbplace?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                </svg>
                            </span>
                            <span class="col-2 fst-italic">"<?=$p->contraintes?>"</span>
                            <span class="col-2 fst-italic">-<?=$p->conducteur->prenom?> <?=$p->conducteur->nom?></span>
                            <span class="col-1 bg-primary rounded fs-4 fw-bold text-white text-center"><?=$p->tarif?>€</span>
                        </div>
                    <?php endforeach; ?>
                    <div class="row card-body">
                        <span class="col-10"></span>
                        <div class="resaSection col-2" data-value="<?=$t['info']['tripIds']?>"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif ?>

<script>
    var sections = document.getElementsByClassName('resaSection');

    if (document.getElementById('isLogged').dataset.value !== '') {
        Array.from(sections).forEach(section => {
            console.log(section.dataset.value);
            section.innerHTML = "<a class='btn btn-primary' href='monApplication.php?action=login'>Reserver</a>";
        });
    } else {
        Array.from(sections).forEach(section => {
            section.innerHTML = "<a class='btn btn-secondary' href='monApplication.php?action=login'>Connectez-vous</a>";
        });
    }
</script>

<script>
    var alerts = JSON.parse('<?=json_encode($context->alerts);?>');
    window.displayAlerts(alerts);
</script>
