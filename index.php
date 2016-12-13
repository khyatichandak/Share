<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Share Future Analysis</title>
        <script type="text/javascript" src="js/jquery-2.2.5.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/share.js"></script>
        <link rel="icon" type="image/png" href="img/graph.ico"/>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <h3><img src="img/graph.png">&nbsp;&nbsp;Share Future Analysis</h3>
                <div class="tabbable-panel" style="margin: 5px">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#tab_bbagola" data-toggle="tab" class="user">B. B. Agola</a>
                            </li>
                            <li>
                                <a href="#tab_asha" data-toggle="tab" class="user">Asha</a>
                            </li>
                            <li>
                                <a href="#tab_khyati" data-toggle="tab" class="user">Khyati</a>
                            </li> 
                            <li>
                                <a href="#tab_dhvani" data-toggle="tab" class="user">Dhvani</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_bbagola">
                                <div class="tabbable-line">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#dialog">Create Table</a>
                                                </li>
                                                <li role="presentation" class="dropdown">
                                                    <a class="dropdown-toggle showTableList" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                        Show Tables <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu bbagola"></ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9 showTable" style="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_asha">
                                <div class="tabbable-line">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#dialog">Create Table</a>
                                                </li>
                                                <li role="presentation" class="dropdown">
                                                    <a class="dropdown-toggle showTableList" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
                                                        Show Tables <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu asha"></ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9 showTable" style="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_khyati">
                                <div class="tabbable-line">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#dialog">Create Table</a>
                                                </li>
                                                <li role="presentation" class="dropdown">
                                                    <a class="dropdown-toggle showTableList" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
                                                        Show Tables <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu khyati"></ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9 showTable" style="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_dhvani">
                                <div class="tabbable-line">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#dialog">Create Table</a>
                                                </li>
                                                <li role="presentation" class="dropdown">
                                                    <a class="dropdown-toggle showTableList" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
                                                        Show Tables <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu dhvani"></ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9 showTable" style="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Create New Table</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Company Name:</label>
                                <input type="text" class="form-control" id="companyName" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">Initial Price:</label>
                                <input type="text" class="form-control" id="initialPrice">
                            </div>
                            <div class="form-group">
                                <label class="control-label">LOT Size:</label>
                                <input type="text" class="form-control" id="LOTSize" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">LOT No:</label>
                                <input type="text" class="form-control" id="LOTNo">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Increment in LOT No:</label>
                                <input type="text" class="form-control" id="incLOTNo">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Margin:</label>
                                <input type="text" class="form-control" id="margin" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">Increment in Margin:</label>
                                <input type="text" class="form-control" id="incMargin" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reserve:</label>
                                <input type="text" class="form-control" id="reserve">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Increment in Reserve:</label>
                                <input type="text" class="form-control" id="incReserve">
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="alert hidden alert-danger col-md-6" role="alert" id="alert_fail"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel" aria-hidden="true">Cancel</button>
                        <button type="button" class="btn btn-primary tableAction" id="createTable">Create Table</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="alertToDelete" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="deleteAlert">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Are you sure to delete this table ?</label>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="noToDelete" aria-hidden="true">No</button>
                        <button type="button" class="btn btn-primary" id="yesToDelete">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>