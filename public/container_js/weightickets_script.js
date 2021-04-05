$(document).ready(function(){
    weighTicketData();
    
});

function weighTicketData(){
    var dataTable =   $('#weightickets-table').dataTable({
                "dom": '<"top"i>rt<"right"flp><"clear">',
                "paging": true,
                "pageLength": 10,
                "bProcessing": true,
                "serverSide": true,
                "bDestroy": true,
                "bAutoWidth": false,
                "bInfo" : false,
                "ajax":{
                    url: weighTicketsUrl,
                    // weighTicketsUrl var define in weigh_ticket.blade.php
                    type:'POST',
                    data:{
                        "_token": $("[name='_token']").val(),
                        },
                },
                "aoColumns": [
                    {mData: 'ticker_number'},
                    {mData: 'reference'},
                    {mData: 'date_time'},
                    {mData: 'weight'},
                    {mData: 'lisence_plate'},
                    {mData: 'container_number'},
                    {mData: 'container_type'},
                    {mData: 'weighing_slip'},
                    // {mData: 'action'},
                ],
                "order": [[0,"ASC"]],        
                "columnDefs": [{
                    "targets": [7],
                    "orderable": false
                }]
    });

    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });  

}

