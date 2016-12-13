<?php

if (isset($_POST['action']) || !empty($_POST['action'])) {
    include 'connect.php';
    $action = $_POST['action'];
    switch ($action) {
        case 'create':
            createOrEditTable();
            break;
        case 'edit':
            createOrEditTable();
            break;
        case 'getTableDataInModal':
            getTableDataInModal();
            break;
        case 'tableList':
            tableList();
            break;
        case 'tableData':
            tableData();
            break;
        case 'dropTable':
            dropTable();
            break;
    }
}

function createOrEditTable() {
    $dbInstance = connect::get_instance();
    $companyNameNew = $_POST['companyNameNew'];
    $initialPrice = $_POST['initialPrice'];
    $LOTSize = $_POST['LOTSize'];
    $LOTNo = $_POST['LOTNo'];
    $incLOTNo = $_POST['incLOTNo'];
    $margin = $_POST['margin'];
    $incMargin = $_POST['incMargin'];
    $reserve = $_POST['reserve'];
    $incReserve = $_POST['incReserve'];
    $activeUser = $_POST['activeUser'];
    $action = $_POST['action'];
    $data = $dbInstance->createOrEditTable($companyNameNew, $initialPrice, $LOTSize, $LOTNo, $incLOTNo, $margin, $incMargin, $reserve, $incReserve, $activeUser, $action);
}

function getTableDataInModal() {
    $dbInstance = connect::get_instance();
    $tableName = $_POST['tableName'];
    $data = $dbInstance->getTableDataInModal($tableName);
    echo json_encode($data);
}

function tableList() {
    $dbInstance = connect::get_instance();
    $activeUser = $_POST['activeUser'];
    $data = array();
    $data = $dbInstance->showTableList($activeUser);
    echo json_encode($data);
}

function tableData() {
    $dbInstance = connect::get_instance();
    $tableName = $_POST['tableName'];
    $data = $dbInstance->getTableData($tableName);
    echo '<table class="table table-hover">'
    . '<caption id="activeTableId"><b style="color:#17b329">' . $tableName . '</b></caption>'
    . '<tr><th width="6%">Sr No</th>'
    . '<th width="10%">Initial Price</th>'
    . '<th width="7%">Lot Size</th>'
    . '<th width="8%">Lot No</th>'
    . '<th width="10%">Shares</th>'
    . '<th width="11%">Profit Values</th>'
    . '<th width="12%">Margin</th>'
    . '<th width="12%">Reserve</th>'
    . '<th width="10%">Profit</th>'
    . '<th width="6%"><a class="glyphicon glyphicon-pencil" data-id="' . $tableName . '" id="btn_edit"></a>&nbsp;&nbsp;'
    . '<a class="glyphicon glyphicon-trash" data-id="' . $tableName . '" id="btn_delete"></a></th></tr>';

    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_object($data)) {
            echo '<tr><td data-toggle="tooltip" data-placement="bottom" title="' . $row->SrNo . '">' . $row->SrNo . '</td>'
            . '<td>' . $row->initialPrice . '</td>'
            . '<td>' . $row->lotSize . '</td>'
            . '<td>' . $row->lotNo . '</td>'
            . '<td>' . $row->shares . '</td>'
            . '<td>' . $row->profitValues . '</td>'
            . '<td>' . $row->margin . '</td>'
            . '<td>' . $row->reserve . '</td>'
            . '<td>' . $row->profit . '</td>'
            . '</tr>';
        }
    } else {
        echo '<tr><td colspan=4>Data not found</td></tr>';
    }
    echo '</table>';
}

function dropTable(){
    $dbInstance = connect::get_instance();
    $tableName = $_POST['tableName'];
    $data = $dbInstance->dropTable($tableName);
}
?>