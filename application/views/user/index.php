
<div class="container">
	<div class="smallcol">
		Pertitent info regarding user lookups for campaigns.
	</div>
	<div class="largecol">
		<?php
			$page = $this->uri->segment(1);
			echo '<div class="graph_canvas">'.
				$this->load->view('user/data', $data, TRUE).
			'</div>';
		?>
	</div>
	<div class="smallcol">
		User identifier information if possible
	</div>
</div>
