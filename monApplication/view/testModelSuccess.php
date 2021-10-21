<h2>Test du modèle de données</h2>
<h3>Utilisateurs et trajets</h3>
<p>L'utilisateur avec login <?=$context->loginTry?> et mot de passe <?=$context->passTry?> <?=($context->user) ? "s'apelle ".$context->user->nom : "n'existe pas"?><p>
<p>L'utilisateur numéro <?=$context->userWithId->id?> s'apelle <?=$context->userWithId->nom?><p>
<p>Le trajet <?=$context->trajet->depart?>-<?=$context->trajet->arrivee?> est le numéro <?=$context->trajet->id?></p>
<h3>Voyages</h3>
<?php
foreach ($context->voyages as $v) {
    echo "<p>Voyage numéro " . $v->id . " avec le conducteur " . $v->conducteur->prenom . " " . $v->conducteur->nom . "</p>";
}
?>
