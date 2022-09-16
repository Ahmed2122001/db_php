<?php

namespace abosaber\DbWrapper;

class dbwrapper
{
    public $conn;
    public $query;
    public $sql;
    // private $pass;

    // public function setPass($input)
    // {
    //     $this->pass = md5($input);
    // }
    // public function getPass()
    // {
    //     return $this->pass;
    // }
    public function __construct($server, $username, $password, $database, $port = 3306)
    {
        $this->conn = mysqli_connect($server, $username, $password, $database, $port);
    }
    // {
    //     $this->conn = mysqli_connect("localhost", "root", "", "slms"); 
    // }
    public function select($table, $column)
    {
        $this->sql = "SELECT $column FROM $table";
        // $this->query=mysqli_query($this->conn, "select * from `$table`" );
        return $this;
    }
    public function where($column, $comper, $vlue)
    {
        $this->sql  .= " where `$column` $comper '$vlue'";

        return $this;
    }
    public function andWhere($column, $comper, $vlue)
    {
        $this->sql  .= " and `$column` $comper '$vlue'";

        return $this;
    }
    public function orWhere($column, $comper, $vlue)
    {
        $this->sql  .= " or `$column` $comper '$vlue'";

        return $this;
    }
    public function Get_All_Rows()
    {
        $this->query();
        while ($row = mysqli_fetch_assoc($this->query)) {
            $data[] = $row;
        }

        return $data;
    }
    public function Get_Row()
    {
        $this->query();
        $row = mysqli_fetch_assoc($this->query);
        return $row;
    }
    public function insert($table, $data)
    {
        $row = $this->bulidSql($data);
        $this->sql = "insert into `$table` set $row";
        return $this;
    }
    public function update($table, $data)
    {
        // $row = "";

        // foreach ($data as $key => $value) {
        //     $row .= " `$key` =" . $this->perparData($value) . ",";
        // }
        $row = $this->bulidSql($data);
        $this->sql = "update `$table` set $row";
        return $this;
    }
    // public function insert_OR_Update($table, $data, $option)
    // {

    //     $row = $this->bulidSql($data);
    //     $this->sql = "$option `$table` set $row";
    //     return $this;
    // }
    public function showError()
    {
        // echo mysqli_errno($this->conn);
        $errors = mysqli_error_list($this->conn);
        foreach ($errors as $error) {
            echo "<h2>Error</h2>" . $error['error'] . "<br> <h3>Error code: </h3>" . $error['errno'];
        }
    }



    public function delete($table)
    {
        $this->sql = "delete from `$table`";
        return $this;
    }


    public function excute()
    {
        $this->query();
        if (mysqli_affected_rows($this->conn) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function query()
    {
        $this->query = mysqli_query($this->conn, $this->sql);
    }
    public function perparData($data)
    {
        if (gettype($data) == "string") {
            return "'$data'";
        } else {
            return $data;
        }
    }
    public function bulidSql($data)
    {
        $row = "";

        foreach ($data as $key => $value) {
            $row .= " `$key` =" . $this->perparData($value) . ",";
        }
        $row = rtrim($row, ",");
        return $row;
    }


    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
