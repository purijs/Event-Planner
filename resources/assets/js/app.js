/**
 * Created by JaskaranSingh on 27-09-2016.
 */
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('autocomplete')),
    {types: ['geocode']});
}
var app=angular.module("planner",[]);
app.controller("MainController",function ($scope) {
    $scope.getDatetime = function() {
        return (new Date).toLocaleFormat("%A, %B %e, %Y");
    };
	$scope.vald=function(){
		if($scope.etime>$scope.stime) {
			$scope.planner.$valid=true
		}
		else
			$scope.planner.$valid=false
	}
    $scope.fsVal=true
    $scope.showEvent=false
    $scope.user=[]
    $scope.events=[]
    $scope.id=0
    $scope.validate=function(userInfo){
        if($scope.signup.$valid) {
            $scope.user.push({
                fname: userInfo.name
            });
            $scope.fsVal=false
            $scope.evVal=true
			angular.element(document.querySelector("#eventsSec")).removeClass("ev-c");
        }
        else {
            $scope.fsVal=true
            $scope.evVal=false
        }
    };
    $scope.validatePlanner=function(userPlannerInfo){
        if($scope.planner.$valid) {
            $scope.id++
            $scope.events.push({
                fname: $scope.user[0].fname, eventName:$scope.userPlannerInfo.eventName,
                eventHost:$scope.userPlannerInfo.eventHost,eventLoc:$scope.userPlannerInfo.geo,
                eventType:$scope.userPlannerInfo.eList,eventSDate:$scope.sdate,
                eventEDate:$scope.edate,eventSTime:$scope.stime,eventGInfo:$scope.userPlannerInfo.gInfo,
                eventETime:$scope.etime,eventGuest:$scope.userPlannerInfo.gList,id:$scope.id
            });
            console.log($scope.id)
            $scope.fsVal=false
            angular.element(document.querySelector("#eventsSec")).addClass("ev-c");
            $scope.showEvent=true
        }
    };
    $scope.callFocus=function () {
		angular.element('#ev-create').trigger('focus');
	}
    $scope.redo=function () {
        $scope.fsVal=false
        angular.element(document.querySelector("#eventsSec")).removeClass("ev-c");
        $scope.showEvent=false
    }
});
app.directive('formAutofillFix', function() {
    return function(scope, elem, attrs) {
        if(attrs.ngSubmit) {
            setTimeout(function() {
                elem.unbind('submit').bind('submit', function(e) {
                    e.preventDefault();
                    elem.find('input, textarea, select').trigger('input').trigger('change').trigger('keydown');
                    scope.$apply(attrs.ngSubmit);
                });
            }, 0);
        }
    };
});