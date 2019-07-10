
<div class="container">
	<div class="smallcol">
		<div class="wrap_collapsable">
			<input id="loc_collapsable" type="checkbox">
			<label for="loc_collapsable">Locations</label>
			<div class="collapsable_content">
				<ul>
				<?php
					if (!is_bool($data['loc_data']))  {
						foreach ($data['loc_data'] as $row)  {

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
					if (!is_bool($data['cam_data']))  {
						foreach ($data['cam_data'] as $row)  {
							echo '<li><a href="/user/cam/'.$row['cam_id'].'">'.$row['title'].'</a></li>';
						}
					}
				?>
				</ul>	
			</div>
		</div><br /><br />
		<a href="/user">Data</a><br />
		<a href="/user/loc">Create Location</a><br />
		<a href="/user/cam">Create Campaign</a><br />
		<a href="/user/logout">Logout</a><br />
	</div>
	<div class="largecol">
		<?php
			$page = $this->uri->segment(2, 0);
			if ($page !== 0)  {
				switch ($page)  {
					case 'loc':
						$this->load->view('user/loc_form', $data);
						break;
					case 'cam':
						$this->load->view('user/cam_form', $data);
						break;
				}
			}  else  {
				echo '<div class="graph_canvas">'.
					$this->load->view('user/data', $data, TRUE).
				'</div>';
			}
		?>
	</div>
	<div class="smallcol">
		RIGHT
	</div>
</div>
