-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2015 at 08:30 AM
-- Server version: 5.6.26-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deltasbl_arc`
--

-- --------------------------------------------------------

--
-- Table structure for table `arc_blog`
--

CREATE TABLE IF NOT EXISTS `arc_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `poster` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=612 ;

--
-- Dumping data for table `arc_blog`
--

INSERT INTO `arc_blog` (`id`, `date`, `title`, `content`, `image`, `tags`, `poster`, `category`, `seourl`) VALUES
(1, '2014-10-06 00:00:00', 'First blog post', 'This is an example blog post.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', 'example', 'Tester', '["News", "Test"]', 'example'),
(3, '2014-10-06 22:41:00', 'Place holder', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'Tester', '["News"]', 'placeholder'),
(4, '2015-01-07 00:00:00', 'Anything', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'Test', '["News"]', 'anything'),
(5, '0000-00-00 00:00:00', 'new', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\n\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\n\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\n\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\n\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', ' ', '["News","4","Test"]', 'new'),
(6, '2015-01-03 00:00:00', 'tttt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'ttt', '["News"]', 'tttt'),
(11, '2014-10-06 00:00:00', 'First blog post', 'This is an example blog post.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', 'example', 'Tester', '["News"]', 'example'),
(31, '2014-10-06 22:41:00', 'Place holder', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'Tester', '["News"]', 'placeholder'),
(41, '2015-01-07 00:00:00', 'Anything', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'Test', '["News"]', 'anything'),
(51, '2015-01-23 00:00:00', 'new', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'new', '["News"]', 'new'),
(61, '2015-01-03 00:00:00', 'tttt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'ttt', '["News"]', 'tttt'),
(111, '2014-10-06 00:00:00', 'First blog post', 'This is an example blog post.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', 'example', 'Tester', '["News"]', 'example'),
(311, '2014-10-06 22:41:00', 'Place holder', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'Tester', '["News"]', 'placeholder'),
(411, '2015-01-07 00:00:00', 'Anything', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'Test', '["News"]', 'anything'),
(511, '2015-01-23 00:00:00', 'new', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'new', '["News"]', 'new'),
(611, '2015-01-03 00:00:00', 'tttt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget turpis sed metus sodales finibus. Donec nec massa sollicitudin, placerat odio ut, mollis purus. Vivamus gravida laoreet tristique. Vivamus at magna in dui egestas dictum. Maecenas a leo lacinia, efficitur velit finibus, ultricies risus. Etiam faucibus mattis ante, porttitor vehicula ipsum sodales et. Nunc lorem tortor, aliquet id nulla sed, euismod scelerisque enim. Proin ullamcorper dolor velit, a gravida odio tincidunt vel. Sed faucibus purus at metus venenatis elementum. Nulla quis nisl dignissim, blandit turpis ut, hendrerit lorem. Pellentesque a facilisis mauris, in viverra tellus.\r\n\r\nNam sollicitudin, nulla ut dapibus vulputate, elit purus bibendum arcu, ut elementum nisi diam ut lectus. In vel sapien tempor, consectetur erat non, tincidunt tortor. Nunc eget laoreet arcu, vitae venenatis mi. In erat nisl, facilisis quis dui a, sagittis feugiat nisl. Nulla in leo vel nunc laoreet fringilla. Aenean vitae lacus mi. Praesent convallis eros quis tellus eleifend dictum. Phasellus bibendum magna vitae ex ullamcorper eleifend. Phasellus tincidunt mauris erat, eget maximus tortor tristique in.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent at eros ac augue imperdiet dignissim. Integer augue neque, auctor eget neque a, feugiat pellentesque urna. Vivamus consequat quam eu lacus feugiat, nec malesuada felis egestas. Maecenas lobortis enim sem. Aenean ornare facilisis augue, vitae maximus augue aliquet vitae. Nam dignissim congue mi, vel consequat augue elementum sit amet. Nulla dapibus sollicitudin risus, nec pharetra nunc accumsan eu. Cras nunc ipsum, commodo sit amet elit non, tempus dignissim enim. Mauris ornare gravida risus, id pulvinar mauris porta non.\r\n\r\nCras consectetur libero a sem bibendum, vitae viverra arcu rhoncus. Phasellus auctor velit eu felis gravida feugiat. Quisque placerat dui in lacus sodales, vitae lacinia massa ullamcorper. Nulla id venenatis velit, ut lobortis sapien. Praesent lacinia vehicula nunc, in lobortis massa luctus id. Fusce pharetra fringilla massa sed malesuada. Nulla vel urna at dui consectetur dictum sit amet at nulla. Etiam vitae nibh sollicitudin, rhoncus metus non, vehicula magna. Nam consequat diam quis neque rutrum, quis tristique eros malesuada. Maecenas sit amet enim hendrerit, finibus ex at, suscipit ligula. Nam congue auctor mollis. Integer convallis, ligula eget maximus consequat, lectus dui pellentesque ante, sed ullamcorper metus velit tristique neque.\r\n\r\nSuspendisse malesuada velit quis condimentum varius. Vestibulum id cursus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean et commodo massa. Suspendisse eget erat fringilla, tempus ipsum sed, rhoncus enim. Suspendisse consectetur condimentum quam, sit amet rutrum enim interdum vitae. Vivamus leo lorem, imperdiet rhoncus facilisis ut, pretium eget quam. Donec et ex at elit tristique fermentum. Fusce consequat mauris eu ultrices iaculis. Nullam eleifend sodales orci, sit amet accumsan massa porta in. Maecenas at dui et nisl euismod interdum. Phasellus fermentum iaculis nunc, nec cursus erat sollicitudin ac.', '6cdd60ea0045eb7a6ec44c54d29ed402.jpg', '', 'ttt', '["News"]', 'tttt');

-- --------------------------------------------------------

--
-- Table structure for table `arc_blog_categories`
--

CREATE TABLE IF NOT EXISTS `arc_blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `seourl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `arc_blog_categories`
--

INSERT INTO `arc_blog_categories` (`id`, `name`, `seourl`) VALUES
(1, 'News', 'news'),
(2, 'Test', 'test'),
(4, 'xxx', 'xxxx');

-- --------------------------------------------------------

--
-- Table structure for table `arc_logs`
--

CREATE TABLE IF NOT EXISTS `arc_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `when` datetime NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2354 ;

--
-- Dumping data for table `arc_logs`
--

INSERT INTO `arc_logs` (`id`, `type`, `module`, `when`, `message`) VALUES
(2225, 'danger', 'error', '2015-10-14 07:32:59', 'Error detected: 404: /test'),
(2226, 'danger', 'error', '2015-10-14 13:02:57', 'Error detected: 404: /skype'),
(2227, 'danger', 'error', '2015-10-16 10:05:43', 'Error detected: 404: /register'),
(2228, 'danger', 'error', '2015-10-16 19:28:43', 'Error detected: 404: /favicon.ico'),
(2229, 'warning', 'Setting', '2015-10-16 19:47:04', 'ARC_DEFAULT_PAGE was initilised with value ''Welcome'''),
(2230, 'danger', 'error', '2015-10-16 20:39:29', 'Error (): '),
(2231, 'danger', 'error', '2015-10-16 21:25:08', 'Error (): '),
(2232, 'danger', 'error', '2015-10-16 23:40:36', 'Error (): '),
(2233, 'danger', 'error', '2015-10-16 23:45:09', 'Error (): '),
(2234, 'danger', 'error', '2015-10-16 23:45:09', 'Error (): '),
(2235, 'danger', 'error', '2015-10-17 01:05:27', 'Error (): '),
(2236, 'danger', 'error', '2015-10-17 01:05:29', 'Error (): '),
(2237, 'danger', 'error', '2015-10-17 01:05:33', 'Error (): '),
(2238, 'danger', 'error', '2015-10-17 01:18:34', 'Error (): '),
(2239, 'danger', 'error', '2015-10-17 04:35:45', 'Error (): '),
(2240, 'danger', 'error', '2015-10-17 04:49:06', 'Error (): '),
(2241, 'danger', 'error', '2015-10-17 08:28:12', 'Error (): '),
(2242, 'danger', 'error', '2015-10-17 08:30:14', 'Error (403): /'),
(2243, 'danger', 'error', '2015-10-17 08:30:47', 'Error (403): /'),
(2244, 'danger', 'error', '2015-10-17 08:32:24', 'Error (403): /test'),
(2245, 'danger', 'error', '2015-10-17 08:32:46', 'Error (404): /test'),
(2246, 'danger', 'error', '2015-10-17 08:34:01', 'Error (404): /favicon.ico'),
(2247, 'danger', 'error', '2015-10-17 08:34:08', 'Error (404): /test'),
(2248, 'danger', 'error', '2015-10-17 08:34:11', 'Error (404): /test'),
(2249, 'danger', 'error', '2015-10-17 08:44:24', 'Error (): '),
(2250, 'danger', 'error', '2015-10-17 12:36:22', 'Error (404): /test'),
(2251, 'danger', 'error', '2015-10-17 17:08:08', 'Error (404): /page/welcome'),
(2252, 'danger', 'error', '2015-10-17 18:21:25', 'Error (404): /js/status.min.js'),
(2253, 'danger', 'error', '2015-10-18 00:26:09', 'Error (404): /page/display'),
(2254, 'danger', 'error', '2015-10-18 01:13:46', 'Error (404): /page/tables.html'),
(2255, 'danger', 'error', '2015-10-18 02:49:14', 'Error (404): /user/register'),
(2256, 'danger', 'error', '2015-10-18 11:02:06', 'Error (404): /page/example_page'),
(2257, 'danger', 'error', '2015-10-18 11:02:08', 'Error (404): /page/example_page'),
(2258, 'danger', 'error', '2015-10-18 11:02:10', 'Error (404): /user/register'),
(2259, 'danger', 'error', '2015-10-18 11:34:55', 'Error (404): /page/example_page'),
(2260, 'danger', 'error', '2015-10-18 11:34:57', 'Error (404): /page/example_page'),
(2261, 'danger', 'error', '2015-10-18 13:38:57', 'Error (404): /page/example_page'),
(2262, 'danger', 'error', '2015-10-18 13:38:59', 'Error (404): /page/example_page'),
(2263, 'danger', 'error', '2015-10-18 15:15:46', 'Error (404): /page/example_page'),
(2264, 'danger', 'error', '2015-10-18 18:53:00', 'Error (404): /js/mage/cookies.js'),
(2265, 'danger', 'error', '2015-10-18 18:57:34', 'Error (404): /js/mage/cookies.js'),
(2266, 'danger', 'error', '2015-10-18 22:45:38', 'Error (404): /page'),
(2267, 'danger', 'error', '2015-10-18 23:05:40', 'Error (404): /page/welcome'),
(2268, 'danger', 'error', '2015-10-19 01:14:05', 'Error (404): /page/example_page'),
(2269, 'danger', 'error', '2015-10-19 02:53:38', 'Error (404): /page/example_page'),
(2270, 'danger', 'error', '2015-10-19 04:10:59', 'Error (404): /page/welcome'),
(2271, 'danger', 'error', '2015-10-19 07:26:55', 'Error (404): /blog/post/placeholder'),
(2272, 'danger', 'error', '2015-10-19 07:26:56', 'Error (404): /blog/post/tttt'),
(2273, 'danger', 'error', '2015-10-19 07:26:57', 'Error (404): /user/forgot'),
(2274, 'danger', 'error', '2015-10-19 07:43:59', 'Error (404): /page/example_page'),
(2275, 'danger', 'error', '2015-10-19 12:15:56', 'Error (404): /page/example_page'),
(2276, 'danger', 'error', '2015-10-19 12:39:39', 'Error (404): /user/login'),
(2277, 'danger', 'error', '2015-10-19 12:45:56', 'Error (404): /app/themes/default/css/bootstrap-theme.min.css'),
(2278, 'danger', 'error', '2015-10-19 15:06:47', 'Error (404): /app/themes/default/css/bootstrap-theme.min.css'),
(2279, 'danger', 'error', '2015-10-19 15:06:48', 'Error (404): /app/themes/default/css/custom.css'),
(2280, 'danger', 'error', '2015-10-19 15:35:42', 'Error (404): /page/example_page'),
(2281, 'danger', 'error', '2015-10-19 17:00:26', 'Error (404): /page/example_page'),
(2282, 'danger', 'error', '2015-10-19 20:57:09', 'Error (404): /app/themes/default/css/custom.css'),
(2283, 'danger', 'error', '2015-10-19 20:57:11', 'Error (404): /app/themes/default/css/bootstrap-theme.min.css'),
(2284, 'danger', 'error', '2015-10-19 21:20:20', 'Error (404): /app/themes/default/css/custom.css'),
(2285, 'danger', 'error', '2015-10-19 22:39:33', 'Error (404): /page/heading.html'),
(2286, 'danger', 'error', '2015-10-19 23:28:58', 'Error (404): /blog/category/news'),
(2287, 'danger', 'error', '2015-10-19 23:29:00', 'Error (404): /blog/category/test'),
(2288, 'danger', 'error', '2015-10-19 23:29:01', 'Error (404): /blog/category/xxxx'),
(2289, 'danger', 'error', '2015-10-19 23:29:03', 'Error (404): /blog/post/anything'),
(2290, 'danger', 'error', '2015-10-19 23:29:04', 'Error (404): /blog/post/new'),
(2291, 'danger', 'error', '2015-10-19 23:29:05', 'Error (404): /blog/post/placeholder'),
(2292, 'danger', 'error', '2015-10-19 23:29:07', 'Error (404): /blog/post/tttt'),
(2293, 'danger', 'error', '2015-10-19 23:29:08', 'Error (404): /user/forgot'),
(2294, 'danger', 'error', '2015-10-19 23:29:12', 'Error (404): /blog/category'),
(2295, 'danger', 'error', '2015-10-19 23:29:13', 'Error (404): /blog/category/news/1'),
(2296, 'danger', 'error', '2015-10-19 23:29:15', 'Error (404): /blog/category/test'),
(2297, 'danger', 'error', '2015-10-19 23:29:16', 'Error (404): /blog/category/xxxx'),
(2298, 'danger', 'error', '2015-10-19 23:29:17', 'Error (404): /blog/post/anything'),
(2299, 'danger', 'error', '2015-10-19 23:29:19', 'Error (404): /blog/post/new'),
(2300, 'danger', 'error', '2015-10-19 23:29:20', 'Error (404): /user/login'),
(2301, 'danger', 'error', '2015-10-20 01:14:00', 'Error (404): /blog'),
(2302, 'danger', 'error', '2015-10-20 06:36:14', 'Error (404): /page/welcome'),
(2303, 'warning', 'Widget', '2015-10-20 08:03:03', 'Widget by the name of :user was not found.'),
(2304, 'warning', 'Widget', '2015-10-20 08:03:42', 'Widget by the name of :user was not found.'),
(2305, 'warning', 'Widget', '2015-10-20 08:04:18', 'Widget by the name of :breadcrumb was not found.'),
(2306, 'danger', 'error', '2015-10-20 08:15:01', 'Error (404): /test'),
(2307, 'danger', 'Widget', '2015-10-20 08:17:04', 'Widget by the name of user has no widget.php file.'),
(2308, 'danger', 'error', '2015-10-20 08:24:57', 'Error (404): /favicon.ico'),
(2309, 'danger', 'error', '2015-10-20 08:26:49', 'Error (404): /app/widgets/login/forgot'),
(2310, 'danger', 'error', '2015-10-20 08:42:28', 'Error (404): /app/widgets/user/js/login.js'),
(2311, 'danger', 'error', '2015-10-20 08:42:38', 'Error (404): /app/widgets/user/js/login.js'),
(2312, 'danger', 'error', '2015-10-20 08:43:14', 'Error (404): /app/widgets/user/js/login.js'),
(2313, 'danger', 'error', '2015-10-20 14:25:13', 'Error (404): /page/example_page'),
(2314, 'danger', 'error', '2015-10-20 15:27:15', 'Error (404): /js/bootstrap-datetimepicker.min.js'),
(2315, 'danger', 'error', '2015-10-20 15:41:18', 'Error (404): /page/example_page'),
(2316, 'danger', 'error', '2015-10-20 16:11:55', 'Error (404): /page/example_page'),
(2317, 'danger', 'error', '2015-10-20 16:11:57', 'Error (404): /page/example_page'),
(2318, 'danger', 'error', '2015-10-21 05:22:01', 'Error (404): /favicon.png'),
(2319, 'danger', 'error', '2015-10-21 07:58:35', 'Error (404): /user/register'),
(2320, 'danger', 'error', '2015-10-21 10:20:29', 'Error (404): /page/example_page'),
(2321, 'danger', 'error', '2015-10-21 11:07:39', 'Error (404): /test'),
(2322, 'danger', 'error', '2015-10-21 11:07:40', 'Error (404): /test'),
(2323, 'danger', 'error', '2015-10-21 11:07:42', 'Error (404): /app/widgets/login/forgot'),
(2324, 'danger', 'error', '2015-10-21 11:07:42', 'Error (404): /app/widgets/login/forgot'),
(2325, 'danger', 'error', '2015-10-21 14:26:05', 'Error (404): /page/example_page'),
(2326, 'danger', 'Modules', '2015-10-21 19:42:56', 'Modules by the name of user has no controller.php file.'),
(2327, 'danger', 'Modules', '2015-10-21 20:20:29', 'Modules by the name of error has no controller.php file.'),
(2328, 'danger', 'Modules', '2015-10-21 20:20:33', 'Modules by the name of error has no controller.php file.'),
(2329, 'danger', 'Modules', '2015-10-21 20:20:36', 'Modules by the name of error has no controller.php file.'),
(2330, 'danger', 'Modules', '2015-10-22 16:23:27', 'Modules by the name of error has no controller.php file.'),
(2331, 'danger', 'Modules', '2015-10-22 19:42:11', 'Modules by the name of error has no controller.php file.'),
(2332, 'danger', 'Modules', '2015-10-22 20:44:07', 'Modules by the name of error has no controller.php file.'),
(2333, 'danger', 'Modules', '2015-10-23 01:02:44', 'Modules by the name of error has no controller.php file.'),
(2334, 'danger', 'Modules', '2015-10-23 01:02:47', 'Modules by the name of error has no controller.php file.'),
(2335, 'danger', 'Modules', '2015-10-23 04:00:07', 'Modules by the name of error has no controller.php file.'),
(2336, 'danger', 'Modules', '2015-10-23 04:38:36', 'Modules by the name of error has no controller.php file.'),
(2337, 'danger', 'Modules', '2015-10-23 07:54:16', 'Modules by the name of breadcrumb has no controller.php file.'),
(2338, 'danger', 'Modules', '2015-10-23 07:57:25', 'The module ''user'' has no view named ''default''.'),
(2339, 'danger', 'Modules', '2015-10-23 07:59:52', 'The module ''user'' has no view named ''default''.'),
(2340, 'danger', 'Modules', '2015-10-23 08:03:20', 'The module ''user'' has no view named ''default''.'),
(2341, 'danger', 'Modules', '2015-10-23 08:03:34', 'The module ''user'' has no view named ''default''.'),
(2342, 'danger', 'Modules', '2015-10-23 08:03:48', 'The module ''user'' has no view named ''default''.'),
(2343, 'warning', 'Modules', '2015-10-23 08:07:08', 'Modules by the name of Array was not found.'),
(2344, 'warning', 'Modules', '2015-10-23 08:07:08', 'Modules by the name of Array was not found.'),
(2345, 'warning', 'Modules', '2015-10-23 08:07:08', 'Modules by the name of Array was not found.'),
(2346, 'danger', 'Modules', '2015-10-23 08:08:31', 'The module '''' has no view named ''''.'),
(2347, 'danger', 'Modules', '2015-10-23 08:08:31', 'The module '''' has no view named ''''.'),
(2348, 'danger', 'Modules', '2015-10-23 08:08:31', 'The module '''' has no view named ''''.'),
(2349, 'danger', 'Modules', '2015-10-23 08:08:54', 'The module '''' has no view named ''''.'),
(2350, 'danger', 'Modules', '2015-10-23 08:09:40', 'The module ''user'' has no view named ''''.'),
(2351, 'danger', 'Modules', '2015-10-23 08:10:14', 'The module ''user'' has no view named ''''.'),
(2352, 'danger', 'Modules', '2015-10-23 08:10:41', 'The module ''user'' has no view named ''''.'),
(2353, 'danger', 'Modules', '2015-10-23 08:11:43', 'The module ''user'' has no view named ''''.');

-- --------------------------------------------------------

--
-- Table structure for table `arc_pages`
--

CREATE TABLE IF NOT EXISTS `arc_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `seourl` varchar(50) NOT NULL,
  `metadescription` varchar(160) NOT NULL,
  `metakeywords` varchar(69) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `arc_pages`
--

INSERT INTO `arc_pages` (`id`, `title`, `content`, `seourl`, `metadescription`, `metakeywords`) VALUES
(1, 'Error', '{{module:error}}', 'error', '', ''),
(19, 'Welcome to Arc', '&lt;div class=&quot;alert alert-warning&quot;&gt;Development site, no content hosted here.&lt;/div&gt;\n\n&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lobortis sit amet erat eget lacinia. Suspendisse tincidunt et orci non malesuada. Nunc rutrum ac massa vel interdum. Vestibulum purus odio, porttitor ac lorem vitae, lacinia elementum risus. Aenean et ante quis erat tempus scelerisque. Praesent consequat nunc nibh, nec semper felis iaculis sit amet. Pellentesque aliquet lobortis felis id ornare. Etiam venenatis et metus vel cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut fringilla vestibulum lorem quis aliquet. Praesent at enim ante. Mauris euismod gravida arcu sit amet bibendum. Sed ornare magna sapien, ac lobortis felis ultricies eu.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Aenean at nibh scelerisque, fringilla justo id, tempor felis. Curabitur gravida pellentesque ipsum et imperdiet. Proin turpis magna, pretium ac eleifend nec, molestie at nunc. Etiam in scelerisque nisl. Maecenas nec pretium arcu, sed efficitur urna. Nulla ut consequat elit. Aliquam ultricies bibendum nulla varius venenatis. Cras accumsan malesuada erat a gravida. Vivamus eu erat et odio euismod dignissim placerat eget justo. Nulla varius ante vitae aliquam porta. Donec id commodo magna.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Vestibulum ut diam in erat ultricies eleifend nec eget mi. Vestibulum viverra sapien ac condimentum ullamcorper. Fusce sagittis pulvinar purus in euismod. Duis mattis sem vitae venenatis posuere. Etiam ac egestas lacus, sit amet tincidunt dui. Etiam at lectus et enim tempor dignissim sit amet sed sapien. Sed sit amet ultrices dolor. Etiam vel erat felis. Donec facilisis finibus justo, tincidunt tincidunt dui molestie in. Duis metus neque, tristique at massa maximus, pellentesque suscipit ipsum. Pellentesque tellus nunc, tristique nec mi et, faucibus posuere purus. Morbi aliquet, est dapibus suscipit viverra, massa diam pretium massa, vel fermentum orci tellus venenatis velit. Aliquam vehicula consectetur nibh. Sed non auctor justo. Praesent tincidunt, justo sit amet volutpat porttitor, metus ante molestie sem, eu pellentesque turpis arcu quis ipsum. Morbi faucibus ultrices libero a faucibus.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Vestibulum quam felis, porta et consectetur id, ullamcorper vitae libero. Cras id enim ullamcorper, bibendum arcu efficitur, faucibus quam. Proin ut arcu quis metus consequat maximus a non massa. Sed vel finibus nibh, nec luctus lectus. Proin consequat mi quis turpis dignissim dictum. Sed ac dui vestibulum, dignissim augue ut, porttitor ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed fermentum, dui sit amet efficitur iaculis, ante nulla ultricies arcu, fermentum condimentum ante ipsum nec dolor. Fusce rhoncus leo eu nisl consectetur, vitae dictum urna tempus. Nullam vehicula ultrices semper. Aenean nibh mauris, convallis quis condimentum at, porta molestie sapien. Aliquam erat volutpat. Pellentesque purus velit, iaculis non mollis id, finibus at sem. Proin blandit magna ut mi consectetur, porta suscipit neque elementum. Integer facilisis quam sit amet nisl laoreet, nec tempus metus fermentum.&lt;/div&gt;\n\n\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n\n\n&lt;div&gt;Aenean ut euismod lorem. Sed tincidunt orci vitae ante placerat, in eleifend diam luctus. Sed et lectus nec elit placerat pellentesque. Mauris molestie maximus velit, at elementum risus consectetur sit amet. Aenean elit massa, mollis nec lobortis non, viverra ut lectus. Fusce accumsan libero et blandit egestas. Cras ut luctus nisi. Phasellus aliquet congue lorem porta vehicula. Curabitur vel est placerat, euismod enim porta, malesuada neque.&lt;/div&gt;', 'welcome', 'Arc open source, multi-platform MVC style application development framework.', 'arc,welcome,deltawolf7,supportone,mvc,framework,ajax'),
(22, 'Test 1', 'Test 1\r\n\r\n{{module:breadcrumb}}', 'test/1', '', ''),
(23, 'Test 2', 'Test 2', 'test/2', '', ''),
(24, 'Page Manager', '{{module:page}}', 'administration/page', '', ''),
(25, 'Login', '{{module:user:login}}', 'login', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `arc_system_settings`
--

CREATE TABLE IF NOT EXISTS `arc_system_settings` (
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arc_system_settings`
--

INSERT INTO `arc_system_settings` (`key`, `value`, `group`, `userid`) VALUES
('ARC_ADMIN_THEME', 'ace', 'Theme', 0),
('ARC_BLOG_CHAR_LIMIT', '600', 'Blog', 0),
('ARC_BLOG_ENTRIES_PER_PAGE', '10', 'Blog', 0),
('ARC_BLOG_MENU_TITLE', 'Blog', 'Blog', 0),
('ARC_BLOG_NOLATEST', '10', 'Blog', 0),
('ARC_BLOG_TITLE', 'Latest News', 'Blog', 0),
('ARC_DEFAULT_PAGE', 'Welcome', 'System', 0),
('ARC_FILE_UPLOAD_SIZE_BYTES', '2000000', 'System', 0),
('ARC_KEEP_LOGS', '30', 'System', 0),
('ARC_MAIL_FROM', 'admin@server.local', 'Mail', 0),
('ARC_MAIL_SMTP_PASSWORD', 'password', 'Mail', 0),
('ARC_MAIL_SMTP_PORT', '25', 'Mail', 0),
('ARC_MAIL_SMTP_SERVER', 'localhost', 'Mail', 0),
('ARC_MAIL_SMTP_USERNAME', 'admin@server.local', 'Mail', 0),
('ARC_MAIL_USE_SMTP', '0', 'Mail', 0),
('ARC_PAGE_MENU_NAME', 'Pages', 'System', 0),
('ARC_THEME', 'default', 'Theme', 0),
('ARC_THUMB_WIDTH', '80', 'System', 0);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_groups`
--

CREATE TABLE IF NOT EXISTS `arc_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `arc_user_groups`
--

INSERT INTO `arc_user_groups` (`id`, `name`, `description`) VALUES
(1, 'Administrators', 'Arc System Aministrators'),
(2, 'Users', 'Arc System Users'),
(3, 'Guests', 'Arc System Guests');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_permissions`
--

CREATE TABLE IF NOT EXISTS `arc_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `arc_user_permissions`
--

INSERT INTO `arc_user_permissions` (`id`, `groupid`, `permission`) VALUES
(1, 3, 'welcome'),
(2, 3, 'error'),
(3, 3, 'test/1'),
(4, 3, 'test/2'),
(5, 1, 'administration/page'),
(6, 3, 'login');

-- --------------------------------------------------------

--
-- Table structure for table `arc_user_settings`
--

CREATE TABLE IF NOT EXISTS `arc_user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
