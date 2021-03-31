<div class="container">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="service-table">
          {{ csrf_field() }}
            <thead class="table-secondary">
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
    </div>
  </div>
  <script type="text/javascript"> var url="{{url('/gethandlingstatus')}}";</script>
  <script type="text/javascript" src="{{ asset('container_js/handlingstatus_script.js')}}"></script>
  