<h4>Vos voyages réservés: </h4>

<?php if (count($context->trips) <= 0): ?>

    <p class="fst-italic">Vous n'avez encore réservé aucun voyage...</p>

<?php else: ?>

    <div class="row justify-content-center">
        <?php foreach($context->trips as $t): ?>
            <div class="card mb-3" style="width: 70%;">
                <div class="card-body row">
                    <div class="col-10">
                        <h2 class="card-title"><?=$t->trajet->depart?> - <?=$t->trajet->arrivee?></h2>
                    </div>
                </div>
                <div class="row card-body">
                    <span class="col-1">N°<?=$t->id?></span>
                    <span class="col-1"><?=$t->heureDepart?>h</span>
                    <span class="col-1">
                                <span><?=$t->nbplace?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                </svg>
                            </span>
                    <span class="col-2 fst-italic">"<?=$t->contraintes?>"</span>
                    <span class="col-2 fst-italic">-<?=$t->conducteur->prenom?> <?=$p->conducteur->nom?></span>
                    <span class="col-1 bg-primary rounded fs-4 fw-bold text-white text-center"><?=$t->tarif?>€</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif ?>
