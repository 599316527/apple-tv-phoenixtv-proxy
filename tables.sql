--
-- 表的结构
--

CREATE TABLE IF NOT EXISTS `statistics` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` tinyint(1) unsigned NOT NULL,
    `guid` varchar(40) NOT NULL,
    `count` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `guid` (`guid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
