

<div class="container">
	<?php echo form_open('forms/user'); ?>
		<table width="100%">
			<tr>
			<td><label form="email">Email</label></td><td> <input type="text" name="email" value="<?php echo set_value('email'); ?>" /></td>
			<td>
				<?php if (!empty(form_error('email')))  {  echo form_error('email');  } ?>
			</td>
			</tr><tr>
			<td><label form="email">Confirm Email</label></td><td>
				<input type="text" name="confirmemail" value="<?php echo set_value('confirmemail'); ?>" /></td>
			<td>
				<?php if (!empty(form_error('confirmemail')))  {  echo form_error('confirmemail');  } ?>
			</td>
			</tr><tr>
			<td><label form="password">Password</label></td><td> <input type="password" name="password" /></td>
			<td>
				<?php if (!empty(form_error('password')))  {  echo form_error('password');  } ?>
			</td>
			</tr><tr>
			<td><label form="password">Confirm Password</label></td><td> <input type="password" name="confirmpassword" /></td>
			<td>
				<?php if (!empty(form_error('confirmpassword')))  {  echo form_error('confirmpassword');  } ?>
			</td>
			</tr><tr>
			<td><input type="reset" name="reset" /></td><td><input type="submit" value="submit" name="submit" /></td>
			</tr>
		</table>
	</form>
</div>
