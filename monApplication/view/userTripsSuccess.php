<h4>Vos voyages réservés: </h4>

<div id="resultsDisplay"></div>

<script>

    $(document).ready(function() {
        // displaying the loading GIF
        $("#resultsDisplay").html("<img src='images\\loading.gif' width='64' height='64' style='margin-left: 10em!important;' alt='loading-gif'>");

        // getting the results of the search
        $.ajax({
            url: "ajaxDispatcher.php?action=userTripsResults"
                + "&userId=" + "<?=$context->getSessionAttribute('userId')?>",
            success: function(result) {
                $("#resultsDisplay").html(result);
            }
        });
    });

</script>
