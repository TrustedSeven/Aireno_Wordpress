jQuery(document).ready(function ($) {
   $('body').on('click', '#btnClearNotis', function (ev) {
      ev.preventDefault();
      var formData = new FormData();
      formData.set('action', 'aireno_clear_unread_notifications');
      $.ajax({
         method: 'POST',
         dataType: 'json',
         url: aireno.ajax_url,
         type: 'POST',
         data: formData,
         cache: false,
         contentType: false,
         processData: false,
         error: function error(response) {
            Swal.fire({
               text: "Internal Server Error!",
               icon: "error",
               buttonsStyling: !1,
               confirmButtonText: "OK",
               customClass: {confirmButton: "btn btn-primary"}
            });
         },
         success: function (result) {
            if (!result.status) {
               Swal.fire({
                  text: "Something went wrong!",
                  icon: "error",
                  buttonsStyling: !1,
                  confirmButtonText: "OK",
                  customClass: {confirmButton: "btn btn-primary"}
               });
            } else {
               window.location.reload();
            }
         }
      });
   });

   $('body').on('click', '#btnClearMsgs', function (ev) {
      ev.preventDefault();
      var formData = new FormData();
      formData.set('action', 'aireno_clear_unread_messages');
      $.ajax({
         method: 'POST',
         dataType: 'json',
         url: aireno.ajax_url,
         type: 'POST',
         data: formData,
         cache: false,
         contentType: false,
         processData: false,
         error: function error(response) {
            Swal.fire({
               text: "Internal Server Error!",
               icon: "error",
               buttonsStyling: !1,
               confirmButtonText: "OK",
               customClass: {confirmButton: "btn btn-primary"}
            });
         },
         success: function (result) {
            if (!result.status) {
               Swal.fire({
                  text: "Something went wrong!",
                  icon: "error",
                  buttonsStyling: !1,
                  confirmButtonText: "OK",
                  customClass: {confirmButton: "btn btn-primary"}
               });
            } else {
               window.location.reload();
            }
         }
      });
   });
});