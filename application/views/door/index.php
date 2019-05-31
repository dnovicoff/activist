
<div class="container">
	<div class="smallcol">
		<?php 
			if ($data['door'] == "auth" || $data['door'] == "about" || $data['door'] == 'index') {
				$this->load->view('door/auth_form', $data);
			}  else  {
				echo "In signing wiith activist to manage your activism just create an account. ";
			}
		?>
	</div>
	<div class="largecol">
		<?php
			switch ($data['door'])  {
				case "user":
					$this->load->view('door/user_form', $data);
					break;
				case "pass":
					$this->load->view('door/pass_form', $data);
					break;
				default:
					echo "Introduction to actifish and a cool looking graphic.";
			}
		?>
	</div>
	<div class="smallcol">
		<?php
			if ($data['door'] == "user")  {
				echo "We hope to become your one stop shop for activism neds.";
			}  else  {
				echo "Not sure what to do with the right. Social stuff maybe.";
			}
		?>
	</div>
</div>
