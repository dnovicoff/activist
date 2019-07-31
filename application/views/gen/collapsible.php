
<div class="container">
	<div class="collapsible-menu">
		<input type="checkbox" id="searchtypes">
		<label for="searchtypes">Search Types</label>
		<div class="menu-content">
			<ul>
			<?php
				foreach ($links as $link => $title)  {
					echo '<li><a href="'.$link.'">'.$title.'</a></li>';
				}
			?>
			</ul>
		</div>
	</div>
</div>
