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
                <title><?php echo $data['title']; ?></title>
        </head>
        <body>
		<div class="container">
			<div class="head">
				<div class="smallcol">
				<?php
					$uri = "/";
					if (!empty($this->auth_role))  {
						$uri = "/admin";
					}
				?>
                		<a href="<?php echo $uri; ?>">Actifish</a>
				<br />
				<?php
					if (!empty($this->auth_role))  {
						echo '
							<div style="font-size: 12px;">
								<a href="/admin/logout">logout</a>
							</div>
						';
					}
				?>
				</div>
				<div class="largecol">
				Activism made simple
				</div>
				<div class="smallcol">
				</div>
			</div>
		</div>

