
<div class="wrap_collapsable">
	<input id="loc_collapsable" type="checkbox">
	<label for="loc_collapsable">Locations</label>
	<div class="collapsable_content">
		<ul>
		<?php
			if (isset($data['loc_data']))  {
				if (is_array($data['loc_data']))  {
					foreach ($data['loc_data'] as $row)  {

					}
				}  else  {
					echo $data['loc_data'];
				}
			}
		?>
		</ul>
	</div>
</div><br />
<div class="wrap_collapsable">
	<input id="cam_collapsable" type="checkbox">
	<label for="cam_collapsable">Campaigns</label>
	<div class="collapsable_content">
		<ul>
		<?php
			if (isset($data['cam_data']))  {
				if (is_array($data['cam_data']))  {
					foreach ($data['cam_data'] as $row)  {
						echo '<li><a href="/admin/cam/select/'.$row['cam_id'].'">'.$row['title'].'</a></li>';
					}
				}  else  {
					echo $data['cam_data'];
				}
			}
		?>
		</ul>	
	</div>
</div>
