

<div class="container">
	<?php echo form_open('user/cam'); ?>
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
					'value' => set_value('start_date'),
					'class' => '',
					'placeholder' => 'yyyy-mm-dd'
				);
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
					'value' => set_value('end_date'),
					'class' => '',
					'placeholder' => 'yyyy-mm-dd'
				);
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
					'value' => set_value('title'),
					'class' => '',
					'placeholder' => ''
				);
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
					'name' => 'cam_test',
					'id' => '',
					'value' => set_value('cam_text'),
					'class' => '',
					'placeholder' => 'Campaign description ...'
				);
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
