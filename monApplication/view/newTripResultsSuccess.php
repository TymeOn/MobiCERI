<script>
    var alerts = JSON.parse('<?=json_encode($context->alerts);?>');
    window.displayAlerts(alerts);
</script>
