<?php
	 $title = "Competitive Programming - From Zero to Hero";
	 include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Εισαγωγή</h3>
							<p class="mypad">Ίσως η πιο σημαντική δομή δεδομένων! Πρέπει να μάθετε να την γράφετε τέλεια, γιατί θα σας λύσει τα χέρια. Καλό θα ήταν σε αυτό το κεφάλαιο να επιμείνετε πολύυυ καιρό (άνω του δίμηνου). </p>
							<p class="mypad">Λόγω των άπειρων εφαρμογών των <strong>Leaf-Oriented BST</strong>, θα σπάσουμε το κεφάλαιο σε 4 υποκεφάλαια:</p>
							<ol><li><a href="Intro/index.php">Βασικές εφαρμογές</a>: Τροποποιούμε ένα στοιχείο, απαντάμε για πολλά.</li>
								<li><a href="Lazy_propagation/index.php">Lazy Propagation</a>: Τροποποιούμε και απαντάμε πολλά!</li>
								<li><a href="Tricks/index.php">Επί της ευκαιρίας, tricks</a>: Coordinate Compression, Sparse Leaf-Oriented BST, Merge Tree, Order-Statistic Tree, Tree Linearization, Sorting Queries offline, Fenwick Tree (aka Binary Indexed Tree).</li>
								<li><a href="Persistency/index.php">Persistency</a>: Ταξίδια στο χρόνο.</li></ol>
							
							<p class="mypad">Ας αναφέρουμε όμως πρώτα κάποια γενικά πράγματα που ισχύουν για όλα τα υποκεφάλαια. Η δομή αυτή μας επιτρέπει να τροποποιούμε τα στοιχεία μας και να απαντάμε ερωτήματα για πολλά στοιχεία (π.χ. τα μισά στοιχεία ενός πίνακα) σε O(logN) χρόνο! Για παράδειγμα μας επιτρέπει να αλλάξουμε σε 1025 την τιμή της θέσης 7, και να βρίσκουμε την ελάχιστη τιμή μεταξύ της θέσης 5 και της θέσης N-2, σε λογαριθμικό χρόνο. Ας την δούμε οπτικά πριν προχωρήσουμε: <img src="leaf-oriented_BST_example.png" /></p>
							<p class="mypad">Η μοναδική απαίτηση για τα ερωτήματα είναι να είναι <em>διαχωρίσιμα</em> (<a href="https://www.sciencedirect.com/science/article/pii/0020019079901170" title="DOI: 10.1016/0020-0190(79)90117-0">Decomposable</a>). Αυτό σημαίνει ότι αν μου χαρίσουν την απάντηση για το πρώτο μισό και την απάντηση για το δεύτερο μισό, μπορώ να τις συνδυάσω γρήγορα (συνήθως σε Ο(1)), και να πάρω τη συνολική απάντηση. Πολλά ερωτήματα είναι διαχωρίσιμα. Οι κλασικότερες εφαρμογές:</p>
							<ul><li><strong>Άθροισμα</strong>: Συνολικό_Άθροισμα = Αριστερό_Άθροισμα + Δεξί_Άθροισμα</li>
								<li><strong>Ελάχιστη τιμή</strong>: Συνολικό_Ελάχιστο = min(Αριστερό_Ελάχιστο, Δεξί_Ελάχιστο)</li>
							</ul>
							<p class="mypad">Ας αναφέρουμε και ένα χαρακτηριστικό παράδειγμα μη-διαχωρίσιμου ερωτήματος, την εύρεση του πλήθους διαφορετικών αριθμών. Βλέπουμε ότι οι πίνακες <em>[3,5,25,1]</em> και <em>[3,5,23,3]</em> δίνουν ίδιες απαντήσεις αριστερά και δεξιά (όλες ίσες με 2), αλλά η συνολική απάντηση διαφέρει (4 και 3 αντιστοίχως). Εδώ <em>δεν</em> εφαρμόζουμε Leaf-Oriented BST.</p>
							<p class="mypad">Τονίζουμε ότι δε θα δούμε κάποια καινούρια δομή δεδομένων! Παρότι ψευδώς κυκλοφορεί με το όνομα <strong>Segment Tree</strong> ή και <em>Interval Tree</em> στους κύκλους των competitive programmers (και μόνο έτσι θα βρείτε πηγές), η αλήθεια είναι ότι πρόκειται απλώς για ένα δέντρο που η πληροφορία βρίσκεται στα φύλλα του. Περισσότερα για αυτό στο πρώτο από τα υποκεφάλαια.</p>
							<p class="mypad">Υποσημείωση (πλήρως άχρηστη για διαγωνισμούς): Οι ονομασίες Segment Tree και Interval Tree δεν είναι απλώς περιττές, αλλά λανθασμένες, καθώς υπάρχουν ήδη 2 δομές δεδομένων με αυτά τα ονόματα (βλέπε <a href="https://www.springer.com/gp/book/9783662034279" title="DOI: 10.1007/978-3-662-03427-9">εδώ</a>) που απαντούν ερωτήματα σχετικά με ευθύγραμμα τμήματα (τα Segment Trees ερωτήματα δύο διαστάσεων, τα Interval Trees μίας διάστασης). Παρόλα αυτά κρατάμε στο νου μας την ονομασία Segment Tree για να μπορούμε να συνεννοηθούμε με όσους το ξέρουν έτσι (όλους).</p>
							
						</div>
					</div>

<?php
	 include 'footer.html';
?>
