

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
	<?php
		if (isset($valid_national))  {
			if (isset($national_campaigns) && is_array($national_campaigns))  {
				$total = count($city_campaigns);
				echo '<a href="/cam/show/'.$country.'">'.$total.' national campaigns</a><br />';
			}  else  {
				echo 'No national campaigns to sign.<br />';
			}
		}

		if (isset($valid_state))  {
			if (isset($state_campaigns) && is_array($state_campaigns))  {
				$total = count($state_campaigns);
				echo '<a href="/cam/show/'.$country.'/'.$state.'">'.$total.' state campaigns</a><br />';
			}  else  {
				echo 'No state campaigns to sign.<br />';
			}
		}

		if (isset($valid_city))  {
			if (isset($city_campaigns) && is_array($city_campaigns))  {
				$total = count($city_campaigns);
				echo '<a href="/cam/show/'.$country.'/'.$state.'/'.$city.'">'.$total.' city campaigns</a><br />';
			}  else  {
				echo 'No city campaigns to sign.<br />';
			}
		}
	?>
</div>
