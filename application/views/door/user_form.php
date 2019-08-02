

<div class="container">
	By creating an account with Actifish you can create and store user data related to the things that matter to you.
	We offer a means of bringing down the ratio of valid signatures.
	<?php
		$attributes = array(
			'accept-charset' => 'ISO-8859-1'
		);
		if (isset($disabled))  {
			echo '
				<div style="border:1px solid red; width: 100%; height: 100%;">
					Account Creation is Disabled.<br /><br />
					If you have exceeded the maximum login attempts, or exceeded
					the allowed number of password recovery attempts, account creation
					will be temporarily disabled.
					Please wait ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' 
					before attepting to create an account.
				</div>
			';
		}  else if (isset($banned))  {
			echo '
				<div style="border:1px solid red; width: 100%; height: 100%">
				<p>
					Account Locked.
				</p>
				<p>
					You have attempted to use the our system using 
					an email address that belongs to an account that has been 
					purposely denied access to the authenticated areas of this website. 
					If you feel this is an error, you may contact us  
					to make an inquiry regarding the status of the account.
				</p>
			</div>
			';
		}  else  {
			$showform = 1;
		}

		if (isset($showform))  {
	?>
	<?php echo form_open('create', $attributes); ?>
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
	<?php
		}
	?>
</div>
