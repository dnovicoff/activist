<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php
$showform = 1;

if (isset($validation_errors))  {
	echo '
		<p>
			The following error occurred while changing your password:
		</p>
		<ul>
			' . $validation_errors . '
		</ul>
		<p>
			PASSWORD NOT UPDATED
		</p>
	';
}  else  {
	$display_instructions = 1;
}

if (isset($validation_passed))  {
	echo '
		<p>
			You have successfully changed your password.
		</p>
		<p>
			You can now <a href="/' . LOGIN_PAGE . '">login</a>
		</p>
	';

	$showform = 0;
}
if (isset($recovery_error))  {
	echo '
		<p>
			No usable data for account recovery.
		</p>
		<p>
			Account recovery links expire after 
			' . ( (int) config_item('recovery_code_expiration') / ( 60 * 60 ) ) . ' 
			hours.<br />You will need to use the 
			<a href="/pass">Account Recovery</a> form 
			to send yourself a new link.
		</p>
	';

	$showform = 0;
}
if (isset($disabled))  {
	echo '
		<p>
			Account recovery is disabled.
		</p>
		<p>
			You have exceeded the maximum login attempts or exceeded the 
			allowed number of password recovery attempts. 
			Please wait ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' 
			minutes, or contact us if you require assistance gaining access to your account.
		</p>
	';

	$showform = 0;
}
if ($showform == 1)  {
	if (isset($recovery_code, $user_id))  {
		if (isset($display_instructions))  {
			if (!isset($username))  {
				echo '<p>Please change your password now:</p>';
			}
		}

		?>
			<div id="form">
				<?php echo form_open(); ?>
					<div class="row">
						<div class="col">
						<?php
							// PASSWORD LABEL AND INPUT ********************************
							echo form_label('Password','passwd', ['class'=>'form_label']);
						?>
						</div>
						<div class="col">
						<?php
							$input_data = [
								'name'       => 'passwd',
								'id'         => 'passwd',
								'class'      => 'form_input password',
								'max_length' => config_item('max_chars_for_password')
							];
							echo form_password($input_data);
						?>
						</div>
						<div class="col" style="color: red; font-size: 80%;">
						<?php
							if (!empty(form_error('passwd')))  {
								echo form_error('passwd');
							}
						?>
						</div>
					</div>
					<div class="row">
						<div class="col">
						<?php
							// CONFIRM PASSWORD LABEL AND INPUT ******************************
							echo form_label('Confirm Password','passwd_confirm', ['class'=>'form_label']);
						?>
						</div>
						<div class="col">
						<?php
							$input_data = [
								'name'       => 'passwdconfirm',
								'id'         => 'passwdconfirm',
								'class'      => 'form_input password',
								'max_length' => config_item('max_chars_for_password')
							];
							echo form_password($input_data);
						?>
						</div>
						<div class="col" style="color: red; font-size: 80%;">
						<?php
							if (!empty(form_error('passwdconfirm')))  {
								echo form_error('passwdconfirm');
							}
						?>
						</div>
					</div>
					<div class="row">
						<div class="col">
						<?php
							// RECOVERY CODE *****************************************************************
							echo form_hidden('recovery_code', $recovery_code);

							// USER ID *****************************************************************
							echo form_hidden('user_identification', $user_id);

							// SUBMIT BUTTON **************************************************************
							$input_data = [
								'name'  => 'form_submit',
								'id'    => 'submit_button',
								'value' => 'Change Password',
								'class' => 'btn'
							];
							echo form_submit($input_data);
						?>
						</div>
						<div class="col">
						</div>
						<div class="col">
						</div>
					</div>
				<?php  echo form_close();  ?>
			</div>
		<?php
	}
}
/* End of file choose_password_form.php */
/* Location: /community_auth/views/examples/choose_password_form.php */
