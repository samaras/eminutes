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
		<div class="view_data">
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Name</span></div>
	            <div>: <?php echo $person->first_name ." ". $person->last_name; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Email</span></div>
	            <div>: <?php echo $person->email; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Username</span></div>
	            <div>: <?php echo $person->username; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Phone</span></div>
	            <div>: <?php echo $person->phone; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Last Logged In</span></div>
	            <div>: <?php echo  date('d-m-Y',strtotime($person->last_login)); ?></div>
			</div>
	</div>

</div>