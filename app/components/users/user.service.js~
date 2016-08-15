angular.module('myApp').service('userDataService',['$http','$httpParamSerializerJQLike',   
function ($http) { 
this.fetchData = function() {
  var userlist = [];
$http.get(	
"http://localhost/angapp/app/api/fetchuserlist.php").then(function (response){
var usrArr = response.data;

var uid = 0;
angular.forEach(usrArr , function(value,key){
	uid = key;
	userlist.push({id: key, firstname: value['firstname'],lastname: value['lastname'], email : value['email'] , pwd : value['pwd'] , contactno : value['contactno']});
	});
});

return userlist;
};

}]);

