<?php 
	class TextChar {

		public function normalizeChar ($char) {
			$countText = strlen($char) - 1;
			$arrayText = str_split($char, 1);
			$newArray  = [];
			for ($i=0; $i <= $countText; $i++) { 
				ord($arrayText[$i]) <= 126 ? array_push($newArray, $arrayText[$i]) : '';
			}
			return $newArray;
		}

		public function randomChar ($char,$countSign) {
			$Modular    = new Modular;
			$charOffset = ctype_upper($char) == true ? 65 : 97 ;
			$charNetral = ord($char) - $charOffset;
			$charText   = '';
			for ($i = 0; $i <= 3; $i++) {
				$charText .= chr( $Modular->tmod($charNetral + ($i + $countSign), ALPHABET) + $charOffset);
			}
			return $charText;
		}

	}
?>