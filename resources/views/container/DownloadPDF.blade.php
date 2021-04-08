<html>
    <head>
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
          }
          
          td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          
          tr:nth-child(even) {
            background-color: #dddddd;
          }
          </style>
    </head>
<body>
    <h1>Your Container Weight List</h1>
    <table>
          <tr>
            <th>Fields</th>
            <th>Details</th>
          </tr>
          <tr>
            <td>Ticker number</td>
            <td>{{$WeighTicketsDetails->id}}</td>
          </tr>
          <tr>
            <td>Reference</td>
            <td>{{$WeighTicketsDetails->reference}}</td>
          </tr>
          <tr>
            <td>Date and time</td>
            <td>{{$WeighTicketsDetails->created_at != '' ? date('d-m-Y h:i', strtotime($WeighTicketsDetails->created_at)) : ''}}</td>
          </tr>
           <tr>
            <td>Weight</td>
            <td>{{$WeighTicketsDetails->weight}}</td>
          </tr>
          <tr>
            <td>license plate</td>
            <td>{{$WeighTicketsDetails->license_plate}}</td>
          </tr>
          <tr>
            <td>Container Number</td>
            <td>{{$WeighTicketsDetails->container_number}}</td>
          </tr>
          <tr>
            <td>Container Type</td>
            <td>{{$WeighTicketsDetails->container_type}}</td>
          </tr>
    </table>
</body>
</html>