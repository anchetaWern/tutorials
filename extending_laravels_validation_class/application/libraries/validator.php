<?php
class Validator extends Laravel\Validator {
	/**
	 * checks if an input is a valid date
	 */
	public function validate_date($attribute, $value, $parameters){
		$e_str = explode("-", $value);
    if(count($e_str) === 3){
      
      //expected format for date input is: Y-m-d
      $year = $e_str[0];
      $month = $e_str[1];
      $day = $e_str[2];

      return checkdate($month, $day, $year); //expected format for checkdate is: m-d-y
    }
    return false;
	}

	/**
	 * checks if an array input has no empty values
	 */
	public function validate_arrayfull($attribute, $value, $parameters){
		$is_full = (in_array('', $value)) ? false : true;
		return $is_full;
	}

	/**
	 * checks if an array input has no duplicate values for a single column
	 * for example the column is names, this checks if every name is unique
	 */
	public function validate_arrayunique($attribute, $value, $parameters){
		return count($value) == count(array_unique($value));
	}

	/**
	 * checks if an array input has only numeric values
	 */
	public function validate_arraynumeric($attribute, $value, $parameters){
		$numeric_values = array_filter($value, create_function('$item', 'return (is_numeric($item));'));
		return count($numeric_values) == count($value);
	}

	
}
?>