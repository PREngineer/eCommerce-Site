<?php

class Database
{
  
  //------------------------- Attributes -------------------------
  
  private $type = null;
  private $name = null;
  private $user = null;
  private $pass = null;
  private $host = null;
  private $port = null;
  private $conn = null;
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    if( file_exists('settings.php') )
    {
      require_once 'settings.php';
      
      $this->type = $DBTYPE;
      $this->name = $DBNAME;
      $this->user = $DBUSER;
      $this->pass = $DBPASS;
      $this->host = $DBHOST;
      $this->port = $DBPORT;
    }
  }

  /**
   * connect - Establishes a connection to the database.
   *
   * @return PDO|String Connection|Error
   */
  private function connect()
  {
    // Set up only if not already connected
    if($this->conn === null)
    {
      $dsn = '';
      
      if($this->type == 'mysql')
      {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->name . ';charset=utf8';
      }
      elseif($this->type == 'sqlsrv')
      {
        $dsn = 'sqlsrv:Server=' . $this->host . ',' . $this->port . ';Database=testdb';
      }
      
      try
      {
        $this->conn = new PDO($dsn, $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
      }
      catch(PDOException $error)
      {
        return $error->getMessage();
      }
    }
    return True;
  }
  
  /**
   * queryDB - Executes a query against the database.
   *
   * @param  string $query
   *
   * @return array|string data|error
   */
  public function query_DB($query)
  {
    $stmt = null;

    try
    {
      $this->connect();
      
      $stmt = $this->conn->prepare($query);
      $data = $stmt->execute();
    }
    catch( PDOException $error )
    {
      return $error->getMessage();
    }

    // If running a SELECT statement
    if( strpos( $query, 'SELECT ' ) !== False )
    {
      // Return the associative arrays of data
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // If running a DELETE or UPDATE statement
    if( strpos( $query, 'DELETE ' ) !== False || strpos( $query, 'UPDATE ' ) !== False )
    {
      // Return the amount of rows affected
      $data = $stmt->rowCount();
    }

    $stmt = null;

    return $data;
  }

}

?>