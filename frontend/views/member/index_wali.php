<?php

$this->title='Dashboard';
?>

<div class='member-index'>
<div class='container'>
	<div class='row'>
		<div class='col-sm-3'>
			<?= $this->render('_menuWali');?>
		</div>
		<div class='col-sm-9'>
			<h1 class='page-header'><?= $this->title;?><h1>
			<?= $this->render('_dashboardWali');?>
		</div>
	</div>
</div>
</div>