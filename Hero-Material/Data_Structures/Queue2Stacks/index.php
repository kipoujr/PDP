<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Θεωρία</h3>
							<p class="mypad">Η εν λόγω δομή δεδομένων είναι μία απλή queue, που όμως υλοποιείται με πολύ περίεργο τρόπο. Αντί να την χτίσουμε άμεσα, χτίζουμε 2 stacks, και με operations πάνω σε αυτές προσομοιώνουμε την queue. Ποιο το κέρδος;</p>
							<p class="mypad">Ας συζητήσουμε δύο προβλήματα. Και στα δύο ζητείται να υλοποιήσουμε μία queue, στο πρώτο ζητείται απάντηση στο ερώτημα: "Ποιο το <strong>άθροισμα</strong> των αριθμών μέσα στην queue;", ενώ στο δεύτερο: "Ποιος ο μέγιστος κοινός διαιρέτης (<strong>GCD</strong>) των αριθμών μέσα στην queue;". Το πρώτο μπορεί να λυθεί με μία τυπική queue. Όταν εισάγουμε αριθμό, απλώς τον προσθέτουμε στο υπάρχον άθροισμα, ενώ όταν εξάγουμε, τον <strong>αφαιρούμε</strong> από το άθροισμα. Στο δεύτερο πρόβλημα όμως δεν υπάρχει τρόπος να αφαιρέσουμε, δεν υπάρχει δηλαδή πράξη που να <strong>αναιρεί</strong> την εφαρμογή του GCD.
							<p class="mypad">Με τη δομή αυτή υποστηρίζουμε τις πράξεις που δεν έχουν αντίστοιχη πράξη αναίρεσης, σε μια queue. Αυτό γίνεται επειδή σε μία stack, αφού φεύγει το κορυφαίο στοιχείο, δε χρειάζεται να υπολογίσουμε την πράξη για τα εναπομείναντα στοιχεία. Mπορούμε απλώς να θυμόμαστε την απάντηση από τη χρονική στιγμή πριν μπει αυτό το στοιχείο (ενώ σε μία queue δεν υπάρχει τέτοια χρονική στιγμή).</p>
							<p class="mypad">Αναλυτικότερα διαβάζουμε θεωρία από <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Theory.html#answer-39089983" href="https://stackoverflow.com/questions/69192/how-to-implement-a-queue-using-two-stacks#answer-39089983">εδώ</a>. Όλες οι λειτουργίες υποστηρίζονται σε <strong>amortized O(1)</strong> χρόνο.</p>
							<p class="mypad">Ας σημειώσουμε ότι με τη δομή αυτή μπορούμε να λύσουμε όλα τα προβλήματα που λύνουμε με μία PQA, αλλά και πολλά ακόμα. Ενδιαφέρον έχει ότι ο κώδικάς της (όπως και ο κώδικας της PQA) είναι απλούστατος.</p>
							<p class="mypad">Υποσημειώσεις (πλήρως άχρηστες για διαγωνισμούς): Όσα αναφέραμε μπορούν να επιτευχθούν και σε worst-case O(1) χρόνο, με μία απλή τεχνική του <a href="https://dl.acm.org/citation.cfm?id=165334" title="Πρόκειται για τη διδακτορική διατριβή του Rajeev Raman.">Raman</a>. Ενδιαφέρον έχει ότι η εν λόγω δομή προέκυψε από την ανάγκη προσομοίωσης μίας <em>dequeue</em> με 2 stacks (λύνεται με όμοιο τρόπο). Με τη σειρά του αυτό απαντάει σε ένα πρόβλημα <a href="https://online.stanford.edu/courses/soe-ycsautomata-automata-theory" title="Automata Theory, του Jeff Ullman">Θεωρίας Υπολογισμού</a>, και μας λέει ότι μπορούμε να προσομοιώσουμε μία <a href="https://en.wikipedia.org/wiki/Turing_machine" title="Στο περίπου έναν υπολογιστή...">Turing Machine</a> χρησιμοποιώντας 2 <a href="https://en.wikipedia.org/wiki/Pushdown_automaton" title="Στο περίπου μία Stack...">Pushdown-Automata</a>.
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
							<ol><li>(*) <a href="gcdseq/Statement.txt">GcdSeq</a> | <a href="https://www.codechef.com/IPC15P1A/problems/GCDMAX1">Judge</a> σχεδόν ίδιου προβλήματος | <a href="gcdseq/test_gcdseq.zip">Testcases</a> | <a href="gcdseq/gcdseq.cpp">Κώδικας</a> | <span title="Προσθέτουμε στοιχεία στην Queue όσο το GCD είναι μεγαλύτερο από 1. Μόλις γίνει 1, αφαιρούμε το παλιότερο στοιχείο και επαναλαμβάνουμε. Πώς βρίσκουμε το GCD όλων των στοιχείων;" class="color1">Hint 1</span> | <span title="Κρατάμε το GCD για κάθε stack, και το GCD αυτών των 2 stack είναι το συνολικό GCD. Αν για κάθε στοιχείο ξέρουμε το GCD του με όλα όσα είναι από κάτω του, όταν μπαίνει ένα καινούριο αρκεί να βρει το GCD του εαυτού του με το (ήδη υπολογισμένο) GCD των από κάτω του." class="color1">Hint 2</span></li>
								<li>(*) <a href="Maxes/Statement.txt">Maxes</a> | <a href="https://www.spoj.com/problems/WINMAXK/">Judge</a> | <a href="Maxes/test_maxes.zip">Testcases</a> | <a href="maxes/sols_maxes.zip">Κώδικας</a></li>
								<li>(***) <a href="Knapsack_SlidingWindow/Statement.txt">Knapsack - Sliding Window</a> Μόνο για σκέψη, δε χρειάζεται γράψιμο! | <a href="https://www.hackerrank.com/contests/cs-quora/challenges/quora-feed-optimizer/problem">Judge</a> για εργασιομανείς! | <span title="Πρέπει να ξέρουμε να λύνουμε το dp πρόβλημα knapsack. Με βάση την αναδρομή του μπορούμε να προσθέσουμε αντικείμενο στη stack μας. Πώς συνδυάζουμε τις απαντήσεις των 2 stack;" class="color1">Hint 1</span> | <span title="Για κάθε βάρος i της πρώτης stack, πρέπει να βρούμε το μέγιστο score για βάρη το πολύ W-i της δεύτερης. Προϋπολογίζουμε: για κάθε βάρος για τη δεύτερη stack, bestScore(weight=i) = max(Score(weight=i), bestScore(weight=i-1))" class="color1">Hint 2</span></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
