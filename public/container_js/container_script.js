$(document).ready(function(){
    loaddata();
    
});

function loaddata(){
        var dataTable =  $('#service-table').dataTable({
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                "paging": true,
                "pageLength": 10,
                "bProcessing": true,
                "serverSide": true,
                "bDestroy": true,
                "bAutoWidth": false,
                "bInfo" : false,
                "ajax":{
                    url: url,
                    // url var define in container_list.blade.php
                    type:'POST',
                    data:{
                        "_token": $("[name='_token']").val(),
                        },
                },
                "aoColumns": [
                    {mData: 'ticker_number'},
                    {mData: 'reference'},
                    {mData: 'date_time'},
                    {mData: 'Pincode'},
                    {mData: 'lisence_plate'},
                    {mData: 'container_number'},
                    {mData: 'container_type'},
                    {mData: 'vol_leeg'},
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

        $("#searchbox").keyup(function() {
            dataTable.fnFilter(this.value);
        });  
}


