<?php
switch (Yii::$app->user->identity->member->IdLev){
	
	case 4:
		echo $this->render('index_guru');
		break;
	case 5:
		echo $this->render('index_wali');
		break;
		
	
}

?>
