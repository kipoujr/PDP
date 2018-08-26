<?php
	$title = "Competitive Programming - From Zero to Hero";
	include_once($_SERVER['DOCUMENT_ROOT']."/PDP/header.php");
?>
					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
							<h3 class="center">Εισαγωγή</h3>
							<p class="mypad">Είμαστε πλήρως άσχετοι με προγραμματισμό, και θέλουμε να φτάσουμε στο σημείο να θεωρούμαστε αρχάριοι. Ένα βήμα τη φορά, ίσα ίσα να μπορούμε να διαβάζουμε αυτά που διαβάζουν κι οι υπόλοιποι, από εκεί και πέρα κάτι θα κάνουμε.</p>
							<p class="mypad">Ευτυχώς υπάρχουν πάμπολλες πηγές για να γίνει αυτή η αρχή.</p>							
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-10 col-sm-8 col-xs-12">
							<hr class="hr">
						</div>
					</div>					

					<div class="row">
						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12" >
							<h3 class="center">Βήματα</h3>
							<p>Υποσημείωση: Αν ήδη γνωρίζουμε να προγραμματίζουμε σε C ή C++, έστω και λίγο, προσπερνούμε τα βήματα 0 και 1. Γενικά δεν ασχολούμαστε με θέματα των γλωσσών, αλλά με το πώς θα τις χρησιμοποιήσουμε για να κάνουμε δικά μας πράγματα (αλγορίθμους).</p>							
							<p class="sub "><strong class="color1">Βήμα 0 (Εγκατάσταση των κατάλληλων προγραμμάτων):</strong> Ακολουθούμε τις πρώτες 30 σελίδες του <a href="https://www.amazon.com/Beginning-Programming-Dummies-Dan-Gookin/dp/1118737636/ref=pd_bxgy_14_img_3?_encoding=UTF8&pd_rd_i=1118737636&pd_rd_r=BAPWRX9TNCMFZC5MFSPQ&pd_rd_w=BXbeW&pd_rd_wg=B7ZQo&psc=1&refRID=BAPWRX9TNCMFZC5MFSPQ" title="Παρακαλούμε αγοράστε το αντί να το κατεβάστε παράνομα, πρόκειται για εξαιρετικό βιβλίο κι έτσι ενισχύετε και τον συγγραφέα.">Beginning Programming with C for Dummies</a>.
							<p class="sub "><strong class="color1">Βήμα 1ο (Εισαγωγή στον προγραμματισμό με C):</strong> Ξεκινούμε από το <a href="https://www.dummies.com/DummiesTitle/C-For-Dummies-2nd-Edition.productCd-0764570684.html" title="Παρακαλούμε αγοράστε το αντί να το κατεβάστε παράνομα, πρόκειται για εξαιρετικό βιβλίο κι έτσι ενισχύετε και τον συγγραφέα.">C For Dummies</a> (2nd Edition). Το διαβάζουμε <strong>ολόκληρο</strong>! Κυρίως τα (μικρά) κεφάλαια <strong>arrays</strong> και <strong>strings</strong>. Πολύ χρήσιμες οι συναρτήσεις <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Zero-Material/strlen.html" href="https://www.programiz.com/c-programming/library-function/string.h/strlen">strlen</a> και <a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Zero-Material/strcmp.html" href="https://www.programiz.com/c-programming/library-function/string.h/strcmp">strcmp</a>.</p>
							<p class="sub "><strong class="color1">Βήμα 2ο (Πιο προχωρημένα θέματα C):</strong> Συνεχίζουμε με το <a title="Παρακαλούμε αγοράστε το αντί να το κατεβάστε παράνομα, πρόκειται για εξαιρετικό βιβλίο κι έτσι ενισχύετε και τον συγγραφέα." href="https://www.amazon.com/Beginning-Programming-Dummies-Dan-Gookin/dp/1118737636/ref=pd_bxgy_14_img_3?_encoding=UTF8&pd_rd_i=1118737636&pd_rd_r=BAPWRX9TNCMFZC5MFSPQ&pd_rd_w=BXbeW&pd_rd_wg=B7ZQo&psc=1&refRID=BAPWRX9TNCMFZC5MFSPQ">Beginning Programming in C for Dummies</a>. Πρόκειται για συνέχεια του προηγούμενου για πιο προχωρημένα θέματα. Δε χρειάζεται να το διαβάσουμε ολόκληρο, το έχουμε για αναφορά όποτε χρειαζόμαστε κάτι (όπως διάβασμα από αρχείο, πίνακες, κείμενα, pointers).</li>
							<p class="sub "><strong class="color1">Βήμα 3ο (Χρήσιμες βιβλιοθήκες για τους διαγωνισμούς):</strong> Κατόπιν διαβάζουμε το <a href="Zero-Material/STL-Best practices.pdf">STL - Best Practices</a> (θυμόμαστε <a href="/PDP/read_pdf.php">αυτό</a>). Ό,τι δεν καταλαβαίνουμε το προσπερνάμε, θα το μάθουμε αργότερα.</p>
							<p class="sub "><strong class="color1">Βήμα 4ο:</strong> To <a href="Zero-Material/ds-stl.pdf">STL Data Structures</a>, όπως και τα παραδείγματα στο αντίστοιχο <a href="Zero-Material/ds-stl.zip">zip</a> είναι η μόνιμη αναφορά μας για χρήση της stl (θυμόμαστε <a href="/PDP/read_pdf.php">αυτό</a>).</p>
							<p class="sub "><strong class="color1">Άλλες αναφορές:</strong>
								<ul>
									<li><a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Zero-Material/Kallinikos_STL.html" href="https://kallinikos.github.io/STL">https://kallinikos.github.io/STL</a></li>
									<li><a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Zero-Material/Kallinikos_Common_Bugs.html" href="https://kallinikos.github.io/Συχνά-Λάθη">https://kallinikos.github.io/Συχνά-Λάθη</a></li>
									<li><a title="Offline: <?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>/Zero-Material/Kallinikos_Debugging.html" href="https://kallinikos.github.io/Debugging">https://kallinikos.github.io/Debugging</a></li>
								</ul>
							</p>
						</div>
					</div>

<?php
	include 'footer.html';
?>
