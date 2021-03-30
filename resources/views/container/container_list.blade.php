<div class="container">
  <div class="table-responsive">
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
  </div>
</div>
<script type="text/javascript"> var url="{{url('/getListContainer')}}";</script>
<script type="text/javascript" src="{{ asset('container_js/container_script.js')}}"></script>
