/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/create-update-category.js ***!
  \************************************************/
$('.btn-create').click(function (e) {
  e.preventDefault();
  var arrayUrl = $(location).attr('pathname').split('/');
  var model = arrayUrl[arrayUrl.length - 1];
  var url = "".concat(model, "/store");
  var nameInput = $('#nameInput').val();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'POST',
    url: url,
    data: {
      "_method": 'POST',
      "_token": CSRF_TOKEN,
      "name": nameInput
    },
    success: function success(results) {
      if (results.status == false) {
        $('#nameInput').addClass('is-invalid '), $('#message').addClass('show'), $('#message').prepend(results.message.name);
      } else {
        Swal.fire({
          title: 'Success',
          icon: 'success',
          type: 'success',
          text: results.message,
          showConfirmButton: false,
          timer: 1000
        }, setTimeout(function () {
          window.location.reload(); // var no = $('tbody tr').length;
          // var row = `
          // <tr>
          //     <td>${no}</td>
          //     <td>${results.data.name}</td>
          //     <td>${results.data.user.name}</td>
          //     <td>
          //             <button class="btn ${results.data.status=='active'?'btn-success':'btn-danger'} btn-sm btn-update"
          //                 data-id="${results.data.id}">${results.data.status}</button>
          //     <td>
          //         <button class="btn btn-danger btn-sm delete-confirm" value="${results.data.id}"><i
          //                 class="fa fa-trash"></i></button>
          //     </td>
          // </tr>
          // `
          // $("tbody").append(row);
          // nameInput.text = "";
          // $('#nameInput').addClass('valid');
          // // $('#modal-default').modal('hide');
        }, 100));
      }
    }
  });
});
$('.btn-modal-edit').click(function () {
  var namePresent = $(this).attr('data-name');
  var idCate = $(this).attr('data-id');
  $('#nameEdit').val(namePresent);
  $('#idCate').val(idCate);
});
$('.btn-edit').click(function (e) {
  e.preventDefault();
  var arrayUrl = $(location).attr('pathname').split('/');
  var model = arrayUrl[arrayUrl.length - 1];
  var idCate = $('#idCate').val();
  var url = "".concat(model, "/update/").concat(idCate);
  var nameEdit = $('#nameEdit').val();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'POST',
    url: url,
    data: {
      "_method": 'POST',
      "_token": CSRF_TOKEN,
      "name": nameEdit,
      'id': idCate
    },
    success: function success(results) {
      if (results.status == false) {
        $('#nameEdit').addClass('is-invalid '), $('#messageEdit').addClass('show'), $('#messageEdit').children('span').text(results.message.name);
      } else {
        Swal.fire({
          title: 'Success',
          icon: 'success',
          type: 'success',
          text: results.message,
          showConfirmButton: false,
          timer: 1000
        }, setTimeout(function () {
          window.location.reload();
        }, 100));
      }
    }
  });
});
/******/ })()
;