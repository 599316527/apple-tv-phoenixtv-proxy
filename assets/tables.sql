--
-- 表的结构
--

CREATE TABLE IF NOT EXISTS `statistics` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` tinyint(1) unsigned NOT NULL,
    `guid` varchar(40) NOT NULL,
    `count` int(10) unsigned NOT NULL,
    `latest_time` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `guid` (`guid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `videos` (
  `guid` char(36) NOT NULL,
  `title` varchar(128) NOT NULL,
  `word_text` varchar(128) NOT NULL,
  `image_text` char(10) NOT NULL,
  `link` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `video_url` varchar(128) NOT NULL,
  `has_audio` tinyint(1) NOT NULL DEFAULT 0,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



