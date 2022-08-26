/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/getDate.js ***!
  \*********************************/
var id = window.location.href.split("/").pop();
var hostname = window.location.origin;
var url = hostname + "/dateBook/" + id;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
$.ajax({
  type: "GET",
  url: url,
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
  },
  data: {
    _token: CSRF_TOKEN,
    _method: "GET"
  },
  success: function success(data) {
    var disabledDates = data.data;
    $("#checkin").datetimepicker({
      minDate: new Date(),
      disabledDates: disabledDates,
      format: "YYYY-MM-DD 14:00",
      collapse: false,
      sideBySide: true,
      useCurrent: false,
      showClose: true,
      timePicker: !0,
      timePicker24Hour: !0,
      icons: {
        time: "far fa-clock"
      }
    }), $("#checkout").datetimepicker({
      minDate: new Date(),
      disabledDates: disabledDates,
      format: "YYYY-MM-DD 12:00",
      collapse: false,
      sideBySide: true,
      useCurrent: false,
      showClose: true,
      timePicker: !0,
      timePicker24Hour: !0,
      icons: {
        time: "far fa-clock"
      }
    });
  }
});
/******/ })()
;