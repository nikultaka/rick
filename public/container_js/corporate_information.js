$(document).ready(function () {
        $("#saveeimg").hide();
        $("#pencilimg").show();

        // function savecorporatedata(){
            $('#corporateform').validate({
                rules: {
                    address1: "required",
                    address2: "required",
                    state: "required",
                    city: "required",
                    vatnumber: "required",
                    
                    weighingslipsemail: {
                        required: true,
                        email: true,
                    },
                    storageemail: {
                        required: true,
                        email: true,
                    },
                    invoiceemail: {
                        required: true,
                        email: true,
                    },
                },
                messages: {
                    address1:"This is a required field",
                    address2:"This is a required field",
                    state:"This is a required field",
                    city:"This is a required field",
                    vatnumber:"This is a required field",
                    weighingslipsemail:{
                        email: "Please enter a valid email address",
                        required : "This is a required field",
                    }, 
                    storageemail:{
                        email: "Please enter a valid email address",
                        required : "This is a required field",
                    }, 
                    invoiceemail:{
                        email: "Please enter a valid email address",
                        required : "This is a required field",
                    },
                },
            submitHandler: function(form){
                $.ajax({
                    url: BASE_URL + '/insertCorporateInformation',
                    type: 'POST',
                    data: $('#corporateform').serialize(),
                    success: function (response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            Swal.fire({
                              icon: 'success',
                              title: response.msg,
                              timer: 1500
                            })
                            $("#saveeimg").hide();
                            $("#pencilimg").show();
                            $('form *').prop('disabled', true);
                        }
                    }
                });
            }
        });
    //    } 
    });
    function removedisabledfield(){
        $('form *').removeAttr("disabled");
        $("#saveeimg").show();
        $("#pencilimg").hide();
    }