<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment">   
    <div class="ui container">        
        <div class="ui grid">
            <div class="six wide column">
                <div class="ui fluid image">
                    <img src="<?= $baseUrl ?>/uploads/profile/<?= $member['mem_picture'] ?>">
                </div>
            </div>
            <div class="ten wide column">
                <form class="ui form">
                    <div class="ui piled segment">
                        <div class="ui grid container">
                            <div class="sixteen wide column">
                                <h3 class="ui header">
                                    <?= $member['mem_fname'] . '    ' . $member['mem_lname'] ?>
                                </h3>
                            </div>
                            <div class="eight wide column"><h3 class="ui header">โทรศัพท์ <?= (empty($member['mem_mobile']) ? '-- โปรดระบุ--' : $member['mem_mobile']) ?></h3></div>
                            <div class="eight wide column"><h3 class="ui header">อีเมลล์  <?= (empty($member['mem_email']) ? '-- โปรดระบุ--' : $member['mem_email']) ?></h3></div>
                            <div class="sixteen wide column"><h3 class="ui header">ที่อยู่ <?= (empty($member['mem_address']) ? '-- โปรดระบุ--' : $member['mem_address']) ?></h3></div>
                            <div class="eight wide column"><h3 class="ui header">วันที่ลงทะเบียน <?= $member['mem_date_create'] ?></h3></div>
                            <div class="eight wide column"><h3 class="ui header">วันที่แก้ไขข้อมูลล่าสุด <?= $member['mem_date_update'] ?></h3></div>
                            <div class="eight wide column"><h3 class="ui header">
                                    สถานะ 
                                    <?php if ($member['mem_status'] == 'active') { ?>
                                        <div class="ui label green">
                                            <i class="check circle icon"></i>  
                                            ใช้งานอยู่
                                        </div>
                                    <?php } else { ?>
                                        <div class="ui label red">
                                            <i class="remove circle outline icon"></i>
                                            ยกเลิกการใช้งาน
                                        </div>
                                    <?php } ?>

                                </h3>
                            </div>
                            <div class="eight wide column">
                                <h3 class="ui header">
                                    สถานะ  <?= $member['lev_name'] ?>                                
                                </h3>
                            </div>                        
                        </div>                   
                    </div>      
                    <button class="ui button green">แก้ไขข้อมูล</button>
                    <a href="<?= Yii::app()->createUrl('/site/index') ?>" class="ui button orange">กลับไปหน้าแรก</a>
                </form>

            </div>
        </div>
    </div>
</div>
