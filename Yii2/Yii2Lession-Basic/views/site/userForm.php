<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php
    if(Yii::$app->session->hasFlash('success'))
    {
        echo Yii::$app->session->getFlash('success');
    }
?>

<?php
    $form = ActiveForm::begin([
        'id' => 'active-form', // Khai báo id của form
        'options' => [ // Khai báo các thuộc tính của thẻ HTML. Như class, id, enctype...
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data'
        ],
    ])
    /* Các trường dữ liệu của ActiveForm */

?>

<?= $form->field($model, 'name')->label('Your Name') ?>
<?= $form->field($model, 'email')->label('Your Email') ?>

<?= Html::submitButton('Submit', ['class'=>'btn btn-success']); ?>

<?php
    ActiveForm::end();
?>