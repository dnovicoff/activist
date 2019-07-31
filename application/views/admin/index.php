
<div class="container">
	<div class="smallcol">
		<br /><br />
		<a href="/admin">Data</a><br />
		<a href="/admin/group">Groupings</a><br />
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
				case 'group':
					$this->load->view('admin/grouping', $data);
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
