current_color = $('.wizard-card').data('color');
full_color = true;

$(document).ready(function(){

     $('.fixed-plugin a, .fixed-plugin .badge').click(function(event){
      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
        if($(this).hasClass('switch-trigger')){
            if(event.stopPropagation){
                event.stopPropagation();
            }
            else if(window.event){
               window.event.cancelBubble = true;
            }
        }
    });

    $('.fixed-plugin .badge').click(function(){

        $wizard = $('.wizard-card');
        $button_next = $('.wizard-card .wizard-footer').find('.pull-right :input');



        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        $wizard.fadeOut('fast', function(){

            $wizard.attr("data-color", new_color);
            $button_next.removeClass(converterColor(current_color)).addClass(converterColor(new_color));

            current_color = new_color;
            $wizard.fadeIn('fast');
        });
    });

    function converterColor(color){
        switch (color) {
            case 'blue':
                return 'btn-info';
                break;
            case 'orange':
                return 'btn-warning';
                break;
            case 'azure':
                return 'btn-primary';
                break;
            case 'red':
                return 'btn-danger';
                break;
            case 'green':
                return 'btn-success';
                break;
        }
    }

    $('.pilih-jalur').click(function(){
        $("#info-jalur-test").hide();
        $("#info-jalur-prestasi").hide();
        $("#info-jalur-transfer").hide();

        let jenis_pendaftaran = $( this ).val()
        $("#jenis_pendaftaran").val(jenis_pendaftaran)

        if (jenis_pendaftaran == "test") {
            $(".info-daftar__jalur").text("Umum")
            $(".info-daftar_detail__jalur").text("Seleksi PTS")
            $("#info-jalur-test").show();
        } else if (jenis_pendaftaran == "prestasi") {
            $(".info-daftar__jalur").text("Prestasi")
            $(".info-daftar_detail__jalur").text("Prestasi")
            $("#info-jalur-prestasi").show();
        } else {
            $(".info-daftar__jalur").text("Transfer")
            $(".info-daftar_detail__jalur").text("Transfer")
            $("#info-jalur-transfer").show();
        }
    });

    $('#fakultas_id').change(function() {
        let fid = $(this).val()
        getJurusan(fid)
    })

    let fid = $("#fakultas_id").val()
    if (fid != null && fid != undefined) {
        getJurusan(fid)
    }

    function getJurusan(fid) {
        $.ajax({
            url : "/daftar-jurusan/" + fid,
            success : function(result) {
                $("#jurusan_id").empty()
                $("#jurusan_id").append("<option value='' disabled selected>-- Pilih Jurusan --</option>")
                $.each( JSON.parse(result), function(key, value) {
                    $("#jurusan_id").append("<option value="+value.jurusan_id+">"+value.nama+"</option>")
                })
            }
        })
    }
});
