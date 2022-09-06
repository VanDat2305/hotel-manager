import Swal from "sweetalert2";

var id = window.location.href.split("/").pop();
var hostname = window.location.origin;
var url = hostname + "/dateBook/" + id;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
$.ajax({
    type: "GET",
    url: url,
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    data: {
        _token: CSRF_TOKEN,
        _method: "GET",
    },
    success: function (data) {
        var disabledDates = data.data
        $("#checkin").datetimepicker({
            minDate: new Date(),
            // disabledDates: disabledDates,
            format: "YYYY-MM-DD 14:00:00",
            collapse:false,
            sideBySide:true,
            useCurrent:false,
            showClose:true,
            timePicker: !0,
            timePicker24Hour: !0,
            icons: {
                time: "far fa-clock",
            }
        }),
        $("#checkin").on("change.datetimepicker", ({
            date,
        }) => {
            date = moment(date).format('MM-DD-YYYY');
            if (disabledDates.includes(date)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Thời gian này đã được đặt',
                  })
            }
        }),
        $("#checkout").datetimepicker({
            minDate: new Date(),
            format: "YYYY-MM-DD 12:00:00",
            collapse:false,
            sideBySide:true,
            useCurrent:false,
            showClose:true,
            timePicker: !0,
            timePicker24Hour: !0,
            icons: {
                time: "far fa-clock",
            },
        }),
        $("#checkout").on("change.datetimepicker", ({
            date,
        }) => {
            date = moment(date).format('MM-DD-YYYY');
            if (disabledDates.includes(date)) {
                Swal.fire({
                    icon: 'error',
                    title:'Thời gian này đã được đặt',
                  })
            }
        })
    },
});
