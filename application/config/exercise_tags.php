<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['exercises'] = array(
						'gmat' => array(
									array('score_en' => 'SC', 'score_cn' => '句子改正', 'subject' => array()),
									array('score_en' => 'CR', 'score_cn' => '批判性推理', 'subject' => array()),
									array('score_en' => 'RC', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '词汇', 'score_cn' => '词汇', 'subject' => array()),
								),
						'gre' => array(
									array('score_en' => '数学', 'score_cn' => '数学', 'subject' => array()),
									array('score_en' => '单词', 'score_cn' => '单词', 'subject' => array()),
									array('score_en' => '语法', 'score_cn' => '语法', 'subject' => array()),
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
								),
						'ielts' => array(
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '听力', 'score_cn' => '听力', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
									array('score_en' => '口语', 'score_cn' => '口语', 'subject' => array()),
								),
						'sat' => array(
									array('score_en' => '数学', 'score_cn' => '数学', 'subject' => array('SAT_math1' => array('sat_math1', 'SAT数学(1)'), 'SAT_math2' => array('sat_math2', 'SAT数学(2)'), 'SAT_math3' => array('sat_math3', 'SAT数学(3)'), 'SAT_math4' => array('sat_math4', 'SAT数学(4)'), 'SAT_math5' => array('sat_math5', 'SAT数学(5)'))),
									array('score_en' => '单词', 'score_cn' => '单词', 'subject' => array('单词练习' => array('sat_danci1', 'SAT单词练习'), '单词填空' => array('sat_danci2', 'SAT单词填空'))),
									array('score_en' => '语法', 'score_cn' => '语法', 'subject' => array('语法练习' => array('sat_yufa1', 'SAT语法练习'), '语法测验' => array('sat_yufa2', 'SAT语法测验'))),
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
								),
						'toefl' => array(
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '听力', 'score_cn' => '听力', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
									array('score_en' => '口语', 'score_cn' => '口语', 'subject' => array()),
								),
						'gaokao' => array(
									array('score_en' => '单词', 'score_cn' => '单词', 'subject' => array('高考单词' => array('gktj_danci', '高考单词'))),
									array('score_en' => '语法', 'score_cn' => '语法', 'subject' => array('高考1' => array('gk_1', '高考单选题'), '高考2' => array('gk_2', '高考多选题'))),
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
								),
					);

/* End of File */