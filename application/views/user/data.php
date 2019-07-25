

<div class="container">
	<div class="graph_canvas">
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
			echo $campaign[0]['title'].'<br /><br />'.
				$campaign[0]['text'].'<br />'.
				'<a href="/cam/sign/'.$campaign[0]['cam_id'].'">Sign</a>';
		}
	?>
	</div>
</div>
