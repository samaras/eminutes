<div class="container">
	<style type="text/css">
		.action-td button a, .view, .delete, .update {color: white !important; text-transform: uppercase; font-size: 11px;}
		.tbl-data th, .tbl-data td { text-align: center; }
		.tbl-data tbody tr td {vertical-align: middle; font-size: 15px;}
	</style>
	<div id="container">
		<p>
			<span class="article-header">Address Book</span>
		</p>
		<br />
		<div class="">
			<ul class="emin-actions">
				<li><a href="<?php echo site_url('people/index'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</a></li>
			</ul>
		</div>
		<br />
		<div class="container">
	<div class="registration-page">
		
		<h3 class="text-uppercase">Add Person to address book</h3>
		<p>&nbsp;</p>
		<?php if(strlen(validation_errors()) > 0): ?>
			<div class="alert alert-danger">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>

		<?php echo form_open('people/add_user'); ?>

		<div class="row">
			<div class="col-md-3">
				<label>First Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="first_name" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Last Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="last_name" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Username:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="username" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Password:</label>
			</div>
			<div class="col-md-4">
				<input type="password" name="password" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Confirm Password:</label>
			</div>
			<div class="col-md-4">
				<input type="password" name="passconfirm" value=""  />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="phone">Phone:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="phone" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="email">Email Address:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="email" value="" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label for="phone">Gender:</label>
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
				<label for="identity_number">ID Number:</label>
			</div>
			<div class="col-md-4">
				<input type="text" name="identity_number" value="" />
			</div>
		</div>

		<div class="row">
			<div style="margin-top: 25px;">&nbsp;</div>
			<div><input class="btn btn-primary" type="submit" value="Save" /></div>
		</div>

		</form>

	</div>
