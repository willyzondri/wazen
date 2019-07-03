<?php 

	define("ALPHABET", 26);
	require_once ("scytale/modular.php");
	require_once ("scytale/textcrypt.php");
	require_once ("scytale/textchar.php");

	class MainCrypt {

		public function indexCrypt () {			
			$theText = '';
			if (isset($_POST['status'])) {
				if ($_POST['status'] == 'encrypt') {
					$theText = $this->encrypt($_POST['text'], $_POST['pass']);
				} else if ($_POST['status'] == 'decrypt') {
					$theText = $this->decrypt($_POST['text'], $_POST['pass']);
				}
			}
			return $theText;
		}

		private function encrypt ($text,$pass) {
			$TextCrypt = new TextCrypt;
			$TextChar  = new TextChar;
			// $textClean = $text;
			$textClean = preg_replace('/\s\s+/', ' ',$text);
			$arrayText = $TextChar->normalizeChar($textClean);
			$countText = count($arrayText) - 1;
			if ($countText + 1 == "") {
				return $theText = "Teks Masih Kosong";
			}
			$arraySign = $TextChar->normalizeChar($pass);
			$countSign = count($arraySign) - 1;
			if ($countSign + 1 < 8) {
				return $theText = "Password Terlalu Pendek, Minimal 8 Character";
				exit();
			}
			return $theText = $TextCrypt->sub($arrayText, $countText, true, $countSign)."::".$TextCrypt->sub($arraySign, $countSign, true, $countSign);
		}

		private function decrypt ($text,$pass) {
			$TextCrypt = new TextCrypt;
			$TextChar  = new TextChar;
			$theSignat = $pass;					
			$theChiper = explode("::", $text);
			if (count($theChiper) !== 2) { return $theText = "Data Tidak Benar"; exit();}
			$plainSign = $theChiper[1];
			$splitSign = str_split($plainSign, 5);
			$countSign = count($splitSign) - 1;
			$arraySign = [];
			for ($i = 0; $i <= $countSign ; $i++) { 
				array_push($arraySign, substr($splitSign[$i], 4,1));
			}
			$theSign = $TextCrypt->sub($arraySign, $countSign, false, $countSign);
			if ($theSignat == $theSign) {
				$plainText = $theChiper[0];
				$splitText = str_split($plainText, 5);
				$countText = count($splitText) - 1;
				$arrayText = [];
				for ($i = 0; $i <= $countText ; $i++) { 
					array_push($arrayText, substr($splitText[$i], 4,1));
				}
				$theText = $TextCrypt->sub($arrayText, $countText, false, $countSign);
			} else {
				$theText = "Password Salah";
			}
			return $theText;
		}
	}	

	$MainCrypt = new MainCrypt;
	echo $MainCrypt->indexCrypt();

?>