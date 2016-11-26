app.controller('DoCrayfishController', DoCrayfishController)
        .controller('CrayfishsController', CrayfishsController)
        .controller('AccessoriesController', AccessoriesController)
        .controller('SalesCrayFishController', SalesCrayFishController)
        .controller('SalesAccessoriesController', SalesAccessoriesController)
        .controller('LocationController', LocationController);

function LocationController($scope, CrayfishService, $log) {
    var vm = this;
    //console.log('Google Maps API version: ' + google.maps.version);
    this.locationList = [];
    this.provinceList = [];
    this.locationLocalList = [];
    var map = CrayfishMap();
    map.getPlaceRealtime(1);
    map.getProvincePlace();

    this.focusLocation = function (provinceId) {
        map.getPlaceRealtime(provinceId);
    }

    function CrayfishMap() {
        var map = {};
        var options = {
            zoomDefault: 10,
        };        
        return{
            getProvincePlace: function () {
                CrayfishService.getProvinceLocation().then(function success(response) {
                    vm.provinceList = response;
                }, function fail(e) {
                    $log.error(e);
                });
            },
            getPlaceRealtime: function (provinceId) {
                var self = this;
                CrayfishService.getPlaceLocation().then(function success(response) {
                    console.log('response ::==', response);
                    vm.locationLocalList = response;
                    vm.locationList = _.map(response, function (location) {
                        //console.log('location ::==', location);
                        return  {
                            title: location.pla_title,
                            lat: parseFloat(location.pla_latitude),
                            lng: parseFloat(location.pla_longitude),
                            desc : location.pla_desc
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
                
                var content = '<h1>'+location.title+'</h1><h3>'+location.desc+'</h3>';
                
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


function SalesAccessoriesController(CrayfishService, $timeout, $log, $window, $scope, URL_SERVICE) {
    var vm = this;
    // ********************** dropzone ***************
    //https://github.com/thatisuday/ng-dropzone
    $scope.dzOptions = {
        url: URL_SERVICE + '/service/PostAccessories',
        paramName: 'myfile',
        autoProcessQueue: false,
        maxFilesize: '10',
        dictDefaultMessage: 'เลือกรูปสินค้าของคุณ สูงสุด 10 ไฟล์',
        uploadMultiple: true, // Adding This 
        acceptedFiles: 'image/jpeg, images/jpg, image/png',
        addRemoveLinks: true
    };
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

function SalesCrayFishController(CrayfishService, URL_SERVICE, $timeout, $log, $window, $scope) {
    Dropzone.autoDiscover = false;
    var vm = this;
    this.imageList = [];
    this.crayfish = {};
    this.uploadFile = {};
    this.uploadSize = [];

    // ********************** dropzone ***************
    //https://github.com/thatisuday/ng-dropzone
    $scope.dzOptions = {
        url: URL_SERVICE + '/service/PostCrayfish',
        paramName: 'myfile',
        autoProcessQueue: false,
        maxFilesize: '10',
        dictDefaultMessage: 'เลือกรูปสินค้าของคุณ สูงสุด 10 ไฟล์',
        uploadMultiple: true, // Adding This 
        acceptedFiles: 'image/jpeg, images/jpg, image/png',
        addRemoveLinks: true
    };
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
            data.append("code", vm.crayfish.code);
            data.append("name", vm.crayfish.name);
            data.append("price", vm.crayfish.price);
            data.append("color", vm.crayfish.color);
            data.append("age", vm.crayfish.age);
            data.append("desc", vm.crayfish.desc);
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