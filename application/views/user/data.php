

<div class="container">
	<?php
		if (isset($campaigns))  {
			echo '<div class="graph_canvas">';
			if (is_array($campaigns))  {
				foreach ($campaigns as $row)  {
					echo '<a href="/cam/detail/'.$row['cam_id'].'">'.$row['title'].'</a><br />';
				}
			}  else  {
				echo 'You have an outdated link. Please try again';
			}
			echo '</div>';
		}
		if (isset($campaign))  {
			$background = '';
			if (isset($bgimage))  {
				$background = preg_replace('/\s/', '', $bgimage);
				$background = '/img/'.strtolower($background).'_gray_opacity.jpg';
			}
	?>
			<div class="graph" style="background-image: url('<?php echo $background; ?>'); background-size: cover; height: 550px;">
	<?php
			$today = new DateTime('now', new DatetimeZone('america/chicago'));
			$end = new DateTime($campaign[0]['end_time'], new DatetimeZone('america/chicago'));
			$diff = $end->diff($today);

			$difference = $diff->format('%I:%S remaining.');
			if ($diff->i != 0)  {
				$difference = $diff->format('%h').':'.$difference;
			}
			if ($diff->d != 0)  {
				$difference = $diff->format('%d days ').$difference;
			}
			if ($diff->m != 0)  {
				$difference = $diff->format('%m months ').$difference;
			}
			if ($diff->y != 0)  {
				$difference = $diff->format('%y years ').$difference;
			}

			$state = '';
			if (isset($bgimage))  {
				$state = $campaign[0]['region_name'].' of '.$bgimage.'<br />';
			}
			echo 'Valid until '.$campaign[0]['end_time'].'<br />'.
				$difference.'<br /><br />'.
				$campaign[0]['region_name'].' campaign<br />'.
				$state.
				$campaign[0]['title'].'<br /><br />'.
				$campaign[0]['text'].'<br />'.
				'<a href="/cam/sign/'.$campaign[0]['cam_id'].'">Sign</a>';
			echo '</div>';
		}
	?>
</div>
