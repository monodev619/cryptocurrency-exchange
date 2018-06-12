

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
var login_dt;

var user_table;
var currentTrObj;

var initTable = function () {
    user_table = $('#tbluser').DataTable({
        columnDefs: [
            // {
            //     targets: 9,
            //     render: function (data, type, full, meta) {
            //         return '<div class="text-center"><button class="btn btn-info" type="button" onclick="open_detail_page('+data+')">查看</button>' +
            //             '<button class="btn btn-danger" type="button" onclick="delete_user('+data+', this)">删除</button></div>';
            //     }
            // }
        ],
        columns: [
            { "data": "name" },
            { "data": "email" },
            { "data": "country" },
            { "data": "state" },
            { "data": "status" },
            { "data": "regdate" },
            { "data": "id" }
        ],
        aaSorting: [[5, 'desc']],
        bProcessing: true,
        bServerSide: true,
        bPaginate: true,
        sAjaxSource: '/admin/getusers/?name=' + $('#name').val() + '&email=' + $('#email').val() + '&country=' + $('#country').val() + '&state=' + $('#state').val() +
        '&from_register_dt=' + register_dt.startDate.format('YYYY-MM-DD') + '&to_register_dt=' + register_dt.endDate.format('YYYY-MM-DD'),
        dom: 'rtip',
        displayLength: 25,
        destroy: true,
    });
};

var open_detail_page = function (id) {
    window.location.href = "/admin/user/" + id;
};

var delete_user = function (id, obj) {
    //currentTrObj = jQuery(obj).closest("tr");

    swal({
            title: "你确定要删除选中的用户吗?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定",
            cancelButtonText: "取消",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $.post('/admin/user/delete', {id: id}, function (resp) {
                    if (resp.code == 0) {
                        initTable();
                        swal("成功!", "用户已被删除.", "success");
                    } else {
                        swal("失败!", resp.message, "error");
                    }
                })
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

    initTable();

});