
<div class="container">
	<div id="container" class="registration-page">
		
		<p> 
			<span class="article-header">Create Meeting</span>
		</p>
		<p>&nbsp;</p>
		<?php if(strlen(validation_errors()) > 0): ?>
			<div class="alert alert-danger">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>

		<?php echo form_open('meeting/save_meeting'); ?>

		<div class="row"> 
			<div class="col-md-6">
				<div class="row">
					<label>Title:</label>
				</div>
				<div class="row">
					<input type="text" name="title" value="" />
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<label>Meeting Role:</label>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="btn-group" data-toggle="buttons">
						  <label class="btn btn-primary">
						    <input type="radio" name="meeting_role" value="0" id="inputChair" autocomplete="off">Chairperson
						  </label>
						  <label class="btn btn-primary">
						    <input type="radio" name="meeting_role" value="1" id="inputMintaker" autocomplete="off">Secretary
						  </label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<span id="otherRole"></span>
			</div>
			<div class="col-md-6">
				<input class="" name="other_role" value="" style="display: none;" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<label for="description">Description:</label>
				</div>
				<div class="row">
					<textarea style="min-height: 150px; min-width: 400px" name="description" required></textarea>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<label>Date:</label>
				</div>
				<div class="row">
					<input id="datetimepicker" name="date" type="text" style="display: none;">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<label>Location:</label>
				</div>
				<div class="row">
					<input type="text" name="location" value="" required />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="row"> 
					<label>Attendees:</label>
				</div>
				<div class="row">
					<input id="" type="text" name="attendees" class="" placeholder="email, email, email, email"  />
				</div>
			</div>
		</div>

		<div class="row">
			<div style="margin-top: 25px;">&nbsp;</div>
			<div class="col-md-6">
				<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
		</div>

		</form>

	</div>
</div>
<script type="text/javascript">

jQuery('#datetimepicker').datetimepicker({
  format:'dateFormat: "dd:MM:yyyy hh:mm:ss',
  inline:true,
});
</script>