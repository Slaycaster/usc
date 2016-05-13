var app = angular.module('unitScorecardApp', ['angularUtils.directives.dirPagination'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});


