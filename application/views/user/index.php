
<div class="container">
	<div class="smallcol">
		<a href="/user/loc">Create Location</a><br />
		<a href="/user/cam">Create Campaign</a><br />
		<a href="/user/logout">Logout</a><br />
	</div>
	<div class="largecol">
		<?php
			$page = $this->uri->segment(2, 0);
			echo $page;
			if ($page !== 0)  {
				switch ($page)  {
					case 'loc':
						break;
					case 'cam':
						break;
				}
			}  else  {
				echo '<div class="graph_canvas">'.
					'CENTER'.
				'</div>';
			}
		?>
	</div>
	<div class="smallcol">
		RIGHT
	</div>
</div>
