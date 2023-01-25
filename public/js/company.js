$("#add_companie_btn").unbind('click').bind("click" , function(){
    $("#add_companie_modal").modal("show");
    $(".modal-title").html('Add Company Data');
    $(".company_btn").hide();
    $("#add_companie").show();
})
$("#add_companie").unbind('click').bind("click" , function(){
    var formData = new FormData();
    $("#loader").show();
    formData.append('name',$("#com_name").val());
    formData.append('address',$("#com_address").val());
    formData.append('email',$("#com_email").val());
    formData.append('logo',$("#com_logo")[0].files[0]);
    formData.append('website',$("#com_website").val());
    $.ajax({
        url: '/add_companie',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        error: function (request, status, error) {
            text_error = "";
            array = JSON.parse(request['responseText'])['errors'];
            jQuery.each( array, function( key , val ) {
                jQuery.each( val, function( key , msg ) {
                    text_error += msg +"<br>";
                });
            });

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: "<p class = 'mx-auto'>"+text_error+"</p>"
            })

        }
    }).done(function(data) {
        $("#loader").hide();
        Swal.fire({
            icon: 'success',
            title: 'Save Data success',
            confirmButtonText: 'Continue',
          }).then((result) => {
            if (result.isConfirmed) {
                $("#add_companie_modal").modal("hide");
            }
          })
    })
})
$('.edit_btn').unbind('click').bind("click" , function(){
    id = $(this).data('id');
    $.ajax({
        url: '/edit_companie',
        type: "POST",
        data: {id : id},
    }).done(function(data) {
        $("#add_companie_modal").modal("show");
        $(".modal-title").html('Edit Company Data');
        $(".company_btn").hide();
        $("#edit_companie").show();
        $("#companie_id").val(id)
        $("#com_name").val(data['name']);
        $("#com_address").val(data['address']);
        $("#com_email").val(data['email']);
        if(data['logo']){
            $("#remove_logo").show();
            $("#logo_btn_text").text("Change Logo");
            $("#base_logo").val($("#base_path").val()+'/'+data['logo'])
        }
        $("#logo_show").attr('src' , data['logo'] ? $("#base_path").val()+'/'+data['logo']:$("#no_logo").val());
        $("#com_website").val(data['website']);
    })
})
$("#edit_companie").unbind('click').bind("click" , function(){
    var formData = new FormData();
    formData.append('id',$("#companie_id").val());
    formData.append('check',$("#check_logo").val());
    formData.append('name',$("#com_name").val());
    formData.append('address',$("#com_address").val());
    formData.append('email',$("#com_email").val());
    formData.append('logo',$("#com_logo")[0].files[0]);
    formData.append('website',$("#com_website").val());
    $.ajax({
        url: '/update_companie',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        error: function (request, status, error) {
            text_error = "";
            array = JSON.parse(request['responseText'])['errors'];
            jQuery.each( array, function( key , val ) {
                jQuery.each( val, function( key , msg ) {
                    text_error += msg +"<br>";
                });
            });

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: "<p class = 'mx-auto'>"+text_error+"</p>"
            })

        }
    }).done(function(data) {
        Swal.fire({
            icon: 'success',
            title: 'Update Data success',
            confirmButtonText: 'Continue',
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        })
    })
})
$('.delete_btn').unbind('click').bind("click" , function(){
    $.ajax({
        url: '/delete_companie',
        type: "POST",
        data: {id : $(this).data('id')},
    }).done(function(data) {
        Swal.fire({
            title: 'Delete Data Success',
            html: 'I will reloade page in <b></b> milliseconds.',
            timer: 1500,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                location.reload();
            }
          })
    })
})
$('#add_companie_modal').on('hidden.bs.modal', function () {
    location.reload();
})
$("#com_logo").unbind('click').bind('change',function(){
    const [file] = com_logo.files
    if (file) {
        logo_show.src = URL.createObjectURL(file)
    }
    $("#logo_btn_text").text("Change Logo");
    $("#remove_logo").hide();
    $('#check_logo').val(1);
    if(com_logo.files){
        $("#clear_logo").show(500);
    }
})
$("#clear_logo").unbind('click').bind('click', function(){
    $("#com_logo").val('');

    $("#logo_btn_text").text("Add Logo");
    $("#clear_logo").hide(300);
    if($("#base_logo").val()){
        $("#logo_show").attr('src',$("#base_logo").val());
        $("#remove_logo").show(300);
    }
    else{
        $("#logo_show").attr('src',$("#no_logo").val());
    }
    $('#check_logo').val(0);
});
$("#remove_logo").unbind('click').bind('click', function(){
    $("#com_logo").val('');
    $("#remove_logo").hide(300);
    $('#check_logo').val(2);
    $("#logo_btn_text").text("Add Logo");
    $("#logo_show").attr('src',$("#no_logo").val());
});
