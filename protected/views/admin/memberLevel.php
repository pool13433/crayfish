<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="<?= Yii::app()->createUrl('admin/membersLevel') ?>">Member Levels Manages</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Member Level Form</div>
            </div>
        </h5>
        <div class="ui attached segment">
            <form class="ui form" name="level" action="<?= Yii::app()->createUrl('/admin/memberLevelSave') ?>" method="post">
                <div class="two fields">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>ชื่อระดับ ผู้ใช้งาน</label>
                                <input type="hidden" name="model[id]" value="<?= $level['lev_id'] ?>">
                                <input type="text" name="model[name]" placeholder="name" value="<?= $level['lev_name'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">                    
                    <div class="two fields">
                        <div class="field">
                            <label>สถานะ</label>
                            <select name="model[status]" required>
                                <?php foreach ($status as $key => $value) { ?>
                                    <?php if ($level['lev_status'] == $key) { ?>
                                        <option value="<?= $key ?>" selected><?= $value ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                <?php } ?>          
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="ui button green">
                    <i class="save icon"></i>
                    บันทึก
                </button>
                <a  class="ui button orange" href="<?= Yii::app()->createUrl('/admin/MembersLevel') ?>">
                    <i class="arrow left icon"></i>
                    ยกเลิก
                </a>

            </form><!-- form -->
        </div>
    </div>
</div>

