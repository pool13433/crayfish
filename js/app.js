// https://github.com/AlmogBaku/ngFacebook
var app = angular.module('crayfishApp', ['ngFacebook'])
        .config(['$facebookProvider', function ($facebookProvider) {
                $facebookProvider
                        .setAppId('1820367104853133')
                        .setCustomInit({
                            channelUrl: 'http://localhost/crayfish/',
                            xfbml: true,
                            version    : 'v2.8'
                        });
            }])
        .run(['$rootScope', '$window', function ($rootScope, $window) {
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/th_TH/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

                $rootScope.$on('fb.load', function () {
                    $window.dispatchEvent(new Event('fb.load'));
                });

                $(document).ready(function () {
                    // fix menu when passed
                    $('.masthead').visibility({
                        once: false,
                        onBottomPassed: function () {
                            $('.fixed.menu').transition('fade in');
                        },
                        onBottomPassedReverse: function () {
                            $('.fixed.menu').transition('fade out');
                        }
                    })
                    // create sidebar and attach to menu open
                    $('.ui.sidebar').sidebar('attach events', '.toc.item');
                });
            }]);

