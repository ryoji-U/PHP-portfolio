<?php

require_once('../../dbc.php');

class Test extends Dbc{
	public function test2(){
		$this->dbConnect();
	}	
}

$test = new Test();
$test->test2();


?>