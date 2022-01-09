<h4 class="mt-2">Selectionnez vos villes de départ et d'arrivée :</h4>

<div class="d-flex flex-row form-group m-3">
    <input type="hidden" name="action" value="tripSearch">

    <div class="p-2">
        <label for="startCitySelect">Départ</label>
        <select id="startCitySelect" class="form-control form-select">
            <?php foreach($context->cities['departures'] as $c): ?>
                <option value="<?=$c?>"><?=$c?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="p-2">
        <label for="endCitySelect">Arrivée</label>
        <select id="endCitySelect" class="form-control form-select">
            <?php foreach($context->cities['arrivals'] as $c): ?>
                <option value="<?=$c?>"><?=$c?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="p-2" style="max-width: 10%">
        <label for="nbPlaceInput">Places</label>
        <input id="nbPlaceInput" class="form-control" type="number" value="1">
    </div>

    <div class="mt-4 p-2">
        <input class="form-check-input" type="checkbox" id="directRouteCheck">
        <label class="form-check-label" for="directRouteCheck">Trajet direct</label>
    </div>

    <div class="p-2">
        <button id="searchSubmitButton" class="btn btn-primary mt-4">Rechercher</button>
    </div>
</div>

<div id="resultsDisplay"></div>

<script>
    $("#searchSubmitButton").on('click', function() {

        // displaying the loading GIF
        $("#resultsDisplay").html("<img src='images\\loading.gif' width='64' height='64' style='margin-left: 10em!important;' alt='loading-gif'>");

        // getting the results of the search
        $.ajax({
            url: "ajaxDispatcher.php?action=tripSearchResults"
                + "&startCity=" + $("#startCitySelect").val()
                + "&endCity=" + $("#endCitySelect").val()
                + "&nbPlace=" + $("#nbPlaceInput").val()
                + "&directRoute=" + $("#directRouteCheck").prop('checked'),
            success: function(result) {
                $("#resultsDisplay").html(result);
            }
        });

    });
</script>
