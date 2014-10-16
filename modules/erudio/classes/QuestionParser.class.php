<?php

/*
 * Simple question parser
 * Replaces {nX} strings with random number within a range.
 * - Where X is the id.
 * Replaces {lX} string with a random uppercase letter.
 * - Where X is the id.
 * 
 * Special characters
 * - Where ~ is use decimal.
 */

class questionparser {

    // holds the value array.
    public $valueArray;
    // holds the letter array.
    public $letterArray;
    // holds the limit for the value array.
    public $valueLimit;
    // peoples names
    public $nameArray;
    public $selectedNames;
    // units
    public $unitArray;
    public $selectedUnits;
    
    function __construct() {
        $this->letterArray = range('A', 'Z');
        $this->valueArray = Array();
        $this->valueLimit = 50;
        $this->nameArray = array('Ben', 'David', 'Sue', 'John', 'Karl', 'Peter', 'Alice', 'Freddy', 'Pam', 'Boris', 'Jane', 'Julie', 'Simon', 'Dan', 'Val');
        $this->unitArray = array('cm', 'mm', '"');
        $this->selectedNames = array();
        $this->selectedUnits = Array();
    }
        
    public function ParseSolution($text)
    {
        $string = 1;
        while ($this->FindString($text, '{n') == true) {
            $text = str_replace('{n' . $string . '}', $this->valueArray['{n' . $string . '}'], $text);
            $string++;
        }
        $string = 1;
        while ($this->FindString($text, '{l') == true) {
            $text = str_replace('{l' . $string . '}', $this->letterArray['{l' . $string . '}'], $text);
            $string++;
        }
        return $text;
    }

    /*
     * Parse the given text for values and letters.
     * @param string text to parse.
     * @return string parsed string with replaced content.
     */

    public function Parse($text) {
        return $this->ParseLetters($this->ParseValues($this->ParseNames($this->ParseUnits($text))));
    }

    /*
     * Parse the given text.
     * @param string text to parse.
     * @return string parsed string with replaced content (Values only).
     */

    private function ParseValues($text) {
        $string = 1;
        while ($this->FindString($text, '{n') == true) {
            $number = rand(1, $this->valueLimit);
            if ($this->UseDecimal($text, '{n' . $string . '}') == true) {
                $text = str_replace('~{n' . $string . '}', '{n' . $string . '}', $text);
                $number = $number / 100 + rand(1, $this->valueLimit);
            }
            if (array_key_exists('{n' . $string . '}', $this->valueArray) == false)
            {
                $this->valueArray['{n' . $string . '}'] = $number;
            }
            $text = str_replace('{n' . $string . '}', $this->valueArray['{n' . $string . '}'], $text);
            $string++;
        }
        return $text;
    }

    /*
     * Parse the given text.
     * @param string text to parse.
     * @return string parsed string with replaced content (Letters only).
     */

    private function ParseLetters($text) {
        $string = 1;
        while ($this->FindString($text, '{l') == true) {
            $text = str_replace('{l' . $string . '}', $this->letterArray[rand(0, 25)], $text);
            $string++;
        }
        return $text;
    }

    private function ParseNames($text) {
        $string = 1;
        while ($this->FindString($text, '{p') == true) {
            if (array_key_exists('{p' . $string . '}', $this->selectedNames) == false)
            {
                $this->selectedNames['{p' . $string . '}'] = $this->nameArray[rand(0, count($this->nameArray) - 1)];
            }
            $text = str_replace('{p' . $string . '}', $this->selectedNames['{p' . $string . '}'], $text);
            $string++;
        }
        return $text;
    }
    
    private function ParseUnits($text) {
        $string = 1;
        while ($this->FindString($text, '{u') == true) {
            if (array_key_exists('{u' . $string . '}', $this->selectedUnits) == false)
            {
                $this->selectedUnits['{u' . $string . '}'] = $this->unitArray[rand(0, count($this->unitArray) - 1)];
            }
            $text = str_replace('{u' . $string . '}', $this->selectedUnits['{u' . $string . '}'], $text);
            $string++;
        }
        return $text;
    }
    
    /*
     * Check if the given text contains a string.
     * @param string text to check.
     * @param string text to test for.
     * @return bool if the string was found.
     */

    private function FindString($text, $string) {
        if (strpos($text, $string) !== false) {
            return true;
        }
        return false;
    }

    /*
     * Check if the given text should use a decimal number.
     * @param string text to check.
     * @param string text to test for.
     * @return bool if the string was found.
     */

    private function UseDecimal($text, $string) {
        if (strpos($text, '~' . $string) !== false) {
            return true;
        }
        return false;
    }

}