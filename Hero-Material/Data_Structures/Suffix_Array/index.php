<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Το Suffix Array είναι μία φοβερά χρήσιμη προχωρημένη δομή δεδομένων. Δίνοντάς της ένα μεγάλο κείμενο (ή και πολλά κείμενα) καταφέρνει:
								<ul><li>Να ταξινομήσει κάθε suffix σε χρόνο O(NlogN), όπου Ν το πλήθος γραμμάτων.</li>
									<li>Να βρίσκει το μέγιστο κοινό πρόθεμα δύο οποιονδήποτε substrings σε χρόνο O(logN).</li>
									<li>Να συγκρίνει οποιαδήποτε δύο substrings σε χρόνο O(logN), χρησιμοποιώντας το μέγιστο κοινό πρόθεμα και συγκρίνοντας τον αμέσως επόμενο χαρακτήρα.</li></ul>
							<p class="mypad">Ο χώρος που απαιτεί είναι O(NlogN).</p>
							<p class="mypad">Το Stanford δίνει μία εξαιρετική <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/suffix_array.pdf" href="http://web.stanford.edu/class/cs97si/suffix-array.pdf">παρουσίαση</a> της δομής, με λυμένα παραδείγατα από διαγωνισμούς. Τη διαβάζουμε παράλληλα με τις <a href="suffix_array_example.pdf">διαφάνειες</a> παρουσίασης εκτέλεσης του αλγορίθμου κατασκευής.</p>
							<p class="mypad">Υποσημείωση (πλήρως άχρηστη για διαγωνισμούς): Οι θεωρητικοί έχουν καταφέρει να λύσουν αυτά τα προβλήματα σε βέλτιστους χρόνους - γραμμικός χώρος, γραμμικός χρόνος κατασκευής (αν το αλφάβητο είναι σταθερού μεγέθους, όπως συμβαίνει στους διαγωνισμούς),  Ο(1) απάντηση σε ερωτήματα. Η λύση αυτή είναι το <a href="https://www.cs.helsinki.fi/u/ukkonen/SuffixT1withFigs.pdf" title="DOI: 10.1007/BF01206331">Suffix Tree</a> του Ukkonen. Αργότερα βρέθηκαν τρόποι να πετύχουμε τα παραπάνω και για Suffix Arrays (όπως καταλαβαίνετε υπάρχει στενή σύνδεση των 2 δομών). Όλα αυτά βεβαίως ξεφεύγουν κατά πολύ από ό,τι χρειαζόμαστε για διαγωνισμούς.
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
