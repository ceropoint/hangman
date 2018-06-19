	
	<div ng-controller="GameController">

		<!-- Start word category selector -->
		<div class="game-category" ng-hide="gameStarted">
			<h2>Choose category</h2>
			<div class="btn-group btn-group-lg" role="group">
				<?php foreach($this->get('categories') as $cat): ?>
					<button type="button" class="btn btn-default" 
					ng-click="startGame(<?php echo esc($cat->id); ?>)"><?php echo esc($cat->name); ?></button>
				<?php endforeach; ?>
			</div>			
		</div>
		<!-- End word category selector  -->

		<!-- Start game room -->
		<div class="game-room" ng-show="gameStarted">

			<!-- Start word board  -->
			<div class="row">
				<div class="col-md-12 word-area">
					<div 
						class="panel panel-default" 
						ng-class="{'panel-success': gameResult === 'won', 'panel-danger': gameResult === 'lost', 'panel-default': gameResult === null}">
		  				<div class="panel-heading clearfix">
							  <div ng-show="gameResult === null" class="row">
								<div class="hint-holder col-md-6 text-left">Hint: {{ hint }} </div>
								<div class="guess-count col-md-6 text-right">Guesses left: {{ 5 - errorCount }}</div>
							  </div>
							  <div ng-show="gameResult !== null" class="row">
									<div ng-show="gameResult === 'won'" class=" col-md-10">
										Congratulations! You have guessed the word!
									</div>
									<div ng-show="gameResult === 'lost'" class="col-md-10 ">
										Sorry! You got hanged!
									</div>
									<div class="col-md-2">
										<button class="btn btn-primary pull-right" type="button" ng-click="newGame()">New game</button>
									</div>
								</div>
						</div>
		  				<div class="panel-body">
							  <div class="col-md-8 word-to-guess ng-cloak">
							  	{{ hiddenWord }}
							  </div>
							  <div class="col-md-4 drawing">
								<img ng-hide="gameResult === 'won'" ng-src="img/hang{{ errorCount }}.png" alt="Hangman">
								<img ng-show="gameResult === 'won'" ng-src="img/hang6.png" alt="Hangman">
							</div>	
						</div>
					</div>		
				</div>							
			</div>
			<!-- End word board -->

			<!-- Start keyboard and controls -->
			<div ng-hide="gameResult !== null" class="row">
				<div class="btn-group letters col-md-8" role="group">
					<?php foreach($this->get('alphabet') as $letter): ?>
						<button class="btn btn-default" type="button" 
						ng-disabled="disabledLetters.indexOf('<?php echo esc($letter); ?>') > -1"
						ng-click="guessLetter('<?php echo esc($letter); ?>')"><?php echo esc(strtoupper($letter)); ?></button>
					<?php endforeach; ?>
				</div>				
				<div class="col-md-4">
					<div class="form-group form-inline">
						<label for="fullWord">Guess word:</label>
						<input class="form-control" type="text" id="fullWord" name="fullWord" ng-model="fullWord">
						<button class="btn btn-success" ng-disabled="fullWord.length < 5" ng-click="guessWord(fullWord)">Guess</button>
					</div>					
				</div>
			</div>
			<!-- End keyboard and controls -->
		</div>
		<!-- End game room --> 

		<!-- Start user stats -->
		<div class="user-stats">
			<h2>Player game statistics</h2>
			<ul class="list-group">
				<li class="list-group-item" ng-repeat="(name, val) in stats">
					{{ name | underscore_replace }}
				<span type="text" class="badge">{{ val }}</span>
				</li>
			</ul>		
		</div>
		<!-- End user stats -->		
	</div>