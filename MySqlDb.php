<?php

class MySqlDb {

    protected $_mysql;
    protected $_query;
    protected $_where = array();
    protected $_paramTypeList;

    /**
     * Initiates the DB object.
     * 
     * @param string $host The MySql DB host
     * @param string $username User name
     * @param string $password Password
     * @param string $db The mysql database name
     */
    public function __construct($host, $username, $password, $db) {
        $this->_mysql = new mysqli($host, $username, $password, $db)
                or die('Problem in connecting to the DB.');
    }

    /**
     * Executes a query.
     * 
     * @param string $query Contains a user-provided select query.
     */
    public function Query($query) {
        $this->_query = filter_var($query, FILTER_SANITIZE_STRING);

        $stmt = $this->_PrepareQuery();
        $stmt->execute();
        $results = $this->_DynamicBindResults($stmt);
        return $results;
    }

    function Get($tableName, $numRows = NULL) {
        
    }

    function Insert($tableName, $insertData) {
        
    }

    function Update($tableName, $updateData) {
        
    }

    function Delete($tableName) {
        
    }

    function Where($whereProp, $whereValue) {
        
    }

    protected function _PrepareQuery() {
        if (!$stmt = $this->_mysql->prepare($this->_query)) {
            trigger_error('Problem preparing query', E_USER_ERROR);
        }
        return $stmt;
    }

    /**
     * This helper method takes care of prepared statements' "bind_result"
     * method, when the number of variables to pass is unknown.
     * 
     * @param object $stmt Equal to the prepared statement object.
     * @return array The results of the SQL fetch.
     */
    protected function _DynamicBindResults($stmt) {
        $parameters = array();
        $results = array();
        $meta = $stmt->result_metadata();

        while ($field = $meta->fetch_field()) {
            $parameters[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $parameters);
        // array($stmt, 'bind_result') ==> $stmt.bind_result();

        while ($stmt->fetch()) {
            $x = array();

            foreach ($row as $key => $val) {
                $x[$key] = $val;
            }
            $results[] = $x;
        }
        return $results;
    }

    function __destruct() {
        $this->_mysql->close();
    }

}

?>
