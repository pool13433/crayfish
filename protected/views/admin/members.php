<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Member Manages</div>
            </div>
            <a class="ui button blue mini" href="<?= Yii::app()->createUrl("admin/member") ?>">
                <i class="plus icon"></i>
                ใหม่
            </a>
        </h5>
        <div class="ui attached segment">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'itemsCssClass' => 'ui selectable celled table',
                'htmlOptions' => array('style' => 'overflow: auto;'),
                'dataProvider' => $dataProvider,
                'columns' => array(
                    'mem_id',
                    'mem_fname',
                    'mem_lname',
                    'mem_mobile',
                    'mem_email',
                    'province.pro_name',
                    'mem_date_create',
                    'mem_date_update',
                    'mem_status',
                    'mem_privileg',
                    'lev_id',
                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{btnEdit} {btnDelete}',
                        'buttons' => array(
                            'btnEdit' => array(
                                'label' => 'แก้ไข',
                                'url' => 'Yii::app()->createUrl("admin/member", array("id"=>$data->mem_id))',
                                'options' => array(
                                    'class' => 'ui button mini teal',
                                )
                            ),
                            'btnDelete' => array(
                                'label' => 'ลบ',
                                'url' => 'Yii::app()->createUrl("admin/memberDelete", array("id"=>$data->mem_id))',
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