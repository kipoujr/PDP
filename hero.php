<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Εισαγωγή</h3>
							<p class="mypad">Πλέον ξέρουμε τι κάνουμε. Έχουμε αποκτήσει ευχέρεια στη γλώσσα και στους βασικούς αλγορίθμους-δομές δεδομένων, και θέλουμε να εμβαθύνουμε. Παρακάτω δίνεται υλικό για κάθε θέμα της <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Hero-Material/ioi-syllabus.pdf" href="https://people.ksp.sk/~misof/ioi-syllabus/ioi-syllabus.pdf">ύλης της Ολυμπιάδας</a>, με έμφαση σε απλές επεξηγήσεις και στα <strong>λυμένα</strong> παραδείγματα.</p>
							<p class="mypad">Πιστεύουμε βαθιά στη <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Hero-Material/simple_not_simpler.html" href="https://quoteinvestigator.com/2011/05/13/einstein-simple/">ρήση</a>: <q>Everything Should Be Made as Simple as Possible, But Not Simpler</q>, με την υποσημείωση ότι το <q>as possible</q> αναφέρεται στο επίπεδο του αναγνώστη. Συνεπώς συγχωρέστε μας αν μερικές φορές φλυαρούμε, τα κείμενα απευθύνονται και σε πιο αρχάριους! Ελπίζουμε ότι σπάνια προσπερνάμε κάτι ως αυτονόητο, όμως όταν δε τα καταφέρνουμε, εσείς ξέρετε τη <a href="mailto:greekcontestspdp@gmail.com">λύση</a>!</p>
							<p class="mypad">Σχετικά με τη δομή, βάλαμε τα θέματα σε μία σειρά που μας έμοιαζε σωστή, όμως μη φοβηθείτε καθόλου να διαβάσετε με τη σειρά που βολεύει εσάς! Για την ακρίβεια, προτείνουμε αυτό τον πιο ελεύθερο τρόπο διαβάσματος.</p>
							<p class="mypad">Εδώ πρέπει να τονιστεί κάτι <strong>σημαντικότατο</strong>. Όταν τελειώσετε αυτή την ύλη, δε σημαίνει ότι είστε έτοιμοι για χρυσό. Αυτό που θα ξεχωρίσει τον πρωταθλητή από τον ερασιτέχνη είναι οι (άπειρες) ώρες προπόνησης. Θα είστε όμως στο σημείο που δε χρειάζεται να μάθετε κάτι καινούριο από πλευράς ύλης.
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>					

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Ύλη</h3>
							<p class="mypad">
								<ul><li><strong class="color1">Data Structures</strong></li>
									<ol><li><a href="Hero-Material/Data_Structures/PQA/index.php">PQA</a> (ψευδώς Monotonous Deque)</li>
										<li><a href="Hero-Material/Data_Structures/Queue2Stacks/index.php">Queue with 2 Stacks</a></li>
										<li><a href="Hero-Material/Data_Structures/Leaf-Oriented_BST/index.php">Στατικά Leaf-Oriented BST</a> (ψευδώς Segment Tree)</li>
										<li><a href="Hero-Material/Data_Structures/Trie/index.php">Trie</a></li>
										<li><a href="Hero-Material/Data_Structures/Suffix_Array/index.php">Suffix Array</a></li>
										<li><a href="Hero-Material/Data_Structures/AhoCorasick/index.php">Aho-Corasick</a> (προαπαιτούμενα: <a href="Hero-Material/Strings/KMP/index.php">KMP</a>, <a href="Hero-Material/Data_Structures/Trie/index.php">Trie</a>)</li>
										<li><a href="Hero-Material/Data_Structures/Dynamic_BSTs/index.php">Δυναμικά Node-Oriented BST</a></li>
									</ol>
									<li><strong class="color1">Graphs</strong></li>
									<ol>
									</ol>
									<li><strong class="color1">General Techniques</strong></li>
									<ol>
									</ol>
									<li><strong class="color1">Strings</strong></li>
									<ol>
									</ol>
									<li><strong class="color1">DP Optimizations</strong></li>
									<ol>
									</ol>
									<li><strong class="color1">Math</strong></li>
									<ol>
									</ol>
									<li><strong class="color1">Geometry</strong></li>
									<ol>
									</ol>
								</ul>
							</p>
						</div>
					</div>

<?php
	include 'footer.html';
?>
