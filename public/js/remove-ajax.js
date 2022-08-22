/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/remove-ajax.js ***!
  \*************************************/
$(document).ready(function () {
  var _this = this;

  $('.delete-confirm').click(function () {
    var arrayUrl = $(location).attr('pathname').split('/');
    var model = arrayUrl[arrayUrl.length - 1];
    var thisBtn = $(_this.activeElement);
    var id = thisBtn.val();
    var tr = thisBtn.parent().parent(); // console.log(thisBtn.val());

    Swal.fire({
      icon: 'warning',
      text: 'Bạn có muốn xóa không?',
      showCancelButton: true,
      confirmButtonText: 'Có',
      confirmButtonColor: '#e3342f',
      cancelButtonText: 'Không'
    }).then(function (result) {
      if (result.isConfirmed) {
        // cách 1 
        // thisBtn.parent('form').submit();
        // cách 2 
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: 'DELETE',
          url: "".concat(model, "/destroy/").concat(id),
          data: {
            "_method": 'DELETE',
            "_token": CSRF_TOKEN
          },
          // dataType: 'JSON',
          success: function success(results) {
            if (results.success === true) {
              Swal.fire({
                title: 'Success',
                icon: 'success',
                type: 'success',
                text: results.message,
                showConfirmButton: false,
                timer: 1500
              }, setTimeout(function () {
                tr.remove();
              }, 500));
            } else {
              Swal.fire({
                title: 'Error',
                type: 'error',
                icon: 'error',
                text: results.message,
                timer: 1500
              });
            }
          }
        });
      }
    });
  });
  $('.btn-update').click(function () {
    var arrayUrl = $(location).attr('pathname').split('/');
    var model = arrayUrl[arrayUrl.length - 1];
    var thisBtn = $(this);
    var id = thisBtn.data('id');
    Swal.fire({
      icon: 'warning',
      text: 'Bạn có muốn cập nhật trạng thái không?',
      showCancelButton: true,
      confirmButtonText: 'Có',
      confirmButtonColor: '#e3342f',
      cancelButtonText: 'Không'
    }).then(function (result) {
      if (result.isConfirmed) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: 'POST',
          url: "".concat(model, "/update-status/").concat(id),
          data: {
            "_method": 'POST',
            "_token": CSRF_TOKEN
          },
          success: function success(results) {
            if (results.success === true) {
              Swal.fire({
                title: 'Success',
                icon: 'success',
                type: 'success',
                text: results.message,
                showConfirmButton: false,
                timer: 1500
              }, setTimeout(function () {
                if (results.data == 'block') {
                  thisBtn.attr('class', 'btn btn-danger btn-sm btn-update');
                  thisBtn.html('block');
                } else {
                  thisBtn.attr('class', 'btn btn-success btn-sm btn-update');
                  thisBtn.html('active');
                }
              }, 0));
            } else {
              Swal.fire({
                title: 'Error',
                type: 'error',
                icon: 'error',
                text: results.message,
                timer: 1500
              });
            }
          }
        });
      }
    });
  });
});
/******/ })()
;