<div class="container">
<style type="text/css">
	.action-td button a, .view, .delete, .update {color: white !important; text-transform: uppercase; font-size: 11px;}
	.tbl-data th, .tbl-data td { text-align: center; }
	.tbl-data tbody tr td {vertical-align: middle; font-size: 15px;}
</style>
	<div id="container">
		<p> 
			<span class="article-header">Meeting</span>
		</p>
		<br />
		<div class="">
			<ul class="emin-actions">
				<li><a href="<?php echo site_url('meeting/index'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</a></li>
			</ul>
		</div>
		<div class="view_data">
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Title</span></div>
	            <div>: <?php echo $meeting_details->title; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">When</span></div>
	            <div>: <?php echo $meeting_details->when; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Description</span></div>
	            <div>: <?php echo $meeting_details->description; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold">Location</span></div>
	            <div>: <?php echo $meeting_details->location; ?></div>
            </div>
            <div class="row">
	            <div class="col-md-3"><span style="font-weight: bold"></span></div>
			</div>
		</div>
		<div class="row">
			<table data-editable="" class="table agenda-tbl" style="">
          	<tbody>
				<tr>
					<td colspan="6"><span class="article-sub-header">Attendees</span></td>
				</tr>
				<tr class="agenda-title">
              		<th class="topic"></th>
					<th class="owner">Accepted</th>
					<th class="due">Declined</th>
					<th class="due">Reasons</th>
					<th class=""></th>
            	</tr>
            	<?php $i = 0; ?>
				<?php foreach ($attendees as $attendee){ ?>
					<?php $i++; ?>
					<tr>
						<td></td>
						<td>
						<?php if($attendee['declined'] == 0){ ?>
							<?php echo $attendee['first_name']." ".$attendee['last_name']; ?>
						<?php } ?>	
						</td>
						<td>
							<?php if($attendee['declined'] == 1){ ?>
								<?php echo $attendee['first_name']." ".$attendee['last_name']; ?>
							<?php } ?>	
						</td>
						<td>
							<?php if(($attendee['declined'] == 1) && ($attendee['reasons'])){ ?>
								<?php echo $attendee['reasons']; ?>
							<?php } ?>	
						</td>
						<td></td>
					</tr>
				<?php } ?>
				</tbody>
				</table>
				<hr/>
		</div>
		<br />
		<div>
			<span class="article-sub-header">Meeting Agenda</span>
			<table data-editable="" class="table agenda-tbl" style="">
          	<tbody>
          		<?php $i = 0; ?>
				<?php foreach ($meeting_agenda as $agenda){ ?>
				<?php $i++; ?>
				<tr>
					<td colspan="6"><span class="article-sub-header"><?php echo $i ." - ".  $agenda['heading']; ?></span></td>
				</tr>
				<tr class="agenda-title">
              		<th class="topic">Item</th>
					<th class="note">Action Required</th>
					<th class="owner">Person Responsible</th>
					<th class="due">Due</th>
					<th class="due">Requirements</th>
					<th class=""></th>
					<th class=""></th>
            	</tr>
					<?php foreach ($meeting_agenda_items as $item) { ?>
					<?php if($item['heading']==$agenda['heading']) { ?>
			          	<tr data-type="agenda" class="">
			              	<td class="item">
			              		<input name="topic" type="hidden" value="">
			              		<?php echo $item['item']; ?>
		              		</td>
			              	<td class="action"> <?php echo $item['action']; ?></td>
			              	<td class="owner"><?php echo $item['person_responsible']; ?></td>
			              	<td class="due"><?php echo $item['due_date']; ?></td>
			              	<td class="requirements"><?php echo $item['requirements']; ?></td>
			              	<td class="actions"></td>
			            </tr>
		            <?php } ?>
		            <?php } ?>	
		            <tr>
		            	<td><p>&nbsp;</p></td>
		            </tr>
				<?php } ?>
			</tbody>
        </table>
		</div>
	</div>