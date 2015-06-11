<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['exercises'] = array(
						'gmat' => array(
									array('score_en' => 'SC', 'score_cn' => '句子改正', 'subject' => array('阅读练习' => array('gmat_reading', 'GMAT阅读练习'))),
									array('score_en' => 'CR', 'score_cn' => '批判性推理', 'subject' => array('听力练习' => array('gmat_listening', 'GMAT听力练习'))),
									array('score_en' => 'RC', 'score_cn' => '阅读', 'subject' => array('写作练习' => array('gmat_writing', 'GMAT写作练习'))),
									array('score_en' => '词汇', 'score_cn' => '词汇', 'subject' => array('口语练习' => array('gmat_speaking', 'GMAT口语练习'))),
								),
						'gre' => array(
									array('score_en' => '数学', 'score_cn' => '数学', 'subject' => array('数学练习' => array('gre_math', 'GRE数学练习'))),
									array('score_en' => '单词', 'score_cn' => '单词', 'subject' => array('单词练习' => array('gre_words', 'GRE单词练习'))),
									array('score_en' => '语法', 'score_cn' => '语法', 'subject' => array('语法练习' => array('ielts_grammer', 'GRE语法练习'))),
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array('阅读练习' => array('ielts_reading', 'GRE阅读练习'))),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array('写作练习' => array('ielts_writing', 'GRE写作练习'))),
								),
						'ielts' => array(
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array('阅读练习' => array('ielts_reading', 'IELTS阅读练习'))),
									array('score_en' => '听力', 'score_cn' => '听力', 'subject' => array('听力练习' => array('ielts_listening', 'IELTS听力练习'))),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array('写作练习' => array('ielts_writing', 'IELTS写作练习'))),
									array('score_en' => '口语', 'score_cn' => '口语', 'subject' => array('口语练习' => array('ielts_speaking', 'IELTS口语练习'))),
								),
						'sat' => array(
									array('score_en' => '数学', 'score_cn' => '数学', 'subject' => array('SAT_math1' => array('sat_math1', 'SAT数学(1)'), 'SAT_math2' => array('sat_math2', 'SAT数学(2)'), 'SAT_math3' => array('sat_math3', 'SAT数学(3)'), 'SAT_math4' => array('sat_math4', 'SAT数学(4)'), 'SAT_math5' => array('sat_math5', 'SAT数学(5)'))),
									array('score_en' => '单词', 'score_cn' => '单词', 'subject' => array('单词练习' => array('sat_danci1', 'SAT单词练习'), '单词填空' => array('sat_danci2', 'SAT单词填空'))),
									array('score_en' => '语法', 'score_cn' => '语法', 'subject' => array('语法练习' => array('sat_yufa1', 'SAT语法练习'), '语法测验' => array('sat_yufa2', 'SAT语法测验'))),
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
								),
						'toefl' => array(
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array('托福单词练习' => array('toefl_reading', '托福单词练习'))),
									array('score_en' => '听力', 'score_cn' => '听力', 'subject' => array('托福SVO1' => array('toefl_listening', '托福句子选择SVO'))),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array('托福SV' => array('toefl_writing', '托福SV替换练习'))),
									array('score_en' => '口语', 'score_cn' => '口语', 'subject' => array('托福SVO2' => array('toefl_speaking', '托福原句改写对应SVO'))),
									array('score_en' => '口语', 'score_cn' => '口语', 'subject' => array('托福SVO3' => array('toefl_speaking', '托福抽象具体练习'))),
									array('score_en' => '口语', 'score_cn' => '口语', 'subject' => array('托福SVO4' => array('toefl_speaking', '托福指代练习'))),
								),
						'gaokao' => array(
									array('score_en' => '单词', 'score_cn' => '单词', 'subject' => array('高考单词' => array('gktj_danci', '高考单词'))),
									array('score_en' => '语法', 'score_cn' => '语法', 'subject' => array('高考1' => array('gk_1', '高考单选题'), '高考2' => array('gk_2', '高考多选题'))),
									array('score_en' => '阅读', 'score_cn' => '阅读', 'subject' => array()),
									array('score_en' => '写作', 'score_cn' => '写作', 'subject' => array()),
								),
					);

/* End of File */