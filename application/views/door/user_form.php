

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
					'value' => htmlspecialchars_decode(set_value('email'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('email')))  {
					echo form_error('email');  
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
					'value' => htmlspecialchars_decode(set_value('confirmemail'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('confirmemail')))  {
					echo form_error('confirmemail');
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
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('password')))  {
					echo form_error('password');
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
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('confirmpassword')))  {
					echo form_error('confirmpassword');
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
