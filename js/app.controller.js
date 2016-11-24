app.controller('DoCrayfishController', DoCrayfishController)
        .controller('CrayfishsController', CrayfishsController)
        .controller('AccessoriesController', AccessoriesController)
        .controller('SalesCrayFishController', SalesCrayFishController)
        .controller('SalesAccessoriesController', SalesAccessoriesController);
function SalesAccessoriesController(CrayfishService, $timeout, $log, $window,$scope,URL_SERVICE) {
        var vm  = this;
    // ********************** dropzone ***************
    //https://github.com/thatisuday/ng-dropzone
    $scope.dzOptions = {
        url: URL_SERVICE + '/service/PostAccessories',
        paramName: 'myfile',
        autoProcessQueue: false,
        maxFilesize: '10',
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