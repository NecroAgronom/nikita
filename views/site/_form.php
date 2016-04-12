<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'text_prev')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->fileInput() ?>
    <?= $model->img ?>

    <?= $form->field($model, 'aud')->fileInput() ?>
    <?= $model->aud ?>
    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(Category::find()->all(),'id','category'),['prompt' => 'Выбери категорию, бля']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать <span class="glyphicon glyphicon-ok"></span>' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
