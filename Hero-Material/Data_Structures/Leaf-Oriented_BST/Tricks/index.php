<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Εισαγωγή</h3>
							<p class="mypad">Σε αυτό το υποκεφάλαιο θα παρουσιάσουμε πολλές ενδιαφέρουσες τεχνικές που χρησιμοποιούνται συχνά πάνω σε Leaf-Oriented BSTs (και στο τέλος μία δομή αντί αυτών...). Τονίζουμε ότι πολλές από αυτές δεν είναι κάτι καινούριο, απλώς εμφανίζονται αρκετά συχνά ώστε να τους αξίζει μία σύντομη αναφορά.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Συμπίεση συντεταγμένων</h3>
							<p class="mypad">Δίνονται Ν=100.000 στοιχεία, το καθένα μεταξύ 0 και 100.000 (μικροί αριθμοί). Ζητείται να μετρήσουμε πόσα ζεύγη υπάρχουν που ο μεγάλος αριθμός να εμφανίζεται πριν τον μικρό (inversions).</p>
							<p class="mypad">Λύση: Διαβάζουμε τους αριθμούς με τη σειρά που μας δίνονται. Κάθε φορά πρέπει να ξέρουμε πόσους αριθμούς έχουμε ήδη διαβάσει που να είναι μεγαλύτεροί του παρόντος, δηλαδή μεταξύ <em>(Παρούσα_Τιμή+1)</em> και <em>Άπειρο</em>, το οποίο θεωρούμε ίσο με 100.001 λόγω εκφώνησης. Αυτό είναι απλά μία ερώτηση αθροίσματος:
								<strong class="formula">Sum(L=current_value+1, R=100.001)</strong>
								Κατόπιν ενημερώνουμε για τον αριθμό που μόλις διαβάσαμε, αυξάνοντας κατά ένα τις εμφανίσεις της παρούσας τιμής:
								<strong class="formula">Update(pos=current_value, how_much=1)</strong>
							</p>
							<p class="mypad">Τι θα κάναμε όμως αν οι αριθμοί μας ήταν τεράστιοι; Δε θα γινόταν να χρησιμοποιήσουμε Leaf-Oriented BST αφού δε θα μπορούσαμε να έχουμε πχ Update(1.000.000.000,1), καθώς θα έπρεπε να έχουμε πίνακα με θέση 1.000.000.000.</p>
							<p class="mypad">Η βασική παρατήρηση είναι ότι δε μας ενδιαφέρουν οι ίδιες οι τιμές των στοιχείων, αλλά το πώς είναι το ένα σε σχέση με το άλλο. Για παράδειγμα ο πίνακας
								<em class="formula">[3, 8, 2]</em>
								και ο αυξημένος κατά ένα πίνακας
								<em class="formula">[4, 9, 3]</em>
								δίνουν την ίδια απάντηση. Εδώ μπαίνει η συμπίεση συντεταγμένων.
							</p>
							<p class="mypad">Μας αρκεί οι σχετικές θέσεις των αριθμών να είναι ίδιες. Έτσι, αν ταξινομήσουμε το input και αναθέσουμε στον κάθε αριθμό τη θέση που πήρε στον ταξινομημένο πίνακα, έχουμε συμπίεση. Για παράδειγμα ο πίνακας
								<em class="formula">[300, 800, 200, 300]</em>
								μετά την ταξινόμηση γίνεται
								<em class="formula">[200, 300, 300, 800]</em>
								Πρώτα εμφανίζεται το 200, άρα του αναθέτουμε την τιμή 1. Δεύτερο εμφανίζεται το 300, άρα του αναθέτουμε την τιμή 2. Τρίτο εμφανίζεται το 800, άρα του αναθέτουμε την τιμή 3. Ο τελικός πίνακας είναι
								<em class="formula">[2, 3, 1, 2]</em>
								και έχει ίδια απάντηση με τον αρχικό πίνακα.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Sparse Leaf-Oriented BST</h3>
							<p class="mypad">Καταλαβαίνουμε ότι για να καταφέρουμε τη συμπίεση συντεταγμένων πρέπει να μας δίνεται όλο το input από την αρχή, ώστε να ταξινομήσουμε. Τι γίνεται αν αυτό δεν ισχύει; Θα μπορούσε για παράδειγμα, στο παραπάνω πρόβλημα, να ζητάει για κάθε αριθμό το πλήθος των προηγούμενων που είναι μεγαλύτεροι, και να μας αποκαλύπτει τον επόμενο αριθμό μόνο αφού δίναμε την απάντηση για τον παρόντα.</p>
							<p class="mypad">Η λύση έρχεται με τα κλασικά μας Leaf-Oriented BST, με τη διαφορά ότι δε χρησιμοποιούμε την αναπαράσταση που είδαμε στη heap
								<em class="formula">left=2*v, right=2*v+1</em>
								Αντ' αυτού, ο κάθε κόμβος θα έχει πέρα από τις γνωστές τιμές και τα πεδία left και right που μας λένε σε ποια θέση του πίνακα είναι αποθηκευμένα το αριστερό και το δεξί του παιδί.
							</p>
							<p class="mypad">Έτσι, όταν θέλουμε να πάμε στο αριστερό παιδί, είτε ξέρουμε πού βρίσκεται (έχουμε ξαναπάει) είτε δεν ξέρουμε. Αν δεν ξέρουμε σημαίνει ότι δεν έχουμε ξαναπάει εκεί, κι άρα δημιουργούμε αυτή τη στιγμή τον κόμβο του αριστερού παιδιού. Πού; Στην πρώτη αχρησιμοποίητη θέση του πίνακα (σαν push_back σε vector). Αυτή ακριβώς την θέση θα δώσουμε και στο πεδίο left του κόμβου.</p>
							<p class="mypad">Με τον τρόπο αυτό, όλο το δέντρο είναι δημιουργημένο στο μυαλό του προγραμματιστή, αλλά μόνο οι κόμβοι τους οποίους κάποτε επισκεφθήκαμε είναι δημιουργημένοι στον υπολογιστή. Αφού κάθε update ή query ζητά το πολύ 4*depth_of_tree κόμβους, αρκεί να έχουμε τόσες θέσεις πίνακα για κάθε operation.</p>
							<p class="mypad">Στην περίπτωσή μας έχουμε depth_of_tree = log(1.000.000.000), περίπου 30. Έχουμε N updates και N queries, άρα θέλουμε 2*Ν*4*depth μέγεθος πίνακα. Χρειαζόμαστε λοιπόν 24.000.000 θέσεις στον πίνακά μας, έναντι των 4.000.000.000 θέσεων της παλιάς αναπαράστασης.</p>
							<p class="mypad">Μια πιο προσεκτική ανάλυση μπορεί να δείξει ότι αυτό είναι υπερεκτίμηση και δε χρειαζόμαστε ούτε τους μισούς. Για να μη μπερδευόμαστε μπορούμε είτε να έχουμε ένα <code>vector&lt;Nodes&gt; node</code> που αναλαμβάνει αυτός να μεγαλώνει όταν δεν φτάσουν οι θέσεις, ή να δίνουμε όσο περισσότερη μνήμη επιτρέπει η εκφώνηση.</p>
							<p class="mypad">Το καλό της αναπαράστασης αυτής είναι ότι ο κώδικάς μας αλλάζει ελάχιστα! Όπου είχαμε
								<code class="formula">2*v</code>
								βάζουμε
								<code class="formula">Left(v)</code>
								και έχουμε μία συνάρτηση <code>int Left(int v)</code> που το μόνο που κάνει είναι:
								<code class="formula">if( node[v].left==0 ) node[v].left = node.size(), node.push_back(EmptyNode());</code>
								<code class="formula">return node[v].left;</code>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Merge Tree</h3>
							<p class="mypad">Merge Sort είναι ένας αλγόριθμος ταξινόμησης που ταξινομεί (αναδρομικά) τα δύο μισά του πίνακα, και μετά σε γραμμικό χρόνο τα συνθέτει. Η συνολική χρονική πολυπλοκότητά της είναι O(NlogN).</p>
							<p class="mypad">Το Merge Tree είναι άλλη μία ονομασία που βγάλανε οι competitive programmers! Πρόκειται απλώς για ένα Leaf-Oriented BST που σε κάθε κόμβο κρατάει ένα vector με ταξινομημένους τους αριθμούς του. Το κάνει αυτό ακριβώς όπως συνθέτει η Merge Sort. Αφού σε κάθε επίπεδο εμφανίζεται μία φορά ο κάθε αριθμός, η χωρική πολυπλοκότητα του είναι O(NlogN). Παρακάτω βλέπουμε ένα τέτοιο δέντρο:
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Εισαγωγή</h3>
							<p class="mypad">Σε αυτό το υποκεφάλαιο θα παρουσιάσουμε πολλές ενδιαφέρουσες τεχνικές που χρησιμοποιούνται συχνά πάνω σε Leaf-Oriented BSTs. Τονίζουμε ότι πολλές από αυτές δεν είναι κάτι καινούριο, απλώς εμφανίζονται αρκετά συχνά ώστε να τους αξίζει μία σύντομη αναφορά.</p>
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
							<ol><li>Εφαρμογή <a href="https://www.spoj.com/problems/DCEPC206/">DCEPC206</a> - Εκφώνηση και Judge | <a href="http://piyushkumarblog.blogspot.com/2013/01/blog-post.html">Κώδικας</a> | <a href="dcepc206.zip">Offline</a></li>
								<li>(*) <a href="https://www.spoj.com/problems/GSS1/">GSS1</a> και η δυναμική εκδοχή του <a href="https://www.spoj.com/problems/GSS3/">GSS3</a> - Εκφώνηση και Judge | <a href="https://www.quora.com/What-is-the-approach-for-solving-GSS1-and-GSS3-on-SPOJ-using-segment-trees">Λύση</a> | <a href="https://github.com/vitsalis/SPOJ/blob/master/GSS3/gss3.cpp">Κώδικας</a> | <a href="gss1-3.zip">Offline</a></li>
								<li>(*) <a href="https://www.spoj.com/problems/BRCKTS/">BRCKTS</a> - Εκφώνηση και Judge | <a href="https://www.quora.com/What-is-the-algorithm-to-solve-the-BRCKTS-problem-of-SPOJ">Λύση</a> στο σχόλιο του Pardyot Shahi | <a href="https://gist.github.com/PrashantYadav/b27287c48672c4e66ce2">Κώδικας</a> | <a href="brckts.zip">Offline</a></li>
							</ol>
						</div>
					</div>

<?php
	include 'footer.html';
?>
