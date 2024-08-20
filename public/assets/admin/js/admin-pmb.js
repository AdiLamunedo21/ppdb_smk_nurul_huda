(function($) {
  "use strict"; // Start of use strict

  //form pendamping
  $('#tipe').change(function() {
    $(".data-pendamping").removeClass('d-block').addClass('d-none')

    if ($(this).val() === "siswa") {
        $('#tipe_siswa').addClass('d-block')
    } else if ($(this).val() === "guru" || $(this).val() === "kepala_sekolah"){
        $('#tipe_guru').addClass('d-block')
    } else {
        $(".data-pendamping").removeClass('d-block').addClass('d-none')
    }
  });

  // Hapus Data pendamping
//   $('#pendampingTable').on( 'draw.dt', function () {
//     $('#modalDelete').modal('hide');
//     $(".btn-hapus").click(function() {
//       $('#modalDelete').modal('show');
//       $(".data-title").text($(this).attr('data-title'));
//       $("#formDelete").attr("action", $(this).attr('data-url'));
//       $("#deleteId").val( $(this).attr('data-id') );
//       $("#deleteId").attr('name', $(this).attr('data-name')+'_id');
//     });
//     $('#submitFormDelete').click(function() {
//       $('#formDelete').submit();
//     })
//   });

     $('#modalDelete').modal('hide');
    $(".btn-hapus").click(function() {
      $('#modalDelete').modal('show');
      $(".data-title").text($(this).attr('data-title'));
      $("#formDelete").attr("action", $(this).attr('data-url'));
      $("#deleteId").val( $(this).attr('data-id') );
      $("#deleteId").attr('name', $(this).attr('data-name')+'_id');
    });
    $('#submitFormDelete').click(function() {
      $('#formDelete').submit();
    })

  $('#modalDelete').on('hidden.bs.modal', function (e) {
      $("#formDelete").attr("action", '');
      $("#deleteId").val('');
      $("#deleteId").attr('name', '');
  })

})(jQuery); // End of use strict
