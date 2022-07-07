<!-- <div class="alert alert-dismissible alert-danger" onclick="this.classList.add('hidden');"><?= h($message) ?></div> -->

<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>&nbsp;
    <strong><?= $message ?></strong>
</div>