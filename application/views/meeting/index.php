<div class="container">

	<div id="container">
		<p> 
			<span class="article-header">Meetings</span>
		</p>
		<br />
		<div class="">
			<ul class="emin-actions">
				<li><a href="<?php echo site_url('meeting/create'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a></li>
			</ul>
		</div>

		<table class="table table-striped tbl-data">
	        <thead>
	          <tr>
	            <th>#</th>
	            <th>Title</th>
	            <th>Organiser</th>
	            <th>Secretary</th>
	            <th>Date</th>
	            <th>Location</th>
	            <th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>

			<?php if(count($meetings) > 0): ?>
		        <?php $i = 1; ?>
		        <?php foreach ($meetings as $meeting) { ?>
		          <tr>
		            <td><?php echo $i; $i++; ?></td>
		            <td><?php echo $meeting->title; ?></td>
		            <td><?php echo $meeting->organiser; ?></td>
		            <td><?php echo $meeting->minutes_taker; ?></td>
		            <td><?php echo $meeting->when; ?></td>
		            <td><?php echo $meeting->location; ?></td>
		            <td><?php echo anchor('meeting/agenda/'.$meeting->id,'Agenda',array('class'=>'agenda-btn')); ?></td>
		            <td>
		            	<?php
		            		echo anchor('meeting/view/'.$meeting->id,'<i class="icon-search-plus">view</i>',array('class'=>'view btn btn-info')).' ';
	                		echo anchor('meeting/update/'.$meeting->id,'<i class="icon-pencil">update</i>',array('class'=>'edit update btn btn-warning')).' ';
	                		echo anchor('meeting/delete/'.$meeting->id,'<i class="icon-trash">delete</i>',array('class'=>'delete btn btn-danger','onclick'=>"return confirm('Are you sure want to delete this meeting?')")).' ';
		             	?>
	             	</td>
		          </tr>
				<?php } ?>
	  		<?php else: ?>
	  			<tr><td colspan="8"><p style="text-align: center">No meetings found </p></td></tr>
			<?php endif; ?>
	    	</tbody>
	  	</table>
	</div>

</div>