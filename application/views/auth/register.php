	
	<div ng-controller="AuthController">
		<form 
			name="registerForm" 
			action="<?php echo PATH; ?>auth/registerUser" 
			method="post" 
			autocomplete="off" 
			novalidate 
			ng-submit="registerUser($event, user)">

			<div class="form-group">
				<label for="email">Email: <span class="required">*</span></label>
				<input 
					id="email"
					class="form-control"
					name="email"
					type="email"
					autofocus 
					required 
					ng-model="user.email"  
					ng-change="hasErrors = false">
			</div>
			<div 
				class="alert alert-danger ng-cloak"
				ng-show="!registrationSuccess && (registerForm.email.$dirty && registerForm.email.$invalid)">
				Invalid email.
			</div>
			<div class="form-group">
				<label for="password">Password: <span class="required">*</span></label>
				<input 
					id="password"
					class="form-control" 
					name="password" 
					type="password" 
					required 
					ng-model="user.password" 
					ng-minlength="6"   
				  	ng-change="hasErrors = false">
			</div>
			<div 
				class="alert alert-danger ng-cloak" 
				ng-show="!registrationSuccess && (registerForm.password.$dirty && registerForm.password.$error.minlength)">
				Password must be longer than 6 characters.
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm password: <span class="required">*</span></label>
				<input 
					id="confirm_password"
					class="form-control" 
					name="confirm_password"
					type="password" 
					required 
					ng-model="user.confirm_password"
					ng-change="hasErrors = false">
			</div>
			<div ng-show="hasErrors === true" class="alert alert-danger ng-cloak">
				<p ng-repeat="error in errors">{{ error }}</p>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" ng-disabled="registerForm.$invalid" value="Register">
			</div>
		</form>
		
		<div ng-show="registrationSuccess === true" class="ng-cloak">
			<div class="alert alert-success">Your registration was successfull! You can now login with your email. </div>	
		</div>
	</div>