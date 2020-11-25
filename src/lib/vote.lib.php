<?php
// Xitrux 2010
// class Vote

// Include settings
require_once( "config/vote.conf.php" );

class Vote {

// public:
	
	// Constructor
	// Parameters:
	//   id: id-number of target
	//   connection: MySQL-connection. If false, do not use database
	//   read: boolean, TRUE: load data with given id, FALSE: write-only
	public function __construct( $id, $connection, $read = true ) {
		
		$this->id_ = $id;
		$this->connection_ = $connection;
		
		// Load vote
		if (is_numeric( $this->id_ ) && $this->connection_ !== false ) {
	
			// Read rating
			$sql = "SELECT score, votes "
			. "FROM ".DB_TABLE_VOTE." "
			. "WHERE id = ".$this->id_;
			$result = mysql_query( $sql, $this->connection_ );
			
			// If rating data found
			if( $result !== false ) {
				$this->score_ = mysql_result( $result, 0, 0 );
				$this->votes_ = mysql_result( $result, 0, 1 );
			}
		}
	
	}
	
	public function getScores() {
		return $this->score_;
	}
	
	public function getAverage() {
		if( $this->votes_ == 0 ) {
			return VOTE_MAX_RATE;
		}
		$average = ( $this->score_ / $this->votes_ );
		return $this->narrow($average);
	}
	
	// Average gives scores different power. If average score is rounded, the
	// lowest and the highest numbers occur more rarely than others
	// For example:
	//   MIN_RATE = 1, MAX_RATE = 5
	//   round(avrg) = 5, if avrg is in [4.5;5.0], but
	//   round(avrg) = 4, if avrg is in [3.5;4.5[
	
	//   getEqualizedInt = 5, if avrg is in [4.2;5.0]
	//   getEqualizedInt = 4, if avrg is in [2.4;4.2[
	public function getEqualizedInt() {
	   $min = VOTE_MIN_RATE;
	   $max = VOTE_MAX_RATE;
	   $oldgap = $max-$min;
	   $newgap = $oldgap + 1;
	   $avrg = $this->getAverage();
	   $abs_avrg = $avrg - $min;
	   $abs_fix = $abs_avrg * $newgap / $oldgap;
	   $avrg_fix = $abs_fix + $min;
	   $return = 0;
	   
	   // If average == max
	   if($avrg_fix == $max + 1) {
	      $return = $max;
	   } else {
	      $return = (int)floor( $avrg_fix );
	   }
	   
	   // narrow value to [VOTE_MIN_RATE,VOTE_MAX_RATE]
	   return $this->narrow($return);
	}
	
	public function getVotes() {
		return $this->votes_;
	}
	
	public function vote( $points ) {
	
		// Load rating
		if (is_numeric( $points ) && $this->connection_ !== false ) {
	      // Fix points to [VOTE_MIN_RATE,VOTE_MAX_RATE]
	      $points = $this->narrow( $points );
	
			// Update new vote
			$sql = "UPDATE ".DB_TABLE_VOTE." "
			. "SET score=score+".$points.", votes=votes+1 "
			. "WHERE id = ".$this->id_;
			$result = mysql_query( $sql, $this->connection_ );
			
			// If vote was successful
			if( $result !== false ) {
				return true;
			}
		}
	
		return false;
	}

// private:

	private $id_;
	private $connection_;
	private $score_;
	private $votes_;
	
	private function narrow( $value ) {
	   // narrow value to [VOTE_MIN_RATE,VOTE_MAX_RATE]
	   $value = min( $value, VOTE_MAX_RATE);
	   $value = max( $value, VOTE_MIN_RATE);
	   return $value;
	}
	
// static

	// function: createBank
	// description: creates vote databank for given id
	// parameters:
	//   connection: MySQL-connection with INSERT privilege
	//   id: databank indentifier
	//   score: start score, default zero
	//   votes: start votes, default zero
	public static function createBank( $connection, $id, $score = 0, $votes = 0) {

		// Create base
		if( is_numeric($id) && $connection !== false 
		&& is_numeric($score) && is_numeric($votes) ) {
			$sql = "INSERT INTO ".DB_TABLE_VOTE."(id,score,votes) "
			. "VALUES (". $id .",". $score .",". $votes .");";
			$result = mysql_query( $sql, $connection );
		}
	
		return false;
	}

}


 





