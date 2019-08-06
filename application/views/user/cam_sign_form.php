

<div class="container">
	<?php
		$attributes = array(
			'accept-charset' => 'ISO-8859-1'
		);
	?>
	<div class="row">
		<img src="/img/thankyou_text.jpg" height="40" width="200">
		<img src="/img/<?php echo $logo; ?>_thumb.jpg" alt="<?php echo $logo; ?>" height="40" width="40">
	</div>
	<?php echo form_open('user/sign/'.$cam_id, $attributes); ?>
		<div class="row">
			<div class="col">
			<?php
				$attributes = array(
					'class' => ''
				);
				echo 'First Name: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'name' => 'fname',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('fname'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('fname')))  {
					echo form_error('fname');  
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
				echo 'Last Name: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'name' => 'lname',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('lname'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('lname')))  {
					echo form_error('lname');
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
				echo 'Country: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'name' => 'country',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('country'), ENT_QUOTES),
					'class' => '',
					'placeholder' => 'United States',
					'disabled' => 'disabled'
				);
				echo form_input($data);
			?>
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('country')))  {
					echo form_error('country');
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
				echo 'Address: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'name' => 'addr',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('addr'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('addr')))  {
					echo form_error('addr');
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
				echo 'City: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'type' => 'text',
					'name' => 'city',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('city'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('city')))  {
					echo form_error('city');
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
				echo 'State: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'type' => 'text',
					'name' => 'state',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('state'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('state')))  {
					echo form_error('state');
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
				echo 'Zip: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'type' => 'text',
					'name' => 'zip',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('zip'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('zip')))  {
					echo form_error('zip');
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
				echo 'Drivers License: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'type' => 'text',
					'name' => 'id',
					'id' => '',
					'value' => htmlspecialchars_decode(set_value('id'), ENT_QUOTES),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col" style="color: red; font-size: 70%; padding-left: 4px;">
			<?php
				if (!empty(form_error('id')))  {
					echo form_error('id');
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
				echo 'eMail: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'type' => 'text',
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
					'class' => 'btn'
				);
				echo form_reset("reset", "Reset");
			?>
			</div>
			<div class="col">
			<?php
				$attributes = array(
					'class' => 'btn'
				);
				echo form_submit("submit", "Submit");
			?>
			</div>
			<div class="col">
			</div>
		</div>
	<?php  echo form_close(); ?>
</div>
