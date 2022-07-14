<?php
/*
	Thaana_Transliterator by naxeem (http://naxeem.com)
	A Thaana PHP Transliterator

	Inspired by works of
	Kailash Nadh (github.com/knadh/ml2en) and Ayaz (github.com/ifreaker/Thaana-Transliterater)

	This work is licensed under GPL v2

	Usage: echo Thaana_Transliterator::transliterate("ސަލާމް");
*/

class Thaana_Transliterator {

	protected string $text;

	private array $all_akuru_fili = array(
		"ަ"		=> "a",		"ާ"		=> "aa",	"ި"		=> "i",
        "ީ"		=> "ee",	"ު"		=> "u",		"ޫ"		=> "oo",
        "ެ"		=> "e",		"ޭ"		=> "ey",	"ޮ"		=> "o",
        "ޯ"		=> "oa",	"ް"		=> "",		"ހ"		=> "h",
        "ށ"		=> "sh",	"ނ"		=> "n",		"ރ"		=> "r",
        "ބ"		=> "b",		"ޅ"		=> "lh",	"ކ"		=> "k",
        "އ"		=> "a",		"ވ"		=> "v",		"މ"		=> "m",
        "ފ"		=> "f",		"ދ"		=> "dh",	"ތ"		=> "th",
        "ލ"		=> "l",		"ގ"		=> "g",		"ޏ"		=> "y",
        "ސ"		=> "s",		"ޑ"		=> "d",		"ޒ"		=> "z",
        "ޓ"		=> "t",		"ޔ"		=> "y",		"ޕ"		=> "p",
        "ޖ"		=> "j",		"ޗ"		=> "ch",	"ޙ"		=> "h",
        "ޚ"		=> "kh",	"ޛ‎"		=> "z",		"ޜ‎"		=> "z",
        "ޝ‎"		=> "sh",	"ޝ"		=> "sh",	"ޤ"		=> "q",
        "ޢ"		=> "a",		"ޞ"		=> "s",		"ޟ"		=> "dh",
        "ޡ"		=> "z", 	"ޠ"		=> "t", 	"ާާޣ"		=> "gh",
        "ޘ"		=> "th", 	"ޛ"		=> "dh", 	"ާާޜ"		=> "z"
	);

	private array $fili_fix = array(
		"އަ"		=> "a",		"އާ"		=> "aa",	"އި"		=> "i",
        "އީ"		=> "ee",	"އު"		=> "u",		"އޫ"		=> "oo",
        "އެ"		=> "e",		"އޭ"		=> "ey",	"އޮ"		=> "o",
        "ޢަ"		=> "a",		"ޢާ"		=> "aa",	"ޢި"		=> "i",
        "ޢީ"		=> "ee",	"ޢު"		=> "u",		"ޢޫ"		=> "oo",
        "ޢެ"		=> "e",		"ޢޭ"		=> "ey",	"ޢޮ"		=> "o",
        "އޯ"		=> "oa",	"ުއް"		=> "uh",	"ިއް"		=> "ih",
		"ެއް"		=> "eh",	"ަށް"		=> "ah",	"ައް"		=> "ah",
		"ށް"		=> "h",		"ތް"		=> "i",		"ާއް"		=> "aah",
		"އް"		=> "ih",	"އް"		=> "h"
	);

	private array $punctuations = array(
		"]"		=> "[",		"["		=> "]",		"\\"	=> "\\",
        "\'"	=> "\'",	"،"		=> ",",		"."		=> ".",
        "/"		=> "/",		"÷"		=> "",		"}"		=> "{",
        "{"		=> "}",		"|"		=> "|",		":"		=> ":",
        "\""	=> "\"",	">"		=> "<",		"<"		=> ">",
        "؟"		=> "?",		")"		=> ")",		"("		=> "("
	);

	private array $dictionary;
	
	public function __construct()
	{
		$this->dictionary = $this->loadDictionary();
	}

	/**
   *
	 * @param string $input
   * @return void
   */
	public function transliterate(string $input) : string
	{
		
		$this->text = $input;
		
		$this->replaceZeroWidthNonJoiners();

		// fix words that normally dont translate well
		// like names and english words.
		$this->replaceFromText($this->dictionary);

		// fili_fix first before replacing akuru and fili
		$this->replaceFromText($this->fili_fix);

		// akuru and fili
		$this->replaceFromText($this->all_akuru_fili);

		// punctuations
		$this->replaceFromText($this->punctuations);

		// capitalize every letter AFTER a full-stop (period).
		$this->capitalizeFirstLetterOfNewSentence();

		return ucfirst($this->text);
	}

	/**
   *
	 * @param string $input
   * @return void
   */
	public function addTranslations(array $array) : void
	{
		$this->dictionary = array_merge($this->dictionary, $array);
	}

	/**
   *
   * @return void
   */
  protected function replaceZeroWidthNonJoiners() : void
  {
    preg_replace("/\xE2\x80\x8C/u", '', $this->text);
  }

  /**
   *
   * @return void
   */
  protected function capitalizeFirstLetterOfNewSentence() : void
  {
    // Shout out to @inerds for this
    $this->text = preg_replace_callback('/[.!?].*?\w/', function ($matches) {
      return  strtoupper($matches[0]);
    }, ucfirst(strtolower($this->text)));
  }

  /**
   * replaces passed array items from text
   * 
   * @param array $collection
   * @return void
   */
  protected function replaceFromText(array $collection) : void
  {
    foreach ($collection as $k => $v) {
      $this->text = preg_replace("/\\" . $k . "/u", $v, $this->text);
    }
  }

  /**
   *
   * @return array
   */
  protected function loadDictionary() : array
  {
			$fullpath = __DIR__ . '/dictionary/translations.json';
			if(!file_exists($fullpath)) {
				throw new Exception('dictionary/translations.json not found!');
			}

			return json_decode(
				file_get_contents($fullpath),
				true
			);
  }

}
