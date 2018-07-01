<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Η τεχνική <strong>Centroid Decomposition</strong> μας δίνει τη δυνατότητα να εφαρμόσουμε τεχνικές <strong>Divide-And-Conquer</strong> σε δέντρα.</p>
							<p class="mypad">Ας δώσουμε ένα παράδειγμα. Έστω ότι ψάχνουμε αν ένα δέντρο (ακμές θετικού βάρους, χωρίς κατεύθυνση) έχει μονοπάτι μήκους 222. Αντί να ψάξουμε παντού, μπορούμε να ψάξουμε μόνο μονοπάτια που περνάνε από ένα συγκεκριμένα κόμβο (το κέντρο του δέντρου, θα οριστεί παρακάτω). Είτε υπάρχει τέτοιο μονοπάτι που περνάει από το κέντρο, είτε αφαιρούμε το κέντρο και δημιουργούνται πολλά δεντράκια. Αναδρομικά ψάχνουμε το καθένα από αυτά.</p>
							<p class="mypad">Αρχικά μπορεί κανείς να φανταστεί ότι τώρα που ξέρουμε έναν κόμβο (το κέντρο) από τον οποίο περνάει το μονοπάτι, τα πράγματα απλοποιούνται. Πράγματι, η κεντρική ιδέα είναι ότι αν υπάρχει το ζητούμενο μονοπάτι, μπορούμε να το σπάσουμε στα δύο, και να πάρουμε δύο μονοπάτια που ξεκινούνε από το κέντρο κι έχουν άθροισμα 222. Αυτό μπορεί να ελεγχθεί γραμμικά (μη σας απασχολήσει ο τρόπος, δεν είναι προφανής).</p>
							<p class="mypad">Η τεχνική αυτή μας εγγυάται ότι αν λύσουμε το παραπάνω πρόβλημα (μονοπάτι που περνάει από συγκεκριμένα κόμβο), τότε και το αρχικό πρόβλημα (μονοπάτι οπουδήποτε) λύνεται σχεδόν εξίσου αποδοτικά (το πολύ *logN μακριά).</p>
							<p class="mypad">Αναλυτικότερα διαβάζουμε θεωρία από <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Theory.htm" href="https://threads-iiith.quora.com/Centroid-Decomposition-of-a-Tree">εδώ</a>. Προσπερνάμε μόνο την τρίτη εξήγηση, γιατί η πολυπλοκότητά της προκύπτει O(N<sup>2</sup>) όπως εξηγείται. Για να πέσει πρέπει να χρησιμοποιηθεί FFT, που είναι εκτός ύλης.</p>
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
							<ol><li>Οι παρακάτω 3 ασκήσεις εξηγούνται στη θεωρία.
									<ol><li><a href="http://codeforces.com/contest/342/problem/E">Xenia and Tree - Judge</a> | <a href="http://codeforces.com/contest/342/submission/11945201">Κώδικας</a> | <a href="xenia.zip">Offline</a></li>
										<li><a href="https://www.spoj.com/problems/QTREE5/">QTREE5 - Judge</a> | <a href="https://github.com/TimonKnigge/Competitive-Programming/blob/master/SPOJ/QTREE5.cpp">Κώδικας</a> | <a href="qtree5.zip">Offline</a></li>
										<li><a href="https://www.hackerrank.com/challenges/bst-maintenance/problem">BST - Judge</a> | <a href="https://www.hackerrank.com/challenges/bst-maintenance/editorial">Κώδικας και άλλη επεξήγηση</a> | <a href="bst.zip">Offline</a></li>
								</ol></li>
								<li>Άλλες 2 ωραίες ασκήσεις (πιο δύσκολες) είναι αυτές.
									<ol><li><a href="https://contest.yandex.com/ioi/contest/571/problems/B/">Race - Judge</a> | <a href="http://www.ioi2011.or.th/hsc/tasks/solutions/race.pdf">Solution</a> | <a href="race.zip">Offline</a></li>
										<li><a href="kazarma.pdf">Καζάρμα</a> | <a href="kazarma.zip">Testcases</a> | <a href="kazarma.cpp">Κώδικας</a> | <span title="Αποδείξτε ότι αν βάλουμε ακμή μεταξύ x και y, τότε η βέλτιστη επιλογή βάρους είναι όσο η μέγιστη ακμή σε αυτό το μονοπάτι." class="color1">Hint 1</span> | <span title="Όμοια με το Race. Αντί για την ύπαρξη μονοπατιού μεγέθους Κ, κρατάμε το μέγιστο πλήθος εμφανίσεων βάρους ακμής σε μονοπάτι που αυτό το βάρος είναι μέγιστο. Συνδυάζουμε προσθέτοντας μονοπάτια ίσου βάρους." class="color1">Hint 2</span></li>
								</ol></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
