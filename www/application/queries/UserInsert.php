<?php
namespace Giftr\Queries;
use \AMQuery;

class UserInsert extends AMQuery
{
	protected function initialize()
	{
		$timestamp = GMRApplication::timestamp_now();
		
		$username  = $this->dbh->real_escape_string($this->options['username']);
		$email     = $this->dbh->real_escape_string($this->options['email']);
		$password  = $this->dbh->real_escape_string($this->options['password']);
		$token     = $this->dbh->real_escape_string($this->options['token']);
		//$active    = (int) $this->dbh->real_escape_string($this->options['active']);
		
		//INSERT INTO user (username, email, password, token, created_on) VALUES ('$username', '$email', '$firstname', '$lastname', '$password', '$token', '$timestamp');
		$this->sql = <<<SQL
		INSERT INTO user (username, email, password, token, created_on) VALUES ('$username', '$email', '$password', '$token', '$timestamp');
SQL;
	}
}

?>