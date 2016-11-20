app.service('CrayfishService', CrayfishService);

function CrayfishService($q, URL_SERVICE) {
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
        }
    }
}

