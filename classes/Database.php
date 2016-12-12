<?php
class Database {

    /**
     * Properties
     */
	private $options;
	private $db = null;
	private $stm = null;

	/**
     * Constructor creating a PDO object connecting to a choosen database.
     *
     * @param array $options containing details for connecting to the database.
     */
	 public function __construct($options = [])
	{
		$default = array(
		'dsn' => null,
		'username' => null,
		'password' => null,
		'driver_options' => null,
		'fetch_style' => PDO::FETCH_OBJ,);
		$this->options = array_merge($default, $options);

		try {
			$this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password']);
			$this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']);
            $this->db->SetAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

	}
	catch(\Exception $e)
	{
		print $e->getMessage();
	}
	
	}

	 /**
     * Execute a query with arguments and return the resultset.
     * Fetch all resultset from select statement.
     * 
     * @param string  $query      the SQL query with ?.
     * @param array   $params     array which contains the argument to replace ?.
     *
     * @return array with resultset.
     */
	public function query($query, $params=array())
	{
		$this->stmt = $this->db->prepare($query);
		$this->stmt->execute($params);
		return $this->stmt->fetchAll();
	}

	/**
     * Execute a query with arguments and return the resultset.
     * Fetch one resultset from select statement.
     * 
     * @param string  $query      the SQL query with ?.
     * @param array   $params     array which contains the argument to replace ?.
     * 
     * @return array with resultset.
     */
	public function fetch($query, $params=array())
	{
		$this->stmt = $this->db->prepare($query);
		$this->stmt->execute($params);
		return $this->stmt->fetch();
	}

    public function insert($query, $params=array())
    {
        $this->stmt = $this->db->prepare($query);
        $this->stmt->execute($params);
    }

	public function update($query, $params=array())
	{
		$this->stmt = $this->db->prepare($query);
		$this->stmt->execute($params);
	}

    public function rowCount($query,$params=array()) {
        $this->stmt = $this->db->prepare($query);
        $this->stmt->execute($params);
        return $this->stmt->rowCount();
    }

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

} // END class 