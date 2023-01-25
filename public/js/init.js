$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#emp_company').select2({
        placeholder: "Plase Select Companie",
        width: '100%',
        dropdownParent: $('#add_employee_modal')
    });

});
