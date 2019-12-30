app.config(['$routeProvider', function($routeProvider) {

    $routeProvider.
    //CUSTOMER
    when('/axapta-export-pkg/axapta-export/list', {
        template: '<axapta-export-list></axapta-export-list>',
        title: 'AxaptaExports',
    }).
    when('/axapta-export-pkg/axapta-export/add', {
        template: '<axapta-export-form></axapta-export-form>',
        title: 'Add AxaptaExport',
    }).
    when('/axapta-export-pkg/axapta-export/edit/:id', {
        template: '<axapta-export-form></axapta-export-form>',
        title: 'Edit AxaptaExport',
    });
}]);