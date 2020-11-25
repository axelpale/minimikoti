<?php
// User

class User {

	// public:
	
	public function __construct($id, $name, $securitylevel, $enable) {
		$this->id_ = $id;
		$this->name_ = $name;
		$this->securitylevel_ = $securitylevel;
		$this->enable_ = $enable;
	}
	
	public function getId() {
		return $this->id_;
	}
	
	public function getName() {
		return $this->name_;
	}
	
	// Returns user security level
	public function getSecurityLevel() {
		return $this->securitylevel_;
	}
	
	public function isEnabled() {
		return $this->enable_;
	}

	// private:
	
	private $id_; // int
	private $name_; // string
	private $securitylevel_; // int
	private $enable_; // boolean

}
