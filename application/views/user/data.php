

<div class="container">
	<div class="graph_canvas"> <!-- style="background-image: url('/img/illinois.gif'); background-size: 100% 100%;");"> -->
	<?php
		if (isset($campaigns))  {
			if (is_array($campaigns))  {
				foreach ($campaigns as $row)  {
					echo '<a href="/cam/detail/'.$row['cam_id'].'">'.$row['title'].'</a><br />';
				}
			}  else  {
				echo 'You have an outdated link. Please try again';
			}
		}
		if (isset($campaign))  {
			$today = new DateTime('now', new DatetimeZone('UTC'));
			$end = new DateTime($campaign[0]['end_time']);
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

			echo 'Valid until '.$campaign[0]['end_time'].'<br />'.
				$difference.'<br /><br />'.
				$campaign[0]['title'].'<br /><br />'.
				$campaign[0]['text'].'<br />'.
				'<a href="/cam/sign/'.$campaign[0]['cam_id'].'">Sign</a>';
		}
	?>
	</div>
</div>
