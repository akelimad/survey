<?php
/**
 * Database
 *
 * @author mchanchaf
 *
 * @package app.database
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

use \PDO;

class Database { 
	
	/**
     * PDO object
     * @var PDO $pdo
     */
    public $pdo;


    /**
     * DB instance
     * @var instance $instance
     */
    private static $_instance = null;


	/**
     * Get Database instance
     * @return Database $instance
     */
	public static function getInstance()
	{		
		// Singleton pattern
        if (is_null(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance;
	}


    /**
     * Database Constructor
     *
     * @return object $pdo
     */
	private function __construct(){
		if( is_null($this->pdo) ){
			try {

				$pdo = new PDO('mysql:dbname='. DB_NAME .';host='. DB_SERVER , DB_USER, DB_PASS,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);

				$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

				$this->pdo = $pdo;
			} catch (PDOException $e) {
				echo 'Ã‰chec lors de la connexion : ' . $e->getMessage();
			}
		}
		return $this->pdo;
	}



	/**
     * Prepared query
     *
     * @param string $statement
     * @param array $attributes
     * @param boolean $one
     *
     * @return object $datas
     */
	public function prepare($statement, $attributes=array(), $one = false){
		try {
			
			$query = $this->pdo->prepare($statement);
			$result = $query->execute($attributes);

			if (strpos( $statement, "INSERT" ) === 0) {
				return $this->pdo->lastInsertId();
			} else if( 
				strpos( $statement, "UPDATE" ) === 0 ||
				strpos( $statement, "DELETE" ) === 0
			){
				return $result;
			}

			$query->setFetchMode(PDO::FETCH_OBJ);

			if( $one ){
				$datas = $query->fetch();
				return $datas;
			} else {
				$datas = $query->fetchAll();
				return $datas;
			}
			
			return false;

		} catch (Exception $e) {
			return false;
		}
	}


	/**
     * Insert a new colomn
     *
     * @param string $table
     * @param string $columns
     *
     * @return boolean
     */
	public function create($table, $columns=['*'], $autoConvertDates=true){
		$sql_parts = [];
		$attributes = [];
		foreach ($columns as $k => $v) {
			$sql_parts[] = "$k = ?";
			if( $autoConvertDates ) {
				if ( preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4} [0-9]{2}:[0-9]{2}$/", $v) ) {
					$v = french_to_english_datetime($v);
				} else if ( preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $v) ) {
					$v = french_to_english_date($v);
				}
			}
			$attributes[] = $v;
		}
		$sql_part = implode(',', $sql_parts);
		return self::$_instance->prepare("INSERT INTO {$table} SET $sql_part", $attributes, true);
	}


	/**
     * Select colomns
     *
     * @param string $table
     * @param string $columns
     * @param boolean $one 
     *
     * @return boolean
     */
	public function read($table, $args=[]){
		$args = $this->getArgs($args);
		$conditions_part = '';
		$attributes = [];
		if(!empty($args->conditions)) : foreach ($args->conditions as $k => $v) :
			if( $k === 0 ) {
				$conditions_part .= 'WHERE `'. $v['key'] .'`=? ';

			} else {
				$conditions_part .= $v['condition'] .' `'. $v['key'] .'`=?';
			}
			$attributes[] = $v['value'];
		endforeach; endif;

		$columns_part = implode(', ', $args->columns);
		return self::$_instance->prepare("SELECT {$columns_part} FROM {$table} {$conditions_part} {$args->orderby} {$args->limit}", $attributes, $args->one);
	}
	

	/**
     * Update colomn
     *
     * @param string $table
     * @param string $column
     * @param string $value
     * @param array  $columns
     *
     * @return boolean
     */
	public function update($table, $column, $value, $columns=['*'], $autoConvertDates=true){
		$sql_parts = $attributes = [];

		foreach ($columns as $k => $v) {
			$sql_parts[] = "$k = ? ";
			if( $autoConvertDates ) {
				if ( preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4} [0-9]{2}:[0-9]{2}$/", $v) ) {
					$v = french_to_english_datetime($v);
				} else if ( preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $v) ) {
					$v = french_to_english_date($v);
				}
			}
			$attributes[] = $v;
		}

		$attributes[] = $value;
		$sql_part = implode(',', $sql_parts);
 
		return self::$_instance->prepare("UPDATE {$table} SET $sql_part WHERE {$column} = ?", $attributes, true);
	}


	/**
     * Delete colomn
     *
     * @param string $table
     * @param string $column
     * @param string $value
     *
     * @return boolean
     */
	public function delete($table, $column, $value){
		return self::$_instance->prepare("DELETE FROM {$table} WHERE {$column} = ?", [$value], true);
	}


	/**
	 * Find one item
	 *
	 * @param string $table
	 * @param string $column
	 * @param string $value
	 * @param array  $args
	 *
	 * @return $datas array
	 */
	public function findOne($table, $column, $value) {
		$args['conditions'][] = ['key' => $column, 'value' => $value];
		$args['limit'] = 1;
		return $this->read($table, $args);
	}


	/**
     * Find elements by column
     *
     * @param string $table
     * @param string $column
     * @param string $value
     * @param array  $args
     *
     * @return $datas array
     */
	public function findByColumn($table, $column, $value, $args=[]){ 
		$args = $this->getArgs($args);
		$columns_part = implode(', ', $args->columns);
		return self::$_instance->prepare("SELECT {$columns_part} FROM {$table} WHERE {$column} = ? {$args->orderby} {$args->limit}", [$value], $args->one);
	}


	/**
   * Count table rows by condition
   *
   * @param string $table
   * @param string $column
   * @param string $value
   *
   * @return $datas array
   */
	public function count($table, $column, $value){ 
		$count = self::$_instance->prepare("SELECT COUNT(*) AS nbr FROM {$table} WHERE {$column} = ?", [$value], true);
		return intval($count->nbr);
	}


	/**
   * Tell if table contain at least one row by condition
   *
   * @param string $table
   * @param string $column
   * @param string $value
   *
   * @return $datas array
   */
	public function exists($table, $column, $value){ 
		$count = self::$_instance->prepare("SELECT COUNT(*) AS nbr FROM {$table} WHERE {$column} = ?", [$value], true);
		return ($count->nbr>0);
	}


	/**
     * Get args
     *
     * @param array $args
     *
     * @return array $new_args
     */
	public function getArgs($args) {
		$default = array(
			'columns' => ['*'],
			'conditions' => [],
			'orderby' => '',
			'order' => 'DESC',
			'limit' => 0,
			'one' => false
		);
		$new_args = array_merge($default, $args);

		// Set order statement
		if ( $new_args['orderby'] != '' ) $new_args['orderby'] = 'ORDER BY '. $new_args['orderby'] .' '. $new_args['order'];
		
		// Set one row
		if( $new_args['limit'] == 1 ) $new_args['one'] = true;

		// Set limit statement
		if( $new_args['limit'] > 0 ) {
			$new_args['limit'] = 'LIMIT '. $new_args['limit'];
		} else {
			$new_args['limit'] = '';
		}

		unset($new_args['order']);	

		return (object) $new_args;
	}	






//END CLASS
}