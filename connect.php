<?php

session_start();

class connect {

    public $hostname = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "sharefutureanalysis";
    public $conn;
    static $instance;
    public $insert_result;

    public function __construct() {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$this->conn) {
            return mysqli_connect_error();
        }
        return $this->conn;
    }

    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function createOrEditTable($companyNameNew, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve, $activeUser, $action) {
        if ($action == 'create') {
            $this->createTable($companyNameNew, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve, $activeUser);
        } else if ($action == 'edit') {
            $activeUser = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $activeUser));
            $tableNameNew = $companyNameNew . '_' . $activeUser;
            $tableNameOld = $_SESSION['companyName'] . '_' . $activeUser;
            $drop_query = "drop table $tableNameOld";
            $drop_result = mysqli_query($this->conn, $drop_query);
            $this->createTable($companyNameNew, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve, $activeUser);
        }
    }

    public function createTable($companyNameNew, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve, $activeUser) {
        $activeUser = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $activeUser));
        echo $tableName = $companyNameNew . '_' . $activeUser;
        
        $checkTableExist_query = "SHOW TABLES LIKE '$tableName'";
        $checkTableExist_result = mysqli_query($this->conn, $checkTableExist_query);
        if (mysqli_num_rows($checkTableExist_result) == 0) {
            $createTable_query = "create table $tableName (SrNo int(10) auto_increment primary key , initialPrice int(10), "
                    . "lotSize int(10), lotNo int(10), shares int(10), profitValues int(10), margin bigint(10), reserve bigint(10), profit bigint(10)) ";
            $createTable_result = mysqli_query($this->conn, $createTable_query);
            $this->insertRow($tableName, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve);
        } else {
            $error = "This table is already exist";
            return $error;
        }
    }

    public function insertRow($tableName, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve) {
        static $i = 1;
        $shares = $LOTSize * $LOTNo;
        $profitValues = 250000 / $shares;
        $profit = $margin + $reserve;
        $insertRow_query = "insert into $tableName(initialPrice, lotSize, lotNo,shares,profitValues,margin,reserve,profit)"
                . " values ($initialPrice, $LOTSize,$LOTNo,$shares, $profitValues, $margin,$reserve, $profit)";
        $insertRow_result = mysqli_query($this->conn, $insertRow_query);
        $LOTNo+= $incLOTNo;
        $margin +=$incMargin;
        $reserve += $incReserve;
        $i++;
        if ($i <= 30) {
            $this->insertRow($tableName, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve);
        }
        return $insertRow_result;
    }

    public function getTableDataInModal($tableName) {
        $selectRow1_query = "select initialPrice, lotSize, lotNo, margin, reserve from $tableName where SrNo=1";
        $selectRow1_result = mysqli_query($this->conn, $selectRow1_query);
        $selectRow2_query = "select initialPrice, lotSize, lotNo, margin, reserve from $tableName where SrNo=2";
        $selectRow2_result = mysqli_query($this->conn, $selectRow2_query);
        if ($selectRow1_result) {
            while ($row1 = mysqli_fetch_array($selectRow1_result)) {
                $this->data[0] = $row1['initialPrice'];
                $this->data[1] = $row1['lotSize'];
                $this->data[2] = $row1['lotNo'];
                $this->data[3] = $row1['margin'];
                $this->data[4] = $row1['reserve'];
            }
            $companyName = strtok($tableName, '_');
            $this->data[5] = $companyName;
            $_SESSION['companyName'] = $companyName;
        }
        if ($selectRow1_result && $selectRow2_result) {
            while ($row2 = mysqli_fetch_array($selectRow2_result)) {
                $this->data[6] = $row2['lotNo'] - $this->data[2];
                $this->data[7] = $row2['margin'] - $this->data[3];
                $this->data[8] = $row2['reserve'] - $this->data[4];
            }
        }
        return $this->data;
    }

    public function showTableList($activeUser) {
        $activeUser = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $activeUser));
        $selectTableList_query = "SELECT DISTINCT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='sharefutureanalysis' AND TABLE_NAME LIKE '%$activeUser'";
        $selectTableList_result = mysqli_query($this->conn, $selectTableList_query);
        $tableList = array();
        if ($selectTableList_result) {
            while ($row = mysqli_fetch_array($selectTableList_result)) {
                $tableList[] = $row['TABLE_NAME'];
            }
            array_push($tableList, $activeUser);
            return $tableList;
        }
    }

    public function getTableData($tableName) {
        $selectAllData_query = "select * from $tableName";
        $selectAllData_result = mysqli_query($this->conn, $selectAllData_query);
        return $selectAllData_result;
    }

    public function dropTable($tableName) {
        echo $dropTable_query = "drop table $tableName";
        $dropTable_result = mysqli_query($this->conn, $dropTable_query);
        return $dropTable_result;
    }

}

?>