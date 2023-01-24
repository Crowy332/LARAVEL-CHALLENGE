$("#add_employee_btn").on("click" , function(){
    $("#add_employee_modal").modal("show");
    $(".modal-title").html('Add Employee Data');
    $(".employee_btn").hide();
    $("#add_employee").show();
})
$("#add_employee").on("click" , function(){
    var formData = new FormData();
    formData.append('first_name',$("#emp_fname").val());
    formData.append('last_name',$("#emp_lname").val());
    formData.append('company',$("#emp_company").val());
    formData.append('email',$("#emp_email").val());
    formData.append('phone',$("#emp_phone").val());
    $.ajax({
        url: '/add_employee',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        error: function (request, status, error) {
            console.log("error")
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
            title: 'Save Data success',
            confirmButtonText: 'Continue',
        })
    })
})
$('.edit_btn').on("click" , function(){
    id = $(this).data('id');
    $.ajax({
        url: '/edit_employee',
        type: "POST",
        data: {id : id},
    }).done(function(data) {
       $("#add_employee_modal").modal("show");
       $(".modal-title").html('Edit Employee Data');
       $(".employee_btn").hide();
       $("#edit_employee").show();
       $("#employee_id").val(id)
       $("#emp_fname").val(data['first_name']);
       $("#emp_lname").val(data['last_name']);
       $("#emp_company").val(data['company']).trigger("change");
       $("#emp_email").val(data['email']);
       $("#emp_phone").val(data['phone']);
    })
})
$("#edit_employee").on("click" , function(){
    var formData = new FormData();
    formData.append('id',$("#employee_id").val());
    formData.append('first_name',$("#emp_fname").val());
    formData.append('last_name',$("#emp_lname").val());
    formData.append('company',$("#emp_company").val());
    formData.append('email',$("#emp_email").val());
    formData.append('phone',$("#emp_phone").val());
    $.ajax({
        url: '/update_employee',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        error: function (request, status, error) {
            console.log("error")
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
$('.delete_btn').on("click" , function(){
    $.ajax({
        url: '/delete_employee',
        type: "POST",
        data: {id : $(this).data('id')},
    }).done(function(data) {
        console.log(data)
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
$('#add_employee_modal').on('hidden.bs.modal', function () {
    location.reload();
})
