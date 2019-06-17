
<div classs="container">
	<?php echo form_open('forms/pass'); ?>
		<table width="100%">
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Email", "email", $attributes);
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'email',
					'id' => '',
					'value' => '',
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</td><td>
				<?php if (!empty(form_error('email')))  {  echo set_value('email').' '.form_error('email');  } ?>
			</td></tr>
			<tr><td>
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
