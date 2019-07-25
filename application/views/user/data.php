

<div class="container">
	<?php
		if (isset($national_campaigns) && is_array($national_campaigns))  {
			var_dump($national_campaigns);
		}  else  {
			echo 'No national campaigns to sign.<br />';
		}

		if (isset($state_campaigns) && is_array($state_campaigns))  {
			var_dump($state_campaigns);
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
	?>
</div>
