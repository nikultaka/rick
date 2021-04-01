$(document).ready(function(){
    loaddata();
});

function loaddata(){
    $('#service-table').dataTable({
        "paging": true,
        "pageLength": 10,
        "bProcessing": true,
        "serverSide": true,
         "bDestroy": true,
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
            // {mData: 'action'},
        ],
        "order": [[0,"ASC"]],        
        "columnDefs": [{
            "targets": [8,9],
            "orderable": false
        }]
});
}

