<div class="container">
	<?php
		if (isset($login_error_mesg))  {
			echo '
				<div style="font-size: 80%; color: red;">
					Login Error #' . $this->authentication->login_errors_count . '/' . 
					config_item('max_allowed_attempts') . ': Invalid
					email address and/or password.
				</div>
			';
		}
	?>

	<?php echo form_open($login_url); ?>
		<table width="100%">
			<tr>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Email";
			?>
			</tr>
			<tr>
			<?php
				$data = array(
					'name' => 'login_string',
					'id' => 'login_string',
					'value' => set_value('login_string'),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</tr>
			<tr>
				<?php
					if (!empty(form_error('login_string')))  {
						echo '<div style="font-size: 80%; color: red;">'.
							form_error('login_string').
						'</div>';
					}
				?>
			</tr>
			<tr>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Password";
			?>
			</tr>
			<tr>
			<?php
				$data = array(
					'type' => 'password',
					'name' => 'login_pass',
					'id' => 'login_pass',
					'value' => '',
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</tr>
			<tr>
				<?php
					if (!empty(form_error('login_pass')))  {
						echo '<div style="font-size: 80%; color: red;">'.
							form_error('login_pass').
						'</div>';
					}
				?>
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
	<a href="/pass/">Password</a><br />
	<a href="/create/">New User</a><br />
</div>
