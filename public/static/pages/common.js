
function showOverlay() {
    $.LoadingOverlay("show", {
        image: "",
        fontawesome: "fa fa-spinner fa-spin",
        fontawesomeColor: "#3acef9",
        size: 5
    });
};

function hideOverlay() {
    $.LoadingOverlay("hide");
};

// var FormValidation = function() {
//     // Init Material Forms Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
//     var resetFormValidation = function(){
//         jQuery('#reset_form').validate({
//             ignore: [],
//             errorClass: 'help-block text-right animated fadeInDown',
//             errorElement: 'div',
//             errorPlacement: function(error, e) {
//                 jQuery(e).parents('.form-group > div').append(error);
//             },
//             highlight: function(e) {
//                 var elem = jQuery(e);
//
//                 elem.closest('.form-group').removeClass('has-error').addClass('has-error');
//                 elem.closest('.help-block').remove();
//             },
//             success: function(e) {
//                 var elem = jQuery(e);
//
//                 elem.closest('.form-group').removeClass('has-error');
//                 elem.closest('.help-block').remove();
//             },
//             submitHandler: function (form) {
//
//             },
//             rules: {
//                 'old-password': {
//                     required: true,
//                 },
//                 'password': {
//                     required: true,
//                     minlength: 6
//                 },
//                 'password-confirmation': {
//                     required: true,
//                     equalTo: '#password'
//                 },
//             },
//             messages: {
//                 'old-password': {
//                     required: '请输入旧密码',
//                 },
//                 'password': {
//                     required: '请输入密码',
//                     minlength: '您的密码长度必须至少为6个字符'
//                 },
//                 'password_confirmation': {
//                     required: '请输入确认密码',
//                     minlength: '您的密码长度必须至少为6个字符',
//                     equalTo: '请输入与上述相同的密码'
//                 },
//             }
//         });
//     };
//
//     return {
//         init: function () {
//             // Init Material Forms Validation
//             resetFormValidation();
//         }
//     };
// }();
//
// var resetPassword = function () {
//     jQuery('#modal-reset').modal();
// };
//
$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // FormValidation.init();
    //
    // jQuery('#reset_form').submit(function (e) {
    //     if (jQuery(this).valid()) {
    //         jQuery('#loading_userinfo').show();
    //         e.preventDefault();
    //
    //         jQuery.post('/admin/user/reset', jQuery(this).serialize(), function (resp) {
    //             jQuery('#loading_userinfo').hide();
    //             console.log(resp);
    //             if (resp.code == 0) {
    //                 jQuery('#modal-reset').modal('hide');
    //             } else {
    //                 jQuery('#old-password').focus();
    //                 jQuery('#error_msg').show();
    //                 jQuery('#error_msg').html(resp.message);
    //             }
    //         })
    //     }
    // });
    //
    // jQuery('#modal-reset').on('hidden.bs.modal', function () {
    //     jQuery("#loading_userinfo").hide();
    //     jQuery('.form-group').each(function () { jQuery(this).removeClass('has-error'); });
    //     jQuery('.help-block').each(function () { jQuery(this).hide(); });
    //     jQuery('input').each(function () {jQuery(this).val('');});
    // });
});