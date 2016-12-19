<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php $this->renderPartial('/layouts/me_menu'); ?>
<div id="content" class="pusher">    
    <?php echo $content; ?>  
    <?php $this->renderPartial('/layouts/me_footer'); ?>
</div><!-- content -->
<?php $this->endContent(); ?>