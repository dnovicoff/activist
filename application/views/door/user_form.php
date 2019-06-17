

<div class="container">
	<?php echo form_open('forms/user'); ?>
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
					'value' => set_value('email'),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</td><td>
				<?php if (!empty(form_error('email')))  {  echo form_error('email');  } ?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Confirm Email", "email", $attributes);
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'confirmemail',
					'id' => '',
					'value' => set_value('confirmemail'),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</td><td>
				<?php if (!empty(form_error('confirmemail')))  {  echo form_error('confirmemail');  } ?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Password", "password", $attributes);
			?>
			</td><td>
			<?php
				$data = array(
					'type' => 'password',
					'name' => 'password',
					'id' => '',
					'value' => '',
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</td><td>
				<?php if (!empty(form_error('password')))  {  echo form_error('password');  } ?>
			</td></tr>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Confirm Password", "password", $attributes);
			?>
			</td><td>
			<?php
				$data = array(
					'type' => 'password',
					'name' => 'confirmpassword',
					'id' => '',
					'value' => '',
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</td><td>
				<?php if (!empty(form_error('confirmpassword')))  {  echo form_error('confirmpassword');  } ?>
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
