<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Η δομή Aho-Corasick μας βοηθάει να βρούμε όλες τις εμφανίσεις όλων των λέξεων ενός λεξικού μέσα σε ένα μεγάλο κείμενο. Πριν την μάθουμε πρέπει οπωσδήποτε να έχουμε καταλάβει καλά τον αλγόριθμο για String Matching <a href="../../Strings/KMP/index.php">KMP</a>, όπως και τα <a href="../Trie/index.php">Tries</a>.</p>
							<p class="mypad">Η πολυπλοκότητα είναι η βέλτιστη. Χρειαζόμαστε γραμμικό (στο πλήθος των γραμμάτων του λεξικού) χρόνο κατασκευής, και για κάθε κείμενο που ελέγχουμε κατόπιν, χρειαζόμαστε γραμμικό (στο πλήθος των γραμμάτων του κειμένου) χρόνο, συν το χρόνο για να τυπώσουμε τις εμφανίσεις (output sensitive).</p>
							<p class="mypad">Διαβάζουμε θεωρία από τις <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/aho-corasick.pdf" href="https://web.stanford.edu/class/cs166/lectures/02/Small02.pdf">διαφάνειες</a> του Stanford.</p>
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
							<ol><li>Εφαρμογή: <a href="http://hsin.hr/coci/archive/2011_2012/contest5_tasks.pdf">Poplocavanje</a> | <a href="http://www.codah.club/tasks.php?show_task=5000001626">Judge</a> | <a href="http://hsin.hr/coci/archive/2011_2012/contest5_solutions.zip">Λύση<a/> | <a href="http://hsin.hr/coci/archive/2011_2012/contest5_testdata.zip">Testcases</a> | <a href="http://hsin.hr/coci/archive/2011_2012/solutions/GagGuy/contest5_poplo.cpp">Κώδικας</a> | <a href="poplocavanje.zip">Offline</a></li>
								<li>(**) <a href="https://www.codechef.com/LTIME06/problems/QMARKS">QMARKS</a>: Εκφώνηση και Judge | <a href="http://discuss.codechef.com/questions/30376/qmarks-editorial">Λύση</a> | <a href="https://s3.amazonaws.com/codechef_shared/download/Solutions/LTIME06/Setter/QMARK.cpp">Κώδικας</a> | <a href="qmarks.zip">Offline</a> | <span title="Αν δεν είχαμε '?' τότε κάθε θέση του κειμένου θα αντιστοιχούσε σε ένα κόμβο του Aho-Corasick. Τώρα μπορεί να αντιστοιχεί σε πολλούς κόμβους..." class="color1">Hint 1</span> | <span title="Αφού οι κόμβοι είναι μόνο 1000 και τα γράμματα του κειμένου 1000, μπορούμε με dp να βρούμε τις μέγιστες εμφανίσεις αν έχουμε επεξεργαστεί τα γράμματα i...N και βρισκόμαστε στον κόμβο j του Aho-Corasick." class="color1">Hint 2</span> | <span title="Αν το Text[i] είναι κανονικό γράμμα, τότε προσθέτουμε τις λέξεις που κάνουν match όταν βρισκόμαστε στον j, και πηγαίνουμε όπου πάει ο j αν πάρει το Text[i]. Αν όμως το Text[i]=='?', τότε δοκιμάζουμε όλα τα πιθανά γράμματα με τον προηγούμενο τρόπο, και κρατάμε το καλύτερο." class="color1">Hint 3</span> | Προσοχή! Ενώ ο κώδικας υπολογίζει σωστά τα suffix/failure links, λόγω των λίγων γραμμάτων κάνει brute force για τις λέξεις που είναι suffix του κόμβου μας (μετράει πόσα συνεχόμενα output links μπορούμε να πάρουμε). Κανονικά θα έπρεπε να υπολογιστούν με παρόμοιο τρόπο.
								<li>(**) Μόνο προς συζήτηση, δεν υπάρχει Judge/Testcases/Κώδικας: <a href="http://boi2014.tubitak.gov.tr/sites/default/files/Hittites_EN.pdf" title="Offline <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Hittites/Hittites.pdf">Hittites</a> | <a href="Hittites/Hittites_sol.php">Λύση</a>.</li>
								<li>(***) Προαπαιτούμενα: <a href="../../General_Techniques/Heavy-Light_Decomposition/index.php">Heavy-Light Decomposition</a> | <a href="http://codeforces.com/contest/163/problem/E">e-Government</a>: Εκφώνηση και Judge | <a href="http://codeforces.com/blog/entry/4187">Λύση</a> | <a href="http://codeforces.com/contest/163/submission/1415345">Κώδικας</a> | <a href="eGovernment.zip">Offline</a> | <span title="Ας δούμε το γράφημα που προκύπτει αν κοιτάμε ΜΟΝΟ τα suffix links. Κάθε κόμβος έχει ένα (εκτός της ρίζας) που δείχνει σε κόμβο αυστηρά μικρότερου βάθους. Τι γράφημα προκύπτει;" class="color1">Hint 1</span> | <span title="Προκύπτει κύκλος, αφού έχουμε Ν-1 ακμές (μία για κάθε κόμβο εκτός της ρίζας) και το γράφημα είναι συνδεδεμένο (όλοι μετά από κάποια βήματα φτάνουν στη ρίζα καθώς το κενό κείμενο είναι sufix κάθε κειμένου). Τρέχοντας το Aho-Corasick, πρέπει να απαντάμε για κάθε κόμβο πόσες λέξεις υπάρχουν που να είναι suffix αυτής. Με τι ισοδυναμεί αυτό στο Suffix-Link-Δέντρο;" class="color1">Hint 2</span> | <span title="Κάθε φορά που είμαστε στον κόμβο v του Aho-Corasick, πρέπει να βρούμε πόσες λέξεις υπάρχουν από τη ρίζα στον v στο Suffix-Link-Δέντρο (καθώς αν επαναληπτικά ακολουθούμε suffix links θα βρούμε όλες τις λέξεις). Εδώ μπαίνει το Heavy-Light Decomposition πάνω στο Suffix-Link-Δέντρο, για να μπορούμε να βρίσκουμε άθροισμα πάνω σε μονοπάτι, και να ανανεώνουμε την τιμή κόμβου όταν μπαίνει/βγαίνει από την κυβέρνηση." class="color1">Hint 3</span></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
