<?php
// Minimikoti
// class Home

// Include home data
require_once( "config/homedata.conf.php" );
require_once( "lib/vote.lib.php" );

// Include language data
require_once( "lib/localization.lib.php" );

class Home {

// public:

	// Constructor
	// Parameters:
	//   id: id-number of home
	public function __construct( $id, &$language ) {

		$this->id_ = $id;

		$this->lang_ = &$language;

		// Load rating
		$this->rating_ = 5;
	}

	public function getId() {
		return $this->id_;
	}

	public function getTitle() {
		global $homedata;
		return $this->lang_->getText($homedata[ $this->id_ ]->title);
	}

	public function getDesigner() {
		global $homedata;
		return $homedata[ $this->id_ ]->designer;
	}

	public function getDesignerFaceSrc() {
		global $homedata;
		return $homedata[ $this->id_ ]->face;
	}

	public function isEmailEnabled() {
		global $homedata;
		return ($this->getEmail() != "");
	}

	public function getEmail() {
		global $homedata;
		return $this->lang_->getText($homedata[ $this->id_ ]->email);
	}

	public function getSlogan() {
		global $homedata;
		return $this->lang_->getText($homedata[ $this->id_ ]->slogan);
	}

	public function getIconSrc() {
		global $homedata;
		return $homedata[ $this->id_ ]->iconsrc;
	}

	public function getPictureTitle( $slide_number ) {
		global $picturedata;
		if( is_null ($picturedata[ $this->id_ ][ $slide_number - 1 ]->title) ) {
			return DEFAULT_SLIDE_PICTURE;
		}
		return $picturedata[ $this->id_ ][ $slide_number - 1 ]->title;
	}

	public function getPictureSrc( $slide_number, $fullsize = false ) {
		global $homedata;
		global $picturedata;
		$filename = "";
		if( $fullsize ) {
			$filename = $picturedata[ $this->id_ ][ $slide_number - 1 ]->original;
		} else {
			$filename = $picturedata[ $this->id_ ][ $slide_number - 1 ]->resized;
		}

		return $homedata[ $this->id_ ]->picturedir . $filename;
	}

	public function getPictureCaption( $slide_number ) {
		global $picturedata;
		return $this->lang_->getText($picturedata[ $this->id_ ][ $slide_number - 1 ]->text);
	}

	public function getPictureCount() {
		global $picturedata;
		return count( $picturedata[ $this->id_ ] );
	}

	// Returns star count
	public function getRating() {
	   return 5;
	}

	public function getFacebookUrl() {
		global $homedata;
		return $homedata[ $this->id_ ]->facebook;
	}

	public function getPdfSrc() {
		global $homedata;
		return $homedata[ $this->id_ ]->pdfsrc;
	}

	public function getPdfFilesizeMB( $precision = 2 ) {
		// filesize produces warning if no file found
		$bytes = @filesize( $this->getPdfSrc() );

		if( $bytes == false ) {
			return 0;
		}

		return round( $bytes / (1024*1024), $precision );
	}

// private:

	private $id_;
	private $rating_;
	private $lang_;

}
