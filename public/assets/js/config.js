var app = angular.module('app',['ngSanitize','ui.bootstrap','ngFileUpload','ui.select','ui.tree','chart.js']);

app.config(['$compileProvider', function ($compileProvider) {
	$compileProvider.debugInfoEnabled(false);
}]);

app.config(['ChartJsProvider', function (ChartJsProvider) {
    // Configure all charts
    ChartJsProvider.setOptions({
      chartColors: ['#0080FF', '#FF8A80','#FF8000'],
      responsive: true
    });
    // Configure all line charts
    ChartJsProvider.setOptions('line','data','labels','options','series','click','hover','colors','dataset-override',{
      showLines: true
    });
}]);

app.directive('changeOnBlur', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, elm, attrs, ngModelCtrl) {
			if (attrs.type === 'radio' || attrs.type === 'checkbox')
				return;

			var expressionToCall = attrs.changeOnBlur;

			var oldValue = null;
			elm.bind('focus', function () {
				oldValue = elm.val();
			});

			elm.bind('blur', function () {
				var newValue = elm.val();
				if (newValue !== oldValue) {
					scope.$eval(expressionToCall);
				}
			});
		}
	};
});