<div class="ui container" style="margin-top: 30px;">
    <div class="ui two column centered grid" ng-controller="SignInController as vm">
        <div class="column">
            <div class="ui basic segment">
                <?php if (Yii::app()->user->hasFlash('error')) { ?>
                    <div class="ui warning message">
                        <i class="close icon"></i>
                        <div class="header">
                            <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>                        
                    </div>
                <?php } ?>
                <form class="ui form piled segment" method="post" action="<?= Yii::app()->createUrl('site/Login') ?>" name="signin">
                    <div class="ui error message"></div>
                    <div class="field">
                        <label>Username</label>
                        <div class="ui left icon input">
                            <input placeholder="Username" type="text" name="username">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <div class="ui left icon input">
                            <input type="password" name="password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui">
                        <button class="ui labeled icon button submit green">
                            <i class="sign in icon"></i>
                            Login
                        </button>
                        <button type="reset" class="ui labeled icon button orange">
                            <i class="erase icon"></i>
                            Clear
                        </button>
                    </div>
                </form>
                <div class="ui horizontal divider">
                    Or
                </div>
                <button class="ui facebook button fluid" ng-click="vm.singInFacebook()">
                    <i class="facebook icon"></i>
                    Facebook
                </button>
            </div>
        </div>
    </div>
</div>