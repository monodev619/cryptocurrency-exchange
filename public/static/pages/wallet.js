

// Daterange picker

var start = moment().subtract(30, 'days');
var end = moment();


$('.input-daterange-datepicker').daterangepicker({
    buttonClasses: ['btn', 'btn-sm'],
    autoUpdateInput: false,
    applyClass: 'btn-danger',
    cancelClass: 'btn-inverse',
    locale: {
        format: 'YYYY/MM/DD',
        cancelLabel: 'Clear'
    },
    // startDate: start,
    // endDate: end,
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Recent 7 Days': [moment().subtract(7, 'days'), moment()],
        'Recent 30 Days': [moment().subtract(30, 'days'), moment()],
        'Previous': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Next': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
    }
});

$('.input-daterange-datepicker').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
});

$('.input-daterange-datepicker').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});

var register_dt;

var deposit_table;
var Withdraw_table;
var currentTrObj;

var initDepositTable = function () {
    deposit_table = $('#tbldeposit').DataTable({
        columnDefs: [
            {
                targets: 6,
                render: function (data, type, full, meta) {

                    if (full['status'] == 'unchecked') {
                        return '<span class="label label-danger">' + data + '</span>';
                    } else if (full['status'] == 'checked') {
                        return '<span class="label label-info">' + data + '</span>';
                    }
                }
            },
            {
                targets: 8,
                render: function (data, type, full, meta) {

                    if (full['status'] == 'unchecked') {
                        return '<div class="button-group">\n' + '<button type="button" class="btn btn-info" onclick="checkDeposit(this, ' + data + ')">' +
                            '<i class="fa fa-check"></i></button>\n' +    '</div>';
                    } else {
                        return null;
                    }
                }
            }
        ],
        columns: [
            { "data": "name" },
            { "data": "currency" },
            { "data": "address" },
            { "data": "amount" },
            { "data": "is_confirmed" },
            { "data": "txid" },
            { "data": "status" },
            { "data": "regdate" },
            { "data": "id" }
        ],
        aaSorting: [[3, 'desc']],
        bProcessing: true,
        bServerSide: true,
        bPaginate: true,
        sAjaxSource: '/admin/wallet/getDeposits/?name=' + $('#name').val() + '&currency=' + $('#currency').val() + '&address=' + $('#address').val() +
        '&from_register_dt=' + register_dt.startDate.format('YYYY-MM-DD') + '&to_register_dt=' + register_dt.endDate.format('YYYY-MM-DD'),
        dom: 'rtip',
        displayLength: 25,
        destroy: true,
    });
};
var initWithdrawTable = function () {
    Withdraw_table = $('#tblwithdraw').DataTable({
        columnDefs: [

            {
                targets: 7,
                render: function (data, type, full, meta) {

                    if (full['status'] == 'pending') {
                        return '<span class="label label-danger">' + data + '</span>';
                    } else if (full['status'] == 'complete') {
                        return '<span class="label label-info">' + data + '</span>';
                    }
                }
            },
            {
                targets: 9,
                render: function (data, type, full, meta) {

                    if (full['status'] == 'pending') {
                        return '<div class="button-group">\n' + '<button type="button" class="btn btn-info" onclick="checkWithdraw(this, ' + data + ')">' +
                            '<i class="fa fa-check"></i></button>\n' +    '</div>';
                    } else {
                        return null;
                    }
                }
            }
        ],
        columns: [
            { "data": "name" },
            { "data": "currency" },
            { "data": "address" },
            { "data": "quantity" },
            { "data": "fee" },
            { "data": "total" },
            { "data": "txid" },
            { "data": "status" },
            { "data": "regdate" },
            { "data": "id" }
        ],
        lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        buttons: [
            'pageLength'
        ],
        aaSorting: [[5, 'desc']],
        bProcessing: true,
        bServerSide: true,
        bPaginate: true,
        sAjaxSource: '/admin/wallet/getwithdraws/?name=' + $('#name').val() + '&currency=' + $('#currency').val() + '&address=' + $('#address').val() + '&state=' + $('#state').val() +
        '&from_register_dt=' + register_dt.startDate.format('YYYY-MM-DD') + '&to_register_dt=' + register_dt.endDate.format('YYYY-MM-DD'),
        // dom: 'rtip',
        displayLength: 25,
        destroy: true,
    });
};

var open_detail_page = function (id) {
    window.location.href = "/admin/user/" + id;
};

var checkDeposit = function (obj, id) {
    swal({
            title: "Checked Deposit?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url: '/admin/wallet/checkDeposit',
                    data: "id=" + id,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    type: 'POST',
                    type: 'POST',
                    success: function (resp) {
                        if (resp.code == '0') {
                            swal("Success!", "", "success");
                            deposit_table.ajax.reload();

                        } else {
                            swal("Error!", resp.message, "error");
                        }
                    }
                });
            }
        });
};
var checkWithdraw = function (obj, id) {
    swal({
            title: "Completed Withdrawal?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url: '/admin/wallet/completeWithdrawal',
                    data: "id=" + id,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    type: 'POST',
                    type: 'POST',
                    success: function (resp) {
                        if (resp.code == '0') {
                            swal("Success!", "", "success");
                            Withdraw_table.ajax.reload();

                        } else {
                            swal("Error!", resp.message, "error");
                        }
                    }
                });
            }
        });
};

var exportUsers = function () {
    $('#export-excel').attr('href', '/admin/users/export?name=' + '&phone=' + $('#phone').val() + '&region=' + $('#region').val()+ '&from_register_dt='
        + register_dt.startDate.format('YYYY-MM-DD') + '&to_register_dt='+ register_dt.endDate.format('YYYY-MM-DD') + '&from_login_dt='
        + login_dt.startDate.format('YYYY-MM-DD') + '&to_login_dt=' + login_dt.endDate.format('YYYY-MM-DD'));

    // $.get('/admin/users/export?name=' + '&phone=' + $('#phone').val() + '&region=' + $('#region').val()+ '&from_register_dt='
    //     + register_dt.startDate.format('YYYY-MM-DD') + '&to_register_dt='+ register_dt.endDate.format('YYYY-MM-DD') + '&from_login_dt='
    //     + login_dt.startDate.format('YYYY-MM-DD') + '&to_login_dt=' + login_dt.endDate.format('YYYY-MM-DD'), function (resp) {
    //
    //     console.log(resp);
    // });
};

$(function () {

    $(".select2").select2();

    register_dt = $('#register-dt').data('daterangepicker');
    login_dt = $('#login-dt').data('daterangepicker');

    register_dt.setStartDate('2018/01/01');

    initDepositTable();
    initWithdrawTable();

});