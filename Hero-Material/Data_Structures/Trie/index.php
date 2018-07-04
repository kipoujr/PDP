<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Η δομή Trie είναι η πρώτη δομή που μαθαίνει κανείς για κείμενα (strings). Μας επιτρέπει να κρατάμε ένα λεξικό, να ελέγχουμε σε βέλτιστο (γραμμικό ως προς το μέγεθος της λέξης) χρόνο αν μία λέξη υπάρχει στο λεξικό μας, και να εισάγουμε/εξάγουμε λέξεις από το λεξικό.</strong>. Οπτικά μοιάζει έτσι:</p>
							<img src="trie.png" />
							<p class="mypad">Ό,τι θα χρειαστούμε για να μάθουμε αυτή τη δομή βρίσκετε σε αυτές τις <a href="trie.pdf">διαφάνειες</a>.</p>
							<p class="mypad">Υποσημείωση: Αυτή η βασική δομή κατόπιν μπορεί να επεκταθεί για να λύνει περισσότερα προβλήματα. Χαρακτηριστικό παράδειγμα το δέντρο <a href="../AhoCorasick/index.php">Aho-Corasick</a>, όπως και το Suffix Tree (που όμως δε χρειάζεται για διαγωνισμούς, αντ' αυτού θα χρησιμοποιούμε μία άλλη δομή, τα <a href="../Suffix_Array/index.php">Suffix Arrays</a>).</p>
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
							<p class="mypad">Εξαιρετική πηγή για εισαγωγή/επεξήγηση ασκήσεων βρίσκουμε <a href="https://threads-iiith.quora.com/Tutorial-on-Trie-and-example-problems" title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/solved_examples.html">εδώ</a>. Συγκεκριμένα εξηγεί τα παρακάτω:</p>
							<ol><li>(*) <a href="https://icpcarchive.ecs.baylor.edu/index.php?Itemid=8&category=345&option=com_onlinejudge&page=show_problem&problem=2683">XORSUM</a>: Εκφώνηση και Judge | <a href="https://raw.githubusercontent.com/pin3da/Programming-contest/master/solved/ICPCLivearchive/4682%20-%20XOR%20Sum/solution.cc">Κώδικας</a> | <a href="xorsum.zip">Offline</a></li>
								<li>(**) <a href="https://www.spoj.com/problems/SUBXOR/">SUBXOR</a>: Εκφώνηση και Judge | <a href="https://raw.githubusercontent.com/tr0j4n034/SPOJ/master/SUBXOR.cpp">Κώδικας</a> | <a href="subxor.zip">Offline</a></li>
								<li>(**) <a href="http://codeforces.com/contest/455/problem/B">A lot of Games</a>: Εκφώνηση και Judge | <a href="http://codeforces.com/contest/455/submission/7407670">Κώδικας</a> | <a href="a_lot_of_games.zip">Offline</a></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
