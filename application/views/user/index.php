
<div class="container">
	<div class="smallcol">
		Search types<br />
		<a href="/cam/location">Location</a><br />
		<a href="/cam/National">National</a><br >
		<a href="/cam/current">Current</a><br />
	</div>
	<div class="largecol">
		<?php
			$output = '';
			$page = $this->uri->segment(1);
			switch ($page)  {
				case 'user':
				case 'cam':
					$output = $this->load->view('user/cam_search_form', $data, TRUE);
					break;
			}
			$output .= '<div class="graph_canvas">'.
				$this->load->view('user/data', $data, TRUE).
			'</div>';

			echo $output;
		?>
	</div>
	<div class="smallcol">
		User identifier information if possible
	</div>
</div>
