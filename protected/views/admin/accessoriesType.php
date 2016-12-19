<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Accessories Type Manages</div>
            </div>
            <a class="ui button blue mini" href="<?= Yii::app()->createUrl("admin/AccessoryType") ?>">
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
                    'type_id',
                    'type_name',
                    'type_desc',
                    'type_status',
                    'type_date_create',
                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{btnEdit} {btnDelete}',
                        'buttons' => array(
                            'btnEdit' => array(
                                'label' => 'แก้ไข',
                                'url' => 'Yii::app()->createUrl("admin/AccessoryType", array("id"=>$data->type_id))',
                                'options' => array(
                                    'class' => 'ui button mini teal',
                                )
                            ),
                            'btnDelete' => array(
                                'label' => 'ลบ',
                                'url' => 'Yii::app()->createUrl("admin/AccessoryTypeDelete", array("id"=>$data->type_id))',
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