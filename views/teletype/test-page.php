<?php

use yii\web\View;

/**
 * @var View $this
 */

?>

<div class="row">
    <div class="col-6 logs">
        <label for="operator_log" class="form-label">Лог оператора</label>
        <textarea id="operator_log" class="form-control" readonly></textarea>
        <label for="client_log" class="form-label">Лог клиента</label>
        <textarea id="client_log" class="form-control" readonly></textarea>
    </div>
    <div class="col-6"></div>
</div>
