<div class="container">
	<?php echo form_open('forms/auth'); ?>
		<table width="100%">
			<tr>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Email", "email", $attributes);
			?>
			</tr>
			<tr>
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
			</tr>
			<tr>
				<?php if (!empty(form_error('email')))  {  echo form_error('email');  } ?>
			</tr>
			<tr>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Password", "password", $attributes);
			?>
			</tr>
			<tr>
			<?php
				$data = array(
					'type' => 'password',
					'name' => 'pass',
					'id' => '',
					'value' => '',
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</tr>
			<tr>
				<?php if (!empty(form_error('pass')))  {  echo form_error('pass');  } ?>
			</tr>
			<tr>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_submit("submit", "Submit", $attributes);
			?>
			</tr>
		</table>
	<?php  echo form_close(); ?>
	<a href="/pass/"">Password</a><br />
	<a href="/user/">New User</a>
</div>
