
<div class="container">
	<div class="smallcol">
		<br /><br />
		<a href="/user/">Active</a><br />
		<a href="/user/search">Drill</a><br />
		<a href="/user/national">National</a><br >
		<a href="/user/current">Current</a><br />
	</div>
	<div class="largecol">
	<?php
		$output = '';
		$page = $this->uri->segment(2);
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
			case 'sign':
				$output = $this->load->view('user/cam_sign_form', $data, TRUE);
				break;
			default:
				$output = $this->load->view('user/cam_graph', $data, TRUE);
		}

		echo $output;
	?>
	</div>
	<div class="smallcol">
		User identifier information if possible
	</div>
</div>
