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
							Πολλά από τα παρακάτω δε λύνονται βέλτιστα με suffix array. Παρόλα αυτά είναι αρκετά για να μας δώσει 100% των βαθμών!
							<ol><li><a href="https://www.spoj.com/problems/BEADS/">Beads</a>, Task 1 θεωρίας | <a href="beads.cpp">Κώδικας</a></li>
								<li>Task 5 θεωρίας | <a href="task5.cpp">Κώδικας</a> | Λύνεται βέλτιστα με <a href="../AhoCorasick/index.php">Aho-Corasick</a>, με μεγαλύτερη προφανώς δυσκολία.</li>
								<li><a href="Querystr/querystr.html">QUERYSTR</a> | <a href="https://www.spoj.com/problems/QUERYSTR/en/">Judge</a> | <a href="Querystr/querystr.cpp">Kώδικας</a> | <span title="Αρκεί στο ανάποδο κείμενο να βρίσκουμε LCP του αρχικού κειμένου με τη θέση που μας ζητάει." class="color1">Hint</span> | Λύνεται βέλτιστα με <a href="../../Strings/Z-Algorithm/index.php">Z-Algorithm</a>.</li>
								<li><a href="Z-Sublexico/Z-Sublexico.html">Z-Sublexico</a> | <a href="http://www.codah.club/tasks.php?show_task=5000000451">Judge</a> | <a href="Z-Sublexico/z-sublexico.cpp">Kώδικας</a> | <span title="Έστω ότι ταξινομούμε τα suffixes. Αν το μικρότερο (έστω aabad) έχει 5 γράμματα, τότε τα 5 μικρότερα substrings είναι τα [a,aa,aab,aaba,aabad]. Το δεύτερο μικρότερο suffix (έστω abad) θα μας δώσει τα  " class="color1">Hint</span></li>								
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
