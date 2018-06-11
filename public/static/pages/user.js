

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
        '今天': [moment(), moment()],
        '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '最近7天': [moment().subtract(7, 'days'), moment()],
        '最近30天': [moment().subtract(30, 'days'), moment()],
        '今月': [moment().startOf('month'), moment().endOf('month')],
        '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
    user_table = $('#tbluser').dataTable({
        columnDefs: [
            {
                targets: [6,7],
                orderable: false
            },
            // {
            //     targets: 0,
            //     render: function (data, type, full, meta) {
            //         console.log(full);
            //         return '<a href="/admin/user/' + full.id + '"><img src="' + data + '" width="50" height="50" style="border-radius: 100%;" alt="user"></a>';
            //     }
            // },
            // {
            //     targets: 9,
            //     render: function (data, type, full, meta) {
            //         return '<div class="text-center"><button class="btn btn-info" type="button" onclick="open_detail_page('+data+')">查看</button>' +
            //             '<button class="btn btn-danger" type="button" onclick="delete_user('+data+', this)">删除</button></div>';
            //     }
            // }
        ],
        columns: [
            // { "data": "avatar" },
            // { "data": "name" },
            { "data": "phone" },
            { "data": "region" },
            { "data": "ip" },
            { "data": "ip_location" },
            { "data": "register_dt" },
            { "data": "login_dt" },
            { "data": "concern_city" },
            { "data": "concern_trend" },
            // { "data": "id" }
        ],
        aaSorting: [[4, 'desc']],
        bProcessing: true,
        bServerSide: true,
        bPaginate: true,
        sAjaxSource: '/admin/user/get?name=' + '&phone=' + $('#phone').val() + '&region=' + $('#region').val()+ '&from_register_dt=' + register_dt.startDate.format('YYYY-MM-DD') + '&to_register_dt='
        + register_dt.endDate.format('YYYY-MM-DD') + '&from_login_dt=' + login_dt.startDate.format('YYYY-MM-DD') + '&to_login_dt=' + login_dt.endDate.format('YYYY-MM-DD'),
        dom: 'rtip',
        displayLength: 25,
        language: {
            url: "../static/plugins/datatables-plugins/i18n/Chinese.lang"
        },
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

    register_dt = $('#register-dt').data('daterangepicker');
    login_dt = $('#login-dt').data('daterangepicker');

    register_dt.setStartDate('2017/01/01');
    login_dt.setStartDate('2017/01/01');

    // initTable();

});