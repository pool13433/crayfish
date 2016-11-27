<div class="ui container" style="margin-top: 100px;" ng-controller="SignInController as vm">
    <div class="ui two column centered grid">
        <div class="column">
            <div class="ui basic segment">
                <div class="ui form piled segment">
                    <div class="field">
                        <label>Username</label>
                        <div class="ui left icon input">
                            <input placeholder="Username" type="text">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <div class="ui left icon input">
                            <input type="password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui">
                        <button class="ui labeled icon button submit green">
                            <i class="sign in icon"></i>
                            Login
                        </button>
                        <button class="ui labeled icon button submit blue">
                            <i class="home icon"></i>
                            Home
                        </button>
                    </div>
                </div>
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