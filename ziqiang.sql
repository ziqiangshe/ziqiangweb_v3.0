-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-08-12 05:23:47
-- 服务器版本： 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ziqiangweb`
--

-- --------------------------------------------------------

--
-- 表的结构 `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `image` varchar(300) NOT NULL,
  `introduction` text CHARACTER SET utf8mb4 NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `pageview` int(11) DEFAULT '0' COMMENT '浏览量',
  `authorid` int(11) NOT NULL COMMENT '作者用户id',
  `tagid` varchar(30) DEFAULT NULL COMMENT '博客类型',
  `summary` text COMMENT '摘要',
  `content` text,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog`
--

INSERT INTO `blog` (`id`, `title`, `pageview`, `authorid`, `tagid`, `summary`, `content`, `create_time`, `update_time`) VALUES
(1, '人十我百，人百我千', 8, 18, '1', NULL, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;博学之，审问之，慎思之，明辨之，笃行之。有弗学，思之弗得，弗措也;有弗辨，辨之弗明，弗措也;有弗行，行之弗笃，弗措也。人一能之，已百之;人十能之，已千之。果能此道矣，虽愚必明，虽柔必强。——题记<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一次偶然的机会看到这句话，便深深触动了心灵。我似乎看见了曾经时刻前行的自己，又想到了寒假懈怠懒散的样子，不由得热泪盈眶。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我很看重一个人的天赋，但也从未小觑过勤奋与努力的力量，因而从不敢放慢前进的步伐，或许因为天生谨慎我更爱步步为营。然而当步进大学的那一刻，我却错误的判断，认为奋斗的路已经走入了坦途。曾经的坚毅、认真、迎难而上竟险些被得过且过替代！<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;寒假的网页设计，作为负责人，我本该拿出远超他人的努力去做事，但事实却是在学长的催促下才完成任务。因为我的指挥不当导致开发延期，学长苦口婆心的训诫了我。俗话说祸福相依，也正是这次失误，为我敲响了警钟，把我从专业第三的沾沾自喜中救了出来，也让我对“业精于勤荒于嬉，行成于思毁于随”有了更深刻的感悟。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;跨入大学的门坎并非意味着结束，恰恰相反，这是一个全新的开端，是新的赛程！树不可无根，人不能忘本。曾经的梦想还只是实现了小小的一步，又怎能就此停歇？不忘初心，砥砺前行应该要时刻铭记于心。当然，光说不练假把式，我们更要用实际行动去践行，把心中的蓝图一步步变为现实。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我想，人最大的弱点之一便是懒惰了。特别是到了大学，无人督促，很多人便迷失了自我，这是极其可怕的。成功的路有千千万万条，然而勤奋务实之道却始终是最为可靠的。买油翁的故事早已烂熟于心，其中孰能生巧的道理也早已铭记。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;苏子曾说，古之成大事者不为有超世之才，亦必有坚韧不拔之志。欲成大事，就必须放下杂念，坚忍不拔，勤实肯干。多说无益，行动会证明一切！<br/>\n', '2017-03-03 16:00:00', '2018-08-12 13:02:48'),
(3, '网页设计感悟', 5, 19, '1', NULL, '还记得那天下午准备开始动手写自强人物了，刚要下手发现什么都不会，压根不知道该从哪着手，当时心里真的是好慌好急…虽然之前也在看html,css，不过真要动手写的时候，感觉是不一样的。于是我拿出了原来的网页，开始一点点看，遇到不会的标签就去百度，就这样慢慢开始做了起来，遇到过很多问题，包括盒子模型，响应式甚至文件路径方面，一方面有各位前辈的指点，一方面我也在百度上，知乎上各种搜。bootstrap，到后来为了更好看，用了font-awesome的小图标(在新版里不知道为什么显示不了，就只能放弃了)，可以说不断探索，直至最后实现的过程，是很有满足感的。还有大家齐心协力，共同克服困难，我想这就是自强吧。', '2017-03-03 16:00:00', '2018-08-12 13:02:48'),
(8, '网页设计感悟', 7, 20, '1', NULL, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;寒假或多或少参与了一下自强网页的制作，重要的不是结果，而是自己从这个过程中学到了不少东西。1、通过一个假期的学习，基本掌握了css+div的布局方式，同时接触了css3和bootstrap框架，对响应式的布局方式有了一定的了解，收益颇丰2、感悟的话主要是一点，设计师一个团队中是很重要的存在，个人认为所有开发人员的工作应该围绕设计师展开。', '2017-03-03 16:00:00', '2018-08-12 13:02:48'),
(10, '寒假感悟', 5, 21, '1', NULL, '      这个寒假是我大学生涯的第一个寒假，也是我真的感觉到自己不同的一个寒假。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;首先，让我来整理一下这个寒假的收获，嗯假期学习了html,css,简单学习了js，还有每天一题以及对C++的学习等等。通过学习和生活让我得出了一些经验和忌讳。<br/>\n      大概有以下几点，首先对html以及css的学习，html，css中有大量的标签，事件等，初学者很难全部机下，所以第一个就是不难能死记，要多多实践。还有，学习是无时无刻的，如果你再假期出去玩，你也同样可以在车上，休息时，通过手机上网查询教程来学习。第二，我觉得在假期里，时间观念是非常重要的，在假期生活中，一个不小心，就会把大量的时间放在玩乐中，所以，我建议将假期的工程分开几天，每天解决必须完成的任务，给了自己计划就会让自己心中有那么一个寄托吧，会让自己对时间的把控更强一些。第三要对自己从事的工作上心，不能以一种马马虎虎，得过且过的心态，那样，你的工作完成的一定不好。第四，就是在团队合作中，要主动与他人沟通，切记，你们是一个团队，要多问别人的意见，来完善自己的不足之处，团队工作不能只是你自己一个人闷头搞，切记切记。最后，如果你的任务完成了，那么，及时向工作的负责人汇报，并接受意见，千万不要拖拉，在deadline的时候才交作业是非常危险的', '2017-03-04 16:00:00', '2018-08-12 13:02:48'),
(11, '寒假网页开发感悟', 5, 22, '1', NULL, '       本次寒假的网页开发，也是我第一次做对于移动端的网页适配，总的来说，设计和需求说的也很清楚，后面有的问题也是直接和队长商量妥了，所以交流方面没什么问题，主要也是因为很多地方是自己做的决定，至于以后开发，也不能像这样子任性才好。:0<br/>\n       对于blog这部分，比如下方的页面预览部分也偷工减料了，自己没自信去用js实现传统的翻页的样式，当然，下一个bbs会加入的，自己也会好好准备，当然自己也f12了好久，用的基本上也都是自己学到的一些辣鸡玩意儿。以后，对于js，jq还有php方面还有很长的路要走。<br/>\n       blog这个部分的主体框架是设计师给的，我自己也只是对部分加入了一点动画和一些小的功能，然后移动端用的media query写的，大体和web端差不多，但是大小细节仔细适配了一下，屏幕大小适配到iPhone4的480*800屏幕，总的来说还是学到了很多，以后我也会好好学习的。。。<br/>\n       就这么多了吧，泽丰放过我吧2333333，学弟学妹们也继续加油。', '2017-03-04 16:00:00', '2018-08-12 13:02:48'),
(12, '寒假感悟', 7, 23, '1', NULL, '       这次的寒假是我上大学以来的第一个寒假，但总的来说还是比较失败的。说实话在最开始的时候，我规划了很多我要在寒假里做的事情。但是事实上，在回到家之后，我更多的是在玩，只有很少一部分时间是在学习，很多原本打算要做的事情都没有完成。大学的假期没有老师给你留作业，完全是你自己来规划和安排，当然更重要的是行动。还记得当时高中的时候老师说：假期是你们赶超别人的最佳时间。现在到了大学，我对这句话有了更深的理解。你要知道，真的有很多的人，他们在努力在学习，他们的假期过的很充实。不要再自欺欺人的觉得，你在玩，别人也在玩。<br/>\n       人因充实而快乐。每天的闲散不会让你快乐，反而会更加空虚与无聊。忙碌而充实的一天，虽然会让你疲惫，但是更多的是得到收获的喜悦。拼搏的生活更美丽多彩，不要在拼搏的年纪选择安逸。<br/>\n       另外再强调一下，无论做什么，千万不要拖拉！不要拖拉！不要拖拉！重要的事情说三遍！！！', '2017-03-04 16:00:00', '2018-08-12 13:02:48'),
(14, '网页开发感悟', 18, 24, '1', NULL, '       一切学习的开头阶段才是最难的，网页制作的学习也是如此。<br/>\r\n       HTML，CSS，JS 算是三门语言吧。最开始学习的时候很是痛苦，因为要记的太多了。但是经过一段时间动手实践：制作网页。在实践中发现了学习的盲点，弱点，难点，一个一个去克服它们。才感觉自己获得了明显的进步。实践的效率要比单纯地看一些资料高太多。<br/>\r\n       在制作的过程中是枯燥的，有时候因为一个样式要反反复复调整十几次。但当你看到自己的代码在浏览器中呈现出来的时候，那种喜悦却是无与伦比<br/>\r\n       一个网页做下来，发现其实制作网页也就这么回事，那些难记的东西，早已经在手指反复敲击键盘中被牢牢地记住。那些枯燥的代码也变成了一个个漂亮的页面。<br/>\r\n      所以想要提升技术，想要有所收获，自己亲手敲出那一行行的代码才是最关键的地方。', '2017-03-04 16:00:00', '2018-08-12 13:02:48'),
(15, '寒假感悟', 10, 25, '1', NULL, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;寒假中参与了网页设计，让我提早知道了以后工作的辛苦与忙碌，即便没有直接参与网页的制作，也懂得了与人沟通的难度与重要。上学期不佳的学习也让假期变得不愉快许多，也感受到了对父母询问成绩时的不堪与紧张，同时在别人玩时自己在学的痛苦，所以深知了学习的重要性与自律的必要性。所谓吃一堑长一智，要让自己的教训成为垫脚石。', '2017-03-04 16:00:00', '2018-08-12 13:02:48'),
(18, '寒假开发小结', 35, 26, '1', NULL, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;想想寒假好像码了一整个寒假，第一次放了假还那么努力没有玩.......不过这个寒假在开发过程中确实也收获了很多。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;寒假最开始其实给自己定了很多目标，什么小白书复习完数论&nbsp;DP，学会MATLAB&nbsp;的数字图像处理，开发完自强网页，开发完&nbsp;TOKEN&nbsp;的panel/question等等。反正在最后好像也没全部都按时完成。所以在给自己定目标的时候还是要根据实际来，因为有的时候智商也会有点不够用什么的。首先从实验室的项目说起吧。由于在图像组这个特殊的组别，因此很多东西都需要从零开始学起，对图像的理解，对&nbsp;MATLAB&nbsp;的使用还有对形态学图像的各类处理。这个寒假主要学习了《MATLAB&nbsp;版数字图像处理》这一本书。然后在这本书的基础上通过查阅资料学习了一些图像分割，图像填充，开处理，轮廓提取等知识。主要遇到的问题是很多问题网上都没有比较详细的资料，在图像处理这一块的很多很好的资料都是全英的，这也证明了英语的重要性（虽然我还是不想学英语）。另外比较深的体会一个是跟同组人员的沟通，因为很多时候你并不是走在最前面的，沟通可以让你们进度始终保持较为一致的步调。而且很多难题可以寻求到不同的解决办法，即使他人无法直接给出解决方案，也可以给你带来很多新的启示。另一个是寻求学长学姐的帮助，图像组大多都是研究生和博士，他们的眼界和知识库往往比我们所知道的多的多。而问也有技巧，问问题前需要经过自己一定的思考和资料的查阅。问的问题需要直指自己疑惑的中心。问的问题也最好要具体，结合问题的环境来描述。而这一点，相信很多人都明白。只是这个寒假对这一点的感触又深了些罢。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其次是&nbsp;TOKEN&nbsp;的项目。在&nbsp;TOKEN&nbsp;参与到了更多的项目开发中，比较累，但是学到的也很多。在完成&nbsp;iwut&nbsp;后台的常见问题的板块开发过程中，对数据库的增删查改更加熟练了。学会了&nbsp;dataTable&nbsp;框架和&nbsp;Smarty&nbsp;框架。对&nbsp;TP&nbsp;框架的controller&nbsp;理解也更深了。阅读前辈们的源码实在是一件让人倍感享受的事情。很多积压的疑惑都会茅塞顿开。随后进行了技术部的&nbsp;winter-test。期间对掌理安卓源码进行了初步的阅读，接触到了一些新的知识，如：SaltUI/Amaze&nbsp;UI、AntDesign&nbsp;这些框架，对&nbsp;TP&nbsp;框架的使用也更加熟练，不仅是&nbsp;3.2.3&nbsp;版，更是接触了&nbsp;5.0&nbsp;版本的一些新特性。QQ，微信，微博的第三方登录的地址回调和登录&nbsp;Hub实现方式。JS&nbsp;填充和&nbsp;cookie&nbsp;存储实现免登。此外，更是参与了掌理课表信息抓取接口的更新和&nbsp;IOS&nbsp;版掌理自定义日程板块的开发。对&nbsp;API&nbsp;的理解更深了一层，也对&nbsp;JS&nbsp;的使用更熟练了。开学初也进行了理工黄页接口的更新。虽然寒假为了这些开发和学习几乎没有怎么休息，但是感觉很值得。现在在开发的&nbsp;BBQ&nbsp;大概也会在这个学期上线。参与这种大型的项目的开发真的是让人快速进步的好方法。然后就不得不提到自强社的第二版自强网页的开发了。这一次我不是作为主要开发人员和负责人参与这个项目，而是一个开发人员和指导人员的身份。在经过一个学期的积累，自身的见识也让自己可以用更多更好的方式来对自强网页进行开发。这一次的开发前端主要遵从基本静态前端开发模式，没有调用什么框架。每一个人都对自强网页都有一定的贡献，这是好事，但也是坏事。一个这样的网站在未来的维护和更新迭代中会产生很多麻烦。因此在暑假期间，自强网页也必然会迎来它的第三版改版。自强网页的后台模拟了&nbsp;TP&nbsp;框架的目录路径，使用了dataTable&nbsp;框架实现数据的&nbsp;AJAX。建立了较为规范的数据表，但是在代码优化和功能方面还有所欠缺。这也是我在开发前就预料到的，我们不可能一次就做到最好，时间和精力都不允许我们进行非常彻底的完美蜕变。再回到前端开发，这一次博客采用的是混编的形式进行数据的异步处理，而比较理想的方式则是通过JS&nbsp;调用格式化的接口来对数据进行获取。其他前端页面也存在着代码冗杂，风格不统一，难以维护管理等等问题。希望后面的迭代开发过程中学弟学妹能注意这一问题。比较合适的是将前端代码模块化，调用合适的框架也不失为一种好方法。进行&nbsp;API&nbsp;调用的方式进行前端和后台的数据逻辑同步。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;最后谈一下寒假小白书的学习，寒假主要对小白书进行了简单的温习，然后刷了几把&nbsp;CF&nbsp;练手，但是很久没打，实力还是有所下降。DP&nbsp;这一块很重要，其实也不算很难，希望打&nbsp;ACM&nbsp;的小队可以注意&nbsp;DP、图论、数论、树的学习。而且DP&nbsp;的状态转移式很多时候一个人真的很难想到，尤其是在题目很隐晦的告诉你可以&nbsp;DP&nbsp;解决时，所以更多人更熟练的掌握可以让整个团队实力再上一层。希望你们能记住，ACM&nbsp;从来都是团队的比赛。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;末了，谈一下自己寒假做的一些杂事和体会。自任技术部副总监以来，责任感使命感和压力一直都伴随着我，服务队队长这一职位也让我感受到不小的压力，但是作为一个管理者，一个负责人，所需要具备的并不止于负责任这一点而已。能力和责任感是基本要素。要敢于突破前辈没有突破的条框，带领伙伴一起去完成一些新的辉煌。而不是故步自封，停滞不前甚至自满于现状。也要比别人更加的努力，才可以让别人觉得跟着你或许不算一个&nbsp;badidea，或者说觉得你是一个可以信任可以依赖的人。寒假也帮家里的店做了一次市场调研和一些改进，也印证了一下前面说到的改变的重要性。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PS：熬夜通宵的人不一定都是在写代码，也可能是在单排上分，嗯~', '2017-03-04 16:00:00', '2018-08-12 13:02:48'),
(19, '写代码的小女孩', 28, 1, '1', NULL, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;天冷极了，下着雪，又快黑了。这是一年的最后一天——大年夜。在这又冷又黑的晚上，一个乖巧的小女孩在机房里调试程序。她从家里出来的时候还穿着一件外套，但是有什么用呢？那是一件很大的外套——那么大，不知是哪一年买的。为了敲代码的时候更方便，她把它脱掉了。同学们常常嘲笑她，因为外套上留下了她梦中写下的伪代码的痕迹。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;小女孩只好一个人在机房里调试程序，机房里没有空调，她的一双小脚冻得红一块青一块的。她的Anjuta开满了文件，GDB还载入着一个。这一整天，她都没有把红黑树写对，没有一家OJ上留下了她这道题Accepted的记录。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可怜的小女孩！她又冷又饿，哆哆嗦嗦地敲击着键盘。雪花从关不牢的窗户飘进来，落在她的金黄的长头发上，那头发打成卷儿披在肩上，看上去很美丽，不过她没注意这些。每个窗子里都透出灯光来，街上飘着一股烤鹅的香味，因为这是大年夜——她可忘不了这个。她在一个复杂的宏定义的地方停了下来，kill，然后修改着错误的代码。她觉得更冷了。她不敢回家，因为她一个裸的红黑树都没有调试出来，没有一个AC，爸爸一定会打她的。再说，家里跟街上一样冷。他们头上只有个房顶，虽然最大的裂缝已经用草和破布堵住了，风还是可以灌进来。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;她的一双小手几乎冻僵了。啊，哪怕一次小小的成功，对她也是有好处的！她敢从一长串水题中选出一道，轻松地AC，来安慰安慰自己受创的心灵吗？她终于选出了一道。哧！答案正确了，题目AC了！她把小手按在屏幕上。多么温暖多么明亮的红色Accepted标记啊，简直像一支小小的蜡烛。这是一个奇异的标记！小女孩觉得自己好像坐在温暖的机房里面，Cena的评测页面上绿字不断闪过，多么舒服啊！哎，这是怎么回事呢？她刚把移动下鼠标，查看自己的程序，Status页面刷新了，Accepted标记不见了。她坐在那儿，眼前只有一个Wrong&nbsp;Answer的程序。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;她交了一道水题。Accepted标记又出现了，发出亮光来了。亮光落在机房里，那儿忽然变成一个领奖台。她站在领奖台上。领奖台上铺着红色的地毯，IOI的徽章挂在对面的墙上，台下掌声雷动。更妙的是杜子德拿着IOI金牌，摇摇摆摆地在地板上走着，一直向这个穷苦的小女孩走来。这时候，页面又刷新了，她面前只有黑色的xterm。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;她又交了一道水题。这一回，她站在美丽的ACM会堂里。这个会堂，比她IOI颁奖典礼的会堂还要大，还要美。ACM会堂里温暖而明亮，墙上的横幅写着“热烈欢迎图灵奖得主演讲”。Donald&nbsp;Knuth、Robert&nbsp;Floyd、Niklaus&nbsp;Wirth坐在台下，跟挂在机房里的画像一个样，在向她眨眼睛。主席台上的人向她示意，小女孩拿起了话筒。这时候，Status页面又刷新了。只见红色的Accepted标记越降越低，最后降到页面底部消失了。DDD显示的红黑树却飞上了天，成了在天空中闪烁的星星。有一颗星星落下来了，在天空中划出了一道细长的红光。“有一个什么人快要死了。”小女孩说。身旁的Rubert&nbsp;Bayer告诉她：一颗星星落下来，就有一个灵魂要到图灵那儿去了。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;她在OJ上又交了一道水题。这一回，鲜红的Accepted标记把周围全照亮了。图灵出现在亮光里，是那么温和，那么慈爱。&nbsp;“图灵！”小女孩叫起来，“啊！请把我带走吧！我知道，页面一刷新，您就会不见的，像那全绿的Cena评测页，IOI的金牌，ACM的礼堂一个样，就会不见的！”<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;她把自己余下的未交的水题全部找了出来，赶紧交了一页水题，要把图灵留住。占满整个Status页的Accepted标记发出强烈的光，照得跟白天一样明亮。图灵从来没有像现在这样高大，这样英俊。他把小女孩抱起来，搂在怀里。他们俩在光明和快乐中飞走了，越飞越高，飞到那没有寒冷，没有饥饿，也没有痛苦的地方去了。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;第二天清晨，这个小女孩坐在机房里里，两腮通红，嘴上带着微笑。她死了，在旧年的大年夜冻死了。新年的太阳升起来了，照在她小小的尸体上。小女孩坐在那儿，屏幕上还闪动着GDB的光标。<br/>\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“她想把红黑树写对。”人们说。谁也不知道她曾经看到过多么美丽的东西，她曾经多么幸福，跟着图灵一起走向新年的幸福中去。', '2017-03-04 16:00:00', '2018-08-12 13:02:49'),
(20, '淼与昶', 93, 1, '1', NULL, '【本故事绝非虚构，若有雷同，应该是你日了狗了】<br/>\r\n<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我叫淼。那是我第一次见到他，在自强社第一次的全社例会上。黑板上写着几个早已记不清的大字，一个又一个同学走向讲台，做着让人记不住的自我介绍，柔柔的夕阳从窗外轻轻的飘在桌上，配合着有些锈迹的窗台绘出奇妙的图案。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那时，他是全社最后一个登台做自我介绍的人，不算突出的身高，不算英俊的面庞，与他脸上自信的微笑还有身上透露出的强势的气场有些格格不入。那天，陆陆续续登台了30多人，末了我只记得一个人，那个嘴角溢满阳光味道的他，只是我竟不记得他自我介绍时，介绍他自己的名字的内容。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开完会一直到回到宿舍，我脑海里总是不由自主的浮现出那个嘴角带着一丝微笑的他，那个跟夕阳，配的不像话的他。那张不算英俊的脸，仿佛在那天的夕阳下，在我的脑海里，慢慢的发酵。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我不知道为什么。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;青春也不需要为什么。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我像所有女孩子的大学生活一样，在不怎么喜欢的专业中，平平淡淡的生活。朋友，社团，学业，还有默默藏在心中的人......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我第二次遇见他，距离着两个聊天气泡。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那天，社团群里的寂静被一个聊天气泡打破，是一个新加群的新人的气泡。气泡旁的备注是一个“昶”字。在社团群中大家调侃的记录中，像个不会倒下的战士，嘴角带着淡淡阳光味道的战士。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阳光，夕阳与他.......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;后来我知道，他就是例会中的那个最后做自我介绍的他。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;他就像所有计算机专业的程序猿，沉浸在自己的0和1的世界中，能为PHP和JS的性能分析比对和人争的面红耳赤，却能完美的屏蔽掉少女们拙劣提问下的暗示，看似毫无情调，偶尔却能大大咧咧的唱出一首震撼所有人的歌。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我和他就这样，在不温不火的平淡中认识了。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;他很擅长编程，但我却不太擅长，在大一唯一的一次C语言实验中，我百无聊赖的写下人生中第一句C语言——<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;printf(“Hello,&nbsp;ZC”);<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ZC是昶名字的缩写，我不知道为什么习惯性的打出来这个缩写。Hello&nbsp;World是计算机很有渊源的一句话，而我却忘记了World。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;又是什么时候，我的世界变成了一个人的呢？<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大一只是青春这首歌恬静的国门，我们永远不知道，等在后面的高潮是狂放的甜蜜，还是猛烈的忧伤。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;社团的换届会上，他又一次站在那个熟悉的讲台上。那天，他说着自己换届感想的时候我第一次盯着他的眼睛，我不知道他是否注意到，台下一个普通的女生那并不普通的眼神。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那天，我在他的眼神中，看见自己如梵高的向日葵般烈到燃烧的心......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那是他第二次站在那个讲台上，那个时候，我喜欢他。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;换届后，我成了副社长，他成了社长。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我和他成了朋友，也仅仅是朋友。<br/>\r\n<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;他总喜欢开我的玩笑，说他要把我吃了，这样整个自强社就是他一个人的天下了。，每当这个时候，我总会默不作声的看着自强BOSS群里各个部长一阵嘘声和他得意洋洋的表情。在我心中，那句“吃了”仿佛有着另一种解读，你愿做社长，我便陪在你身边做你的副社辅佐你。倘若有一天你不需要我了，那便让我做一个你身后的人，默默分享你成功的喜悦。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;中国人一向喜欢开会，我也是如此。但我的理由也许是每个女生心中最浪漫的理由。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;每次开会他都回招呼我做在他旁边，虽然他每次都数落着我的工作做的如何如何不尽人意，但，就像法海永远说要收复白素贞，这种有些病态的执着是否是另一种爱呢？<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有次，有个部长不怀好意的说他每次要我坐他身边是不是他对我有意思？<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我笑了笑，看着他嘴角那不经意的翘起，心中做出了一个女孩最勇敢的决定。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我决定向他告白。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我少有的上了一次编程实验课，我故意找了一个编程问题把他喊来。当他终于稀里糊涂的给我解答完时，我笑嘻嘻的给他看我第一次用C语言写的那句话。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当素白的屏幕编译出那句”Hello,&nbsp;ZC”时，我的脸涨得通红，像一朵油画上燃烧的向日葵。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“瞎写！你这根本不符合C++的语法！应该是std::printf，因为使用的话，函数会在std&nbsp;namespace下。你这一年都学的啥啊！”<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“詹昶是大笨蛋......”<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“你说什么？”<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“......没什么”<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原来，我唯一为你写的一句话也是错的.......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那天社里的群又拿我和他开涮，他却半开玩笑半真心的吐出了一句话——<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;他喜欢外院的社长。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;外院社长是个小巧玲珑的女生，他们俩走在一起一定很配吧......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我默默屏蔽掉群里爆炸式的起哄，带上耳机，痴痴的打开相册。是他第一次站在那个熟悉的讲台上，相片中的他嘴角依然满溢着迷人的微笑，相片中大家热烈的在鼓着掌，我却独自歇斯底里的大哭。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原来，我不是你的那个她，我只是一个只敢躲在屏幕后看着你叱咤风云的一个朋友.......我不是白素贞，我只是青儿.......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;青春是歌，时间是留声机，无论歌声的高潮是多么的壮烈与悲伤，它只是静静的播放着，不作任何评论，就那么在静谧中死去。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;他和她并没有在一起，没有理由，就像我和他一样，也没有理由。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;对社团的热情也随着青春的夕阳，在一抹末日般的光辉中燃烧的连灰也不剩。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;又过了一个学期，我们正式步入大二的下学期。只不过这一次，我们也即将推下我们的位置了。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这一年因为服务队又开发了一次自强网页，我们一起到KTV去庆祝。宣传部的部长赵云在KTV唱《情歌王》时，昶突然跑上了台，抓住赵云的手，当着所有人的面，脸上出现与他性格不衬的绯红，他的脸让我回忆起一年前那个梵高笔下的夕阳，那个看似温柔却在疯狂燃烧着的夕阳......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;死水般的台下爆炸了，所有人的起哄中，他给那个男生唱起了那首歌——《小苹果》<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;啊，原来.......原来从来都不是我.......<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我无意中看见了身为外国语学院社长的女孩子，我们相视苦笑。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那天，他最后一次站在台上。<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原来...法海喜欢的人，不是白素贞，也不是青儿.......而是许仙........<br/>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那天的夕阳，那些大红色的青春，在梵高的忧伤中，步履蹒跚的朝末日走去.......', '2017-03-06 04:30:12', '2018-08-12 04:40:21');

-- --------------------------------------------------------

--
-- 表的结构 `blog_tag`
--

DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE IF NOT EXISTS `blog_tag` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` char(10) CHARACTER SET utf8 NOT NULL COMMENT '博客类型具体名称',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `sign`
--

DROP TABLE IF EXISTS `sign`;
CREATE TABLE IF NOT EXISTS `sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `cardNo` varchar(10) NOT NULL COMMENT '卡号',
  `dept1` varchar(30) NOT NULL COMMENT '第一志愿',
  `dept2` varchar(30) DEFAULT NULL COMMENT '第二志愿',
  `class` varchar(30) NOT NULL,
  `date` date DEFAULT NULL,
  `qq` varchar(30) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `dorm` varchar(30) DEFAULT NULL COMMENT '宿舍',
  `status` int(10) DEFAULT NULL,
  `content` text COMMENT '介绍',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `realname` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '头像url',
  `introduce` text COMMENT '介绍',
  `message` text CHARACTER SET utf8 COMMENT '寄语',
  `birthday` datetime DEFAULT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未知1-男2-女',
  `class` varchar(40) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `session` tinyint(11) UNSIGNED DEFAULT NULL COMMENT '届数',
  `department` varchar(40) NOT NULL COMMENT '所属部门',
  `position` varchar(50) DEFAULT NULL COMMENT '职务',
  `role` varchar(20) NOT NULL DEFAULT '0' COMMENT '0-访客1-管理2-超级管理',
  `status` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '0-下架1-上架',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='社员表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `realname`, `avatar`, `introduce`, `message`, `birthday`, `sex`, `class`, `qq`, `tel`, `email`, `session`, `department`, `position`, `role`, `status`, `create_time`, `update_time`) VALUES
(1, 'xzfff', 'wqZMQtV37/w8I', '谢泽丰', NULL, '简介：\r\n\r\n   大一主要参加的比赛有武汉市内各大高校的ACM竞赛以及华为精英赛。最近参加的是理工黄页以及自强社的网站开发。掌握的编程语言是C、C++、Html5+CSS3、PHP（个人比较喜欢C++和PHP，C++的博大精深，支持多种编程方式，其中的STL更是好玩。PHP语言入门容易，功能强大，在编写脚本与后台的时候十分好用）感觉要学好一门语言或技术需要多写代码多调试，个人觉得技术学习最需要的是兴趣和愿意付出的时间。\r\n', '这一届的新生很多都开始提前学习，也有很多巨巨出现。但是小白也不要灰心（我大一时候也是纯小白）不要好高骛远，学习需要一步一个脚印，学技术更是如此。另外，不要把计算机专业和外面的培训机构相提并论，最后希望你们能加入服务队与我们一起交流。', '2018-08-02 00:00:00', 1, 'zy1502', '616973936', '13125177868', '616973936@qq.com', 15, '服务队', '队长', '1', '1', '2018-08-13 18:08:21', '2018-08-12 13:07:14'),
(2, 'lsj575', 'wq.9Mwm0rBUGI', '龙思杰', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 16, '服务队', '队长', '2', '1', '2018-08-11 23:05:33', '2018-08-12 13:08:03'),
(4, '', '', '骆代鹏', NULL, '感触：好一点，再好一点\r\n\r\n   自强君最吸引人的地方不仅是他的人格魅力，而且是和小伙伴们一起努力干活的那种感觉。当时自强社情况不是太好，出于责任心，我们想出一个个点子慢慢来改变现状。还记得大二上学期几乎天天熬夜，只为无愧于心，无愧于前辈们的托付。\r\n\r\n寄语：\r\n\r\n   作为计算机学院的宝宝们，应该抛开传统思维，用互联网思维来思考问题我们对自己的要求。尝试着去做产品，发展成学院内的互联网技术团队，这是一幅美好的画面，当然需要不只一年不只一代人来实现。但是梦想还是要有的，万一实现了呢？', NULL, NULL, 1, NULL, NULL, NULL, NULL, 12, '', '自强副社', '0', '0', '2018-08-11 23:05:33', NULL),
(5, '', '', '廖星', NULL, '简介：\r\n\r\n   廖星大大是义工服务队的创始人，最喜欢的语言是PHP，最擅长的是前端开发。曾经在中国大学生计算机设计大赛中取得全国二等奖的名次，参加过掌上理工大的开发，现任Token技术部总监。2015年暑假在阿里巴巴集团实习，担任淘宝电影的前端工程师。\r\n\r\n寄语：\r\n\r\n   专业课程是学好计算机的必备知识，同时也要多加实践。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 12, '', '服务队队长', '0', '0', '2018-08-11 23:05:33', NULL),
(6, '', '', '张浩浩', NULL, '简介：\r\n\r\n   人生苦短，我用python，至于学什么语言好，我的建议是需要什么学什么。因为对于一个项目来说，没有最好的语言，只有最合适的语言。同时我觉得学好一门语言要做到ABC（always be coding），空余时间可以多参加国创，多在项目中锻炼自己，提高自己的代码能力，了解这种创新项目的流程，学会自己写申报书。\r\n寄语：\r\n\r\n   大学不长，要对得起自己。碰到什么机会多去试试，除了专业技能还有一些软实力也很重要。祝学弟学妹们能有一个精彩的大学生活。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 12, '', '义工服务队', '0', '0', '2018-08-11 23:05:33', NULL),
(7, '', '', '张泰然', NULL, '简介：\r\n\r\n   张泰然学长是第一届义工队的副队长，现在比较擅长的是基于.NET的C#语言来开发ASP.NET网站。曾经担任过Token团队技术部里的服务器端开发工程师，参与过经纬网的新闻经纬网站的服务器的开发。\r\n寄语：\r\n\r\n   如果想学好一门语言，就要学习上的耐心以及坚持不懈的努力钻研，还要掌握这门语言或技术上的细节之处，多看一些其他人的博客。同时也希望新生们能多花一些时间进行技术上的学习，至少掌握一门主力语言或技术，希望你们能早日找到自己的兴趣所在，通过兴趣提高自己的技术水平。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 12, '', '服务队副队', '0', '0', '2018-08-11 23:05:33', NULL),
(8, '', '', '高文昌', NULL, '简介：\r\n\r\n   掌握的技术：前端，并没有特别喜欢的编程语言，对我来说都是工具；最近用的比较多的是JavaScript，原因是因为前端需要吧。\r\n\r\n\r\n寄语：\r\n\r\n   个人觉得学好一门语言的精华在于coding，如果自己不coding的话，看再多的书也没用。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '义工服务队', '0', '0', '2018-08-11 23:05:33', NULL),
(9, '', '', '梁爽', NULL, '感触：爱你千千万万遍\r\n\r\n   自强君总是爱心满满，尽自己所能去帮助他人。同时自强社是个有情有爱的小组织，也是个团结友爱的大家庭。各部门之间关系紧密，平时的互动和交流也比较频繁，这使得各部门间亲如一家人。\r\n   刚入大学时懵懂无知，在自强社的一群优秀前辈的带领下，我们看待事物的角度、自己的思想都有了不同的变化。当面对需要帮助的人时会毫不犹豫地去帮助他人。在自强君身边两年，认识了很多了的人，收获到很多友情。\r\n\r\n寄语：\r\n\r\n   思想上更深刻，做事态度更端正，在与人打交道时时刻刻学会换位思考，更乐观、更积极地面对生活。爱上自强君，改变看得见！Bingo，没错，就是这样！\r\n', NULL, NULL, 0, NULL, NULL, NULL, NULL, 13, '', '自强社长', '0', '0', '2018-08-11 23:05:33', NULL),
(10, '', '', '卢双', NULL, '感触：带我忙碌带我飞\r\n\r\n   还记得大一军训老社长进教室宣传时，我就爱上了自强君。自强君真的非常自强。他教会每一个新成员如何更好的处理学习和社团之间的关系。作为四大社团中最为“忙碌”的组织，我大自强最大的吸引力在于其强大的锻炼人的能力以及以“家”为核心的情怀。\r\n   四大社团中，自强的活动总是最多的，所以让每一位想要得到锻炼的同学都能得到应有的锻炼，在不经意间能力得到提升。也许这样的变化你轻易不会发现，但当你有一天开始承担更多责任，进入更大的天地时，你会发现，相比于其他人，你能更好的融入集体，与人交流，也能更快的完成繁杂的任务，紧张但不失条理，迅速而不失质量。\r\n\r\n寄语：\r\n\r\n   自强社作为一个和谐的大家庭，总是能在节日里为你送上祝福，生日时为你送去温暖，这份情谊，是你用辛勤的汗水和与伙伴们朝昔相处的时间换来的。可以说，这种家的温暖，是你在其他社团里无法体验的真情。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '自强副社', '0', '0', '2018-08-11 23:05:33', NULL),
(11, '', '', '张玉斌', NULL, '感触：学习新知，收获快乐\r\n\r\n   在自强君身边的两年，我学到了很多东西。\r\n   第一，要是有想法，自己可以大胆提出来和大家讨论，在通过之前，一定要给出一个较为详细的方案，然后和大家讨论之后再确定一些细节问题，才能最后确定一个方案。\r\n   第二，细节决定成败，或许我们点子很好，而且准备充分，但是活动的一些细节没有注意到，比如人员的座位安排，先后顺序，物资的摆放，这些简单而又容易让别人忽视的问题，没有注意到的话，我们整个活动会给人一种很乱很糟糕的感觉，所以细节很重要\r\n   第三，做事情要明确自己的目标和效果，然后从结果出发，再去指定计划，这样才能达到最好的效果。\r\n寄语：\r\n\r\n   我认为，自强君最吸引人的地方，就是引导我们，让我们带着一颗感恩的心去看世界，通过服务于他人，从被帮助人的笑容中，获得属于我们自己的快乐。永远不要低估，我们的所作所为会产生多大的能量。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '宣传部部长', '0', '0', '2018-08-11 23:05:33', NULL),
(12, '', '', '李文坦', NULL, '简介：\r\n\r\n   掌握的语言是C++，Java，易语言和Flash语言，自我感觉如果要学好一门语言或技术需要自制力要好，并且肯花出时间敲代码。最近正在参与开发的项目是为参加计算机设计大赛而做的cocos2d-x的3D和2D混合游戏项目和为课程结题需要而做的web前台项目。\r\n寄语：\r\n\r\n   合理选择社团，切记参加太多，因为很多社团里并不能得到锻炼，建议只加入一个社团并认真做好这个社团里的事情，精益求精才能有成效。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '义工服务队', '0', '0', '2018-08-11 23:05:33', NULL),
(13, '', '', '刘雨培', NULL, '简介：\r\n\r\n   最近在腾讯实习。最喜欢的编程语言是C++，可上可下，不强制GC，无unsafe，而且语义残废度低于目前主流语言，且是静态类型，社区繁荣。个人觉得如果要学好一门语言，最需要的是时间。\r\n\r\n\r\n寄语：\r\n\r\n   认真打好基础，别沉迷于前端、移动APP这些破烂玩意。。。（小编不禁觉得背后一阵寒意，QAQ）', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '义工服务队', '0', '0', '2018-08-11 23:05:33', NULL),
(14, '', '', '邵威', NULL, '简介：\r\n\r\n   参与了小挑战杯，参与了益行游戏：行界·零的开发，与益行人科技教育有限公司签了一年的游戏开发，掌握的编程语言是C++和C#（因为要用到这两种语言，配合VS环境用起来特别舒服）。感觉要学好一门语言所需要的是不停的思考，看书，写代码。\r\n\r\n寄语：\r\n\r\n   加入义工服务队绝对是会收获很多的，好好编程，好玩:)\r\n', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '义工服务队', '0', '0', '2018-08-11 23:05:33', NULL),
(15, '', '', '李统旭', NULL, '简介：\r\n   擅长的编程语言是C，C++，C#（开发界面比较常用C#，而C++和C我觉得很有趣，非常好玩）最近参与的项目是学校方面安排的，一般是参与后台。个人觉得学好一门语言付出的肯定是时间，经验和知识都是在不断的编码中成长的。\r\n\r\n\r\n寄语：\r\n\r\n   义工服务队的氛围需要有人带动，也需要你去积极参与，当然你能收获的绝对超出你的想象。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 13, '', '义工服务队', '0', '0', '2018-08-11 23:05:33', NULL),
(16, '', '', '金笑天', NULL, '简介：\r\n\r\n   收获有ASC16 铜，ACM 铜。最近参加的项目是莫少聪巨巨那边的项目，一个是动作语义识别，一个是云定位。现在参与的项目开发是在跟着教程做游戏（其实是自己在玩U3D）。计算机方面掌握的比较好的是硬件方面和C、C++。感觉要学好一门语言要付出时间，巨大的练习量，还要深入项目中来学习。\r\n\r\n寄语：\r\n\r\n   加油咯，要努力超越上一届学长，而不是跟着他们走。\r\n\r\n', NULL, NULL, 1, NULL, NULL, NULL, NULL, 14, '', '服务队队长', '0', '0', '2018-08-11 23:05:33', NULL),
(17, '', '', '陈亚辉', NULL, '感触：时光堆叠，融入骨血\r\n\r\n   我来过，我经历过。在自强君的身边，我收获过。\r\n   首先是前所未有的自信。在与自强君共度两年多的时间里，已经可以很自然的去讲话，组织活动。其次是学会了如何去做事情和承担责任，如何调节自己的状态，分配自己的时间。丝丝缕缕的记忆都是无形的价值，它带给我的改变溶入血液。而我也见证了自强君在一年中的成长，新旧交替，互助前行，这份感动历久弥新。\r\n\r\n寄语：\r\n\r\n   “让别人提起计算机学院就会想到计算机自强社”。', NULL, NULL, 1, NULL, NULL, NULL, NULL, 12, '', '自强社长', '0', '0', '2018-08-11 23:05:33', NULL),
(18, 'gyx', 'wqZMQtV37/w8I', '官宇霞', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 16, '服务队', '成员', '0', '0', '2018-08-11 23:05:33', '2018-08-11 23:05:33'),
(19, 'zys', 'wqZMQtV37/w8I', '朱永生', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 16, '服务队', '成员', '0', '0', '2018-08-11 23:05:56', '2018-08-11 23:05:56'),
(20, 'cy', 'wqZMQtV37/w8I', '陈宇', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 16, '服务队', '成员', '0', '0', '2018-08-11 23:06:11', '2018-08-11 23:06:11'),
(21, 'qty', 'wqZMQtV37/w8I', '齐天一', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 16, '服务队', '成员', '0', '0', '2018-08-11 23:06:51', '2018-08-11 23:06:51'),
(22, 'czy', 'wqZMQtV37/w8I', '陈中源', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 15, '服务队', '副队长', '0', '0', '2018-08-11 23:07:15', '2018-08-11 23:07:35'),
(23, 'ljy', 'wqZMQtV37/w8I', '刘婧伊', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 16, '宣传部', '部长', '0', '0', '2018-08-11 23:08:12', '2018-08-11 23:08:12'),
(24, 'js', 'wqZMQtV37/w8I', '蒋殊', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 16, '外联部', '成员', '0', '0', '2018-08-11 23:08:51', '2018-08-11 23:08:51'),
(25, 'wm', 'wqZMQtV37/w8I', '王淼', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 15, '副社', '大人', '0', '0', '2018-08-11 23:09:13', '2018-08-11 23:09:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
