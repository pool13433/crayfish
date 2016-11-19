app.controller('CrayfishController', CrayfishController);

function CrayfishController($timeout) {
    var vm = this;

    $timeout(function () {
        $(document).ready(function () {

            $("#owl-demo").owlCarousel({
                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true,
                navigationText: ["<i class='fast backward icon red'></i>","<i class='fast forward icon red'></i>"]

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