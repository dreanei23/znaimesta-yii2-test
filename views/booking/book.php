<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1 class="page-header">Забронировать: <?= $room->title ?> (<?= $room->category->title ?>)</h1>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'col-sm-4'
        ]
]); ?>


<?= $form->field($booking, 'room_id')->hiddenInput(['value' => $room->id])->label(false); ?>
<?= $form->field($booking, 'client_name')->textInput() ?>
<?= $form->field($booking, 'client_email')->input('email') ?>
<?= $form->field($booking, 'arrival_date')->textInput(['type' => 'date']); ?>
<?= $form->field($booking, 'departure_date')->textInput(['type' => 'date']); ?>

<div class="form-group">
    <?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

