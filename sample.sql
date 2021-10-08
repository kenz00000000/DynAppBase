-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
-- 生成日時: 2021 年 10 月 09 日 02:53

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- テーブルの構造 `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Page ID',
  `num_order` int(11) NOT NULL DEFAULT '0' COMMENT 'Number Order',
  `toplevel_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Top Level  ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Parent Page ID',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Created DateTime',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Update DateTime',
  `publish` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Private=0 / Public=1',
  `title` varchar(100) NOT NULL COMMENT 'Page Title',
  `sub_title` varchar(100) NOT NULL COMMENT 'Page Sub Title',
  `description` text NOT NULL COMMENT 'Page Description',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- テーブルのデータのダンプ `pages`
--

INSERT INTO `pages` (`id`, `num_order`, `toplevel_id`, `parent_id`, `type`, `created_at`, `updated_at`, `publish`, `title`, `sub_title`, `description`) VALUES
(1, 1, 0, 0, 0, '2021-07-05 11:38:24', '2021-07-05 11:38:24', 1, 'Top', 'トップページ', 'Maecenas convallis eaque facilis quo arcu iste quam, laboris, habitasse, ipsa egestas animi ab curae. Quibusdam, corporis cubilia! Volutpat commodi, cupiditate ante occaecat odit? Sapien. Cursus pariatur sapiente adipiscing rem vulputate debitis autem mi dicta proident magnam dapibus velit dui, amet habitasse lobortis ullamcorper lorem tristique mollit. Felis etiam sem.'),
(2, 2, 0, 0, 0, '2021-07-05 11:38:24', '2021-07-05 11:38:24', 1, 'Profile', 'プロフィール', 'Dui convallis tempus arcu turpis laboris aliquip aliquet lacus ullamco magni dolores, mi. Laboriosam! Porta aspernatur mauris veritatis, temporibus, curabitur urna, repellat corporis! Error iste class quod imperdiet nisi deleniti quod gravida! Diamlorem scelerisque aliquip dicta consectetuer similique cum justo eligendi exercitationem aspernatur rutrum dignissimos magnis eros augue, suscipit conubia.'),
(3, 3, 0, 0, 0, '2021-08-15 18:33:18', '2021-08-15 18:33:18', 1, 'Work', '作品', 'Doloribus tellus! Luctus blandit dictum proin fusce est, autem nullam ornare, occaecat, fusce ridiculus cras. Cubilia quam ligula, reprehenderit odio? Accumsan? Tincidunt debitis nostrud, tellus eu reprehenderit quas doloremque consequat rhoncus facilisis taciti pede sapiente dapibus convallis mus! Rutrum, vel, sagittis. Hic cursus cubilia, incidunt? Dictumst possimus cras, praesent sed.'),
(4, 4, 0, 0, 0, '2021-08-15 18:33:18', '2021-08-15 18:33:18', 1, 'LAB', '研究', 'Sem aliquet numquam praesentium nascetur vestibulum sociosqu adipisci proident, dictum mollis officia, litora. Tincidunt, ligula odit cupiditate voluptate, purus tincidunt. Vero hendrerit quas fringilla, dictumst, harum quis ultrices facilis mus ducimus quia minima aut, consectetuer sunt nostrum? Magnam beatae tempus, iure voluptatum! Quisquam saepe platea perferendis gravida mollit. Impedit illum.doloribus mauris minus semper soluta dolore eleifend ultricies dignissimos risus quisque.'),
(5, 5, 0, 0, 0, '2021-08-15 18:33:18', '2021-08-15 18:33:18', 1, 'Activities', '活動', 'Nostrum eiusmod, integer eiusmod felis saepe auctor dignissimos semper phasellus nemo. Voluptatem, ligula, adipisci proin sollicitudin viverra necessitatibus dis quisque provident aptent. Adipisicing eaque, montes natus, dicta exercitation sollicitudin integer, illum molestiae ultricies proident explicabo dui nullam rem minus autem, amet tellus consequat facilisi! Et risus blanditiis eos, inventore habitasse.'),
(6, 6, 0, 0, 0, '2021-08-15 18:33:18', '2021-08-15 18:33:18', 1, 'Sports', 'スポーツ', 'Magni ac ratione, hac deleniti inceptos deserunt illo qui reprehenderit hac morbi accumsan, lobortis, fames voluptate repellat nostrum, volutpat, nemo taciti nulla nostrud veniam, amet nisi egestas justo iusto, nec! Exercitation tincidunt cillum. Similique, pulvinar temporibus hac adipisicing, commodo eleifend iure laborum ac accusamus orci, provident scelerisque quos. Auctor, aliqua.'),
(7, 7, 0, 0, 0, '2021-08-15 18:33:18', '2021-08-15 18:33:18', 1, 'Favorites', 'お気に入り', 'Suscipit nisi felis hic, proident distinctio dis, quisque cras elementum totam auctor sociosqu cursus consequuntur sagittis? Iusto deserunt autem et cillum? Varius inventore delectus! Lectus et pede libero aspernatur, lobortis orci per congue pulvinar. Volutpat habitasse, ultrices maecenas atque eligendi, posuere interdum. Occaecat? Tincidunt facere, nostrum porro do lectus excepturi.'),
(8, 8, 0, 0, 0, '2021-07-05 11:38:24', '2021-07-05 11:38:24', 1, 'Contact', 'お問い合わせ', 'Nisl architecto vel, magni doloremque cumque architecto quibusdam odio hic. Dolorem auctor venenatis irure, purus. Proident sint, ex egestas consequat quidem iste? Mi expedita. Error pretium, pulvinar sequi minima porttitor, pretium officia cursus vestibulum, vulputate, do, consectetur voluptate distinctio, dolorem? Hymenaeos ultrices, justo sollicitudin accusantium odit rerum urna cras hac.'),
(9, 0, 3, 3, 0, '2021-08-15 18:33:54', '2021-08-15 18:33:54', 1, 'DIY', '内装・外装 デザイン、施工', 'Sed tristique! Tortor praesentium cupidatat, facilisis litora assumenda potenti! Parturient, occaecati nonummy, dolore alias varius? Et modi blandit scelerisque aptent quae sit inventore illum similique proident. Hic. Integer quaerat lobortis. Orci parturient magni. Exercitationem, nunc, aliquam. Tenetur urna luctus impedit nullam cupiditate dictum magna? Dicta magna amet deleniti. Feugiat quia.'),
(10, 0, 3, 3, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Software', 'ソフトウェア', 'Excepturi fuga euismod. Voluptates pharetra nunc turpis, aspernatur eum, perferendis corporis cillum magna, aliqua accumsan fuga. Nostrum orci dicta lectus blanditiis, vestibulum, class proin venenatis delectus exercitationem sit excepteur repudiandae proin error fames? Asperiores diam nemo, magnis sint asperiores repellat, primis fringilla. Nulla risus torquent aliquet optio, sem? Dicta viverra.'),
(11, 0, 3, 3, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'DJ Mix Sounds', 'DJ ミックス音源', 'Iste proin felis felis reprehenderit tincidunt. Aliquam, ipsam sociosqu potenti? Laborum, odit quisquam necessitatibus! Tempus repellat molestiae officia, nisl, maiores! Habitasse dolor. Nemo parturient? Turpis cum sapien occaecati? Per litora, adipiscing inceptos maecenas, autem lobortis, minima est amet excepteur. Atque, quisque unde quisquam veniam gravida! Excepturi? Earum incididunt! Veritatis maecenas.'),
(12, 0, 3, 3, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Musics', '音楽', 'Molestias commodi tristique libero! Modi earum, class sem conubia gravida per recusandae, mi anim, rutrum? Proin pulvinar veritatis nam voluptatum consequatur iste semper ipsa! Praesent volutpat feugiat porro quasi cursus, deleniti necessitatibus itaque? Reprehenderit dolorum sit pellentesque accumsan tempor, tellus? Nihil, optio dolor tincidunt expedita eget minim aut? Anim mattis.'),
(13, 0, 4, 4, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Wind Surfing', 'ウインドサーフィン', 'Alias, cupidatat? Animi leo voluptatum a, reiciendis mattis laboriosam deleniti congue morbi debitis commodo, cum, per totam at! Sed voluptatibus sociosqu, metus semper egestas? Similique, eiusmod adipisicing venenatis, natoque scelerisque magnis rhoncus, aliquet assumenda erat accumsan, in quo cum ea, consequat vel facere aptent integer platea sollicitudin! Facere? Torquent debitis.'),
(14, 0, 4, 4, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Software', 'ソフトウェア', 'Lorem pulvinar error nihil irure, mi nunc libero, quibusdam, taciti! Itaque sapien? Corporis modi, porta urna! Corporis minima, porta? Quos? Recusandae explicabo recusandae temporibus ab congue explicabo, luctus, reiciendis sociis, minim libero scelerisque. Vero, nullam sit quasi ridiculus quis nascetur. Auctor primis, ad. Deleniti ridiculus in nostra eu iusto inceptos.'),
(15, 0, 5, 5, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Wind Surfing', 'ウインドサーフィン', 'Ante veritatis rem, dolorum ultricies, lorem consequuntur molestiae imperdiet, sociosqu culpa? Mauris auctor! Lobortis. Commodo, proident voluptates, aptent harum donec eveniet officia per incidunt. Mollit nec. Ex excepteur pulvinar ratione exercitation eos. Mus? Lorem augue fermentum, nunc alias turpis vero, aliquam, ratione hendrerit harum ad similique aenean, volutpat nisi metus.'),
(16, 0, 5, 5, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Mountain Bike', 'マウンテンバイク', 'Venenatis, incidunt fugiat vestibulum quibusdam lorem consectetuer iaculis at officiis, sequi debitis, congue cubilia quod consequatur? Habitasse. Nisl dicta, lacinia, euismod itaque facilisi aspernatur tellus dicta et irure, accumsan maecenas, ultrices minus risus ultrices, imperdiet. Taciti sunt architecto senectus augue laudantium cillum, voluptatibus metus, tempore harum morbi illo lacinia hac.'),
(17, 0, 5, 5, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Road Bike', 'ロードバイク', 'Aenean molestie cumque penatibus turpis, nostrum adipiscing a placeat class, ab magnis atque quas sagittis perspiciatis, duis minus occaecati, ante velit molestias habitant! Dui! Cubilia distinctio? Eos consequatur commodi dui, tellus et torquent aute natus tortor, nonummy tempus, facilisis, itaque, bibendum maiores do nulla. Porta ac est esse, tristique voluptates.'),
(18, 0, 3, 9, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Exterior Design', '外装 デザイン・施工', 'Rerum augue adipiscing debitis sollicitudin blanditiis, nobis morbi. Temporibus commodi ornare eos, fusce dis doloremque, conubia, natus do! Cras proin vivamus recusandae assumenda aliquam nec quas natus pariatur. Habitasse lectus metus adipisicing vestibulum in, facilisis! Parturient. Corrupti atque facilisi assumenda. Fusce exercitationem vulputate possimus dolorum. Sodales? Ipsa laboris dignissimos quis.'),
(19, 0, 3, 9, 1, '2021-08-08 18:12:59', '2021-08-08 18:12:59', 1, 'Interior Design', '内装 デザイン・施工', 'Senectus enim inceptos illo debitis, occaecat nascetur? Class id consectetur, maiores mi? Cupidatat aenean! Aliquip! Euismod, aliquip minima adipiscing mi, ligula gravida posuere duis beatae sequi conubia cum necessitatibus duis. Wisi fringilla. Laboriosam dolorem malesuada mattis. Scelerisque tenetur quia suspendisse viverra integer, ea pede conubia distinctio leo esse! Fames eget.');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Post ID',
  `toplevel_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Top Level  ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Parent Page ID',
  `num_order` int(11) NOT NULL DEFAULT '0' COMMENT 'Number Order',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Created DateTime',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Update DateTime',
  `publish` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Public=0 / Private=1',
  `title` varchar(100) NOT NULL COMMENT 'Post Title',
  `sub_title` varchar(100) NOT NULL COMMENT 'Post Sub Title',
  `description` text NOT NULL COMMENT 'Post Description',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `toplevel_id`, `parent_id`, `num_order`, `created_at`, `updated_at`, `publish`, `title`, `sub_title`, `description`) VALUES
(1, 3, 18, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Exterior Sample #1', '外装施工サンプル #1', 'Doloribus egestas recusandae vitae temporibus magni? Congue convallis ab! Congue necessitatibus, taciti. Posuere ornare vero ea! Officia eleifend! Consequat saepe, hymenaeos quam molestias gravida maxime distinctio earum fusce netus nihil, molestie fusce erat veniam tortor mollis fusce facere autem auctor maxime ornare. Diam urna est, a consectetur erat? Explicabo, varius.'),
(2, 3, 18, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Exterior Sample #2', '外装施工サンプル #2', 'Vulputate diamlorem eius minim. Facilis diam turpis venenatis, ac et nostrum turpis adipiscing cras viverra dolore iste impedit optio autem blanditiis? Ullam accusantium fugiat! Minus quam doloribus anim, corrupti ea, rerum, nisi cubilia voluptatem, cumque, rhoncus id blandit, in eaque mollit fermentum? Debitis accumsan optio auctor deleniti, exercitationem erat expedita.'),
(3, 3, 18, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Exterior Sample #3', '外装施工サンプル #3', 'Aperiam ea quas tortor accusamus, modi et proident? Aliquet corporis pharetra, litora, sollicitudin blandit class ullamcorper, bibendum hendrerit quos quibusdam taciti. Corporis sociis nisi suscipit ultricies voluptatum quibusdam, eros nibh ullamcorper augue laudantium. Inventore totam! Nunc, ullam sequi occaecati scelerisque eget facere nulla repellat sequi, hic ut, duis! Veritatis dignissim.'),
(4, 3, 18, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Exterior Sample #4', '外装施工サンプル #4', 'Dignissimos vivamus at faucibus nulla! Quo? Potenti ligula mus sequi sapien vitae commodi rem risus donec vehicula atque pariatur condimentum laboris taciti? Aenean architecto magni elit voluptatem eaque, occaecat egestas elementum? Deleniti, recusandae. Nullam ab est viverra malesuada tempor feugiat! Reiciendis nisi quisquam mollis sapiente. Fames ridiculus occaecat magni suspendisse.'),
(5, 3, 18, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Exterior Sample #5', '外装施工サンプル #5', 'Diamlorem ac! Mus incidunt rutrum. Vel, dignissim deleniti iusto sed nulla? Iste? Mattis habitasse! Lacinia, possimus, temporibus magnis netus sit, potenti inceptos conubia accumsan sit dignissim justo exercitation etiam facere mauris fugit fames? Nulla urna platea. Parturient neque minus eiusmod sagittis odit, hendrerit est tellus litora dolorum officiis impedit quae.'),
(6, 4, 19, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Software Sample #1', 'ソフトウェアサンプル #1', 'Accusantium, conubia minima deserunt unde ipsa? Modi congue elementum odit. Laborum laboriosam vehicula reprehenderit est, repellendus condimentum. Rem, earum accusantium, euismod, blanditiis morbi donec tristique impedit! Neque metus iure! Risus? Dictumst proin scelerisque minim fugit diam hic quibusdam totam odio, proident dignissim porro harum eaque wisi. Quasi suscipit. Lacinia cras.'),
(7, 4, 19, 0, '2021-07-05 21:07:56', '2021-07-05 21:07:56', 1, 'Software Sample #2', 'ソフトウェアサンプル #2', 'Animi? Veniam ab sollicitudin consequuntur cillum lacus mollis. Itaque cupidatat autem accusamus diamlorem, semper! Dictumst conubia? Arcu, scelerisque! Primis, vivamus, convallis! Aliquet? Aptent ullam quam, mattis, egestas dictum ut molestiae wisi autem eveniet fusce platea! Nulla, porro minim iste diamlorem, donec id dignissimos, facere venenatis cras amet earum incididunt mattis.'),
(8, 4, 19, 0, '2021-07-05 21:07:56', '2021-07-05 21:07:56', 1, 'Software Sample #3', 'ソフトウェアサンプル #3', 'Ullamcorper, vel tempora incididunt augue urna duis adipisci placerat quia praesentium egestas pellentesque blandit laborum! Suscipit adipiscing voluptatem justo? Perferendis iure amet minus, fuga fames atque! Sem laoreet. Ad. Minima aliquip velit. Quisquam tellus morbi, mollis nostrum magni curabitur dapibus! Perspiciatis laudantium suscipit a at accumsan dolore quae? Unde nostrud.'),
(9, 4, 19, 0, '2021-07-05 21:07:56', '2021-07-05 21:07:56', 1, 'Software Sample #4', 'ソフトウェアサンプル #4', 'Arcu officiis eu curae, autem urna varius, aliquid mi mollis unde doloremque! Iste? Torquent luctus harum minus commodi rhoncus. Necessitatibus ultrices tenetur maiores ipsa, tempus ipsa totam qui repellendus malesuada. Odit, pretium nostra necessitatibus anim sapiente, repudiandae tempor luctus natus. Sint fames, exercitation aut? Cupidatat! Blanditiis sodales maxime, sint volutpat.'),
(10, 4, 19, 0, '2021-07-05 21:03:55', '2021-07-05 21:03:55', 1, 'Software Sample #5', 'ソフトウェアサンプル #5', 'Nemo ipsa donec distinctio, sodales imperdiet, purus semper nihil nunc autem magnis exercitation, officiis? Dictum semper morbi vel, arcu alias molestie. Odio modi saepe, itaque dapibus vitae provident inceptos mollis. Risus, fringilla magna, nostra impedit laoreet consectetuer sint, nullam deleniti! Amet porro! Senectus tempora ultrices veniam? Primis facilisis, laboriosam habitasse.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
