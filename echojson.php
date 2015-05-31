<?php
	$exercises = array(
					array('exercise_id' => '1', 'subject_en' => 'sat_math1', 'subject_cn' => 'SAT数学1', 'amount' => '25'),
					array('exercise_id' => '2', 'subject_en' => 'sat_danci', 'subject_cn' => 'SAT单词练习', 'amount' => '50'),
					array('exercise_id' => '3', 'subject_en' => 'sat_danci2', 'subject_cn' => 'SAT单词填空', 'amount' => '75'),
					array('exercise_id' => '4', 'subject_en' => 'sat_yufa', 'subject_cn' => 'SAT语法', 'amount' => '100')
				);
	
	echo serialize($exercises);
?>