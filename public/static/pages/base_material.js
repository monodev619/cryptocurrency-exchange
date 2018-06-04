
var openCurrency = function() {
    $('#currency-modal').modal();
};

var selectImage = function(obj) {
    var fileList = obj.files;

    if (fileList.length > 0) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#logo').attr('src', e.target.result);
        };

        reader.readAsDataURL(fileList[0]);
    }
};

$(function () {
    $('.dropify').dropify();
});