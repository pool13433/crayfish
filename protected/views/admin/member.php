<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            <div class="ui large breadcrumb">
                <a class="section" href="<?= Yii::app()->createUrl('admin/dashboard') ?>">Dashboard</a>
                <i class="right chevron icon divider"></i>
                <a class="section" href="<?= Yii::app()->createUrl('admin/members') ?>">Member</a>
                <i class="right chevron icon divider"></i>
                <div class="active section">Member Form</div>
            </div>
        </h5>
        <div class="ui attached segment">
            <form class="ui form" name="member" action="<?= Yii::app()->createUrl('/admin/memberSave') ?>" method="post">
                <div class="two fields">
                    <div class="field">
                        <label>ข้อมูลเข้าระบบ</label>
                        <div class="two fields">
                            <div class="field">
                                <label>username</label>
                                <input type="text" name="model[username]" placeholder="Username" value="<?= $member['mem_username'] ?>" required>
                            </div>
                            <div class="field">
                                <label>password</label>
                                <input type="password" name="model[password]" placeholder="Password" value="<?= $member['mem_password'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>ชื่อ</label>
                                <input type="text" name="model[fname]" placeholder="fname" value="<?= $member['mem_fname'] ?>" required>
                            </div>
                            <div class="field">
                                <label>สกุล</label>
                                <input type="text" name="model[lname]" placeholder="lname" value="<?= $member['mem_lname'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>mobile</label>
                                <input type="text" name="model[mobile]" placeholder="Mobile" value="<?= $member['mem_mobile'] ?>"  required>
                            </div>
                            <div class="field">
                                <label>email</label>
                                <input type="text" name="model[email]" placeholder="Email" value="<?= $member['mem_email'] ?>"  required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>ที่อยู่</label>
                        <textarea name="model[address]" placeholder="address"><?= $member['mem_lname'] ?></textarea>
                    </div>
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>จังหวัด</label>
                                <select name="model[province]" required>
                                    <?php foreach ($provinces as $index => $province) { ?>
                                        <?php if ($member['pro_id'] == $province['pro_id']) { ?>
                                            <option value="<?= $province['pro_id'] ?>" selected><?= $province['pro_name'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $province['pro_id'] ?>"><?= $province['pro_name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>                                    
                                </select>
                            </div>
                            <div class="field">
                                <label>รหัสไปรษณีย์</label>
                                <input type="text" name="model[zipcode]" placeholder="Zipcode" value="<?= $member['mem_zipcode'] ?>"  required>
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
                                    <?php if ($member['mem_status'] == $key) { ?>
                                        <option value="<?= $key ?>" selected><?= $value ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                <?php } ?>          
                            </select>
                        </div>
                        <div class="field">
                            <label>สิทธิ</label>
                            <select name="model[pivileg]" required>
                                <?php foreach ($privilegs as $key => $value) { ?>
                                    <?php if ($member['mem_privileg'] == $key) { ?>
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
                <a  class="ui button orange" href="<?= Yii::app()->createUrl('/admin/members') ?>">
                    <i class="arrow left icon"></i>
                    ยกเลิก
                </a>

            </form><!-- form -->
        </div>
    </div>
</div>

