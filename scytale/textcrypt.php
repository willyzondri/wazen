<?php 
	class TextCrypt {

		public function sub ($arrayText, $countText, $status, $countSign) {
			$Modular = new Modular;
			$TextChar = new TextChar;
			$pcText = ''; 
			if ($status) {
				for ($i = 0; $i <= $countText; $countText--){
					if (ctype_alpha($arrayText[$countText])) {
						$pcText .=  $TextChar->randomChar($arrayText[$countText],$countSign) . $this->shift($arrayText[$countText], $status, $countSign);
					} else {
						$pcText .= $arrayText[$countText] == ' ' ? $TextChar->randomChar($arrayText[$countText],$countSign) . '%' : $TextChar->randomChar($arrayText[$countText],$countSign) . $arrayText[$countText]; 
					}
				}
				return $pcText;
			} else {
				for ($i = 0; $i <= $countText; $countText--){
					if (ctype_alpha($arrayText[$countText])) {
						$pcText .= $this->shift($arrayText[$countText], $status, $countSign);
					} else {
						$pcText .= $arrayText[$countText] == '%' ? ' ' : $arrayText[$countText]; 
					}
				}
				return $pcText;
			}
		}

		private function shift ($char, $status, $countSign) {
			$Modular    = new Modular;
			$valueA 	= $Modular->createPrime($countSign + 1);
			$valueB		= $Modular->createLength($countSign + 1);
			$charOffset = ctype_upper($char) ? 65 : 97 ;
			$nChar 		= ord($char) - $charOffset;
			$xChar		= $status ? $Modular->mod($valueA,$valueB,$nChar) + $charOffset : $Modular->imod($valueA,$valueB,$nChar) + $charOffset;
			return chr($xChar);
		}

	}
?>