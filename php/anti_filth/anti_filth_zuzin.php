<?php
	require_once('../general/connect.php');
	$connection = connect('database', 'root', '');
	if ($_SERVER['REQUEST_METHOD'] == "GET")
	{
		if (isset($_GET['input_text']))
		{
			$result_text = '';
			$text = $_GET['input_text'];
			$polite_text = '';
			$query = "SET NAMES utf8";
			$connection->prepare($query)->execute();
			$query = "SELECT * FROM bad_words";
			$sdh = $connection->prepare($query);
			$sdh->execute();
			$badwords_array = array_column($sdh->fetchAll(), 1);
			$text_array = explode(" ", $text);
			$fl = false;
			foreach ($text_array as $text_part)
			{
				if ($text_part == '') continue;
				foreach($badwords_array as $badword)
				{
					$word = trim($text_part,":;,.!?-");
					if ($word == '') continue;
					$f = strpos($text_part, $word);
					$first_part = mb_substr($text_part,0,$f);
					$third_part = mb_substr($text_part,mb_strlen($badword) + $f);
					$word = mb_strtolower($word);		
					if($word == $badword)
					{
						$text_part=$first_part.str_repeat("*",mb_strlen($badword)).$third_part;
						$fl = true;
					}
				}
				$result_text =  $result_text.$text_part.' ';
			}
			
			
			echo  mb_substr($result_text ,0,mb_strlen($result_text ) - 1);
		}
}
?>
