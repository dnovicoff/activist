
<div class="container">
	<div class="smallcol">
		<br /><br />
	<?php
		$this->load->view('gen/collapsible', $data);
	?>
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
				case 'data':
					$this->load->view('gen/cam_graph', $data);
					break;
				default:
					$this->load->view('admin/data', $data);
			}
		?>
	</div>
	<div class="smallcol">
		RIGHT
	</div>
</div>
