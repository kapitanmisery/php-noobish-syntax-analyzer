<?php


/**
 * Class ParseAnalyzer
 */
class ParseAnalyzer {

    protected static $_instance;

    /**
     * @return ParseAnalyzer
     */
    public static function createInstance() {

        if(!self::$_instance instanceof self) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    protected $rawCode = "";


    protected $rawCodeArr = array();

    protected $cleanCodeArr = array();

    protected $analyzedCodeArr = array();
    /**
     * @param $code
     * @return $this
     */
    public function setCode($code) {
        $this->rawCode = $code;
        return $this;
    }

    /**
     * @return $this
     */
    protected function parseCodeToArr() {

        $this->rawCodeArr =  preg_split('/(\r\n|\n|\r)/', htmlspecialchars($this->rawCode));
        return $this;
    }


    /**
     * @return $this
     */
    protected function createCleanCodeArr() {


        foreach($this->rawCodeArr as $rawCode) {
            $cleaned = trim($rawCode);
            if((!empty($cleaned) &&
                !is_null($cleaned))) {
                $this->cleanCodeArr[] = $cleaned;
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function analyzeCleanCodeItems() {
        unset($this->cleanCodeArr[0]);
        $this->analyzedCodeArr = array();

        foreach($this->cleanCodeArr as $lineNumber => $cleanCode) {
            $this->analyzedCodeArr[] = $this->analyzeLine($cleanCode);
        }

        return $this;
    }


    /**
     * @param string $cleanCode
     * @return array
     */
    protected function analyzeLine($cleanCode = "") {
        $lineAnalysis = array();
        $parts = preg_split('/\s+/', $cleanCode);

        foreach($parts as $part) {
            $lineAnalysis[] = $this->analyzeLineSegment($part);
        }

        return $lineAnalysis;
    }

    protected function analyzeLineSegment($part = "") {

        $str = "";

        if(strpos($part, "echo") !== false) {
            $str = "ECHO STMT";
        } else if($part == ";") {
            $str = "TERMINATOR";
        } else if(in_array($part, array("+", "/", "-", "*", "(", ")", "="))) {
            $str = "OPERATOR <" . $part . ">";
        } else if(is_numeric($part)) {
            $str = "NUMBER <" . $part . ">";
        } else {
            $str .= "STRING <" . $part . ">";
        }

        return $str;
    }

    /**
     * @return $this
     */
    protected function analyze() {
        $this->parseCodeToArr();
        $this->createCleanCodeArr();
        $this->analyzeCleanCodeItems();
        return $this;
    }


    /**
     * @return $this
     */
    protected function displayAnalysis() {

        echo "<p>Displaying Analysis</p>";


        echo "<pre>";
        print_r($this->analyzedCodeArr);
        echo "</pre>";
        return $this;
    }

    /**
     * @return $this
     */
    public function analyzeAndDisplay() {

        return $this->analyze()->displayAnalysis();
    }
}