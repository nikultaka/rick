<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>
    <style>
            .sub-menu {
            float: left;
            display: block;
            text-align: center;
            }
            .link{
            color: black;
            text-decoration: none;
            }
            .sub-menu .menu-title {
            display: block;
            margin-top: 5px;
            }
    </style>
    <title>Weight Tickets List</title>
    <script type="text/javascript">
          var BASE_URL="{{url('/')}}";
    </script>
</head>
<body>
    <table class="table table-bordered table-hover" id="weightickets-table">
        {{ csrf_field() }}
          <thead>
            <th>Ticker number</th>
            <th>Reference</th>
            <th>Date and time </th>    
            <th>Weight</th>    
            <th>Licence plate</th>    
            <th>Container number</th>    
            <th>Container type</th>    
            <th>Weighing Slip</th>    
          </thead>  
    </table>
</body>
<script type="text/javascript"> var weighTicketsUrl="{{url('/getListWeighTickets')}}";</script>
<script type="text/javascript" src="{{ asset('container_js/weightickets_script.js')}}"></script>
</html>