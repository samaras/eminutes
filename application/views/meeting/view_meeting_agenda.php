<div class="container">

	<div id="container">
		<p> 
			<span class="article-header">Meetings Agenda</span>
		</p>
		<br />
		<div class="">
			<ul class="emin-actions">
				<li><a href="<?php echo site_url('meeting/index'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-left-arrow" aria-hidden="true"></span> Back</a></li>
			</ul>
		</div>
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
			              	<td class="actions"><span data-remove="">×</span></td>
			            </tr>
		            <?php } ?>
		            <?php } ?>	
		            <!-- The last <tr> in the <tbody> will be used as template for new rows -->
		            <tr data-type="agenda" class="" style="border-top: 1px solid #ddd">
		              	<td class="item"><input name="item" type="text" value=""></td>
		              	<td class="action"><input type="text" name="action" id="" /></td>
		              	<td class="owner"><input type="text" name="action" id="" /></td>
		              	<td class="due"><input type="text" name="action" id="" /></td>
		              	<td class="requirements"><input type="text" name="requirements" id="" /></td>
		              	<td class="actions">
		                	<td><button id="" class="btn btn-primary">Add Item</button></td>
		              	</td>
		            </tr>
		            <tr>
		            	<td><p>&nbsp;</p></td>
		            </tr>
				<?php } ?>
				<tr>
					<td><button id="" class="btn btn-primary">Add Heading</button></td>
				</tr>
			</tbody>
        </table>
	</div>

</div>