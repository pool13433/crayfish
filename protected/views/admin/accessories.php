<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Accessories Manages</div>
            </div>
            <a class="ui button blue mini" href="<?= Yii::app()->createUrl("admin/Accessory") ?>">
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
                    'acc_id',
                    'acc_name',
                    'acc_desc',
                    'acc_price',
                    'acc_picture',
                    'acc_date_create',
                    'acc_date_update',
                    'acc_status',
                    'accessoriesType.type_id',
                    'mem_id',
                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{btnEdit} {btnDelete}',
                        'buttons' => array(
                            'btnEdit' => array(
                                'label' => 'แก้ไข',
                                'url' => 'Yii::app()->createUrl("admin/Accessory", array("id"=>$data->acc_id))',
                                'options' => array(
                                    'class' => 'ui button mini teal',
                                )
                            ),
                            'btnDelete' => array(
                                'label' => 'ลบ',
                                'url' => 'Yii::app()->createUrl("admin/AccessoryDelete", array("id"=>$data->acc_id))',
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