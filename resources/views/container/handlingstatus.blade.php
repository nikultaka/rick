      <div class="input-icons">
        <div class="icon">
          <i class="fa fa-search"></i>
        </div>
        <input type="text" id="searchbox" placeholder="Search keyword.." class="input-field" >
      </div>
      <table class="GeneratedTable" id="service-table">
          {{ csrf_field() }}
            <thead>
                <th>Ticker number</th>
                <th>Kind of action</th>
                <th>Date and time </th>    
                <th>Pincode</th>    
                <th>Lisence plate</th>    
                <th>Container number</th>    
                <th>Container type</th>    
                <th>Number of handling</th>    
                <th>ADR</th>    
                <th>Genset</th>    
            </thead>
      </table>
  <script type="text/javascript"> var url="{{url('/gethandlingstatus')}}";</script>
  <script type="text/javascript" src="{{ asset('container_js/handlingstatus_script.js')}}"></script>
  