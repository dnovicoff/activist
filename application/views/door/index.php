
<div class="container">
	<div class="smallcol">
	<br /><br />
	<?php
		$pages = array('create', 'pass', 'about', 'recovery', 'login');
		$current = $this->uri->segment(1);
		if (!isset($on_hold_message))  {
			if (is_null($this->auth_role) && !in_array($current, $pages))  {
				$this->load->view('gen/collapsible', $data);
			}  else  {
				echo "Pertitent info";
			}
		}  else  {
			echo "&nbsp;";
		}
	?>
	</div>
	<div class="largecol">
	<?php
		if (!isset($on_hold_message))  {
			switch ($current)  {
				case "create":
					$this->load->view('door/user_form');
					break;
				case "pass":
					$this->load->view('door/pass_form', $data);
					break;
				case "about":
					$this->load->view('door/about');
					break;
				case "recovery":
					$this->load->view('door/choose_pass_form', $data);
					break;
				case "login":
					$this->load->view('door/auth_form', $data);
					break;
				default:
					$this->load->view('door/intro', $data);
					break;
			}
		}  else  {
			echo '
				<div style="border:1px solid red;">
					Excessive Login Attempts
					<p>
						You have exceeded the maximum number of failed login<br />
						attempts that this website will allow.
					<p>
					<p>
						Your access to login and account recovery has been blocked for ' .
						((int) config_item('seconds_on_hold') / 60) . ' minutes.
					</p>
					<p>
						Please use the <a href="/examples/recover">Account Recovery</a> after ' .
						((int) config_item('seconds_on_hold') / 60) . ' minutes has passed,<br />
						or contact us if you require assistance gaining access to your account.
					</p>
				</div>
			';
		}
	?>
	</div>
	<div class="smallcol">
	<?php
		if (!isset($on_hold_message))  {
			if (!in_array($current, $pages))  {
				echo "We hope to become your one stop shop for activism neds.";
			}  else  {
				echo "Not sure what to do with the right. Social stuff maybe.";
			}
		}  else  {
			echo "&nbsp;";
		}
	?>
	</div>
</div>
