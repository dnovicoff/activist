

<div class="container">
	<div class="graph_canvas">
		<img src="/img/unitedstates_map.jpg" height="327" width="488">	
	</div>
	<?php
		if (isset($cam_id))  {
	?>
		<a href="/admin/cam/select/<?php if (isset($cam_id)) {  echo $cam_id;  } else {  echo '';  } ?>">View</a>
	<?php
		}
	?>
</div>
