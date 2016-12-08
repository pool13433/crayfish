<?php $baseUrl = Yii::app()->baseUrl; ?>
<!DOCTYPE html>
<html lang="en" ng-app="crayfishApp">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            @font-face {
                font-family: superspace;
                src: url('<?= $baseUrl ?>/fonts/Superspace Regular ver 1.00.ttf');		
            }
            body *{
                font-family: superspace;
            }
            [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
                display: none !important;
            }
        </style>
        <script type="text/javascript"> var CRAYFISH_URL = '<?= $baseUrl ?>';</script>
    </head>

    <body>

        <?php echo $content; ?>

    </body>
</html>
