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
    if( file_exists('/config/settings.php') )
    {
      require_once '/config/settings.php';
      
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
      
      // Establish a connection to the database specified in settings
      if($this->type == 'mysql')
      {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->name . ';charset=utf8';
      }
      elseif($this->type == 'sqlsrv')
      {
        $dsn = 'sqlsrv:Server=' . $this->host . ',' . $this->port . ';Database=' . $this->name;
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
      $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    // If running an UPDATE statement
    if( strpos( $query, 'UPDATE ' ) !== False )
    {
      // No need to return anything
      // $data already returns if the query was successful or not (true|false)
    }
    
    // If running a DELETE or UPDATE statement
    if( strpos( $query, 'DELETE ' ) !== False )
    {
      // Return the amount of rows affected
      $data = $stmt->rowCount();
    }

    $stmt = null;

    return $data;
  }

  /**
   * This function escapes special characters that are a problem due to SQL injection
   */
  public function sanitize( $string )
  {
    $string = str_replace("'", "&apos;", $string);
    $string = str_replace('"', '&quot;', $string);
    // $string = str_replace("(", '&#40;', $string);
    // $string = str_replace(")", '&#41;', $string);
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    $string = str_replace('&', '&amp;', $string);
    $string = str_replace("%", "&#37;", $string);
    $string = str_replace('\\', '\\\\', $string);
    $string = str_replace("\0", '', $string);
    $string = str_replace("\t", '&#09;', $string);
    $string = str_replace("\Z", '', $string);
    return $string;
  }

}

?>