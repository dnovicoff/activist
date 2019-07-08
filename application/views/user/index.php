
<div class="container">
	<div class="smallcol">
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
