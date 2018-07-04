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
				<li><a href="<?php echo site_url('people/create'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a></li>
			</ul>
		</div>
		<br />
		<table class="table table-striped tbl-data">
	        <thead>
	          <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>Email</th>
	            <th>Username</th>
	            <th>Phone</th>
	            <th>Last Logged In</th>
	            <th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>
			<?php if(count($people) > 0): ?>
			
		        <?php $i = 1; ?>
		        <?php foreach ($people as $person) { ?>
		          <tr>
		            <td><?php echo $i; $i++; ?></td>
		            <td><?php echo $person->first_name ." ". $person->last_name; ?></td>
		            <td><?php echo $person->email; ?></td>
		            <td><?php echo $person->username; ?></td>
		            <td><?php echo $person->phone; ?></td>
		            <td><?php echo  date('d-m-Y',strtotime($person->last_login)); ?></td>
		            <td class="action-td">
			            <?php
			            	echo anchor('people/view/'.$person->id,'<i class="icon-search-plus">view</i>',array('class'=>'view btn btn-info')).' ';
	                		echo anchor('people/update/'.$person->id,'<i class="icon-pencil">update</i>',array('class'=>'update btn btn-warning')).' ';
	                		echo anchor('people/delete/'.$person->id,'<i class="icon-trash">delete</i>',array('class'=>'delete btn btn-danger','onclick'=>"return confirm('Are you sure want to delete this person?')")).' ';
                		?>
            		</td>
		          </tr>
				<?php } ?>
	  		<?php else: ?>
	  			<tr><td colspan="7"><p style="text-align: center">No users found </p></td></tr>
			<?php endif; ?>
			</tbody>
		</table>
		<div style="text-align: center;">
			<ul class="pagination">
				<?php echo $pagination; ?>
			</ul>
		</div>
	</div>

</div>