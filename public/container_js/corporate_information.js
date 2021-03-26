$(document).ready(function () {
    // $('#save').on('click', function(){
    //     $.ajax({
    //       url: BASE_URL + '/insertCorporateInformation',
    //       type: 'POST',
    //       data: $('#corporateform').serialize(),
    //           success:function(response){
    //             var response = JSON.parse(response);
    //             if(response.status == 1){
    //                alert(response.msg);
    //           }
    //       }
    //     });
    //   });
    alert('0');
    $(function() {

        $("form[name='corporateform']").validate({
            rules:{
                address1:  { required: true, minlength: 3 }, 
                address2:  { required: true, minlength: 3 },
                state:     { required: true, minlength: 3 },
                city:      { required: true, minlength: 3 },
                vatnumber: { required: true, minlength: 3 },
                clientid:  { required: true, minlength: 3 },
                weighingslipsemail: {
                    required: true,
                    email: true,
                    email: 'email',
                },
                storageemail: {
                    required: true,
                    email: true,
                    email: 'email',
                },
                invoiceemail: {
                    required: true,
                    email: true,
                    email: 'email',
                },
            },
            messages:{
                address1, address2, state, city, vatnumber: 
                {
                    required: "This is a required field"
                },
                weighingslipsemail, storageemail, invoiceemail:
                {
                    email: "Please enter a valid email address",
                    required : "This is a required field",
                },
            },
            submitHandler: function(){
                $.ajax({
                    url: BASE_URL + '/insertCorporateInformation',
                    type: 'POST',
                    data: $('#corporateform').serialize(),
                    success: function (response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            alert(response.msg);
                        }
                    }
                });
            }
        });
    });
});