chefmindApp.directive('fileModel', ['$parse', function($parse){
	return {
		restrict: 'A',
		link: function(scope, elemnt, attr){
			var model = $parse(attr.fileModel);
			var modelSetter = model.assign;

			element.bind('change', function(){
				scope.$apply(function(){
					modelSetter(scope, element[0].files[0])
				})
			})
		}
	}
}])