
<div class="container">
	<div class="smallcol">
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
		</div><br /><br />
		<a href="/admin">Data</a><br />
		<a href="/admin/loc">Create Location</a><br />
		<a href="/admin/cam">Create Campaign</a><br />
	</div>
	<div class="largecol">
		<?php
			$page = $this->uri->segment(2);
			switch ($page)  {
				case 'loc':
					$this->load->view('admin/loc_form', $data);
					break;
				case 'cam':
					$this->load->view('admin/cam_form', $data);
					break;
				default:
					echo '<div class="graph_canvas">'.
						$this->load->view('admin/data', $data, TRUE).
					'</div>';
			}
		?>
	</div>
	<div class="smallcol">
		RIGHT
	</div>
</div>
