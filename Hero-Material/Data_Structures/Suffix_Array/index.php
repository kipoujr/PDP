<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Το <strong>Suffix Array</strong> είναι μία φοβερά χρήσιμη προχωρημένη δομή δεδομένων. Δίνοντάς της ένα μεγάλο κείμενο (ή και πολλά κείμενα) καταφέρνει:
								<ul><li>Να ταξινομήσει κάθε suffix σε χρόνο O(NlogN), όπου Ν το πλήθος γραμμάτων.</li>
									<li>Να βρίσκει το μέγιστο κοινό πρόθεμα δύο οποιονδήποτε substrings σε χρόνο O(logN).</li>
									<li>Να συγκρίνει οποιαδήποτε δύο substrings σε χρόνο O(logN), χρησιμοποιώντας το μέγιστο κοινό πρόθεμα και συγκρίνοντας τον αμέσως επόμενο χαρακτήρα.</li></ul>
							<p class="mypad">Οπτικά είναι απλούστατο και μοιάζει σαν την παρακάτω εικόνα: <img src="suffix_array.png" /></p>
							<p class="mypad">Στην παραλλαγή που θα δούμε εμείς, εκτός από την ταξινομημένη θέση του κάθε suffix, κρατάμε και την ταξινομημένη του θέση εάν από κάθε suffix κρατούσαμε μόνο τα πρώτα 2<sup>k</sup> γράμματα, για κάθε k. Αυτές είναι logN τιμές για κάθε suffix, και ενώ είναι βοηθητικές για την κατασκευή, τις κρατάμε γιατί βοηθούν και στην απάντηση των ερωτημάτων που αναφέραμε.</p>
							<p class="mypad">Ο χώρος που απαιτεί είναι O(NlogN) λόγω των βοηθητικών τιμών. Αν δε θέλουμε να απαντήσουμε σε αυτά τα ερωτήματα, και θέλουμε μόνο την ταξινόμηση, γίνεται σε O(N) χώρο. Ο χρόνος που χρειάζεται είναι O(Nlog<sup>2</sup>N), και πέφτει σε O(NlogN) αν γράψουμε δική μας O(N) Counting Sort, την οποία θα τρέξει logN φορές ο αλγόριθμος.</p>
							<p class="mypad">Το Stanford δίνει μία εξαιρετική <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/suffix_array.pdf" href="http://web.stanford.edu/class/cs97si/suffix-array.pdf">παρουσίαση</a> της δομής, με λυμένα παραδείγατα από διαγωνισμούς. Τη διαβάζουμε παράλληλα με τις <a href="suffix_array_example.pdf">διαφάνειες</a> παρουσίασης εκτέλεσης του αλγορίθμου κατασκευής. Βεβαίως στο <a href="https://visualgo.net/en/suffixarray?slide=1">visualgo</a> μπορείτε δείτε την εκτέλεση και σε δικά σας παραδείγματα εισόδου.</p>
							<p class="mypad">Υποσημείωση (πλήρως άχρηστη για διαγωνισμούς): Οι θεωρητικοί έχουν καταφέρει να λύσουν αυτά τα προβλήματα βέλτιστα - γραμμικός χώρος, γραμμικός χρόνος κατασκευής (αν το αλφάβητο είναι σταθερού μεγέθους, όπως συμβαίνει στους διαγωνισμούς), Ο(1) απάντηση σε ερωτήματα. Η λύση αυτή είναι το <a href="https://www.cs.helsinki.fi/u/ukkonen/SuffixT1withFigs.pdf" title="DOI: 10.1007/BF01206331">Suffix Tree</a> του Ukkonen. Αργότερα βρέθηκαν τρόποι να πετύχουμε τα παραπάνω και για Suffix Arrays (όπως καταλαβαίνετε υπάρχει στενή σύνδεση των 2 δομών). Όλα αυτά βεβαίως ξεφεύγουν κατά πολύ από ό,τι χρειαζόμαστε για διαγωνισμούς.</p>
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
							<p class="mypad">Πολλά από τα παρακάτω δε λύνονται βέλτιστα με suffix array. Παρόλα αυτά είναι αρκετό για να μας δώσει τουλάχιστον 70% των βαθμών!</p>
							<ol><li><a href="https://www.spoj.com/problems/BEADS/">Beads</a>, Task 1 θεωρίας | <a href="beads.cpp">Κώδικας</a> - 100%</li>
								<li>Task 5 θεωρίας | <a href="task5.cpp">Κώδικας</a> (διαφορετικός από την εξήγηση στις διαφάνειες, πάλι με Suffix Arrays) | Λύνεται βέλτιστα με χρήση <a href="../AhoCorasick/index.php">Aho-Corasick</a> (με δύσκολο τρόπο, δεν είναι τυπική εφαρμογή), με μεγαλύτερη προφανώς δυσκολία.</li>
								<li><a href="Querystr/querystr.html">QUERYSTR</a> | <a href="https://www.spoj.com/problems/QUERYSTR/en/">Judge</a> | <a href="Querystr/querystr.cpp">Kώδικας</a> - Παίρνει TLE στα μεγάλα Testcases | <span title="Αρκεί στο ανάποδο κείμενο να βρίσκουμε LCP του αρχικού κειμένου με τη θέση που μας ζητάει." class="color1">Hint</span> | Λύνεται βέλτιστα με <a href="../../Strings/Z-Algorithm/index.php">Z-Algorithm</a>.</li>
								<li><a href="Z-Sublexico/Z-Sublexico.html">Z-Sublexico</a> | <a href="http://www.codah.club/tasks.php?show_task=5000000451">Judge</a> | <a href="Z-Sublexico/z-sublexico.cpp">Kώδικας</a> - 100% | <span title="Έστω ότι ταξινομούμε τα suffixes. Αν το μικρότερο (έστω aabad) έχει 5 γράμματα, τότε τα 5 μικρότερα substrings είναι τα [a,aa,aab,aaba,aabad]. Αποκλείεται κάποιο από τα 5 να προκύπτει από άλλο suffix, γιατί τότε το άλλο suffix θα ήταν μικρότερο από το μικρότερο! Αντίστοιχα το 2 μικρότερο suffix μας δίνει τα επόμενα substrings, κλπ κλπ." class="color1">Hint 1</span> | <span title="Βεβαίως όταν βρίσκουμε τα substrings που δίνει το i-οστό μικρότερο suffix, πρέπει να αφαιρέσουμε αυτά που εμφανίστηκαν ήδη. Πόσα είναι αυτά;" class="color1">Hint 2</span> | <span title="Σύντομη απάντηση: Όσο το LCP με το (i-1)-οστό μικρότερο suffix. Μεγαλύτερη απάντηση: Όσο το μέγιστο LCP με κάποιο από τα προηγούμενα μικρότερα suffix (αυτό γιατί αν κάποιο substring έχει γεννηθεί ήδη, τότε και τα prefix αυτού έχουν γεννηθεί, άρα αρκεί να βλέπουμε μόνο LCP). Όμως το μέγιστο LCP προκύπτει από το (i-1)-οστό μικρότερο suffix, ακριβώς λόγω της ταξινόμησης." class="color1">Hint 3</span></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
