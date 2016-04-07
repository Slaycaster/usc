var app = angular.module('uscApp', ['angularUtils.directives.dirPagination'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});