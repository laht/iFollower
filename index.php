<?php
require_once('common/view/output.php');
require_once('common/controller/application.php');

//instance of medoo framework for easy db useage
$database = new \common\model\medoo();
$app = new \common\controller\application($database);
$app->whatToDo();
//output class to get html
$output = new \common\view\output($database);

echo $output->getPage();
