
<?php
	$readonly = '';
	$sd = '';
	$ed = '';
	$ttle = '';
	$txt = '';
	$tail = '';
	if (isset($cam_detail) && !empty($cam_detail))  {
		$spl = explode(" ", $cam_detail[0]['start_time']);
		$sd = $spl[0];
		$spl = explode(" ", $cam_detail[0]['end_time']);
		$ed = $spl[0];
		$ttle = $cam_detail[0]['title'];
		$txt = $cam_detail[0]['text'];
		if ($hidden_data['status'] !== 'update')  {
			$readonly = 'readonly';
		}  else  {
			$tail = '/update/'.$cam_detail[0]['cam_id'];
		}
	}
?>

<?php if (($hidden_data['status'] == 'insert' && !isset($hidden_data['cam_id'])) || !empty($cam_detail))  { ?>
<div class="container">
	<?php echo form_open('admin/cam'.$tail, '', $hidden_data); ?>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Start Date: ";
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('start_date')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('start_date').
					'</div>';  
				}
			?>
			</div>
		</div>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "End Date: ";
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('end_date')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('end_date').
					'</div>';  
				}
			?>
			</div>
		</div>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Title: ";
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('title')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('title').
					'</div>';  
				}
			?>
			</div>
		</div>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Text ";
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('cam_text')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('cam_text').
					'</div>';  
				}
			?>
			</div>
		</div>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => 'btn'
				);
				if ($readonly == '')  {
					echo form_reset("reset", "Reset", $attributes);
				}  else  {
					echo '<a href="/admin/cam/update/'.$cam_detail[0]['cam_id'].'">Update</a>';
				}
			?>
			</div>
			<div class="col">
			<?php
				$attributes = array(
					'class' => 'btn'
				);
				if ($readonly == '')  {
					echo form_submit("submit", "Submit", $attributes);
				}  else  {
					echo '<a href="/admin/cam/delete/'.$cam_detail[0]['cam_id'].'">Delete</a>';
				}
			?>
			</div>
			<div class="col">
			</div>
		</div>
	<?php  echo form_close(); ?>
</div>

<?php }  else {  echo "Unable to perform desired action and/or locate record<br />";  } ?>
