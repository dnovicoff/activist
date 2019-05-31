
<div classs="container">
	<?php echo form_open('forms/pass'); ?>
		<table width="100%">
			<tr>
				<td><label form="email">Email</label></td><td><input type="text" name="email" /></td>
			<td>
				<?php if (!empty(form_error('email')))  {  echo set_value('email').' '.form_error('email');  } ?>
			</td>
			</tr><tr>
				<td><input type="submit" value="submit" name="submit" /></td>
			</tr>
		</table>
	</form>
</div>
