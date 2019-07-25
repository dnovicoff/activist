

<div class="container">
	<?php echo form_open('user/search'); ?>
		<table width="100%">
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo "Country: ";
			?>
			</td><td>
			<?php
				$options = array(
					'choose' => 'choose',
				);
				$js = array(
					'id' => 'country',
					'onChange' => 'alert(\'Yes\');'
				);
				if (!is_bool($countries))  {
					if (is_array($countries))  {
						foreach ($countries as $row)  {
							$options[$row['country_id']] = $row['country_name'];
						}
					}
				}
				echo form_dropdown('country', $options, $country);
			?>
			</td><td>
			<?php
				if (!empty(form_error('country')))  {
					echo '<div style="font-size: 80%; color: red;">'.
						form_error('country').
					'</div>';  
				}
			?>
			</td></tr>

			<?php
				if ($country != "choose")  {
			?>
				<tr><td>
				<?php
					$attributes = array(
						'class' => ''
					);
					echo "State: ";
				?>
				</td><td>
				<?php
					$options = array(
						'choose' => 'choose',
					);
					$js = array(
						'id' => 'state',
						'onChange' => 'alert(\'Yes\');'
					);
					if (isset($states))  {
						if (is_array($states))  {
							foreach ($states as $row)  {
								$options[$row['state_id']] = $row['state_name'];
							}
						}
					}
					echo form_dropdown('state', $options, $state);
				?>
				</td><td>
				<?php
					if (!empty(form_error('state')))  {
						echo '<div style="font-size: 80%; color: red;">'.
							form_error('state').
						'</div>';  
					}
				?>
				</td></tr>

				<?php
					if ($state != 'choose')  {
				?>
					<tr><td>
					<?php
						$attributes = array(
							'class' => ''
						);
						echo "City ";
					?>
					</td><td>
					<?php
						$data = array(
							'name' => 'city',
							'id' => '',
							'value' => set_value('city'),
							'class' => '',
							'placeholder' => 'type city name'
						);
						echo form_input($data);
					?>
					</td><td>
					<?php
						if (!empty(form_error('city')))  {
							echo '<div style="font-size: 80%; color: red;">'.
								form_error('city').
							'</div>';  
						}
					?>
					</td></tr>
				<?php
					}
				?>
			<?php
				}
			?>
			<tr><td>
			<?php
				$attributes = array(
					'class' => ''
				);
				echo '<a href="/user/search">Reset</a>';
			?>
			</td><td>
			<?php
				$attributes = array(
					'class' => 'btn'
				);
				echo form_submit("submit", "Submit", $attributes);
			?>
			</td></tr>
		</table>
	<?php  echo form_close(); ?>
</div>
