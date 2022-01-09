<div class="row justify-content-center mt-4">
    <div class="card" style="width: 40%;">
        <div class="card-body">
            <h1 class="card-title">Inscription</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="inputLogin" class="form-label">Identifiant</label>
                    <input type="text" name="login" class="form-control" id="inputLogin">
                </div>
                <div class="mb-3">
                    <label for="inputName" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" id="inputName">
                </div>
                <div class="mb-3">
                    <label for="inputFirstName" class="form-label">Prénom</label>
                    <input type="text" name="firstName" class="form-control" id="inputFirstName">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="mb-3">
                    <label for="inputConfirmPassword" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword" maxlength="45">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
            <div class="text-center mt-2">
                <span>Vous avez déjà un compte?</span><br/>
                <a href="monApplication.php?action=login" class="card-link">Connectez-vous !</a>
            </div>
        </div>
    </div
</div>

<script>
    var alerts = JSON.parse('<?=json_encode($context->alerts);?>');
    console.log(alerts);
    window.displayAlerts(alerts);
</script>

