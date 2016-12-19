<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">MemberLevel Manages</div>
            </div>
            <a class="ui button blue mini" href="<?= Yii::app()->createUrl("admin/memberLevel") ?>">
                <i class="plus icon"></i>
                ใหม่
            </a>

            <!-- Message -->
            <?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
                <div class="ui <?= $key ?> message">
                    <div class="header">
                        <?= $message ?>
                    </div>
                </div>
            <?php } ?>

        </h5>
        <div class="ui attached segment">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'itemsCssClass' => 'ui selectable celled table',
                'htmlOptions' => array('style' => 'overflow: auto;'),
                'dataProvider' => $dataProvider,
                'columns' => array(
                    'lev_id',
                    'lev_name',
                    'lev_date_create',
                    'lev_status',
                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{btnEdit} {btnDelete}',
                        'buttons' => array(
                            'btnEdit' => array(
                                'label' => 'แก้ไข',
                                'url' => 'Yii::app()->createUrl("admin/memberLevel", array("id"=>$data->lev_id))',
                                'options' => array(
                                    'class' => 'ui button mini teal',
                                )
                            ),
                            'btnDelete' => array(
                                'label' => 'ลบ',
                                'url' => 'Yii::app()->createUrl("admin/MemberLevelDelete", array("id"=>$data->lev_id))',
                                'click' => 'function() { return confirm("ยืนยันการลบ"); }',
                                'options' => array(
                                    'class' => 'ui button mini red',
                                )
                            )
                        )
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>