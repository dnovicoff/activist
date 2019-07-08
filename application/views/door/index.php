
<div class="container">
	<div class="smallcol">
		<?php
			$pages = array('create', 'pass', 'about');
			$page = $this->uri_segment(1, 0);
			if (!in_array($page, $pages))  {
				$this->load->view('door/auth_form');
			}  else  {
				echo "Pertitent info";
			}
		?>
	</div>
	<div class="largecol">
		<?php
			// $page = $this->uri->segment(1, 0);
			switch ($page)  {
				case "create":
					$this->load->view('door/user_form');
					break;
				case "pass":
					$this->load->view('door/pass_form');
					break;
				case "about":
					$this->load->view('door/about');
					break;
				default:
					echo "Introduction to actifish and a cool looking graphic.";
			}
		?>
	</div>
	<div class="smallcol">
		<?php
			if (!in_array($page, $pages)  {
				echo "We hope to become your one stop shop for activism neds.";
			}  else  {
				echo "Not sure what to do with the right. Social stuff maybe.";
			}
		?>
	</div>
</div>
