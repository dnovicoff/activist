<div class="container">
	<?php echo form_open('forms/auth'); ?>
		<table width="100%">
			<tr>User Name</tr>
			<tr><input type="text" name="user"></tr>
			<tr><?php if (!empty(form_error('user')))  {  echo form_error('user');  } ?></tr>
			<tr>Password</tr>
			<tr><input type="password" name="pass"></tr>
			<tr><?php if (!empty(form_error('pass')))  {  echo form_error('pass');  } ?></tr>
			<tr><input type="submit" value="Submit" name="submit" /></tr>
		</table>
	</form>
	<a href="/pass/"">Password</a><br />
	<a href="/user/">New User</a>
</div>
