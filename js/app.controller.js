app.controller('DoCrayfishController', DoCrayfishController)
        .controller('CrayfishsController', CrayfishsController)
        .controller('AccessoriesController', AccessoriesController)
        .controller('SalesCrayFishController', SalesCrayFishController)
        .controller('SalesAccessoriesController', SalesAccessoriesController)
        .controller('LocationController', LocationController)
        .controller('SignInController', SignInController)
        .controller('RegisterController', RegisterController);
function RegisterController($timeout) {
    var vm = this;
    $timeout(function () {
        $('#btnBrowsProfile').on('click', function () {
            console.log('xxxxxx');
            $('#inputProfile').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imageProfile').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }).trigger('click');
        });

        $('form[name="register"]').form({
            on: 'blur',
            fields: {
                picture: {identifier: 'picture', rules: [{type: 'empty', prompt: 'กรุณาเลือก รูปภาพโปรไฟล์ของคุณ'}]},
                name: {identifier: 'name', rules: [{type: 'empty', prompt: 'กรุณากรอก ชื่อ'}]},
                username: {identifier: 'username', rules: [
                        {type: 'empty', prompt: 'กรุณากรอก Username'},
                        {type: 'minLength[4]', prompt: 'กรุณากรอก Username 4 ตัวอักษร ขึ้นไป'}
                    ]},
                password_0: {identifier: 'password_0', rules: [
                        {type: 'empty', prompt: 'กรุณากรอก รหัสผ่าน'},
                        {type: 'minLength[4]', prompt: 'กรุณากรอก Password 4 ตัวอักษร ขึ้นไป'},
                        {type: 'match[password_1]', prompt: 'กรุณากรอก รหัสผ่านให้ตรงกัน'}
                    ]},
                password_1: {identifier: 'password_1', rules: [
                        {type: 'empty', prompt: 'กรุณากรอก ยืนยัน รหัสผ่าน'},
                        {type: 'minLength[4]', prompt: 'กรุณากรอก Password 4 ตัวอักษร ขึ้นไป'},
                        {type: 'match[password_0]', prompt: 'กรุณากรอก รหัสผ่านให้ตรงกัน'}
                    ]},
                email: {identifier: 'email', rules: [{type: 'email', prompt: 'กรุณากรอก อีเมล์ ให้ถูกต้อง'}]},
                mobile: {identifier: 'mobile', rules: [{type: 'empty', prompt: 'กรุณากรอก มือถือ'}]},
                address: {identifier: 'address', rules: [{type: 'empty', prompt: 'กรุณากรอก ที่อยู่'}]},
                province: {identifier: 'province', rules: [{type: 'empty', prompt: 'กรุณาเลือก จังหวัด'}]},
                zipcode: {identifier: 'zipcode', rules: [
                        {type: 'empty', prompt: 'กรุณากรอก รหัสไปรษณีย์'},
                        {type: 'maxLength[5]', prompt: 'กรุณากรอก Zipcode 5 ตัวอักษร เท่านั้น'}
                    ]},
            },
            onSuccess: function (event, fields) {
                $(fields).submit();
                //event.preventDefault();                
            }
        });
    }, 1000);

}
function SignInController(AuthorizationService, $facebook, $log, $window) {

    $facebook.getLoginStatus().then(function (response) {
        //console.log('response ::==', response);
        if (response.status === 'connected') {
            var authResponse = response.authResponse;
            var accessToken = authResponse.accessToken;
            $facebook.api('/me', 'get', {
                access_token: accessToken,
                fields: 'id,name,first_name,last_name,email,gender'
            }).then(function (facebook) {
                //console.log('api me  ::==', facebook);
                AuthorizationService.checkMemberProfile(facebook).then(function success(profile) {
                    //console.log('check member profile ::==', profile);
                    $window.location.href = profile.redirect;
                }, function fail(e) {
                    $log.error(e);
                });
            }, function (e) {
                $log.error(e);
            });
        } else if (response.status === 'not_authorized') {

        } else {
            $window.alert('Please log into Facebook.')
        }
    }, function (e) {
        $log.error(e);
    });

    this.singInFacebook = function () {
        $facebook.login().then(function (response) {
            //console.log('response ::==', response);
        }, function (e) {
            $log.error(e);
        });

    }

}

function LocationController($scope, CrayfishService, $log) {
    var vm = this;
    //console.log('Google Maps API version: ' + google.maps.version);
    this.locationList = [];
    this.provinceList = [];
    this.locationLocalList = [];
    var map = CrayfishMap();

    map.getProvincePlace();

    this.focusLocation = function (provinceId) {
        map.getPlaceRealtime(provinceId);
        vm.provinceId = provinceId;
    }

    function CrayfishMap() {
        var map = {};
        var options = {
            zoomDefault: 10,
        };
        return{
            getProvincePlace: function () {
                var self = this;
                CrayfishService.getProvinceLocation().then(function success(response) {
                    vm.provinceList = response;
                    vm.provinceId = 1;
                    self.getPlaceRealtime(vm.provinceId);
                }, function fail(e) {
                    $log.error(e);
                });
            },
            getPlaceRealtime: function (provinceId) {
                var self = this;
                CrayfishService.getPlaceLocation().then(function success(response) {
                    //console.log('response ::==', response);
                    vm.locationLocalList = response;
                    vm.locationList = _.map(response, function (location) {
                        //console.log('location ::==', location);
                        return  {
                            title: location.pla_title,
                            lat: parseFloat(location.pla_latitude),
                            lng: parseFloat(location.pla_longitude),
                            desc: location.pla_desc
                        };
                    });
                    if (vm.locationList.length > 0) {
                        self.buildGoogleMap(provinceId);
                    }
                }, function fail(e) {
                    $log.error(e);
                });
            },
            buildGoogleMap: function (provinceId) {
                var self = this;
                var centerIndex = self.findIndexCenterMarker(provinceId);
                // ผูก element กับ MAP zoom ระดับ 6 เลขน้อย จะมองระยะกว้าง เลขมาก จะละเอียด center ให้ focus ที่ Bangkok
                this.map = new google.maps.Map(document.getElementById('mapCrayfish'), {
                    zoom: options.zoomDefault,
                    center: vm.locationList[centerIndex],
                    disableDefaultUI: true
                });

                // Loop วาด Marker บนแผนที่
                angular.forEach(vm.locationList, function (location, index) {
                    self.buildMarker(location)
                });

                self.addEventMap();
            },
            buildMarker: function (location) {
                var self = this;
                // สร้าง marker
                var marker = new google.maps.Marker({position: location, map: this.map, title: location.title});

                var content = '<h1>' + location.title + '</h1><h3>' + location.desc + '</h3>';

                // สร้าง popup content ใส่ content เป็น location title
                var infowindow = new google.maps.InfoWindow({content: content});
                // สร้าง event ให้ จุด marker
                marker.addListener('click', function (event) {
                    //console.log(event);
                    // เปิด popup เมื่อ click marker
                    infowindow.open(self.map, marker);
                });
            },
            findIndexCenterMarker: function (provinceId) {
                //console.log('provinceId ::==', provinceId);
                var centerIndex = _.findLastIndex(vm.locationLocalList, function (place) {
                    //console.log('place.pro_id ::==', place.pro_id);
                    //console.log('provinceId ::==', provinceId);
                    //console.log('----------------------------------------');
                    return place.pro_id == provinceId;
                });
                //console.log('centerIndex ::==', centerIndex);
                return parseInt(centerIndex);
            },
            addEventMap: function () {
                // ใส่ event click ให้ MAP ทั้ง MAP
                this.map.addListener('click', function (event) {
                    //console.log('latitude ::==' + event.latLng.lat());
                    //console.log('longtitude ::==' + event.latLng.lng());
                    // alert Latitude and Longitude
                    alert('Latitude ::==' + event.latLng.lat() + ' \nLongitude ::==' + event.latLng.lng());
                });
            }
        }
    }
}


function SalesAccessoriesController(CrayfishService, UPLOAD_CONFIG, $timeout, $log, $window, $scope, URL_SERVICE) {
    var vm = this;
    // ********************** dropzone ***************
    //https://github.com/thatisuday/ng-dropzone
    $scope.dzOptions = UPLOAD_CONFIG;
    $scope.dzOptions.url = URL_SERVICE + '/service/PostAccessories';

    //Handle events for dropzone
    //Visit http://www.dropzonejs.com/#events for more events
    $scope.dzCallbacks = {
        'addedfile': function (file) {
            console.log(file);
            $scope.newFile = file;
            vm.uploadSize++;
        },
        removedfile: function (file) {
            vm.uploadSize--;
        },
        'success': function (file, response) {
            var data = eval("(" + response + ')');
            console.log('response ::==', data);
            if (data.status) {
                $window.location.href = data.redirect;
            } else {
                $window.alert(data.message);
            }
        },
        sending: function (file, xhr, data) {
            data.append("code", vm.accessories.code);
            data.append("name", vm.accessories.name);
            data.append("price", vm.accessories.price);
            data.append("type", vm.accessories.type);
            data.append("desc", vm.accessories.desc);
        },
        maxfilesexceeded: function (file) {
            $scope.dzMethods.removeFile(file);
        }
    };

    //Apply methods for dropzone
    //Visit http://www.dropzonejs.com/#dropzone-methods for more methods
    $scope.dzMethods = {};
    $scope.removeNewFile = function () {
        $scope.dzMethods.removeFile($scope.newFile); //We got $scope.newFile from 'addedfile' event callback
    }
    // ********************** dropzone ***************
    this.crayfishSubmit = function () {
        $scope.dzMethods.processQueue();
    }
}

function SalesCrayFishController(CrayfishService, UPLOAD_CONFIG, URL_SERVICE, $timeout, $log, $window, $scope) {
    var vm = this;
    this.imageList = [];
    this.crayfish = {};
    this.uploadFile = {};
    this.uploadSize = [];

    // ********************** dropzone ***************
    //https://github.com/thatisuday/ng-dropzone
    $scope.dzOptions = UPLOAD_CONFIG;
    $scope.dzOptions.url = URL_SERVICE + '/service/PostCrayfish';

    //Handle events for dropzone
    //Visit http://www.dropzonejs.com/#events for more events
    $scope.dzCallbacks = {
        'addedfile': function (file) {
            //console.log(file);
            $scope.newFile = file;
            vm.uploadSize++;
            console.log('$scope.dzMethods ::==',$scope.dzMethods);
            console.log('$scope.dzCallbacks ::==',$scope.dzCallbacks);
        },
        removedfile: function (file) {
                vm.uploadSize--;
        },
        'success': function (file, response) {
            var data = eval("(" + response + ')');
            console.log('response ::==', data);
            if (data.status) {
                $window.location.href = data.redirect;
            } else {
                $window.alert(data.message);
            }
        },
        sending: function (file, xhr, data) {
            data.append("code", vm.crayfish.code);
            data.append("name", vm.crayfish.name);
            data.append("price", vm.crayfish.price);
            data.append("color", vm.crayfish.color);
            data.append("age", vm.crayfish.age);
            data.append("desc", vm.crayfish.desc);
        },
        maxfilesexceeded: function (file) {
            $scope.dzMethods.removeFile(file);
        }
    };

    //Apply methods for dropzone
    //Visit http://www.dropzonejs.com/#dropzone-methods for more methods
    $scope.dzMethods = {};
    $scope.removeNewFile = function () {
        $scope.dzMethods.removeFile($scope.newFile); //We got $scope.newFile from 'addedfile' event callback
    }
    
    // ********************** dropzone ***************
    this.crayfishSubmit = function () {
        $scope.dzMethods.processQueue();
    }

}

function AccessoriesController(CrayfishService, $log) {
    var vm = this;
    this.accessoryList = [];
    this.typeList = [];
    this.priceList = [];
    this.filter = {};
    init();
    this.filterEvent = function () {
        vm.filter = {
            type: vm.type,
            price: vm.price
        }
        accessoriesList();
    }

    function init() {
        accessoriesList();
        CrayfishService.getListAccessoriesFilter().then(function success(response) {
            vm.typeList = response.type;
            vm.priceList = response.price;
        }, function fail(e) {
            $log.error(e);
        });
    }

    function accessoriesList() {
        CrayfishService.getListAccessories(vm.filter).then(function success(response) {
            vm.accessoryList = response;
        }, function fail(e) {
            $log.error(e);
        });
    }

}

function CrayfishsController(CrayfishService, $log) {
    var vm = this;
    this.crayfishList = [];
    this.ageList = [];
    this.colorList = [];
    this.priceList = [];
    this.filter = {};
    init();
    this.filterEvent = function () {
        vm.filter = {
            age: vm.age,
            color: vm.color,
            price: vm.price
        }
        crayfishList();
    }


    function init() {
        crayfishList();
        CrayfishService.getListCrayfishFilter().then(function success(response) {
            vm.ageList = response.ages;
            vm.colorList = response.colors;
            vm.priceList = response.price;
        }, function fail(e) {
            $log.error(e);
        });
    }

    function crayfishList() {
        CrayfishService.getListCrayfish(vm.filter).then(function success(response) {
            vm.crayfishList = response;
        }, function fail(e) {
            $log.error(e);
        });
    }

}


function DoCrayfishController($timeout) {
    var vm = this;
    $timeout(function () {
        $(document).ready(function () {

            $("#owl-demo").owlCarousel({
                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true,
                navigationText: ["<i class='fast backward icon red'></i>", "<i class='fast forward icon red'></i>"]

                        // "singleItem:true" is a shortcut for:
                        // items : 1, 
                        // itemsDesktop : false,
                        // itemsDesktopSmall : false,
                        // itemsTablet: false,
                        // itemsMobile : false

            });
        });
    }, 0)

}