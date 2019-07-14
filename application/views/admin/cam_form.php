
<?php
	$readonly = '';
	$sd = '';
	$ed = '';
	$ttle = '';
	$txt = '';
	if (isset($cam_detail) && !empty($cam_detail))  {
		$spl = explode(" ", $cam_detail[0]['start_time']);
		$sd = $spl[0];
		$spl = explode(" ", $cam_detail[0]['end_time']);
		$ed = $spl[0];
		$ttle = $cam_detail[0]['title'];
		$txt = $cam_detail[0]['text'];
		if ($hidden_data['status'] !== 'update')  {
			$readonly = 'readonly';
		}
	}
?>

<?php if (($hidden_data['status'] == 'insert' && !isset($hidden_data['cam_id'])) || !empty($cam_detail))  { ?>
<div class="container">
	<?php echo form_open('admin/cam', '', $hidden_data); ?>
		<table width="100%">
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Start Date: ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'start_date',
					'id' => '',
					'value' => set_value('start_date', $sd),
					'class' => '',
					'placeholder' => 'yyyy-mm-dd'
				);
				if ($readonly !== '')  {
					$data['readonly'] = $readonly;
				}
				echo form_input($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('start_date')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('start_date').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "End Date: ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'end_date',
					'id' => '',
					'value' => set_value('end_date', $ed),
					'class' => '',
					'placeholder' => 'yyyy-mm-dd'
				);
				if ($readonly !== '')  {
					$data['readonly'] = $readonly;
				}
				echo form_input($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('end_date')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('end_date').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Title: ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'title',
					'id' => '',
					'value' => set_value('title', $ttle),
					'class' => '',
					'placeholder' => ''
				);
				if ($readonly !== '')  {
					$data['readonly'] = $readonly;
				}
				echo form_input($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('title')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('title').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Text ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'cam_text',
					'id' => '',
					'value' => set_value('cam_text', $txt),
					'class' => '',
					'placeholder' => 'Campaign description ...'
				);
				if ($readonly !== '')  {
					$data['readonly'] = $readonly;
				}
				echo form_textarea($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('cam_text')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('cam_text').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				if ($readonly == '')  {
					echo form_reset("reset", "Reset", $attributes);
				}  else  {
					echo '<a href="/admin/cam/update/'.$cam_detail[0]['cam_id'].'">Update</a>';
				}
			?>
			</td><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				if ($readonly == '')  {
					echo form_submit("submit", "Submit", $attributes);
				}  else  {
					echo '<a href="/admin/cam/delete/'.$cam_detail[0]['cam_id'].'">Delete</a>';
				}
			?>
			</td></tr>
		</table>
	<?php  echo form_close(); ?>
</div>

<?php }  else {  echo "Unable to perform desired action and/or locate record<br />";  } ?>
