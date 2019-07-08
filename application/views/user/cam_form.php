

<div class="container">
	<?php echo form_open('user/cam'); ?>
		<table width="100%">
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Title: ";
			?>
			</td><td>
			<?php
				$data = array(
					'name' => 'title',
					'id' => '',
					'value' => set_value('title'),
					'class' => '',
					'placeholder' => ''
				);
				echo form_input($data);
			?>
			</td><td>
			<?php
				if (!empty(form_error('title')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('title').
					'</div>';  
				}
			?>
			</td></tr>
		</table>
	<?php  echo form_close(); ?>
</div>
