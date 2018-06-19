angular.module('hangmanApp', ['ui.bootstrap', 'hangmanApp.services'])

.controller('GameController', function($scope, WordService){
	$scope.stats = {};
	resetGame();

	// Get user stats
	WordService.getUserStats(function(data){
		for(var x in data){
			$scope.stats[x] = data[x];
		}
	});

	// Initiate game
	$scope.startGame = function(catId){
		$scope.gameStarted = true;
		$scope.gameResult = null;

		WordService.getRandomWord(catId, function(data){
			$scope.hint = data.hint;
			$scope.answer = data.name;
			$scope.hiddenWord = hideLetters(data.name);
		});
	};

	// Respond to user guess
	$scope.guessLetter = function(letter){
		$scope.disabledLetters.push(letter);

		// Update stats
		WordService.updateStats('letter_guesses');
		$scope.stats.letter_guesses++;

		if(letterExists(letter)){
			showLetter(letter);
		}else{
			$scope.errorCount++;

			if($scope.errorCount === 5) gameOver('lost');
		}
	};

	$scope.guessWord = function(){
		// Check if whole word was guessed
		if($scope.fullWord.toLowerCase() === $scope.answer.toLowerCase()){
			$scope.hiddenWord = $scope.answer;
			gameOver('won');

			WordService.updateStats('full_words_guessed');
			$scope.stats.full_words_guessed++;
		}else{
			gameOver('lost');
		}
	};

	$scope.newGame = function(){
		resetGame();
	};

	// Hide letters from word
	function hideLetters(word){
		var hiddenWord = '';
		var len = word.length;

		// Check if word consists of more than one part
		if(word.indexOf(' ') > -1){
			var words = word.split(' ');

			// Repeat process for each part
			for(var i = 0; i < words.length; i++){
				hiddenWord += hideLetters(words[i]);

				if(i < words.length - 1) hiddenWord += ' ';
			}

			return hiddenWord;
		}

		for(var j = 0; j < len; j++){
			// Replace all letters except first and last with _	
			hiddenWord += (j > 0 && j < len - 1) ? '_' : word[j];
		}

		return hiddenWord;
	}

	function letterExists(letter){
		return $scope.answer.indexOf(letter) > -1;
	}

	function showLetter(letter){	
		var indexes = [];
		indexes = findIndex(indexes, $scope.answer, letter, 0);

		var newWord = '';

		// Show letter at all indexes where it exists
		for(var i = 0; i < $scope.hiddenWord.length; i++){
			newWord += (indexes.indexOf(i) > -1) ? letter : $scope.hiddenWord[i];
		}

		$scope.hiddenWord = newWord;

		// Check if all letters have been shown
		if($scope.hiddenWord === $scope.answer) gameOver('won');
	}

	// Find all occurances of a letter
	function findIndex(indexes, word, letter, start){
		var letterIndex = word.indexOf(letter, start);
		
		if(letterIndex > -1){
			indexes.push(letterIndex);

			findIndex(indexes, word, letter, letterIndex + 1);
		}

		return indexes;
	}

	function gameOver(outcome){
		$scope.gameResult = outcome;

		WordService.updateStats(`games_${outcome}`);

		$scope.stats.games_played++;
		$scope.stats[`games_${outcome}`]++;
	}

	// Reset game values
	function resetGame(){
		$scope.gameStarted = false;
		$scope.disabledLetters = [];
		$scope.errorCount = 0;
		$scope.fullWord = '';
		$scope.gameResult = null;
	}
})

.controller('AuthController', function($scope, $window, AuthService){
	resetErrors();

	$scope.loginUser = function(e, user){
		e.preventDefault();
		resetErrors();

		AuthService.login(user, function(data){
			if(data.success){
				// If login successful, redirect to home page
				var url = $window.location.href;
				var pos = url.indexOf('auth');
				var dest = url.substr(0, pos);

				$window.location.href = dest;	
			}else{
				showErrors(data.errors);
			}
		});
	};

	$scope.registerUser = function(e, user){
		e.preventDefault();
		resetErrors();

		AuthService.register(user, function(data){
			if(data.success){
				$scope.user = {};
				$scope.registrationSuccess = true;
			}else{
				showErrors(data.errors);
			}
		});
	};

	// Show errors to user
	function showErrors(errors){
		$scope.hasErrors = true;

		// Check if return value is an object
		if(typeof errors === 'object'){
			for(var x in errors){
				for(var i = 0; i < errors[x].length; i++){
					$scope.errors.push(errors[x][i]);
				}
			}	
		}else{
			$scope.errors.push(errors);
		}
	}

	// Reset error values
	function resetErrors(){
		$scope.hasErrors = false;
		$scope.errors = [];	
	}
})

// Custom filter to replace underscores in string
.filter('underscore_replace', function(){
	return function(input){
		return input.replace(/_/g, ' ');
	};
});