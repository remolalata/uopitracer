DROP TABLE tbl_news_events;

CREATE TABLE `tbl_news_events` (
  `news_events_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `posted_by_id` varchar(255) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `date_time_posted` varchar(255) NOT NULL,
  PRIMARY KEY (`news_events_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_news_events VALUES("1","Welcome to UPangiTracer","<p>Hi hello&nbsp;Hi hello&nbsp;Hi hello&nbsp;Hi hello&nbsp;Hi hello&nbsp;</p>","images/news_events/UPANG_logo.png","1","Ronne Roever","Jun 11 2016 - 10:01 PM");
INSERT INTO tbl_news_events VALUES("2","PHINMA UPANG offers “Pisasalamat” for 91 years","<p>With a rich heritage in quality education spanning 91 years, the entire community of PHINMA University of Pangasinan commemorated its Founding Anniversary Celebration this year with the theme&nbsp;<em>Pisasalamat ed 91</em>(Grateful at 91), looking forward to an even &ldquo;bigger, better, best&rdquo; future for the institution.</p><p>&nbsp;</p><p>The one-day celebration kicked off on February 19, 2016 with a colorful display of costumes and talent at the University Gymnasium by the&nbsp;<em>Ligliwa&nbsp;</em>Dance Troupe together with the amazing ensemble of local folk songs of the rondalla group&nbsp;<em>Anewing na Cuerdas</em>, both from Mangatarem National High School. Students from the Basic Education department also showcased an energetic performance of&nbsp;<em>Awit ng Kabataan</em>.</p>","images/news_events/phinma.png","1","Ronne Roever","Jun 12 2016 - 07:34 PM");
INSERT INTO tbl_news_events VALUES("3","sample news","<p>sample content here</p>","images/news_events/Alumni-2.jpg","1","Ronne Roever","Jul 23 2016 - 04:51 PM");



