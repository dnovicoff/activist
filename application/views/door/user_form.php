

<div class="container">
	<?php echo form_open('create'); ?>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo form_label("Email", "email", $attributes);
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('email')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('email').
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
				echo form_label("Confirm Email", "email", $attributes);
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('confirmemail')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('confirmemail').
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
				echo form_label("Password", "password", $attributes);
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('password')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('password').
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
				echo form_label("Confirm Password", "password", $attributes);
			?>
			</div>
			<div class="col">
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
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('confirmpassword')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('confirmpassword').
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
				echo form_reset("reset", "Reset", $attributes);
			?>
			</div>
			<div class="col">
			<?php
				$attributes = array(
					'class' => 'btn'
				);
				echo form_submit("submit", "Submit", $attributes);
			?>
			</div>
			<div class="col">
			</div>
		</div>
	<?php  echo form_close(); ?>
</div>
