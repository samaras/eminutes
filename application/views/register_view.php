<div class="container">
	<div id="container" class="registration-page">
		
		<p>
			<span class="article-header">Register</span>
		</p>
		<p>&nbsp;</p>
		<?php if(strlen(validation_errors()) > 0): ?>
			<div class="alert alert-danger">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>

		<?php echo form_open('home/signup'); ?>

		<div class="row">
			<div class="col-md-3">
				<label>First Name*:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="first_name" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Last Name*:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="last_name" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Username*:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="username" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Password*:</label>
			</div>
			<div class="col-md-4">
				<input type="password" name="password" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Confirm Password*:</label>
			</div>
			<div class="col-md-4">
				<input type="password" name="passconfirm" value=""  />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="phone">Phone*:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="phone" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="email">Email Address*:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="email" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="phone">Gender*:</label>
			</div>
			<div class="col-md-4">
				<div class="btn-group" data-toggle="buttons">
				  <label class="btn btn-primary">
				    <input type="radio" name="gender" value="0" id="inputFemale" autocomplete="off"> Female
				  </label>
				  <label class="btn btn-primary">
				    <input type="radio" name="gender" value="1" id="inputMale" autocomplete="off"> Male
				  </label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="identity_number">ID Number*:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="identity_number" value="" />
			</div>
		</div>

		<div class="row">
			<div style="margin-top: 25px;">&nbsp;</div>
			<div><input class="btn btn-primary" type="submit" value="Submit" /></div>
		</div>

		</form>

	</div>
</div>