<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="<?= Yii::app()->createUrl('admin/crayfishs') ?>">Crayfishs Manages</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Crayfishs Form</div>
            </div>
        </h5>
        <div class="ui attached segment">
            <form class="ui form" name="level" action="<?= Yii::app()->createUrl('/admin/crayfishSave') ?>" method="post">
                <div class="two fields">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Code</label>
                                <input type="hidden" name="model[id]" value="<?= $crayfish['cray_id'] ?>">
                                <input type="text" name="model[code]" placeholder="code" value="<?= $crayfish['cray_code'] ?>" required>
                            </div>
                            <div class="field">
                                <label>ชื่อ</label>
                                <input type="text" name="model[name]" placeholder="name" value="<?= $crayfish['cray_name'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>รายละเอียด</label>
                        <textarea name="model[desc]" required><?= $crayfish['cray_desc'] ?></textarea>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Price</label>
                                <input type="number" name="model[price]" placeholder="Price" value="<?= $crayfish['cray_price'] ?>" required>
                            </div>
                            <div class="field">
                                <label>Color</label>
                                <input type="text" name="model[color]" placeholder="Color" value="<?= $crayfish['cray_color'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">                    
                    <div class="two fields">
                        <div class="field">
                            <label>Age</label>
                            <input type="number" name="model[age]" placeholder="Price" value="<?= $crayfish['cray_age'] ?>" required>
                        </div>
                        <div class="field">
                            <label>สถานะ</label>
                            <select name="model[status]" required>
                                <?php foreach ($status as $key => $value) { ?>
                                    <?php if ($crayfish['cray_status'] == $key) { ?>
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
                <a  class="ui button orange" href="<?= Yii::app()->createUrl('/admin/crayfishs') ?>">
                    <i class="arrow left icon"></i>
                    ยกเลิก
                </a>

            </form><!-- form -->
        </div>
    </div>
</div>

