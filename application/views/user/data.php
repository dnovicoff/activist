

<div class="container">
	<?php
		if (!isset($campaigns))  {

		}  else  {
			if (is_array($campaigns))  {
				foreach ($campaigns as $row)  {
					echo '<a href="/cam/detail/'.$row['cam_id'].'">'.$row['title'].'</a><br />';
				}
			}  else  {
				echo 'You have an outdated link. Please try again';
			}
		}
	?>
</div>
