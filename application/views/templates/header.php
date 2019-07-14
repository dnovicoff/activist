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
		<div class="container">
			<div class="smallcol">
                	<h3><a href="/">Actifish</a></h3><br />
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

