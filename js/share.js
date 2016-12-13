$(document).ready(function () {
    $(document).on('click', '.user', function () {
        $('.showTable').html("");
    });

    $(document).on('click', '.showTableList', function () {
        $('.dropdown-menu').html("");
        fetch_tableList(getActiveUser());
    });

    $(document).on('click', '#createTable', function () {
        createOrEdit('createTable', getActiveUser());
    });

    $(document).on('click', '#btn_edit', function () {
        setIdValueOfButton('editTable');
        $('#dialog').modal("show");
        getTableDataInModal($(this).data("id"));
    });

    $(document).on('click', '#editTable', function () {
        initEditModal();
    });
    $(document).on('click', '#btn_delete', function () {
        $('#alertToDelete').modal("show");
    });
    $(document).on('click', '#yesToDelete', function () {
        dropTable($("#btn_delete").data("id"));
    });
});

var dropTable = function (tableName) {
    $.ajax({
        url: "operation.php",
        method: "POST",
        data: {tableName: tableName, action: 'dropTable'},
        success: function () {
            $('#alertToDelete').modal('hide');
            $('.showTable').html("<div class='row'>\n\
                                    <div class='col-md-12'>\n\
                                        <div class='alert alert-success' role='alert' id='alertDeleteSuccess'>Your Table is deleted successfully.\n\
                                        </div>\n\
                                    </div>\n\
                                  </div>");
            $("#alertDeleteSuccess").fadeIn().delay(2000).fadeOut();
        }
    });
};
var initEditModal = function () {
    createOrEdit('editTable', getActiveUser());
    setIdValueOfButton('createTable');
    setNullValue("companyName");
    setNullValue("initialPrice");
    setNullValue("LOTSize");
    setNullValue("LOTNo");
    setNullValue("incLOTNo");
    setNullValue("margin");
    setNullValue("incMargin");
    setNullValue("reserve");
    setNullValue("incReserve");
};

var fetch_tableList = function (activeUser) {
    $.ajax({
        url: "operation.php",
        method: "POST",
        data: {activeUser: activeUser, action: 'tableList'},
        dataType: "JSON",
        success: function (data) {
            $.each(data, function (index) {
                if (index < (data.length - 1)) {
                    $("." + data[data.length - 1]).append("<li><a class= 'myclass' href='#" + data[index] + "' data-toggle='pill' id='" + index + "' onclick='showTableData(" + index + ")'>" + data[index] + "</a></li>");
                }
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("error");
        }
    });
};

var showTableData = function (id) {
    fetchTableData(getValueFromId(id));
};

var fetchTableData = function (tableName) {
    $.ajax({
        url: "operation.php",
        method: "POST",
        data: {tableName: tableName, action: 'tableData'},
        success: function (data) {
            $('.showTable').html(data);
        }
    });
};

var getValueFromId = function (id) {
    return $("#" + id).html();
};

var setNullValue = function (id) {
    $("#" + id).val("");
};

var createOrEdit = function (id, activeUser) {
    var action = "";
    if (id === "createTable") {
        action = 'create';
    } else if (id === 'editTable') {
        action = 'edit';
    }
    var companyNameNew = $("#companyName").val();
    var initialPrice = $("#initialPrice").val();
    var LOTSize = $("#LOTSize").val();
    var LOTNo = $("#LOTNo").val();
    var incLOTNo = $("#incLOTNo").val();
    var margin = $("#margin").val();
    var incMargin = $("#incMargin").val();
    var reserve = $("#reserve").val();
    var incReserve = $("#incReserve").val();
    if (!$.trim(companyNameNew) || !$.trim(initialPrice) || !$.trim(LOTSize) || !$.trim(LOTNo) ||
            !$.trim(incLOTNo) || !$.trim(margin) || !$.trim(incMargin) || !$.trim(reserve) || !$.trim(incReserve)) {
        $("#alert_fail").removeClass('hidden');
        $("#alert_fail").html("Enter all details please");
        $("#alert_fail").fadeIn().delay(2000).fadeOut();
        return false;
    }
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        async: false,
        data: {companyNameNew: companyNameNew, initialPrice: initialPrice, LOTSize: LOTSize, LOTNo: LOTNo,
            incLOTNo: incLOTNo, margin: margin, incMargin: incMargin, reserve: reserve,
            incReserve: incReserve, activeUser: activeUser, action: action},
        success: function (data) {
            $('#dialog').modal('hide');
            fetchTableData(data);
        }
    });
};

var setIdValueOfButton = function (id) {
    if (id === "createTable") {
        $(".tableAction").attr('id', 'createTable');
        $("#createTable").html("Create Table");
    }
    else if (id === "editTable") {
        $(".tableAction").attr('id', 'editTable');
        $("#editTable").html("Edit Table");
    }
};

var getTableDataInModal = function (tableName) {
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        dataType: "JSON",
        data: {tableName: tableName, action: 'getTableDataInModal'},
        success: function (data) {
            $('#companyName').val(data[5]);
            $('#initialPrice').val(data[0]);
            $('#LOTSize').val(data[1]);
            $('#LOTNo').val(data[2]);
            $('#incLOTNo').val(data[6]);
            $('#margin').val(data[3]);
            $('#incMargin').val(data[7]);
            $('#reserve').val(data[4]);
            $('#incReserve').val(data[8]);
            $('#modalLabel').html('Edit Table&nbsp;&nbsp;<b>' + tableName + '</b>');
        }
    });
};

var getActiveUser = function () {
    return $('.active a').html();
};

function ajaxindicatorstart(text) {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="img/loading.gif"><div>' + text + '</div></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '1000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': 'transparent',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '999',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

jQuery(document).ajaxStart(function () {
    ajaxindicatorstart('loading data.. please wait..');
}).ajaxStop(function () {
    ajaxindicatorstop();
});

