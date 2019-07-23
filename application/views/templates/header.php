<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
        <head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/main.css">
		<?php
			if ($this->uri->segment(1) == 'admin')  {
				echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/user.css">';
			}
		?>
                <title>Activism</title>
        </head>
        <body>
		<div class="container" style="background: linear-gradient(blue, 10%, white);}">
			<div class="smallcol">
			<?php
				$uri = "/";
				if (!$data['login'])  {
					$uri = "/admin";
				}
			?>
                	<h3><a href="<?php echo $uri; ?>">Actifish</a></h3><br />
			<?php
				if (!empty($this->auth_role))  {
					echo "Welcome ".$this->auth_username."<br />";
					echo "ID: ".$this->auth_user_id;
				}
			?>
			</div>
			<div class="largecol">
			Activism made simple
			</div>
			<div class="smallcol">
			</div>
		</div>

