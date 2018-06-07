
/* +++++++++++++++++++++++ Currency ++++++++++++++++++++++++ */
var currency_table;
var selected_row;

var openCurrency = function(obj, bEdit, id) {
    $('#currency-error').html('');

    if (!bEdit) {
        $('#preview').attr('src', '');
        $('#logo').val('');
        $('#name').val('');
        $('#symbol').val('');
        $('#info').html('');
        $('#currency_id').val('');
        $('#currency-modal').modal();
    } else {
        showOverlay();
        selected_row = currency_table.row( $(obj).parents('tr') );
        console.log(currency_table.row(selected_row).data()[0]);

        $.get('/admin/currency/' + id, function (resp) {
            console.log(resp);
            if (resp.code == 0) {
                $('#preview').attr('src', resp.data.logo);
                $('#name').val(resp.data.name);
                $('#symbol').val(resp.data.symbol);
                $('#info').html(resp.data.info);
                $('#currency_id').val(resp.data.id);
            }
            hideOverlay();
            $('#currency-modal').modal();
        })
    }
};

var deleteCurrency = function (obj, id) {

    swal({
            title: "Delete currency?",
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
                    url: '/admin/currency/delete',
                    data: "id=" + id,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    type: 'POST',
                    success: function (resp) {
                        if (resp.code == '0') {
                            swal("Success!", "", "success");
                            currency_table
                                .row( $(obj).parents('tr') )
                                .remove()
                                .draw();
                            // $('#admin-' + id).remove();
                        } else {
                            swal("Error!", resp.message, "error");
                        }
                    }
                });
            }
        });
};

var selectImage = function(obj) {
    var fileList = obj.files;

    if (fileList.length > 0) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(fileList[0]);
    }
};

/* ---------------------------------------------------------------- */

/* ++++++++++++++++++++++++++++ Market ++++++++++++++++++++++++++++++ */

var openMarket = function(obj, bEdit, id) {
    if (!bEdit) {
        $('#market-modal').modal();
    } else {
        showOverlay();
        selected_row = currency_table.row( $(obj).parents('tr') );
        console.log(currency_table.row(selected_row).data()[0]);

        $.get('/admin/currency/' + id, function (resp) {
            console.log(resp);
            if (resp.code == 0) {
                $('#preview').attr('src', resp.data.logo);
                $('#name').val(resp.data.name);
                $('#symbol').val(resp.data.symbol);
                $('#info').html(resp.data.info);
                $('#currency_id').val(resp.data.id);
            }
            hideOverlay();
            $('#currency-modal').modal();
        })
    }
};
/* ---------------------------------------------------------------- */

$(function () {
    $('.selectpicker').selectpicker();
    $(".select2").select2({
        dropdownParent: $("#market-modal")
    });

    currency_table = $('#tblcurrency').DataTable();

    $('#currency-form').submit(function (e) {
        e.preventDefault();

        var form = new FormData($(this)[0]);
        if ($('#currency_id').val() == '') {
            $.ajax({
                url: '/admin/currency/add',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (resp) {
                    if (resp.code == '0') {
                        console.log(resp);
                        $('#currency-modal').modal('hide');
                        currency_table.row.add([
                            '<img src="' + resp.data.logo + '" width="50px" height="50px">',
                            resp.data.name,
                            resp.data.symbol,
                            '<div class="button-group"><button type="button" class="btn btn-info" onclick="openCurrency(this, true, ' + resp.data.id + ')"><i class="fa fa-edit"></i></button>\n' +
                            '<button type="button" class="btn btn-danger" onclick="deleteCurrency(this, ' + resp.data.id + ')"><i class="fa fa-remove"></i></button></div>'
                        ]).draw(false);
                    } else {
                        $('#currency-error').html(resp.message);
                    }
                }
            });
        } else {
            $.ajax({
                url: '/admin/currency/update',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (resp) {
                    if (resp.code == '0') {
                        $('#currency-modal').modal('hide');
                        var data = currency_table.row(selected_row).data();
                        data[0] = '<img src="' + resp.data.logo + '" width="50px" height="50px">';
                        data[1] = resp.data.name;
                        data[2] = resp.data.symbol;
                        currency_table.row(selected_row).data(data).draw();
                    }
                }
            });
        }

    })
});