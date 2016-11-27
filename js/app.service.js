app.service('CrayfishService', CrayfishService)
        .service('AuthorizationService', AuthorizationService);

function AuthorizationService($q, URL_SERVICE, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    return {
        checkMemberProfile: function (facebook) {
            var defer = $q.defer();
            $http({
                url: URL_SERVICE + '/service/CheckProfileSystem',
                method: 'POST',
                data: $.param(facebook)
            }).then(function success(response) {
                defer.resolve(response.data);
            }, function error(e) {
                defer.reject(e);
            });
            return defer.promise;
        }
    }
}

function CrayfishService($q, URL_SERVICE, $http) {
    return {
        getListCrayfish: function (filter) {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetCrayfishs', filter, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getListCrayfishFilter: function () {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetCrayfishFilter', {}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getListAccessoriesFilter: function () {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetAccessoryFilter', {}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getListAccessories: function (filter) {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetAccessories', filter, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        postCrayfish: function (form) {
            var defer = $q.defer();
            $.ajax({
                type: "POST",
                url: URL_SERVICE + '/service/postCrayfish',
                data: form,
                dataType: 'json'
            }).done(function (data) {
                defer.resolve(data);
            }).fail(function (jqXHR, textStatus) {
                defer.reject(jqXHR);
            });
            return defer.promise;
        },
        postAccessories: function (form) {
            var defer = $q.defer();
            $.ajax({
                type: "POST",
                url: URL_SERVICE + '/service/PostAccessories',
                data: form,
                dataType: 'json'
            }).done(function (data) {
                defer.resolve(data);
            }).fail(function (jqXHR, textStatus) {
                defer.reject(jqXHR);
            });
            return defer.promise;
        },
        getPlaceLocation: function () {
            var defer = $q.defer();
            $http.get(URL_SERVICE + '/service/GetMarketPlaceLocation', {}).then(function success(response) {
                defer.resolve(response.data);
            }, function error(e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getProvinceLocation: function () {
            var defer = $q.defer();
            $http.get(URL_SERVICE + '/service/GetProvinceMinPlace', {}).then(function success(response) {
                defer.resolve(response.data);
            }, function error(e) {
                defer.reject(e);
            });
            return defer.promise;
        }
    }
}

