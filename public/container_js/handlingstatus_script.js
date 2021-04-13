$(document).ready(function(){
    $('#handlingModal').on('hidden.bs.modal', function(){
        $('#formdata').trigger("reset");
    });
    loaddata();
    $("#formdata").validate({
        rules: {
            lisenceplate : "required",
            containernumber : "required",
        },
        messages: {
            lisenceplate : "Lisence Plate is Required",
            containernumber : "Container number is Required",
        },
        submitHandler:function() {
            $.ajax({
                url: BASE_URL + '/updatehandalingdata',
                type: 'POST',
                data: $('#formdata').serialize(),
                success: function (responce) {
                    var data = JSON.parse(responce);
                    console.log(data);
                    if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500

                            })
                        $('#handlingModal').modal('hide');
                        loaddata();
                    }
                }
            });
        }
    });
});

function loaddata(){
   var dataTable = $('#service-table').dataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "paging": true,
        "pageLength": 10,
        "bProcessing": true,
        "serverSide": true,
         "bDestroy": true,
         "bPaginate": false,  
         "bAutoWidth": false,
         "bInfo" : false,
         "ajax":{
            url: BASE_URL + '/gethandlingstatus',
         
            type:'POST',
            data:{
                "_token": $("[name='_token']").val(),
                },
        },
        "aoColumns": [
            {mData: 'ticker_number'},
            {mData: 'kind_of_action'},
            {mData: 'date_time'},
            {mData: 'Pincode'},
            {mData: 'lisence_plate'},
            {mData: 'container_number'},
            {mData: 'container_type'},
            {mData: 'number_of_handling'},
            {mData: 'adr'},
            {mData: 'genset'},
            {mData: 'action'},
        ],
        "order": [[0,"ASC"]],        
        "columnDefs": [{
            "targets": [8,9,10],
            "orderable": false
        }]
});

$("#searchbox").keyup(function() {
    dataTable.fnFilter(this.value);
 });   
}

function record_delete(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You are sure to delete this record !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL +'/deletehandalingdata',
                    type: 'POST',
                    data:{
                        id : id ,
                        "_token": $("[name='_token']").val(),
                    },
                    success: function (responce) {
                        var data = JSON.parse(responce);
                        if (data.status == 1) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your record has been deleted.',
                                    'success'
                                )
                                loaddata();
                        }
                    }
                });
         }
    })
}

function record_edit(id){
    $.ajax({
        url: BASE_URL +'/edithandalingdata',
        type: 'POST',
        data:{
            id : id ,
            "_token": $("[name='_token']").val(),
        },
        success: function (responce) {
            $('#handlingModal').modal('show');
            var data = JSON.parse(responce);
            var result = data.user;
            if (data.status == 1) {
                $('#hid').val(result.id);
                $('#pincode').val(result.pin);
                $('#lisenceplate').val(result.license_plate);
                $('#containernumber').val(result.container_number);
                $('#containertype').val(result.container_type);
                $('#handling').val(result.handling_status);
                var adr = result.adr;
                if(adr == 1){
                    $("input[name='adr']").prop('checked', true);
                }else{
                    $("input[name='adr']").prop('checked', false);
                }
                var genset = result.genset;
                if(genset == 1){
                    $("input[name='genset']").prop('checked', true);
                }else{
                    $("input[name='genset']").prop('checked', false);
                }
            }
            loaddata();
        }
    });
}




