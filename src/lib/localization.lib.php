<?php
// Localization
// Akseli Palén 2010

class Localization {
	
	// Language
	private $language_;
	private $datapack_;

	// Constructor
	public function __construct( $language, &$datapack ) {
		$this->language_ = $language;
		$this->datapack_ = &$datapack; // data is not copied
	}
	
	// Alias to getText
	public function get( $key ) {
	   return $this->getText( $key );
	}

	// Get localized text. If text is not found, returns original key.
	public function getText( $key ) {
		if( is_null( $this->datapack_[$key][$this->language_] ) ) {
			return $key;
		}
		return $this->datapack_[$key][$this->language_];
	}
	
	// Current language code
	public function getLanguage() {
		return $this->language_;
	}

}

?>
