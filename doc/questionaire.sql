高考（新）
CREATE TABLE `en_gk_1` (/*高考单选题*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `timu`    varchar(2048) NOT NULL,
  `timu2`   varchar(256),
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `answer`  int unsigned,
  `tishi`   varchar(1024)
);
CREATE TABLE `en_gktj_1` (/*高考单选题统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_gk_2` (/*高考多选题*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `timu`    varchar(4096) NOT NULL,
  `timu2`   varchar(256),
  `answer`  int unsigned,
  `tishi`   varchar(1024)
);
CREATE TABLE `en_gktj_2` ( /*高考多选题统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_gk_danci`(/*高考单词练习*/
  `no`        int unsigned NOT NULL PRIMARY KEY,
  `name`      varchar(64) NOT NULL,
  `level`     varchar(8),
  `chinese`   varchar(256),
  `xuan1`     varchar(64),
  `xuan2`     varchar(64),
  `xuan3`     varchar(64),
  `xuan4`     varchar(64),
  `cn1`       varchar(256),
  `cn2`       varchar(256),
  `cn3`       varchar(256),
  `cn4`       varchar(256)
);
CREATE TABLE `en_gktj_danci`(/*高考单词练习统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);

SAT（新）
CREATE TABLE `en_Log_all`(
  `userid`   varchar(16),
  `datetime` varchar(32),
  `t_type`   varchar(16),
  `t_no`     integer,
  `choice`   varchar(16),
  `answer`   varchar(16)
);
CREATE TABLE `sat_movie`(
  `no`   integer NOT NULL PRIMARY KEY,
  `id`   varchar(32) NOT NULL,
  `path` varchar(64) binary NOT NULL
);
CREATE TABLE `en_sat_math1`(/*SAT数学1*/
  `no`      integer NOT NULL PRIMARY KEY,
  `timu`    varchar(64) NOT NULL,
  `answer`  varchar(1),
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `ch5`     varchar(256)
);
CREATE TABLE `en_sattj_math1`(/*SAT数学1统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sat_math2`(/*SAT数学2*/
  `no`      integer NOT NULL PRIMARY KEY,
  `timu`    varchar(64) NOT NULL,
  `answer`  varchar(1),
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `ch5`     varchar(256),
  `dif`		int unsigned,
  `typ`		varchar(16)
);
CREATE TABLE `en_sattj_math2`(/*SAT数学2统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sat_math3`(/*SAT数学3*/
  `no`      integer NOT NULL PRIMARY KEY,
  `timu`    varchar(64) NOT NULL,
  `answer`  varchar(1),
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `ch5`     varchar(256),
  `dif`		int unsigned,
  `typ`		varchar(16)
);
CREATE TABLE `en_sattj_math3`(/*SAT数学3统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sat_math4`(/*SAT数学4*/
  `no`      integer NOT NULL PRIMARY KEY,
  `timu`    varchar(64) NOT NULL,
  `answer`  varchar(1),
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `ch5`     varchar(256),
  `dif`		int unsigned,
  `typ`		varchar(16)
);
CREATE TABLE `en_sattj_math4`(/*SAT数学4统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `sat_math5`(/*SAT数学5*/
  `no`      integer NOT NULL PRIMARY KEY,
  `timu`    varchar(64) NOT NULL,
  `answer`  varchar(1),
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `ch5`     varchar(256),
  `dif`		int unsigned,
  `typ`		varchar(16)
);
CREATE TABLE `en_sattj_math5`(/*SAT数学5统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sat_danci`(/*SAT单词练习*/
  `no`        int unsigned NOT NULL PRIMARY KEY,
  `name`      varchar(32) NOT NULL,
  `level`     int unsigned,
  `yinbiao`   varchar(128) binary,
  `duyin`     varchar(32),
  `english`   varchar(64),
  `chinese`   varchar(256) binary,
  `movieid`   varchar(8),
  `movietime` varchar(8),
  `tishi`     varchar(64),
  `xuan1`     varchar(32),
  `xuan2`     varchar(32),
  `xuan3`     varchar(32),
  `xuan4`     varchar(32),
  `cn1`       varchar(64),
  `cn2`       varchar(64),
  `cn3`       varchar(64),
  `cn4`       varchar(64)
);
CREATE TABLE `en_sattj_danci`(/*SAT单词练习统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sat_danci2`(/*SAT单词填空*/
  `no`      integer NOT NULL PRIMARY KEY,
  `id`      varchar(8) NOT NULL,
  `timu`    varchar(512) NOT NULL,
  `ch1`     varchar(64),
  `ch2`     varchar(64),
  `ch3`     varchar(64),
  `ch4`     varchar(64),
  `ch5`     varchar(64),
  `an1`     varchar(8),
  `an2`     varchar(8),
  `an3`     varchar(8),
  `an4`     varchar(8),
  `an5`     varchar(8)
);
CREATE TABLE `en_sattj_danci2`(/*SAT单词填空统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sat_yufa`(/*SAT语法*/
  `no`      integer NOT NULL PRIMARY KEY,
  `id`      varchar(64),
  `timu`    varchar(255) NOT NULL,
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `ch5`     varchar(256),
  `an1`     varchar(160),
  `an2`     varchar(160),
  `an3`     varchar(160),
  `an4`     varchar(160),
  `an5`     varchar(160)
);
CREATE TABLE `en_sattj_yufa`(/*SAT语法练习统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_sattj_yufa2`(/*SAT语法测验统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);

托福（新）
CREATE TABLE `en_tf_danci`(/*托福单词*/
  `no`        int unsigned NOT NULL PRIMARY KEY,
  `timu`      varchar(1024) NOT NULL,
  `xuan1`     varchar(64),
  `xuan2`     varchar(64),
  `xuan3`     varchar(64),
  `xuan4`     varchar(64),
  `answer`    int unsigned
);
CREATE TABLE `en_tftj_danci`(/*托福单词统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_tf_svo1` (/*托福句子选择SVO1*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `mode`    varchar(4),
  `timu`    varchar(1024) NOT NULL,
  `a`       int unsigned,
  `b`       int unsigned,
  `c`       int unsigned
);
CREATE TABLE `en_tftj_svo1` ( /*托福句子选择SVO1统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_tf_svo15` (/*托福SV分别替换15*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `mode`    varchar(4),
  `timu`    varchar(2048) NOT NULL,
  `ch1`     varchar(256),
  `ch2`     varchar(256),
  `ch3`     varchar(256),
  `ch4`     varchar(256),
  `answer`  int unsigned
);
CREATE TABLE `en_tftj_svo15` ( /*托福SV分别替换15统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_tf_svo2` (/*托福原句和改写句中选择对应SVO2*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `mode`    varchar(4),
  `timu`    varchar(1024) NOT NULL,
  `timu2`   varchar(1024) NOT NULL,
  `a`       int unsigned,
  `b`       int unsigned,
  `c`       int unsigned
);
CREATE TABLE `en_tftj_svo2` ( /*托福原句和改写句中选择对应SVO2统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `tf_svo3` (/*托福抽象具体练习3*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `mode`    varchar(4),
  `timu`    varchar(2048) NOT NULL,
  `a`       int unsigned,
  `b`       int unsigned,
  `c`       int unsigned
);
CREATE TABLE `en_tftj_svo3` ( /*托福抽象具体练习3统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
CREATE TABLE `en_tf_svo4` (/*托福指代练习4*/
  `no`      int unsigned NOT NULL PRIMARY KEY,
  `mode`    varchar(4),
  `timu`    varchar(2048) NOT NULL,
  `a`       int unsigned,
  `b`       int unsigned,
  `c`       int unsigned
);
CREATE TABLE `tftj_svo4` ( /*托福指代练习4统计*/
  `timu_no`  int unsigned NOT NULL,
  `userid`   varchar(16),
  `yes`      int unsigned,
  `wrong`    int unsigned,
  `no`       int unsigned NOT NULL PRIMARY KEY auto_increment
);
