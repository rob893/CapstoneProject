<?php
require_once('RelevancyRule.php');

class RelevancyRule1 extends RelevancyRule
{
	public function analyzeData($databaseData)
	{
		echo 'Analyzing data using RelevancyRule1!';
	}
}

?>