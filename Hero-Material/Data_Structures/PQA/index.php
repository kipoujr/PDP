<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Η δομή αυτή κυκλοφορεί με πολλά ονόματα. Ίσως αυτό που μας δίνει να καταλάβουμε καλύτερα περί τίνος πρόκειται είναι το <strong>Monotonous Deque</strong>. Η βασική δουλειά βέβαια γίνεται από το ένα άκρο, οπότε (λανθασμένα) κυκλοφορεί και ως <em>Monotonous Stack</em>, ή και ως <em>Stack of Incomplete Subproblems</em> λόγω της πιο συνηθισμένης εφαρμογής της. Η σωστή ονομασία της είναι <strong>Priority Queue with Attrition (PQA)</strong>.</p>
							<p class="mypad">Οι απαιτήσεις αυτής της δομής είναι αυτές μίας απλής <strong>queue</strong> και τα ερωτήματα είναι του τύπου: Ποιο είναι το ελάχιστο στοιχείο στη δομή μας; Καταφέρνουμε να υποστηρίξουμε τα πάντα σε <strong>amortized O(1)</strong> χρόνο. Οπτικά είναι μια deque χωρίς εισαγωγή στο αριστερό άκρο, με τα στοιχεία της ταξινομημένα (αυτό θα προκύψει με φυσικό τρόπο παρακάτω). <img src="pqa.png" /></p>
							<p class="mypad">Η βασική ιδέα είναι ο χαρακτηρισμός ενός στοιχείου X ως <em>άχρηστου</em> όταν εισήχθη πριν από κάποιο άλλο Y και είναι ταυτόχρονα μεγαλύτερο από αυτό (X&ge;Y). Για παράδειγμα, στην παραπάνω εικόνα, αν έπρεπε να εισάγουμε το Y=35, αυτό θα καθιστούσε διαδοχικά άχρηστα τα X=70, X=60, X=50, X=40, τα οποία και θα διώχναμε από τη δομή (το γιατί εξηγείται στην επόμενη παράγραφο). Έτσι στη δομή μας θα έμεναν τα {10,15,20,30,35}.</p>
							<p class="mypad">Ο λόγο που χαρακτηρίζουμε ένα στοιχείο X ως άχρηστο είναι ότι, αφού τα operations είναι σαν της queue, θα βγει πριν το Y, και μέχρι να βγει δε θα είναι ποτέ το μικρότερο. Έτσι, όταν εισάγουμε ένα καινούριο στοιχείο, αφαιρούμε όλα τα άχρηστα που προκλήθηκαν εξαιτίας αυτού (θα βρίσκονται όλα στο τέλος της δομής, γιατί;). Αυτό διατηρεί και τη μονοτονία της δομής.</p>
							<p class="mypad">Αναλυτικότερα διαβάζουμε θεωρία από <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Theory.html" href="https://people.cs.uct.ac.za/~ksmith/articles/sliding_window_minimum.html">εδώ</a>.</p>
							<p class="mypad">Υποσημείωση (πλήρως άχρηστη για διαγωνισμούς): Όσα αναφέραμε μπορούν να επιτευχθούν και σε worst-case O(1) χρόνο, όπως έδειξε ο <a href="https://www.sciencedirect.com/science/article/pii/0020019089900719" title="DOI: 10.1016/0020-0190(89)90071-9">Sundar</a>.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>					

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12" >
							<h3 class="center">Ασκήσεις</h3>
							<ol><li><a href="http://www.boi2007.de/tasks/sound.pdf">Sound</a> | <a href="https://dmoj.ca/problem/boi2007p3">Judge</a> | <a href="http://www.boi2007.de/tasks/book.pdf">Λύση<a/> | <a href="http://www.boi2007.de/tasks/testdata-sound.tar.gz">Testcases</a> | <a href="http://www.boi2007.de/tasks/solution-sound.tar.gz">Κώδικας</a> | <a href="sound.zip">Offline</a></li>
								<li>(*) <a href="https://www.informatik.uni-ulm.de/acm/Locals/2003/html/histogram.html">Histogra</a> | <a href="https://www.spoj.com/problems/HISTOGRA/">Judge</a> | <a href="https://www.informatik.uni-ulm.de/acm/Locals/2003/html/judge.html">Λύση<a/> | <a href="https://www.informatik.uni-ulm.de/acm/Locals/2003/input/histogram.in">Input</a> | <a href="https://www.informatik.uni-ulm.de/acm/Locals/2003/output/histogram.out">Output</a> | <a href="https://www.informatik.uni-ulm.de/acm/Locals/2003/solution/other/histogram_ralf_stack.cc">Κώδικας</a> | <a href="histogra.zip">Offline</a></li>
								<li>(**) <a href="http://hsin.hr/coci/archive/2006_2007/contest2_tasks.pdf">Stol</a> | <a href="https://dmoj.ca/problem/coci06c2p5">Judge</a> | <a href="http://hsin.hr/coci/archive/2006_2007/contest2_solutions.zip">Λύση</a>... είναι O(N<sup>3</sup>). Αν εφαρμόσουμε την τεχνική του Histogram σε κάθε γραμμή (με έξυπνο preprocessing) πέφτουμε σε O(N<sup>2</sup>) | <a href="stol.cpp">Κώδικας O(N<sup>2</sup>)</a> | <a href="http://hsin.hr/coci/archive/2006_2007/contest2_testdata.zip">Testcases</a> | <a href="stol.zip">Offline</a></li>
								<li>(**) <a href="http://hsin.hr/coci/archive/2012_2013/contest4_tasks.pdf">Razlika</a> | <a href="http://www.codah.club/tasks.php?show_task=5000001796">Judge</a> | <a href="http://hsin.hr/coci/archive/2012_2013/contest4_solutions.zip">Λύση και κώδικας<a/> | <a href="http://hsin.hr/coci/archive/2012_2013/contest4_testdata.zip">Testcases</a> | <a href="razlika.zip">Offline</a></li>
								<li>(***) <a href="http://ceoi.inf.elte.hu/probarch/11/balzad.pdf">Balloons</a> | <a href="https://szkopul.edu.pl/problemset/problem/FM-LF_oP6i8yo3ZdJA3o5clO/site/?key=statement">Judge</a> | <a href="http://ceoi.inf.elte.hu/probarch/11/ceoi2011booklet.pdf">Λύση<a/> | <a href="http://ceoi.inf.elte.hu/probarch/11/baltst.zip">Testcases</a> | <a href="http://ceoi.inf.elte.hu/probarch/11/balprg.zip">Κώδικας</a> | <a href="balloons.zip">Offline</a></li>
								<li>(***) <a href="http://www.ioinformatics.org/locations/ioi06/contest/day1/pyramid/pyramid.pdf">Pyramid</a> | <a href="https://vn.spoj.com/problems/MPYRAMID/">Judge</a> | <a href="http://www.ioinformatics.org/locations/ioi06/contest/day1/pyramid/pyramid_sol.pdf">Λύση<a/> | <a href="https://www.commonlounge.com/discussion/75d2b28a4d5c43eda9c34d30bb62d99b/main">Λύση - One hint at a time!</a> | <a href="http://www.ioinformatics.org/locations/ioi06/contest/day1/pyramid/pyramid_td.zip">Testcases</a> | <a href="https://github.com/keshav57/ioi-training/blob/master/IOI/2006/pyramid.cpp">Κώδικας</a> | <a href="pyramid.zip">Offline</a></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
