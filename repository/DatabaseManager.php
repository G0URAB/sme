<?php

namespace Repository;

require $_SERVER['DOCUMENT_ROOT'] . "\interfaces\DatabaseManagerInterface.php";
use Meta\DatabaseManagerInterface;
use PDO;

class DatabaseManager implements DatabaseManagerInterface{

    private $connection;
    private $segment;
    private $table;
    private $lastInsertedId;

    public function __construct($segment)
    {
        $this->segment = $segment;
        $this->table = substr(strrchr(get_class($segment), "\\"), 1);
    }

    public function setConnection()
    {
        $this->connection = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/database/sme.db');
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function deleteConnection()
    {
        $this->connection=null;
    }

    public function findAll()
    {
        $stmt = $this->connection->prepare('SELECT * FROM '.$this->table);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
        return $result;
    }

    public function find($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM '.$this->table.' WHERE id = ? ');
        $stmt->execute([$id]);
        $this->segment = clone $stmt->fetch(PDO::FETCH_OBJ);
        $stmt = null;
        return $this->segment;
    }

    /**
     * @param array $options
     * @param $table
     * example of array: ['user'=>'alex','age'=>21]
     */
    public function findOneBy(array $options)
    {
        $keys ="";
        $values =[];
        $count=0;
        foreach($options as $key=>$value )
        {
            if($count>1)
              $keys.=' '."AND".' '.$key."= ?";
            else
                $keys .= $key ."= ?";

            array_push($values,$value);
            $count++;
        }

        $stmt = $this->connection->prepare('SELECT * FROM '.$this->table.' '.'WHERE'.' '.$keys);
        $stmt->execute($values);
        $this->segment = clone $stmt->fetch(PDO::FETCH_OBJ);
        $stmt = null;
        return $this->segment;
    }

    public function create()
    {
        list($keys,$values,$questionMarks)= $this->getCondition('create');
        $condition ="(".$keys.") VALUES (".$questionMarks.")";
        $sql = "INSERT INTO ". $this->table.$condition;
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($values);
        $this->lastInsertedId = $this->connection->lastInsertId();
    }

    private function getCondition($option)
    {
        $segmentArray=  $this->segment instanceof \stdClass ? (array) $this->segment: $this->segment->toArray();

        //Ignore the id
        array_shift($segmentArray);

        $keys="";
        $questionMarks= '';
        $values =[];
        $count=0;
        foreach($segmentArray as $key=>$value )
        {
            if ($count > 0)
            {
                if($option=="create")
                {
                    $keys .= "," . $key;
                    $questionMarks .= "," . '?';
                }
                else if($option=="update")
                {
                    $keys .= ",".$key. "=?";
                }
                else if($option=="findOneBy"){
                    $keys.=' '."AND".' '.$key."= ?";
                }

            }
            else
            {
                if($option=="create")
                {
                    $keys .= $key;
                    $questionMarks.='?';
                }
                else if($option=="update")
                {
                    $keys .= $key. "=?";
                }
                else if($option=="findOneBy"){
                    $keys .= $key ."= ?";
                }
            }
            if(is_array($value))
                array_push($values,serialize($value));
            else
                array_push($values,$value);
            $count++;
        }

        return [$keys,$values,$questionMarks];
    }

    public function update($id)
    {
        list($keys,$values,$questionMarks)= $this->getCondition('update');
        array_push($values,$id);
        $sql = "UPDATE ". $this->table ." SET ".$keys ." WHERE id=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($values);
    }
    public function update1($id)
   {
        list($keys,$values,$questionMarks)= $this->getCondition('update');
        array_push($values,$id);
        $sql = "UPDATE ". $this->table ." SET ".$keys ." WHERE id=?";
        $stmt= $this->connection->prepare($sql);
        var_dump($sql,$values);
        var_dump($stmt->execute($values));
        die();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ". $this->table ." WHERE id=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }


    public function getSegment()
    {
        return $this->segment;
    }

    public function setSegment($segment): void
    {
        $this->segment = $segment;
    }

    public function getTable()
    {
        return $this->table;
    }


    public function setTable($table): void
    {
        $this->table = $table;
    }

    public function getLastInsertedId()
    {
        return $this->lastInsertedId;
    }

    public function getChildrenOfParent($parentType, $parentId)
    {
        $stmt = $this->getConnection()->prepare('SELECT children FROM '.$parentType.' WHERE id = ? ');
        $stmt->execute([$parentId]);
        $result= $stmt->fetch(PDO::FETCH_OBJ);
        $stmt = null;

        return $result;
    }
}