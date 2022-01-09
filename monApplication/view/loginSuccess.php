<div class="row justify-content-center mt-4">
    <div class="card" style="width: 40%;">
        <div class="card-body">
            <h1 class="card-title">Connexion</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Identifiant</label>
                    <input type="text" name="login" class="form-control" id="inputEmail" maxlength="45">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" maxlength="45">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>.
            </form>
            <div class="text-center mt-2">
                <span>Pas encore de compte?</span><br/>
                <a href="monApplication.php?action=register" class="card-link">Inscrivez-vous !</a>
            </div>
        </div>
    </div>
</div>

<script>
    var alerts = JSON.parse('<?=json_encode($context->alerts);?>');
    window.displayAlerts(alerts);
</script>
