app.directive('focusMe', ['$timeout', function ($timeout) {
	return {
		link: function (scope, element) {
			$timeout(function () {
				element[0].focus();
			}, 100);
		}
	};
}]);

app.directive('onEnter', function () {
	return {
		restrict: 'A',
		link: function (scope, element, attrs) {
			element.bind("keyup", function (event) {
				if (event.which === 13) {
					scope.$apply(function () {
						scope.$eval(attrs.onEnter);
					});
					event.preventDefault();
				}
			});
		}
	}
});

app.directive('maskCompanyPin', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function (event) {

				element.val(maskCompanyPINBR(element.val()));

				// Atualiza o valor do ngModel também
				ctrl.$setViewValue(element.val());
				ctrl.$render();

			});
		}
	}
});

app.directive('maskCurrency', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function (event) {

				var prefix = attrs.currencyPrefix != undefined ? attrs.currencyPrefix : null;
				element.val(maskCurrencyBR(element.val(),prefix));

				// Atualiza o valor do ngModel também
				ctrl.$setViewValue(element.val());
				ctrl.$render();

			});
		}
	}
});

app.directive('maskDate', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function (event) {

				element.val(maskDateBR(element.val()));
				ctrl.$setViewValue(element.val());
				ctrl.$render();

			});
		}
	}
});

app.directive('maskHours', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function (event) {

				element.val(maskHours(element.val()));
				ctrl.$setViewValue(element.val());
				ctrl.$render();

			});
		}
	}
});

app.directive('maskNumber', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function (event) {

				element.val(onlyNumbers(element.val()));

				// Atualiza o valor do ngModel também
				ctrl.$setViewValue(element.val());
				ctrl.$render();

			});
		}
	}
});

app.directive('maskPersonPin', function () {
	return {
		restrict: 'A',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function () {

				element.val(maskPersonPINBR(element.val()));

				if (ctrl && ctrl.$setViewValue){
					ctrl.$setViewValue(element.val());
					ctrl.$render();
				}

			});
		}
	}
});

app.directive('maskPhoneNumber', function () {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, element, attrs,ctrl) {
			element.bind("keyup", function (event) {

				element.val(maskPhoneNumberBR(element.val()));
				ctrl.$setViewValue(element.val());
				ctrl.$render();

			});
		}
	}
});