<div class="row justify-content-center mt-4">
    <div class="card" style="width: 40%;">
        <div class="card-body">
            <h1 class="card-title">Proposer un voyage</h1>
            <form method="post">
                <input type="hidden" name="userId" value="<?=$context->getSessionAttribute('userId')?>">
                <div class="mb-3">
                    <label for="startCitySelect">Départ</label>
                    <select id="startCitySelect" name="startCity" class="form-control form-select">
                        <?php foreach($context->cities['departures'] as $c): ?>
                            <option value="<?=$c?>"><?=$c?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="endCitySelect">Arrivée</label>
                    <select id="endCitySelect" name="endCity" class="form-control form-select">
                        <?php foreach($context->cities['arrivals'] as $c): ?>
                            <option value="<?=$c?>"><?=$c?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputPrice" class="form-label">Tarif</label>
                    <input type="number" name="price" class="form-control" id="inputPrice" maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="inputNbSeats" class="form-label">Nombre de places</label>
                    <input type="number" name="nbSeats" class="form-control" id="inputNbSeats" maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="inputDepTime" class="form-label">Heure de départ</label>
                    <input type="number" name="depTime" class="form-control" id="inputDepTime" maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="inputConstraints" class="form-label">Contraintes</label>
                    <input type="text" name="constraints" class="form-control" id="inputConstraints" maxlength="500">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>.
            </form>
        </div>
    </div>
</div>

<script>
    var alerts = JSON.parse('<?=json_encode($context->alerts);?>');
    window.displayAlerts(alerts);
</script>
