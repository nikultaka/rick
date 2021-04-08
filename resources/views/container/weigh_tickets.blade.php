{{-- dowload pdf logo style --}}
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
            a:hover, a:focus {
            color: black;
            }
            .sub-menu .menu-title {
            display: block;
            margin-top: 5px;
            }
    </style>

  <div class="table-responsive">
    <table class="GeneratedTable" id="weightickets-table">
      <div class="input-icons">
        <div class="icon">
          <i class="fa fa-search"></i>
        </div>
        <input type="text" id="searchbox" placeholder="Search keyword.." class="input-field" >
      </div>
        {{ csrf_field() }}
          <thead>
            <th>Ticker number</th>
            <th>Reference</th>
            <th>Date and time </th>    
            <th>Weight</th>    
            <th>license plate</th>    
            <th>Container number</th>    
            <th>Container type</th>    
            <th>Weighing Slip</th>    
          </thead>  
    </table>
  </div>

<script type="text/javascript"> var weighTicketsUrl="{{url('/getListWeighTickets')}}";</script>
<script type="text/javascript" src="{{ asset('container_js/weightickets_script.js')}}"></script>
