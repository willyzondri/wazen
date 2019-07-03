<?php 
	class Modular {

		public function mod ($a, $b, $l) {
			return ($a * $l + $b) % ALPHABET; 
		}

		public function imod ($a, $b, $l) {
			$i = 0;
			$x = 0;
			while ($x !== 1) {
				$x = ($a * $i) % ALPHABET;
				if ($x == 1) {$an = $i;}
				$i++;
			}
			return $this->tmod($an * ($l - $b), ALPHABET);
		}

		public function tmod ($invers, $alphabet) {
			return ($alphabet + ($invers % $alphabet)) % $alphabet;
		}	

		public function createPrime ($a) {		
			$a = $a % 26;
			if ($a % 2 !== 0) {
				if ($a == 13) {
					$a = 11;
				} 
				if ($a <= 2){
					$a = 3;
				}
			}else {
				if ($a <= 2) {
					$a = 3;
				} else {
					$a = $a + 1;
				}
				if ($a == 13) {
					$a = 15;
				} 
			}
			return $a;
		}

		public function createLength ($b) {
			return ($b + 3) % ALPHABET;
		}

	}
?>