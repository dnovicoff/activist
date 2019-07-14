
<div class="container">
	<div class="smallcol">
		Pertitent info regarding user lookups for campaigns.
	</div>
	<div class="largecol">
		<?php
			$page = $this->uri->segment(1);
			switch ($page)  {
				case 'cam':
					$this->load->view('user/cam_search_form', $data);
					break;
				default:
				echo '<div class="graph_canvas">'.
						$this->load->view('user/data', $data, TRUE).
					'</div>';
					break;
			}
		?>
	</div>
	<div class="smallcol">
		User identifier information if possible
	</div>
</div>
