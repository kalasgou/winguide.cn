-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 07 日 17:22
-- 服务器版本: 5.5.28-log
-- PHP 版本: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `winguide`
--

-- --------------------------------------------------------

--
-- 表的结构 `wg_administrators`
--

CREATE TABLE IF NOT EXISTS `wg_administrators` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_articles`
--

CREATE TABLE IF NOT EXISTS `wg_articles` (
  `article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(16) NOT NULL,
  `admin_id` int(11) unsigned NOT NULL,
  `category` varchar(128) NOT NULL,
  `cover` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `keywords` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `summary` varchar(256) NOT NULL,
  `recommend` smallint(5) NOT NULL,
  `status` smallint(5) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_students`
--

CREATE TABLE IF NOT EXISTS `wg_students` (
  `student_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `course` varchar(32) NOT NULL,
  `purchase_time` int(11) unsigned NOT NULL,
  `start_time` int(11) unsigned NOT NULL,
  `end_time` int(11) unsigned NOT NULL,
  `init_pswd` varchar(16) NOT NULL,
  `reset_pwsd` smallint(5) NOT NULL,
  `status` smallint(5) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- 转存表中的数据 `wg_students`
--

INSERT INTO `wg_students` (`student_id`, `user_id`, `username`, `password`, `course`, `purchase_time`, `start_time`, `end_time`, `init_pswd`, `reset_pwsd`, `status`) VALUES
(1, 0, '000000_wg', '$2a$08$/cRSfl45x.8ESV1kMTzfEuKKmvJAdXJXsAkLkDLpVzXYIrh0FUYVq', 'gmat', 1428256111, 0, 0, '2up3zf2s', 0, 0),
(2, 0, '000001_wg', '$2a$08$gcgrwbZ0zysRN76ixHJ4XORRG5c.766uErrVlxL4MQ0Kk8RnVfsvO', 'gmat', 1428256111, 0, 0, 's5GDLgUK', 0, 0),
(3, 0, '000002_wg', '$2a$08$haUyF2edgxfOysAm1DT8r.CcTTnXTY6g6SdQyldze7N6TqVC3uxd6', 'gmat', 1428256111, 0, 0, 'LwnzNbgQ', 0, 0),
(4, 0, '000003_wg', '$2a$08$3Pe3zAZ813mFVk6/rCfWJ.7b.vOJNvxRANCPxsRhm3MHMwkAYfRtW', 'gmat', 1428256111, 0, 0, 'JD3oQ1oq', 0, 0),
(5, 0, '000004_wg', '$2a$08$y/iTyP654A9hh0YyqvLhjOmS14ZWR1i5266aCl/BOjOykaCjYjDlu', 'gmat', 1428256111, 0, 0, 'MtYhGCWw', 0, 0),
(6, 0, '000005_wg', '$2a$08$jLgf.EaBVaoDrobgKnV7seBF4TOOGq1KZONTl5AbvKC0TaBG5fcQ6', 'gmat', 1428256111, 0, 0, 'FqDfvZPN', 0, 0),
(7, 0, '000006_wg', '$2a$08$0oO50NPWcru5jPDDqHDZjuJXQZcxpZ9hD0WcNz86UOo1IgF3Azr.6', 'gmat', 1428256111, 0, 0, '5CDEPRwQ', 0, 0),
(8, 0, '000007_wg', '$2a$08$7Q2W6PrglCcXpI.zZ.fOmeGUqjHatwbXdFg2rQX6yzt4cdvGWmSLC', 'gmat', 1428256111, 0, 0, 'xgFdb0CS', 0, 0),
(9, 0, '000008_wg', '$2a$08$D.Bod4PidxAqfwGPIENv9OPChf.3MoJiJpD6dpYYymqGOX63ilUN.', 'gmat', 1428256111, 0, 0, 'EcIVomNM', 0, 0),
(10, 0, '000009_wg', '$2a$08$Y.HzwgKdG7Xyzr/d0V0HNuA4ii25liC3VNkoNltrYWFLbGS2bDSEC', 'gmat', 1428256111, 0, 0, 'xEiP50HB', 0, 0),
(11, 0, '00000a_wg', '$2a$08$sYGbuq54VrmXAM8QpxW.uez8bSjI1hRlFUmvO0uVqKnYmlMfzImIa', 'sat', 1428256116, 0, 0, '52UokqIQ', 0, 0),
(12, 0, '00000b_wg', '$2a$08$W31dpg.9ZfrWyzm2a3LTceT8cwwh/XW704QWupZr1orXFDglKCGk.', 'sat', 1428256116, 0, 0, 'kUPQtXBL', 0, 0),
(13, 0, '00000c_wg', '$2a$08$cJXdNYdtE8UVEV0xYsZ/qOrPz.iBpw0EwitEqnhi.fkDgukgakBNK', 'sat', 1428256116, 0, 0, 'LIbkpl3l', 0, 0),
(14, 0, '00000d_wg', '$2a$08$0mLJimPxxuzC588Sl//lv.6kYi/CjXQluMxhRJ0ghKPZDu0eeVUZW', 'sat', 1428256116, 0, 0, 'vRkUHpzS', 0, 0),
(15, 0, '00000e_wg', '$2a$08$vaNLhXB/KY9TlDsPPwZQ.Ou.YAiNA8C5YpBK1V1I3c2t9P22Mtcne', 'sat', 1428256116, 0, 0, 'NENPqK6m', 0, 0),
(16, 0, '00000f_wg', '$2a$08$ugeLifACZB6PSVeEKtbVZuno.SoA4MFrbgszWKDFwITJXS/cDQ0oq', 'sat', 1428256116, 0, 0, '7Ewu4tgv', 0, 0),
(17, 0, '00000g_wg', '$2a$08$rGOAdI/vAoqUjuLmTGcyP.dAtkHO00AqwZHVoRqotqEF2ZdHi9R1u', 'sat', 1428256116, 0, 0, '8h4SWNoz', 0, 0),
(18, 0, '00000h_wg', '$2a$08$4U38HC5qxOZAByg8nOOEjOtV4a/RmVTEjrrlBPh/BfGXNiJFoDaCC', 'sat', 1428256116, 0, 0, 'mETPvx0u', 0, 0),
(19, 0, '00000i_wg', '$2a$08$GJJOhpefFrdHBnMt4/sgYesI67gc2y1D695MIFQjnNer7TfGHQM1q', 'sat', 1428256116, 0, 0, 'yG3tpZaW', 0, 0),
(20, 0, '00000j_wg', '$2a$08$E/C.mUYFGZds9On8Jbb.ZOxs3mWy4ucTE6aO4Lnnvc7p5hiIMB2Bi', 'sat', 1428256116, 0, 0, 'KDcYnaST', 0, 0),
(21, 0, '00000k_wg', '$2a$08$RxCTsysrK0EDQ9tKLyV0xeQtCvAYv2mb2l66Z9m.Quavxdmt4as7K', 'gre', 1428256120, 0, 0, 'jOovpDzE', 0, 0),
(22, 0, '00000l_wg', '$2a$08$w1u.t4f3YuVNQbZtIXauiO/A9XvPi6vhpWyeru8g6gJIlBWYPev9q', 'gre', 1428256120, 0, 0, 'kG7VAUns', 0, 0),
(23, 0, '00000m_wg', '$2a$08$mXW9miSgiB6VJWLbP1Qe8uhcDAkDKPrkIdprgOFJnJBzij0hnUFcG', 'gre', 1428256120, 0, 0, 'cLtwLsn7', 0, 0),
(24, 0, '00000n_wg', '$2a$08$vrmiIDaYeHqoNqbxJPDiJugrky8Be/NDrsxEq5qBV54sblz3YzAgO', 'gre', 1428256120, 0, 0, 'xDhuwOUV', 0, 0),
(25, 0, '00000o_wg', '$2a$08$2NUsc7RcgYjeqen4vJvtL.Ji7pFwdGakILA5/Oa1OHHCArwe4UVii', 'gre', 1428256120, 0, 0, 'dZYdbIha', 0, 0),
(26, 0, '00000p_wg', '$2a$08$YWg4KOok/RJKUhUYWodksuYxL7s1.vHTEw5caL0LgMvr305DakH7q', 'gre', 1428256120, 0, 0, '62NoR6xt', 0, 0),
(27, 0, '00000q_wg', '$2a$08$GvPNQTFkCjTNHhXm84um1ekktvDIUJpCfqYwxHzw5cUr0I4Ets4Mu', 'gre', 1428256120, 0, 0, '9sAVDLEN', 0, 0),
(28, 0, '00000r_wg', '$2a$08$Cqhsh0r1D4GMazRBzYrGn.I.gQ5HTsfcEsCTdRzS5XCPPXQB06Z6S', 'gre', 1428256120, 0, 0, 'r7OKdcX2', 0, 0),
(29, 0, '00000s_wg', '$2a$08$cUQzePU.gID2etPUTWDRVe36iq.HJlebIi5ISjpjOtGemZzlWGJEu', 'gre', 1428256120, 0, 0, 'O9rHzpg5', 0, 0),
(30, 0, '00000t_wg', '$2a$08$yEIvD0g6ZgtibD0pVdh5ouuIK/pmDZbUAaYKSoP2enWg17qBPvo5S', 'gre', 1428256120, 0, 0, 'dFUfPreg', 0, 0),
(31, 0, '00000u_wg', '$2a$08$epYrE1tTd7GrER8WZ4P26euba/QHa2SyemokPqemzVFoNs1ZrSto.', 'gmat', 1428256613, 0, 0, 'dvCMOGAB', 0, 0),
(32, 0, '00000v_wg', '$2a$08$dokFFaHJgSA/42jXLqbnfeWTJM8C6QM9ZsMu2uaolZaQ4VlZfeQve', 'gmat', 1428256613, 0, 0, 'FDrhbVg0', 0, 0),
(33, 0, '00000w_wg', '$2a$08$s5OhDMXK0DEWfefrlkxdJeaZy8X96L.b0ZkfcnZGgbgiHV0ljqDd6', 'gmat', 1428256613, 0, 0, 'mwOvhfNN', 0, 0),
(34, 0, '00000x_wg', '$2a$08$CmG7E6/gWpTUQTRPqItQXuNtdSIy/3J1hbjm6fscQ6HEhLO7nQXnK', 'gmat', 1428256613, 0, 0, 'vfVXJRmR', 0, 0),
(35, 0, '00000y_wg', '$2a$08$J00qfVKqz8ovBzsPAd2Bfu6aTi6qnq.0S3YwBivy5/ISTYQLhMYjy', 'gmat', 1428256613, 0, 0, 'afX3YT2d', 0, 0),
(36, 0, '00000z_wg', '$2a$08$9Gm/WtBc9Wr02Cofr7pKBOVozsOcaqWJac9jKmwv.R1gcxZVjhYZW', 'gmat', 1428256613, 0, 0, '81IbqtSD', 0, 0),
(37, 0, '000010_wg', '$2a$08$OqzfD9YETYjjLi5hudeUVuab8wO6DG6dXcguDkWgoRtP33mWHqSc6', 'gmat', 1428256613, 0, 0, 'wtkvJzUt', 0, 0),
(38, 0, '000011_wg', '$2a$08$uQnaCgE4C0c518dpi3Naj.x/2Y3fsbeHQD92mhAOeugzRm9RlQIV.', 'gmat', 1428256613, 0, 0, '91q47OqT', 0, 0),
(39, 0, '000012_wg', '$2a$08$CdVqkk37WXVhBxymntSOFeShaWz5vzQYoG4.l83RN66C.53S3cRIC', 'gmat', 1428256613, 0, 0, 'UM53hNEM', 0, 0),
(40, 0, '000013_wg', '$2a$08$egxblLHX4J8ma1aAxtI8Ue/ShNHuDfG3BasL5owRA2urzEwlWYWp2', 'gmat', 1428256613, 0, 0, 'bLTIRLe5', 0, 0),
(41, 0, '000014_wg', '$2a$08$cGjh8.bkoauluCqa9MbvwOOblVFdnNwNxSwFN3u0xLwsdmhWOWVuO', 'gmat', 1428257096, 0, 0, 'WVne9Imb', 0, 0),
(42, 0, '000015_wg', '$2a$08$TOSUbjGB.JFFvpz.95.tDeX4ZZvidkb7xdPW90ij1PEcuvDLtYqx6', 'gmat', 1428257096, 0, 0, '2emfI3zv', 0, 0),
(43, 0, '000016_wg', '$2a$08$4sPYISce87OzIxkFcCYCX.B4OvTleim9TjHKClFrq5kJY8hSd16vS', 'gmat', 1428257096, 0, 0, 'UWZGnKf7', 0, 0),
(44, 0, '000017_wg', '$2a$08$0ZEBs63jsoRwjTSAGIZPXeJanE64AqWCRmniANrlprshH74AKcidy', 'gmat', 1428257096, 0, 0, '9QlzuLRj', 0, 0),
(45, 0, '000018_wg', '$2a$08$DLqw8aS8quhchH9mxCycH.r357WRBN0qVVKLOsxFXBvnRcECAKtT6', 'gmat', 1428257096, 0, 0, 'iphnQc1R', 0, 0),
(46, 0, '000019_wg', '$2a$08$wIakSN4VxavY6Zy1oCDPqeBhBJBaLtriPKpo5ansNrVQnn6NUUVCm', 'gmat', 1428257096, 0, 0, 'ZZNGrrcR', 0, 0),
(47, 0, '00001a_wg', '$2a$08$UoXd9Q.j.6GBvZW/Uq8Nh.SIyLriJSzDwhmn5m9Ac8NMxA6wj1NJW', 'gmat', 1428257096, 0, 0, 'bXHf4PLQ', 0, 0),
(48, 0, '00001b_wg', '$2a$08$46Uo.VwEbOUFt3lk6ophhu5QqNeABTonV7SbhLhCV9DclRlzSjqce', 'gmat', 1428257096, 0, 0, 'RnQCYE7J', 0, 0),
(49, 0, '00001c_wg', '$2a$08$SQaNLwmkpH7ESyD03hqGfeT.5wmcNBq2.bNu1PyogfF.SwkwdNH/2', 'gmat', 1428257096, 0, 0, 'P5DVWhh7', 0, 0),
(50, 0, '00001d_wg', '$2a$08$ip5D.b6dq1qqiqVU014PS.NS88EZGOcck22j/y5hyehFkzMLZpejS', 'gmat', 1428257096, 0, 0, 'dsFXbOKU', 0, 0),
(63, 0, '00001q_wg', '$2a$08$6edSI9GfzTdD3SrQdlBaGeo/ccMvrdtIlsoiAo8kQhMhQvLfwdqk2', 'gmat', 1428257401, 0, 0, 'Ko5rn3Ri', 0, 0),
(51, 0, '00001e_wg', '$2a$08$AmZakUgDZlmrQwOvAQNCf.oHiVziLerVkBmOSV/c5VeVBWKdpvViW', 'gmat', 1428257214, 0, 0, 'CBQLKUFP', 0, 0),
(52, 0, '00001f_wg', '$2a$08$qDxlj2y5sgM13plNzHgV9.flYLRxr48MTNQ9lQ.o51/YsmakM64Wy', 'gmat', 1428257214, 0, 0, '8Hqvx2nE', 0, 0),
(53, 0, '00001g_wg', '$2a$08$ffom0SRFl20t7selEkI9DuKTIs0JB65B7pbfUmQZ3zybzNKDMvmtW', 'gmat', 1428257214, 0, 0, 'eQSrpnqC', 0, 0),
(54, 0, '00001h_wg', '$2a$08$HETeHLA78mmdHwKVnUUm4ep0sArUfLJAr48ZBbik0zn0U5L9Py70y', 'gmat', 1428257214, 0, 0, 'uzkMyVxk', 0, 0),
(55, 0, '00001i_wg', '$2a$08$PdFZN5pxmYL9xe0QLPzEs.j0vgSmhjIRNd1gRAH82.lDoksW.QO4C', 'gmat', 1428257214, 0, 0, 'G882UeLO', 0, 0),
(56, 0, '00001j_wg', '$2a$08$kWPQohOOk9dZ4o6rc.hB0eTF6EB8ATnu5HonHZcqXr7uUtZBPtzJW', 'gmat', 1428257214, 0, 0, 'oh7UOZKz', 0, 0),
(57, 0, '00001k_wg', '$2a$08$JBKAVLzuZAgIOHYGmo6NJu6ZRkz2nPmX.2WrRnotMqTyNK125e1XG', 'gmat', 1428257214, 0, 0, 'OLtDLDzT', 0, 0),
(58, 0, '00001l_wg', '$2a$08$EeuVFVOoZWzStLfVADQ8pu.VOJLbE3uF0567e7An7s7eF.QH7wpOG', 'gmat', 1428257214, 0, 0, 'SQGgBeaK', 0, 0),
(59, 0, '00001m_wg', '$2a$08$eCXpmXb6uPQl.d6rHdy59uzxsKKk6SuOj.Ri/03KYwKo5hokXMEyO', 'gmat', 1428257214, 0, 0, 'FTfOoZeo', 0, 0),
(60, 0, '00001n_wg', '$2a$08$7afDn8dFpkOvmqjs2IX43.o1zGO3Beu0prOa/nm2Ia.cH7cyl6m0u', 'gmat', 1428257214, 0, 0, 'S1KttXTW', 0, 0),
(62, 0, '00001p_wg', '$2a$08$wxQJajELLV8Lnu8kRHvlCuUNw6Z2hgS19K2YHMNAu7.q7e6kGmfam', 'gmat', 1428257401, 0, 0, 'bwWV0zJp', 0, 0),
(61, 0, '00001o_wg', '$2a$08$WsIc8MBaoVlbVOTAAp2V7OCSea.WBxvEeqfi/zs2wBNKsZL0MFZXC', 'gmat', 1428257401, 0, 0, 'u7M4Awvi', 0, 0),
(64, 0, '00001r_wg', '$2a$08$44PBqDPohVzXki9OgoB/1OumOX05XJ9VXSH/kqY4SXBsx/UHGgdU6', 'gmat', 1428257401, 0, 0, 'wh4SJlHN', 0, 0),
(65, 0, '00001s_wg', '$2a$08$HYmZ5DaVxKykNtwFAiUxIujNlgKXevoAGgBAK4AgHiErwb6sskWJK', 'gmat', 1428257401, 0, 0, 'K64oFcNA', 0, 0),
(66, 0, '00001t_wg', '$2a$08$cUwrOao.mJyj3bfe8bPWTud4qsZJFUweD3RaPc.o26y6Eq5QrnOda', 'gmat', 1428257401, 0, 0, 'edKWmMAr', 0, 0),
(67, 0, '00001u_wg', '$2a$08$DzDxLuHf/egk9icNRvLZ6.FnvmiebjHHpTt.b7xsXo6tBS.gelAsO', 'gmat', 1428257401, 0, 0, 'lwdlNh4N', 0, 0),
(68, 0, '00001v_wg', '$2a$08$CMqZ9yFQ5NxmM0W6voo0T.Jq42qx6xdV15n7nD5xuO09vn.21uIai', 'gmat', 1428257401, 0, 0, 'xefF3Fcw', 0, 0),
(69, 0, '00001w_wg', '$2a$08$u8bk58G2fnK8zW7ll/ERKe9Ncnc2yQuZQDhgZZ5Q3EyA6pyRfCozy', 'gmat', 1428257401, 0, 0, 'qNmy4YD7', 0, 0),
(70, 0, '00001x_wg', '$2a$08$h6RACNX8ezlgj6uv7evkl.d6UzQHSB7mDKQ7SqnxaH47u7TFWqaJS', 'gmat', 1428257401, 0, 0, 'yAcypEbj', 0, 0),
(71, 0, '00001y_wg', '$2a$08$kBetmRN/JF7v5wDkOcAMluSVpw8Zog/aolE4NanxIBxt/L3tD/pnC', 'gmat', 1428295071, 0, 0, 'guPdCIlt', 0, 0),
(72, 0, '00001z_wg', '$2a$08$518pocKaWct9fsKeIbMBx.jEJSOeTQ4xmX4yZZoqHbEJTe6eeHlHm', 'gmat', 1428295071, 0, 0, 'nakUwZ7o', 0, 0),
(73, 0, '000020_wg', '$2a$08$pQ/CE1lCPH5NR6l6OPGio.8ab/P.ToXY6Dt8JrBjKdS.zh0j28gtO', 'gmat', 1428295071, 0, 0, 'MztF1duJ', 0, 0),
(74, 0, '000021_wg', '$2a$08$DQjhP/fcsB03I66zG2ETKOASIUXEii2b5ie2/f.j.5GsPJaaZQEry', 'gmat', 1428295071, 0, 0, '5j2QQbNU', 0, 0),
(75, 0, '000022_wg', '$2a$08$RU5AlOxzh7zG2p6V01xnAe7dL/DS88jKfDXI/o6pRmjUBFLGWNhIO', 'gmat', 1428295071, 0, 0, 'wnhWndi6', 0, 0),
(76, 0, '000023_wg', '$2a$08$g.wJGcGT6o91BaV2IuPjAOYgGPPVu3FII3f09TNq7VmT.AwydrgxW', 'gmat', 1428295071, 0, 0, 'reQR8e65', 0, 0),
(77, 0, '000024_wg', '$2a$08$sING.0NnIwrvU9XKQasIreu62Etog0v82XYmHKV5bwiE3bR/iWr8W', 'gmat', 1428295071, 0, 0, 'G9oaSCK3', 0, 0),
(78, 0, '000025_wg', '$2a$08$iSlr8Nk31kt8U964KGiituhx8QXSzNhgJ/SJGxlLmoFhji.231seO', 'gmat', 1428295071, 0, 0, '6Tmchgsc', 0, 0),
(79, 0, '000026_wg', '$2a$08$LgvG/jIlsIFuxXBBghNQke7eaYmfMgt772gOvqxt/DuznY7rgpYUe', 'gmat', 1428295071, 0, 0, 'NjZGyLD6', 0, 0),
(80, 0, '000027_wg', '$2a$08$s1oU4oU1.YPSv2h2jMt5rugVcH5HG3BAnUlqmksCl89R0.dSh1USO', 'gmat', 1428295071, 0, 0, '6EkGrc5Y', 0, 0),
(81, 0, '000028_wg', '$2a$08$JEiiaHOcOv0Rwk75N1sU1uOqn6J.x3Ku70wfMvfdQYozb6Or5hLFK', 'ielts', 1428295191, 0, 0, 'SYxf4L28', 0, 0),
(82, 0, '000029_wg', '$2a$08$Pgf4lgAvqe/czjR4XKAI/e4PspHb/paNQHvYJ0qK2KNwJty9KCiDK', 'ielts', 1428295191, 0, 0, 'FopuTCTP', 0, 0),
(83, 0, '00002a_wg', '$2a$08$36rfJ0ZVoi1xVEvmPNB7ROVgV1t2/SZ3LtZrGCbUCtyJvOdBrQ3ny', 'ielts', 1428295191, 0, 0, 'rroyY9Py', 0, 0),
(84, 0, '00002b_wg', '$2a$08$Qo3TpV./oICNV4jC9D9qgOagHwXWN7dQwIFDYb60e2uz6Jj9dmo86', 'ielts', 1428295191, 0, 0, 'ZTK8yAXv', 0, 0),
(85, 0, '00002c_wg', '$2a$08$r8/H.XceF.VutrRoUIxw9.SEh605C2WN7.zPi7W3Sqs.yk2xRSALS', 'ielts', 1428295191, 0, 0, 'gBb376I4', 0, 0),
(86, 0, '00002d_wg', '$2a$08$LL/KMYIt4NYCqy4o90KlieEJ4ORm9YloIpdJDYb1EV6RijbDZOP92', 'ielts', 1428295191, 0, 0, 'PUBtuTsP', 0, 0),
(87, 0, '00002e_wg', '$2a$08$pYMeOAxoxGbQY/7WJ5DYU.J4oV9x4fS2yZSwxB2OKstS3aXld1./y', 'ielts', 1428295191, 0, 0, 'jHx1HuD2', 0, 0),
(88, 0, '00002f_wg', '$2a$08$qbV0uAe9j72/XJYoAOnpcuK5wAxewTP.8f8o6MtwhvZrxOJMqqhcG', 'ielts', 1428295191, 0, 0, 'JJohjM90', 0, 0),
(89, 0, '00002g_wg', '$2a$08$VpDDSCk0zvSi94MAh6r2Z..W50S6BN7.r6Vte015IEamMe6zr3Jia', 'ielts', 1428295191, 0, 0, '6Z3QuVc0', 0, 0),
(90, 0, '00002h_wg', '$2a$08$wfVaKZSe1gY2dmc5KOfS.OoAvWR.jdsBy1Rgp6pM6XMXzLHjuInvK', 'ielts', 1428295191, 0, 0, 'D9FMvPvB', 0, 0),
(91, 2, '00002i_wg', '$2a$08$YwGT/vqmg2g/2c9azhW9EufkA52I1FKkbVyl3slw8se790NvmWp4O', 'ielts', 1428295227, 0, 0, 'lrXKQqRZ', 0, 1),
(92, 2, '00002j_wg', '$2a$08$OntrAH1Zir1tpA2wcq8znOIDBITWlJz/fu9.E9TcxUyfJgzyiuzXq', 'ielts', 1428295227, 0, 0, 'l31KDUne', 0, 1),
(93, 0, '00002k_wg', '$2a$08$bVbCJUwDYv3zttD2PW7abOiEJ2tAEd7b77s9jwwbTWUXLbGJiCprO', 'ielts', 1428295227, 0, 0, 'dqsvmDJs', 0, 0),
(94, 0, '00002l_wg', '$2a$08$PxKkBxg6.olH75oYmPnDROR4uvohgJfZ277IRDAVpnPbKfIrKryoy', 'ielts', 1428295227, 0, 0, 'Ir6hH6CE', 0, 0),
(95, 0, '00002m_wg', '$2a$08$hZYJ4gSzY8VULF3Qj.Ls4ebcUCWHBhu02eCsyHQwv4KRqMoC/YaxK', 'ielts', 1428295227, 0, 0, 'vCPfYpqN', 0, 0),
(96, 0, '00002n_wg', '$2a$08$0mD6ATUGML0PtXNXjsblNeDECl/JpRuq1Kbp2OZskgbuskgiIlqXq', 'ielts', 1428295227, 0, 0, 'rKRQY3cq', 0, 0),
(97, 0, '00002o_wg', '$2a$08$A.eELosYElMhAxgIPGvmF.PefkmOlBZU7rAjNTtL3XX6yQeDjjXKC', 'ielts', 1428295227, 0, 0, 'Cn7xlIZY', 0, 0),
(98, 0, '00002p_wg', '$2a$08$ZrpIc/ZUkEgCOevAksXnZeWwfC7Zni.EyW16uBGRH0X4RyLe4NPbW', 'ielts', 1428295227, 0, 0, 'wN54B86U', 0, 0),
(99, 0, '00002q_wg', '$2a$08$MLmBb9M50aoGftS/zeLviuoAT9xMdxdLg030LxKCOUCmL50ow2bra', 'ielts', 1428295227, 0, 0, 'F7dayQhN', 0, 0),
(100, 0, '00002r_wg', '$2a$08$YdBs3hslijA4iZQpncd36.X7wMAjhpzX1ORrSnxaSkvmLNkWvz3aC', 'ielts', 1428295227, 0, 0, '0uxTkVL1', 0, 0),
(101, 0, '00002s_wg', '$2a$08$/PvkDuvJRwZtkPLPEPx2l.1zwggaz2XcbHcLps7wXfReW1q6xHN6i', 'ielts', 1428295230, 0, 0, 'Z3ls8MlC', 0, 0),
(102, 0, '00002t_wg', '$2a$08$nPkedtPS0YRnXh9O0OVvEesSp/s08OXDGHJijmyDhtt62dTjA5JfK', 'ielts', 1428295230, 0, 0, 'ahov3JTq', 0, 0),
(103, 0, '00002u_wg', '$2a$08$49eBrjVrNDapod264MLjc.xuNQAlYXknIQoup4yCs7AuMhOSrZbsS', 'ielts', 1428295230, 0, 0, 'aAf5l7I0', 0, 0),
(104, 0, '00002v_wg', '$2a$08$68PXW7os9InIxc8kR9EkYOm4IvJQKx27P.qxflYJ1z8U8EmVe8Om6', 'ielts', 1428295230, 0, 0, '9ppJWljN', 0, 0),
(105, 0, '00002w_wg', '$2a$08$sxNFMAcaqd5qJKjmB/q8GOeNZabedRKiR84rcncwWXOrsXPwR3eBW', 'ielts', 1428295230, 0, 0, 'WsRwbCkl', 0, 0),
(106, 0, '00002x_wg', '$2a$08$QJvZuKC66E897WePOBQJ7.o4IeCsLXWUqqhhGmghU1T5gFiiZ6kkC', 'ielts', 1428295230, 0, 0, 'clE8FxUM', 0, 0),
(107, 0, '00002y_wg', '$2a$08$mTpusSCf0H7fvqRIGuA51unegoFfPxJPSO9O1AO/foMpeonfQrzyG', 'ielts', 1428295230, 0, 0, 'EczCm2ch', 0, 0),
(108, 0, '00002z_wg', '$2a$08$O6ZI1mMR.U/0oiOUvGRnwO4lMBRAoDOEPjUTY.CuTZqd39rL1lBYW', 'ielts', 1428295230, 0, 0, 'FPVdlVQr', 0, 0),
(109, 0, '000030_wg', '$2a$08$dJ8g2PLHckbq1TQLuNQWJexCKGVI570NKJmlmbZ7fpvv4DOpzFzYi', 'ielts', 1428295230, 0, 0, '2hnzmQYN', 0, 0),
(110, 0, '000031_wg', '$2a$08$L9zdsYtX8W/yFgkggZLSme3z2kSATmp/vv3p2fol6rpblYFzDlt4e', 'ielts', 1428295230, 0, 0, 'NiXI3Va9', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_application`
--

CREATE TABLE IF NOT EXISTS `wg_student_application` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `degree` varchar(128) NOT NULL,
  `major` varchar(256) NOT NULL,
  `entrance_time` date NOT NULL,
  `country_region` varchar(256) NOT NULL,
  `expenses_expected` varchar(64) NOT NULL,
  `school_type` varchar(128) NOT NULL,
  `school_requirement` int(11) NOT NULL,
  `school_expected` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='拟申请留学信息' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wg_student_application`
--

INSERT INTO `wg_student_application` (`id`, `student_id`, `degree`, `major`, `entrance_time`, `country_region`, `expenses_expected`, `school_type`, `school_requirement`, `school_expected`) VALUES
(1, 92, 'werwer', 'ertert', '0000-00-00', 'rete', 'tertsert', 'ertert', 0, 0),
(2, 91, 'werwer', 'ertert', '0000-00-00', 'rete', 'tertsert', 'ertert', 0, 0),
(3, 91, 'werwer', 'ertert', '0000-00-00', 'rete', 'tertsert', 'ertert', 0, 0),
(4, 91, 'werwer', 'ertert', '0000-00-00', 'rete', 'tertsert', 'ertert', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_education`
--

CREATE TABLE IF NOT EXISTS `wg_student_education` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `degree` enum('middle','high','college','institute') NOT NULL,
  `profile` varchar(256) NOT NULL,
  `quality` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='教育背景' AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `wg_student_education`
--

INSERT INTO `wg_student_education` (`id`, `student_id`, `degree`, `profile`, `quality`) VALUES
(1, 92, 'middle', 'school', 'test'),
(2, 92, 'middle', 'property', 'effasgfsdg'),
(3, 92, 'middle', 'address', 'sdfgsdfgs'),
(4, 92, 'middle', 'zip_code', 'sdfgdgf'),
(5, 92, 'middle', 'entrance_time', 'sdgsdfg'),
(6, 92, 'middle', 'departure_time', 'sdgfsdgf'),
(7, 92, 'middle', 'languages', 'sdgfsdfg'),
(8, 91, 'middle', 'school', 'test'),
(9, 91, 'middle', 'property', 'effasgfsdg'),
(10, 91, 'middle', 'address', ''),
(11, 91, 'middle', 'zip_code', ''),
(12, 91, 'middle', 'entrance_time', 'sdgsdfg'),
(13, 91, 'middle', 'departure_time', 'sdgfsdgf'),
(14, 91, 'middle', 'languages', 'sdgfsdfg'),
(15, 91, 'middle', 'school', 'test'),
(16, 91, 'middle', 'property', 'effasgfsdg'),
(17, 91, 'middle', 'address', ''),
(18, 91, 'middle', 'zip_code', ''),
(19, 91, 'middle', 'entrance_time', 'sdgsdfg'),
(20, 91, 'middle', 'departure_time', 'sdgfsdgf'),
(21, 91, 'middle', 'languages', 'sdgfsdfg'),
(22, 91, 'middle', 'school', 'test'),
(23, 91, 'middle', 'property', 'effasgfsdg'),
(24, 91, 'middle', 'address', NULL),
(25, 91, 'middle', 'zip_code', NULL),
(26, 91, 'middle', 'entrance_time', 'sdgsdfg'),
(27, 91, 'middle', 'departure_time', 'sdgfsdgf'),
(28, 91, 'middle', 'languages', 'sdgfsdfg');

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_family`
--

CREATE TABLE IF NOT EXISTS `wg_student_family` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `parent` enum('dad','mom') NOT NULL,
  `real_name` varchar(64) NOT NULL,
  `cellphone` varchar(32) NOT NULL,
  `company` varchar(128) NOT NULL,
  `position` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='家庭信息' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `wg_student_family`
--

INSERT INTO `wg_student_family` (`id`, `student_id`, `parent`, `real_name`, `cellphone`, `company`, `position`) VALUES
(1, 92, 'dad', 'gergaeg', 'gser', 'gaerg', 'argser'),
(2, 92, 'mom', 'aegser', 'aergar', 'awergaer', 'sfwer'),
(3, 91, 'dad', 'gergaeg', 'gser', 'gaerg', 'argser'),
(4, 91, 'mom', 'aegser', 'aergar', 'awergaer', 'sfwer'),
(5, 91, 'dad', 'gergaeg', 'gser', 'gaerg', 'argser'),
(6, 91, 'mom', 'aegser', 'aergar', 'awergaer', 'sfwer'),
(7, 91, 'dad', 'gergaeg', 'gser', 'gaerg', 'argser'),
(8, 91, 'mom', 'aegser', 'aergar', 'awergaer', 'sfwer');

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_referee`
--

CREATE TABLE IF NOT EXISTS `wg_student_referee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `real_name` int(11) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `company` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telephone` int(11) NOT NULL,
  `qq_weixin` int(11) NOT NULL,
  `addr` int(11) NOT NULL,
  `zip_code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='推荐人信息' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wg_student_referee`
--

INSERT INTO `wg_student_referee` (`id`, `student_id`, `real_name`, `sex`, `company`, `email`, `telephone`, `qq_weixin`, `addr`, `zip_code`) VALUES
(1, 92, 0, '', 'ertwert', 'ertwert', 0, 0, 0, 0),
(2, 91, 0, '', 'ertwert', 'ertwert', 0, 0, 0, 0),
(3, 91, 0, '', 'ertwert', 'ertwert', 0, 0, 0, 0),
(4, 91, 0, '', 'ertwert', 'ertwert', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_score`
--

CREATE TABLE IF NOT EXISTS `wg_student_score` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `course` enum('TOEFL','IELTS','GRE','GMAT','SAT') NOT NULL,
  `subject` varchar(64) NOT NULL,
  `score` int(11) NOT NULL,
  `last_update` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_standardization`
--

CREATE TABLE IF NOT EXISTS `wg_student_standardization` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `subject` enum('TOEFL','IELTS','GRE','GMAT','SAT') NOT NULL,
  `profile` varchar(256) NOT NULL,
  `quality` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='标准化信息' AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `wg_student_standardization`
--

INSERT INTO `wg_student_standardization` (`id`, `student_id`, `subject`, `profile`, `quality`) VALUES
(1, 92, 'GMAT', 'total_point', 'sdfsdf'),
(2, 92, 'GMAT', 'reading', 'gfsdfhsdgh'),
(3, 92, 'GMAT', 'mathematics', 'dfsdf'),
(4, 92, 'TOEFL', 'total_point', '123'),
(5, 92, 'TOEFL', 'listening', '12'),
(6, 92, 'TOEFL', 'speaking', '23'),
(7, 92, 'TOEFL', 'reading', '34'),
(8, 92, 'TOEFL', 'writing', '45'),
(9, 92, 'TOEFL', 'exam_time', '124234'),
(10, 92, 'TOEFL', 'login_id', '123'),
(11, 92, 'TOEFL', 'login_pswd', '123'),
(12, 92, 'TOEFL', 'ets_id', '13'),
(13, 92, 'TOEFL', 'reg_serial', '123123'),
(14, 91, 'GMAT', 'total_point', 'sdfsdf'),
(15, 91, 'GMAT', 'reading', 'gfsdfhsdgh'),
(16, 91, 'GMAT', 'mathematics', 'dfsdf'),
(17, 91, 'TOEFL', 'total_point', '123'),
(18, 91, 'TOEFL', 'listening', '12'),
(19, 91, 'TOEFL', 'speaking', '23'),
(20, 91, 'TOEFL', 'reading', '34'),
(21, 91, 'TOEFL', 'writing', '45'),
(22, 91, 'TOEFL', 'exam_time', '124234'),
(23, 91, 'TOEFL', 'login_id', '123'),
(24, 91, 'TOEFL', 'login_pswd', '123'),
(25, 91, 'TOEFL', 'ets_id', '13'),
(26, 91, 'TOEFL', 'reg_serial', '123123'),
(27, 91, 'GMAT', 'total_point', 'sdfsdf'),
(28, 91, 'GMAT', 'reading', 'gfsdfhsdgh'),
(29, 91, 'GMAT', 'mathematics', 'dfsdf'),
(30, 91, 'TOEFL', 'total_point', '123'),
(31, 91, 'TOEFL', 'listening', '12'),
(32, 91, 'TOEFL', 'speaking', '23'),
(33, 91, 'TOEFL', 'reading', '34'),
(34, 91, 'TOEFL', 'writing', '45'),
(35, 91, 'TOEFL', 'exam_time', '124234'),
(36, 91, 'TOEFL', 'login_id', '123'),
(37, 91, 'TOEFL', 'login_pswd', '123'),
(38, 91, 'TOEFL', 'ets_id', '13'),
(39, 91, 'TOEFL', 'reg_serial', '123123'),
(40, 91, 'GMAT', 'total_point', 'sdfsdf'),
(41, 91, 'GMAT', 'reading', 'gfsdfhsdgh'),
(42, 91, 'GMAT', 'mathematics', 'dfsdf'),
(43, 91, 'TOEFL', 'total_point', '123'),
(44, 91, 'TOEFL', 'listening', '12'),
(45, 91, 'TOEFL', 'speaking', '23'),
(46, 91, 'TOEFL', 'reading', '34'),
(47, 91, 'TOEFL', 'writing', '45'),
(48, 91, 'TOEFL', 'exam_time', '124234'),
(49, 91, 'TOEFL', 'login_id', '123'),
(50, 91, 'TOEFL', 'login_pswd', '123'),
(51, 91, 'TOEFL', 'ets_id', '13'),
(52, 91, 'TOEFL', 'reg_serial', '123123');

-- --------------------------------------------------------

--
-- 表的结构 `wg_users`
--

CREATE TABLE IF NOT EXISTS `wg_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(64) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `real_name` varchar(64) DEFAULT NULL,
  `used_name` varchar(64) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `marriage` enum('single','married') DEFAULT NULL,
  `born_city` varchar(64) DEFAULT NULL,
  `family_addr` varchar(256) DEFAULT NULL,
  `family_zip_code` varchar(32) DEFAULT NULL,
  `contact_addr` varchar(256) DEFAULT NULL,
  `contact_zip_code` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `cellphone` varchar(32) NOT NULL,
  `account_type` smallint(5) NOT NULL,
  `status` smallint(5) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `telephone` (`telephone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `wg_users`
--

INSERT INTO `wg_users` (`user_id`, `nickname`, `password`, `real_name`, `used_name`, `birthday`, `sex`, `marriage`, `born_city`, `family_addr`, `family_zip_code`, `contact_addr`, `contact_zip_code`, `email`, `telephone`, `cellphone`, `account_type`, `status`, `create_time`, `update_time`) VALUES
(1, '', '', '123123', 'sfsfsf', '2014-02-02', '', '', 'asdfsdf', 'asdfasd', '342342', 'asdfasdfadsf', 'sadfasd', 'asdfasdf', 'asadfasdf', 'asdfasdf', 123, 1, 1428300838, 1428304225),
(2, '', '', '123123', 'sfsfsf', '2014-02-02', 'male', '', 'asdfsdf', 'asdfasd', '342342', 'asdfasdfadsf', 'sadfasd', 'asdfasdf', 'asadfasdf', 'asdfasdf123', 123, 1, 1428304312, 1428426976),
(3, 'akakakak', '$2a$08$a51CfTHTYQePvM8kuOxYgOmolARMVJSlCtVZCUf69twImvYJQrsDG', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '1324525434', 0, 0, 1428307773, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
