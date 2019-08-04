
<?php
	$form_status = array(
		'select',
		'delete'
	);
	$sd = '';
	$ed = '';
	$cid = '';
	$rid = '';
	$sid = '';
	$city = '';
	$ttle = '';
	$txt = '';
	$tail = '';
	if (isset($cam_detail) && !empty($cam_detail))  {
		$spl = explode(" ", $cam_detail[0]['start_time']);
		$sd = $spl[0];
		$spl = explode(" ", $cam_detail[0]['end_time']);
		$ed = $spl[0];
		$cid = $cam_detail[0]['country_id'];
		$rid = $cam_detail[0]['region_id'];
		$sid = $cam_detail[0]['state_id'];
		$city = $cam_detail[0]['city'];
		/**
		if ($cam_detail[0]['table_key'] !== 0)  {
			$sid = $cam_detail[0]['table_key'];
			if (preg_match('/(\d+)-(\d+)/', $matches, $cam_detail[0]['table_key']))  {
				$sid = $matches[1];
				$city = $matches[2];
			}
		}
		**/
		$table_key = $cam_detail[0]['table_key'];
		$ttle = $cam_detail[0]['title'];
		$txt = $cam_detail[0]['text'];
		if ($hidden_data['status'] === 'update')  {
			$tail = '/update/'.$cam_detail[0]['cam_id'];
		}
		$level++;
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
				if (in_array($hidden_data['status'], $form_status))  {
					$data['disabled'] = 'disabled';
				}
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 80%;">
			<?php
				if (!empty(form_error('start_date')))  {
					echo form_error('start_date');  
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
				if (in_array($hidden_data['status'], $form_status))  {
					$data['disabled'] = 'disabled';
				}
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 80%;">
			<?php
				if (!empty(form_error('end_date')))  {
					echo form_error('end_date');  
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
				echo "Country: ";
			?>
			</div>
			<div class="col">
			<?php
				$options = array(
					'choose' => 'choose'
				);
				$js = array(
					'id' => 'country_id'
				);
				if (in_array($hidden_data['status'], $form_status))  {
					$js['disabled'] = 'disabled';
				}
				if (!is_bool($countries))  {
					if (is_array($countries))  {
						foreach ($countries as $row)  {
							$options[$row['country_id']] = $row['country_name'];
						}
					}
				}
				echo form_dropdown('country_id', $options, set_value('country_id', $cid), $js);
			?>
			</div>
			<div class="col" style="color: red; font-size: 80%;">
			<?php
				if (!empty(form_error('country_id')))  {
					echo form_error('country_id');  
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
				echo "Region: ";
			?>
			</div>
			<div class="col">
			<?php
				$options = array(
					'choose' => 'choose'
				);
				$js = array(
					'id' => 'region_id'
				);
				if (in_array($hidden_data['status'], $form_status))  {
					$js['disabled'] = 'disabled';
				}
				if (!is_bool($regions))  {
					if (is_array($regions))  {
						foreach ($regions as $row)  {
							$options[$row['region_id']] = $row['region_name'];
						}
					}
				}
				echo form_dropdown('region', $options, set_value('region_id', $rid), $js);
			?>
			</div>
			<div class="col" style="color: red; font-size: 80%;">
			<?php
				if (!empty(form_error('region_id')))  {
					echo form_error('region_id');  
				}
			?>
			</div>
		</div>

	<?php
		if ($level > 0)  {
	?>
			<div class="row">
				<div class="col">
				<?php
					$attributes = array(
						'class' => ''
					);
					echo "State: ";
				?>
				</div>
				<div class="col">
				<?php
					$options = array(
						'choose' => 'choose'
					);
					$js = array(
						'id' => 'state_id'
					);
					if (in_array($hidden_data['status'], $form_status))  {
						$js['disabled'] = 'disabled';
					}
					if (!is_bool($states))  {
						if (is_array($states))  {
							foreach ($states as $row)  {
								$options[$row['state_id']] = $row['state_name'];
							}
						}
					}
					echo form_dropdown('state_id', $options, set_value('state_id', $sid), $js);
				?>
				</div>
				<div class="col" style="color: red; font-size: 80%;">
				<?php
					if (!empty(form_error('state_id')))  {
						echo form_error('state_id');  
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
					echo "City: ";
				?>
				</div>
				<div class="col">
				<?php
					$data = array(
						'name' => 'city',
						'id' => '',
						'value' => set_value('city', $city),
						'class' => '',
						'placeholder' => ''
					);
					if (in_array($hidden_data['status'], $form_status))  {
						$data['disabled'] = 'disabled';
					}
					echo form_input($data);
				?>
				</div>
				<div class="col" style="color: red; font-size: 80%;">
				<?php
					if (!empty(form_error('city')))  {
						echo form_error('city');  
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
					if (in_array($hidden_data['status'], $form_status))  {
						$data['disabled'] = 'disabled';
					}
					echo form_input($data);
				?>
				</div>
				<div class="col" style="color: red; font-size: 80%;">
				<?php
					if (!empty(form_error('title')))  {
						echo form_error('title');  
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
					if (in_array($hidden_data['status'], $form_status))  {
						$data['disabled'] = 'disabled';
					}
					echo form_textarea($data);
				?>
				</div>
				<div class="col" style="color: red; font-size: 80%;">
				<?php
					if (!empty(form_error('cam_text')))  {
						echo form_error('cam_text');  
					}
				?>
				</div>
			</div>
	<?php
		}
	?>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => 'btn'
				);
				if (!in_array($hidden_data['status'], $form_status))  {
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
				if (!in_array($hidden_data['status'], $form_status))  {
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
