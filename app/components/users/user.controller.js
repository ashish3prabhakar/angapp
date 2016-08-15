angular.module('myApp').controller("usrController", ['$scope','$http','$httpParamSerializerJQLike','userDataService', function ($scope,$http,$httpParamSerializerJQLike,userDataService) {
 
$scope.users = userDataService.fetchData();

$scope.showAddForm = false;
$scope.showEditForm = false;

$scope.toggleAddNew = function() {
$scope.showAddForm = !$scope.showAddForm;
return false;
};

$scope.toggleEdit = function() {
$scope.showEditForm = !$scope.showEditForm;
return false;
};

$scope.usrSubmit = function() {

var transform = function(data) {
	return $httpParamSerializerJQLike(data);
}


$http.post('http://localhost/angapp/api/adduser.php',$scope.newUser,
{
headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
transformRequest: transform
}).then(function (addUserResponse){
$scope.addUserMsg = addUserResponse.data.message;
$scope.users = userDataService.fetchData();
$scope.newUser = {};
});
};

$scope.usrEditLoad = function(editUserId){
$scope.editArr = {'userid':editUserId}; 
var transform = function(data) {
	return $httpParamSerializerJQLike(data);
}
 
$http.post('http://localhost/angapp/api/fetchuser.php',$scope.editArr,
{
headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
transformRequest: transform
})
.then(function(editUserResponse){
$scope.editUserMsg = editUserResponse.data.message;
$scope.editUser = editUserResponse.data.users;
$scope.toggleEdit();
console.log($scope.editUser);
});

};

$scope.usrUpdate = function() {

var transform = function(data) {
	return $httpParamSerializerJQLike(data);
}


$http.post('http://localhost/angapp/api/edituser.php',$scope.editUser,
{
headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
transformRequest: transform
}).then(function (editUserResponse){
$scope.editUserMsg = editUserResponse.data.message;
$scope.users = userDataService.fetchData();
$scope.newUser = {};
$scope.editUser = {};
$scope.toggleEdit();
});
};


$scope.usrDelete = function(delUserId){
$scope.delArr = {'userid':delUserId}; 
var transform = function(data) {
	return $httpParamSerializerJQLike(data);
}
 
$http.post('http://localhost/angapp/app/api/deluser.php',$scope.delArr,
{
headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
transformRequest: transform
})
.then(function(delUserResponse){
$scope.delUserMsg = delUserResponse.data.message;
$scope.users = userDataService.fetchData();
console.log($scope.delArr);
});

}; 

/*$scope.usrDataBuild = function (usrArrData) {
 var users = [];
var uid = 0;
angular.forEach(usrArrData , function(value,key){
	uid = key;
	users.push({id: key, firstname: value['firstname'],lastname: value['lastname'], email : value['email'] , pwd : value['pwd'] , contactno : value['contactno']});
	});
return users;
console.log(users);
}; */

}]);
