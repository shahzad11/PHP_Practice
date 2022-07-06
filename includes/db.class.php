<?php

class dvdb {
	private $db_host ;
	private $db_user ;
	private $db_pass ;
	private $db_name ;

	public $connect;
	public $affected_rows;
	public $last_query;
	public $last_insert_id;
	public $num_rows;
	public $last_error;

	function __construct(){

		$this->db_host	=	DB_HOST_NAME;
		$this->db_user	=	DB_USER;
		$this->db_pass	=	DB_PASS;
		$this->db_name	=	DB_NAME;

		$this->database_connect();
	}

	function database_connect(){
		$this->connect = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
	}

	private function execute_query($query){
		$this->last_query		=	$query;
		$sql_query 				=	mysqli_query($this->connect, $query);
		$this->last_insert_id	=	mysqli_insert_id($this->connect);
		$this->last_error		=	mysqli_error($this->connect);
		return $sql_query;
	}

	function run_sql($query){
		$sql			=	$this->execute_query($query);
		$this->num_rows	=	mysqli_num_rows($sql);
		return $sql;
	}

	function	get_results($query){
		$res_query		=	$this->execute_query($query);
		$this->num_rows	=	mysqli_num_rows($res_query);

		while($result	=	mysqli_fetch_assoc($res_query)){
			$output[]		=	$result;
		}
		return $output;
	}

	function	get_row($query){
		$res_query		=	$this->execute_query($query);
		$result	=	mysqli_fetch_assoc($res_query);
		return $result;
	}


	function insert_row($table, $data=array(), $type="INSERT"){


		foreach ( $data as $value ) {

			if(!empty($value) or $value==0){
				$values[]  = "'$value'";
				//$values[]  = "'mysqli_real_escape_string($this->connect,$value)'";
			}else{
				$values[]  = NULL;
			}
		}

		$fields  = '`' . implode( '`, `', array_keys( $data ) ) . '`';
		$values = implode( ", ", $values );

		$sql = "$type INTO `$table` ($fields) VALUES ($values)";
		return $this->execute_query($sql);
	}


	function insert_row2($table, $data=array(), $type="INSERT"){


		foreach ( $data as $value ) {

			$escaped_value = $this->escape_string($value);
			if(!empty($value) or $value==0){
				$values[]  = "'$escaped_value'";
			}else{
				$values[]  = "null";
			}
		}

		$fields  = '`' . implode( '`, `', array_keys( $data ) ) . '`';
		$values = implode( ", ", $values );

		$sql = "$type INTO `$table` ($fields) VALUES ($values)";
		return $this->execute_query($sql);
	}

	function update_row($table, $data=array(), $where){

		/*
			use like this
			$db->update_row("products", array("title"=>"asdf", "desc"=>"234"), " where id='23'");
		*/

		foreach ( $data as $key=>$value ) {

			$values[]  = "`$key`='$value'";
		}

		$values = implode( ", ", $values );

		$sql = "UPDATE `$table` SET $values $where limit 1";
		//return $sql;
		return $this->execute_query($sql);
	}


	function delete_row($table, $column, $value){

		$sql	=	"DELETE from $table where $column='".$value."'";
		return $this->execute_query($sql);

	}

	// replace any non-ascii character with its hex code.
	function escape_string($value) {
		$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
		$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

		return str_replace($search, $replace, $value);

		//return $value;
	}

	function close_conn(){
		return mysqli_close($this->connect);
	}

 }

?>
