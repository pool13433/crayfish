app.controller('DoCrayfishController', DoCrayfishController)
        .controller('CrayfishsController', CrayfishsController)
        .controller('AccessoriesController', AccessoriesController)
        .controller('SalesCrayFishController', SalesCrayFishController)
        .controller('SalesAccessoriesController', SalesAccessoriesController);
function SalesAccessoriesController(CrayfishService, $timeout, $log, $window) {
    $timeout(function () {
        init();
    }, 0);

    function init() {
        $('form[name="form-accessories"]').form({
            on: 'blur',
            inline: true,
            fields: {
                code: {identifier: 'code', rules: [
                        {type: 'empty', prompt: 'กรุณากรอกข้อมูล รหัส'},
                        {type: 'maxLength[20]', prompt: 'กรุณากรอกข้อมูล ไม่เกิน 20 ตัวอักษร'}
                    ]},
                name: {identifier: 'name', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล ชื่อ'}]},
                price: {identifier: 'price', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล ราคา'}, {type: 'number', prompt: 'กรุณากรอกข้อมูล ราคา เป็นตัวเลขเท่านั้น'}]},
                type: {identifier: 'type', rules: [{type: 'empty', prompt: 'กรุณาเลือกข้อมูล ประเภท'}]},
                desc: {identifier: 'desc', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล รายละเอียด'}]},
            },
            onSuccess: function (event, fields) {
                event.preventDefault();
                CrayfishService.postAccessories(fields).then(function success(response) {
                    console.log('response ::==', response);
                    $window.alert('title :: ' + response.title + '\n message :: ' + response.message);
                    if (response.status) {
                        $window.location = response.redirect;
                    }
                }, function fail(e) {
                    $log.error(e);
                });
            }
        });
    }
}

function SalesCrayFishController(CrayfishService, URL_SERVICE, $timeout, $log, $window) {
    var vm = this;
    this.imageList = [];
    this.crayfish = {};
    this.uploadFile = {};

    $timeout(function () {
        init();
        myDropzone();
    }, 1000);

    function init() {
        $('form[name="form-crayfish"]').form({
            on: 'blur',
            inline: true,
            fields: {
                code: {identifier: 'code', rules: [
                        {type: 'empty', prompt: 'กรุณากรอกข้อมูล รหัส'},
                        {type: 'maxLength[20]', prompt: 'กรุณากรอกข้อมูล ไม่เกิน 20 ตัวอักษร'}
                    ]},
                name: {identifier: 'name', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล ชื่อ'}]},
                price: {identifier: 'price', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล ราคา'}, {type: 'number', prompt: 'กรุณากรอกข้อมูล ราคา เป็นตัวเลขเท่านั้น'}]},
                color: {identifier: 'color', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล สี'}]},
                age: {identifier: 'age', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล อายุ'}, {type: 'number', prompt: 'กรุณากรอกข้อมูล อายุ เป็นตัวเลขเท่านั้น'}]},
                desc: {identifier: 'desc', rules: [{type: 'empty', prompt: 'กรุณากรอกข้อมูล รายละเอียด'}]},
            },
            onSuccess: function (event, fields) {
                event.preventDefault();
//                CrayfishService.postCrayfish(fields).then(function success(response) {
//                    console.log('response ::==', response);
//                    $window.alert('title :: ' + response.title + '\n message :: ' + response.message);
//                    if (response.status) {
//                        $window.location = response.redirect;
//                    }
//                }, function fail(e) {
//                    $log.error(e);
//                });


            }
        });
    }

    function myDropzone() {
        $(document).ready(function () {
            Dropzone.autoDiscover = false;
            Dropzone.options.myAwesomeDropzone = {// The camelized version of the ID of the form element
                // The configuration we've talked about above
                url: "/file/post",
                previewsContainer: ".dropzone-previews",
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100
            }
        });

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