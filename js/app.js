// https://github.com/AlmogBaku/ngFacebook
var app = angular.module('crayfishApp', ['ngFacebook', 'thatisuday.dropzone'])
        .constant('URL_SERVICE', CRAYFISH_URL)
        .constant('UPLOAD_CONFIG', {
            paramName: 'myfile',
            autoProcessQueue: false,
            maxFilesize: 5, // MB
            maxFiles: 10,
            dictDefaultMessage: 'เลือกรูปสินค้าของคุณ สูงสุด ' + 10 + ' ไฟล์',
            uploadMultiple: true, // Adding This 
            acceptedFiles: 'image/jpeg, images/jpg, image/png, image/gif',
            addRemoveLinks: true,
            clickable: true,
            parallelUploads: 10,
            dictMaxFilesExceeded: "คุณเลือกไฟล์เกินจำนวน 10 ไฟล์",
        })
        .config(['$facebookProvider', function ($facebookProvider) {
                $facebookProvider
                        .setAppId('1820367104853133')
                        .setCustomInit({
                            channelUrl: 'http://localhost/crayfish/',
                            xfbml: true,
                            version: 'v2.8'
                        });

            }])
        .run(['$rootScope', '$window', function ($rootScope, $window) {
                Dropzone.autoDiscover = false;
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
                    });
                    $('.ui.dropdown').dropdown().dropdown({transition: 'drop'}).dropdown({on: 'hover'});
                    // create sidebar and attach to menu open
                    $('.ui.sidebar').sidebar({transition: 'overlay'}).sidebar('attach events', '.toc.item');
                    $('.ui.accordion').accordion();
                });
            }]);

