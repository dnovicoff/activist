

<div class="container">
	<?php echo form_open('user/search'); ?>
		<table width="100%">
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Region: ";
			?>
			</td><td>
			<?php
				$options = array(
					'choose' => 'choose',
					'national' => 'National',
					'state' => 'State',
					'city' => 'City'
				);
				$js = array(
					'id' => 'region',
					'onChange' => 'alert(\'Yes\');'
				);
				echo form_dropdown('region', $options, 'choose');
			?>
			</td><td>
			<?php
				if (!empty(form_error('region')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('region').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "State: ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'state',
					'id' => '',
					'value' => set_value('state'),
					'class' => '',
					'placeholder' => '<select>'
				);
				echo form_input($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('state')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('state').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "City ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'city',
					'id' => '',
					'value' => set_value('cam_text'),
					'class' => '',
					'placeholder' => '<select>'
				);
				echo form_input($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('city')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('city').
					'</div>';  
				}
			?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_reset("reset", "Reset", $attributes);
			?>
			</td><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_submit("submit", "Submit", $attributes);
			?>
			</td></tr>
		</table>
	<?php  echo form_close(); ?>
</div>
