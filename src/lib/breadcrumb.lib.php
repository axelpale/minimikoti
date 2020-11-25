<?php
// Breadcrumb
// Akseli Palén 2010

// Example:
//	$BREADCRUMB = array(
//		"maintitle" => "mainpage.php",
//		"subtitle" => "subpage.php"
//	);
//
//	require_once( "breadcrumb.php" );
//
//	$bread = new Breadcrumb( " > ", $BREADCRUMB );
//
//  echo $bread->getBreadcrumb( true );
//
// Prints two links:
//	maintitle > subtitle

class Breadcrumb {
	
	// Separator symbol
	private $separator_;
	
	// Breadcrumb data
	private $datapack_;

	// Constructor
	public function __construct( $separator, &$datapack ) {
		$this->separator_ = $separator;
		$this->datapack_ = &$datapack; // data is not copied
	}

	// Produce breadcrumb
	// Precondition:
	//   $links is a boolean
	//   $separator_ is a string
	//   $datapack_ contains valid data
	// Postcondition:
	//   object variables are not altered
	//   returns breadcrumb as string
	// Parameters:
	//   $create_links, boolean. True creates a-tags, False creates plain text
	// Returns:
	//   breadcrumb as string. Ex. "maintitle > subtitle"
	public function getBreadcrumb( $create_links ) {
		
		$output = ""; // string to return
		$first = true; // boolean, true means first element
		
		foreach ( $this->datapack_ as $key => $value ) {
		
			if( !$first ) {
				$output .= $this->separator_;
			} else {
				$first = false;
			}
			
			if( $create_links ) {
				$output .= "<a href=\"" . $value . "\">"
				         . $key . "</a>";
			} else {
				$output .= $key;
			}
		}
		
		return $output;
	}

}

?>
