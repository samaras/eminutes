<div class="container">
	<div id="container" class="registration-page">
		
		<p>
			<span class="article-header">Meeting Invites</span>
		</p>
		<p>&nbsp;</p>

		<br />
		
		<table class="table table-striped tbl-data">
	        <thead>
	          <tr>
	            <th>#</th>
	            <th>Title</th>
	            <th>Chairperson</th>
	            <th>Secretary</th>
	            <th>Date</th>
	            <th>Location</th>
	            <th></th>
	            <th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>

			<?php if(count($meeting_invites) > 0): ?>
		        <?php $i = 1; ?>
		        <?php foreach ($meeting_invites as $invites) { ?>
		          <tr>
		            <td><?php echo $i; $i++; ?></td>
		            <td><?php echo $invites['title']; ?></td>
		            <td><?php echo $invites['organiser']; ?></td>
		            <td><?php echo $invites['minutes_taker']; ?></td>
		            <td><?php echo $invites['when']; ?></td>
		            <td><?php echo $invites['location']; ?></td>
		            <td><?php echo anchor('meeting/agenda/'.$invites['meeting_id'],'Agenda',array('class'=>'agenda-btn')); ?></td>
		            <td>
		            	<?php
		            		echo anchor('meeting/accept/'.$invites['inv_id'],'<i class="icon-search-plus">Accept</i>').'  | ';
	                		echo anchor('meeting/decline/'.$invites['inv_id'],'<i class="icon-pencil">Decline</i>').' ';
		             	?>
	             	</td>
		          </tr>
				<?php } ?>
	  		<?php else: ?>
	  			<tr><td colspan="8"><p style="text-align: center">No meetings invites found </p></td></tr>
			<?php endif; ?>
	    	</tbody>
	  	</table>

	</div>
</div>