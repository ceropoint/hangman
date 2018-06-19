angular.module('hangmanApp.services', [])

.service('WordService', function($http){

	this.getUserStats = function(callback){
		$http.get('game/getStats').then(function(res){
			callback(res.data);
		}, function(err){
			console.log(err);
		});
	};

	this.getRandomWord = function(catId, callback){
		$http.get('game/getRandomWord/' + catId).then(function(res){
			callback(res.data);
		}, function(err){
			console.log(err);
		});
	};

	this.updateStats = function(updatedStat){
		$http.post('game/updateStats', { stat: updatedStat }).then(function(res){
			console.log(res.data);
		}, function(err){
			console.log(err);
		});
	};
})

.service('AuthService', function($http){

	this.login = function(user, callback){
		$http.post('loginUser', user).then(function(res){
			callback(res.data);
		}, function(err){
			console.log(err);
		});
	};

	this.register = function(user, callback){
		$http.post('registerUser', user).then(function(res){
			callback(res.data);
		}, function(err){
			console.log(err);
		});
	};
});