CREATE TABLE `raw_crime_data` (
  `dr_no` varchar(9) NOT NULL,
  `date_rptd` datetime DEFAULT NULL,
  `date_occ` datetime DEFAULT NULL,
  `time_occ` varchar(4) DEFAULT NULL,
  `area` text,
  `area_name` text,
  `rpt_dist_no` varchar(4) DEFAULT NULL,
  `part_1_2` int(11) DEFAULT NULL,
  `crm_cd` text,
  `crm_cd_desc` text,
  `mocodes` text,
  `vict_age` varchar(2) DEFAULT NULL,
  `vict_sex` varchar(4) DEFAULT NULL,
  `vict_descent` varchar(1) DEFAULT NULL,
  `premis_cd` int(11) DEFAULT NULL,
  `premis_desc` text,
  `weapon_used_cd` text,
  `weapon_desc` text,
  `status` text,
  `status_desc` text,
  `crm_cd_1` varchar(10) DEFAULT NULL,
  `crm_cd_2` varchar(10) DEFAULT NULL,
  `crm_cd_3` varchar(10) DEFAULT NULL,
  `crm_cd_4` varchar(10) DEFAULT NULL,
  `location` text,
  `cross_street` text,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  PRIMARY KEY (`dr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `crime_type` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO area (id, name)
SELECT DISTINCT area, area_name FROM raw_crime_data;

INSERT INTO crime_type (`id`, `description`)
SELECT DISTINCT crm_cd, crm_cd_desc FROM raw_crime_data;
