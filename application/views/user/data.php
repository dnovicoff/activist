

<div class="container">
	<?php
		if (!isset($campaigns))  {
			if (isset($national_campaigns) && is_array($national_campaigns))  {
				$total = count($city_campaigns);
				echo '<a href="/cam/show/'.$country.'">'.$total.' national campaigns</a><br />';
			}  else  {
				echo 'No national campaigns to sign.<br />';
			}

			if (isset($state_campaigns) && is_array($state_campaigns))  {
				$total = count($city_campaigns);
				echo '<a href="/cam/show/'.$country.'/'.$state.'">'.$total.' state campaigns</a><br />';
			}  else  {
				echo 'No state campaigns to sign.<br />';
			}

			if (isset($city_campaigns) && is_array($city_campaigns))  {
				$total = count($city_campaigns);
				echo '<a href="/cam/show/'.$country.'/'.$state.'/'.$city.'">'.$total.' city campaigns</a><br />';
			}  else  {
				echo 'No city campaigns to sign.<br />';
			}
		}  else  {
			if (is_array($campaigns))  {
				foreach ($campaigns as $row)  {
					echo '<a href="/cam/show/'.$row['cam_id'].'">'.$row['title'].'</a><br />';
				}
			}  else  {
				echo 'You have an outdated link. Please try again';
			}
		}
	?>
</div>
