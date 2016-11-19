<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php $this->renderPartial('/layouts/me_menu'); ?>
<div id="content" class="pusher">    
    <?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>