
<div class="container">
	Campaigns total: <?php echo $cam_total[0]['total']; ?><br />
	Current campaigns: <?php echo $cam_current[0]['total']; ?><br />
	Average signatures per hour: <?php echo $sign_avg; ?><br />
	Top campaign: "<a href="/admin/cam/select/<?php echo $cam_top[0]['cam_id'] ?>"><?php echo $cam_top[0]['title']; ?></a>"<br />	
</div>
