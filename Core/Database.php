<?php
namespace Core;
use PDO;
class Database 
{
    public $connection;
    private $statement;
    private $driver = 'sqlite';
    public function __construct($config)
    {
        $dsn = ($this->driver === 'sqlite'?
         'sqlite:'.$config['sqlite']['dsn'] :
         'mysql:'.http_build_query($config['mysql'],'',';'));
        $this->connection = new PDO($dsn);
       
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function fetch()
    {
        return $this->statement->fetch();
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }

    
}