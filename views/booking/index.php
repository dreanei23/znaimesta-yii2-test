<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1 class="page-header">Бронирование</h1>


<div class="row">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'options' => [
            'class' => 'col-sm-4'
            ]
    ]); ?>


    <?= $form->field($booking, 'arrival_date')->textInput(['type' => 'date']); ?>
    <?= $form->field($booking, 'departure_date')->textInput(['type' => 'date']); ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


<?php if (!empty($rooms)): ?>
    <h2 class="page-header">Свободные комнаты на выбранные даты</h2>
    <div class="category-buttons">
        <?= Html::a('Все', Url::current(['category_id' => 0]), ['class'=>'btn btn-default']) ?>
        <?php foreach ($categories as $category): ?>
            <?= Html::a($category->title . "(" . $category->count_free_rooms . ")", Url::current(['category_id' => $category->id]), ['class'=>'btn btn-default']) ?>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><?= $room->title ?></div>
                    <div class="panel-body">
                        <?= Html::a('Забронировать', [Url::toRoute(['booking/book', 'id' => $room->id])], ['class'=>'btn btn-primary']); ?>
                    </div>
                    <div class="panel-footer text-right"><?= $room->category->title ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
