<?php
require_once("utils.php");
require_once("ParseAnalyzer.php");

$code = $_REQUEST['code'];
echo "<p><a href='index.php'>Go back to form.</a> </p>";
echo "<p><strong>Here's the php code you're trying to to analyse the syntax:</strong></p>";
echo generate_displayable_php_code($code);
echo "<p><strong>Here's the parse analysis:</strong></p>";
echo "<p><strong>Syntax evaluation:</strong> " . display_php_code_status(is_valid_php_code($code)). "</p>";

if(!is_valid_php_code($code)) {
    exit;
}


$parser = ParseAnalyzer::createInstance()
    ->setCode($code)
    ->analyzeAndDisplay();
