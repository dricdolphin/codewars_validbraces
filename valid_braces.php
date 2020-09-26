<?php

class valid_braces {

    public function __construct()
    {
        //Keep this empty, it's here just for show!
    }

    public function valid_braces ($braces) {
		$current_position = 0;
        $current_brace = substr($braces,$current_position,1);
		$braces_length = strlen($braces);
		
        switch ($current_brace) {//Get the closing brace for the current
            case "[":
                $closing_brace = "]";
                break;
            case "{":
                $closing_brace = "}";
                break;
            case "(":
                $closing_brace = ")";
                break;
            default:
                return false;
        }

        $closing_position = strpos($braces,$closing_brace);
		//Check if there is another OPENING position BEFORE this closing. If there is, it might be possible that the closing we get is actually not the right one!
		while ($next_closing_position = strpos($braces,$closing_brace,$closing_position+1)) {
			$next_opening_position = strpos($braces,$current_brace,$current_position+1);
			if ($next_opening_position < $closing_position) {
				$closing_position = $next_closing_position;
			} else {
				break;
			}
		}
		
		$braces_length = strlen($braces);

        if ($closing_position === false) {//We didn't find a closing brace, so the string is invalid!
            return false;
        }
		
		//Check if there is an inner string
		$inner_string_length = $closing_position-($current_position+1);
		$string_inner = "";
		if ($inner_string_length > 0) {
			$string_inner = substr($braces,$current_position+1,$inner_string_length);
		} 
        
        if (empty($string_inner) && ($closing_position+1) == strlen($braces)) {//If the inner string is empty and we are at the last char of our input, we're done!
            return true;
        } elseif (empty($string_inner)) {//We closed this brace, get the remaining string and validate it
            $remaining_string = substr($braces,$closing_position+1);
			return $this->valid_braces($remaining_string);
        } else {//We have an inner string, check it
            //If the inner string is fine, then move to the next position
			if ($this->valid_braces($string_inner)) {
				$remaining_string = substr($braces,$closing_position+1);
				if (!empty($remaining_string)) {
					return $this->valid_braces($remaining_string);
				} else {
					return true;
				}
            }  else {
                return false;
            }
        }
    }
}
?>
