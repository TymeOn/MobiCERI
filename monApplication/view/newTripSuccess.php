<div class="row justify-content-center mt-4">
    <div class="card" style="width: 40%;">
        <div class="card-body">
            <h1 class="card-title">Proposer un voyage</h1>
            <div>
                <input type="hidden" id="inputUserId" name="userId" value="<?=$context->getSessionAttribute('userId')?>">
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
                <button id="tripSubmitButton" class="btn btn-primary">Envoyer</button>.
            </div>
        </div>
    </div>
</div>

<div id="resultsDisplay"></div>

<script>
    $("#tripSubmitButton").on('click', function() {
        // getting the results of the search
        $.ajax({
            url: "ajaxDispatcher.php?action=newTripResults"
                + "&userId=" + $("#inputUserId").val()
                + "&startCity=" + $("#startCitySelect").val()
                + "&endCity=" + $("#endCitySelect").val()
                + "&price=" + $("#inputPrice").val()
                + "&nbSeats=" + $("#inputNbSeats").val()
                + "&depTime=" + $("#inputDepTime").val()
                + "&constraints=" + $("#inputConstraints").val(),
            success: function(result) {
                $("#resultsDisplay").html(result);
            }
        });

    });
</script>
