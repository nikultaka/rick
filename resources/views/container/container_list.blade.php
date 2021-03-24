<html>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>
    <title>Container List</title>
    <script type="text/javascript">
          var BASE_URL="{{url('/')}}";
    </script>
</head>
<body>
    <table class="table table-bordered table-hover" id="service-table">
        {{ csrf_field() }}
          <thead>
            <th>Ticker number</th>
            <th>Reference</th>
            <th>Date and time </th>    
            <th>Pincode</th>    
            <th>Lisence plate</th>    
            <th>Container number</th>    
            <th>Container type</th>    
            <th>Vol/Leeg/papieren</th>    
            <th>ADR</th>    
            <th>Genset</th>    
          </thead>  
    </table>
</body>
<script type="text/javascript"> var url="{{url('/getListContainer')}}";</script>
<script type="text/javascript" src="{{ asset('container_js/container_script.js')}}"></script>
</html>