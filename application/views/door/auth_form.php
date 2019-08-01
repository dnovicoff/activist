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

		$attributes = array(
			'accept-charset' => 'ISO-8859-1'
		);
	?>
	<?php echo form_open($login_url, $attributes); ?>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Email";
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'name' => 'login_string',
					'id' => 'login_string',
					'value' => htmlspecialchars_decode(set_value('login_string'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('login_string')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('login_string').
					'</div>';
				}
			?>
			</div>
		</div>
		<br /><br />
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Password";
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('login_pass')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('login_pass').
					'</div>';
				}
			?>
			</div>
		</div>
		<div class="row">
		<?php
			$attributes = array(
				'class' => 'btn'
			);
			echo form_submit("submit", "Submit");
		?>
		</div>
	<?php  echo form_close(); ?>
</div>
