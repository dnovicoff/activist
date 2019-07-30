

<div class="container">
	<?php echo form_open('user/sign/'.$cam_id); ?>
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
					'value' => set_value('fname'),
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
					'value' => set_value('lname'),
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
				echo 'Address: ';
			?>
			</div>
			<div class="col">
			<?php
				$data = array(
					'name' => 'addr',
					'id' => '',
					'value' => set_value('addr'),
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
					'value' => '',
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
					'value' => '',
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
					'value' => '',
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</div>
			<div class="col">
			<?php
				if (!empty(form_error('zip')))  {
					echo form_error('zip');
				}
			?>
			</div>
		</div>
		<div class="row">
			<div class="col">
			</div>
			<div class="col">
			</div>
			<div class="col">
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
