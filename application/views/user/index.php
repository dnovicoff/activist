
<div class="container">
	<div class="smallcol">
		Search types<br />
		<a href="/user/search">Drill</a><br />
		<a href="/user/national">National</a><br >
		<a href="/user/current">Current</a><br />
	</div>
	<div class="largecol">
		<?php
			$output = '';
			$page = $this->uri->segment(2);
			if (!empty($page))  {
				switch ($page)  {
					case 'search':
						$output = $this->load->view('user/cam_search_form', $data, TRUE);
						break;
					case 'show':
						$output = $this->load->view('user/data', $data, TRUE);
						break;
					case 'detail':
						$output = $this->load->view('user/data', $data, TRUE);
						break;
				}
				$output .= '<div class="graph_canvas">'.
				'</div>';
			}  else  {
				$output = 'Probable a graph of current campaigns being signed.';
			}

			echo $output;
		?>
	</div>
	<div class="smallcol">
		User identifier information if possible
	</div>
</div>
