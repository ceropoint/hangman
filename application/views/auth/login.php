	
	<div ng-controller="AuthController">
		<form 
			name="loginForm" 
			action="<?php echo PATH; ?>auth/loginUser" 
			method="post" 
			autocomplete="off" 
			novalidate 
			ng-submit="loginUser($event, user)">
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
				ng-show="loginForm.email.$dirty && loginForm.email.$invalid">
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
					ng-change="hasErrors = false">
			</div>
			<div ng-show="hasErrors === true" class="alert alert-danger ng-cloak">
				<p ng-repeat="error in errors">{{ error }}</p>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" ng-disabled="loginForm.$invalid" value="Sign in">
			</div>
		</form>
	</div>