<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="<?= Yii::app()->createUrl('admin/locations') ?>">Locations Manages</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Locations Form</div>
            </div>
        </h5>
        <div class="ui attached segment">
            <form class="ui form" name="level" action="<?= Yii::app()->createUrl('/admin/locationSave') ?>" method="post">
                <div class="two fields">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>ชื่อสถานที่</label>
                                <input type="hidden" name="model[id]" value="<?= $location['pla_id'] ?>">
                                <input type="text" name="model[name]" placeholder="name" value="<?= $location['pla_title'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>รายละเอียด</label>
                        <textarea name="model[desc]" required><?= $location['pla_desc'] ?></textarea>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Latitude</label>
                                <input type="text" name="model[latitude]" placeholder="latitude" value="<?= $location['pla_latitude'] ?>" required>
                            </div>
                            <div class="field">
                                <label>Longitude</label>
                                <input type="text" name="model[longitude]" placeholder="longitude" value="<?= $location['pla_longitude'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">                    
                    <div class="two fields">
                        <div class="field">
                            <label>จังหวัด</label>
                            <select name="model[province]" required>
                                <?php foreach ($provinces as $index => $province) { ?>
                                    <?php if ($location['pro_id'] == $province['pro_id']) { ?>
                                        <option value="<?= $province['pro_id'] ?>" selected><?= $province['pro_name'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $province['pro_id'] ?>"><?= $province['pro_name'] ?></option>
                                    <?php } ?>
                                <?php } ?>                                    
                            </select>
                        </div>
                        <div class="field">
                            <label>สถานะ</label>
                            <select name="model[status]" required>
                                <?php foreach ($status as $key => $value) { ?>
                                    <?php if ($location['pla_status'] == $key) { ?>
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
                <a  class="ui button orange" href="<?= Yii::app()->createUrl('/admin/locations') ?>">
                    <i class="arrow left icon"></i>
                    ยกเลิก
                </a>

            </form><!-- form -->
        </div>
    </div>
</div>

