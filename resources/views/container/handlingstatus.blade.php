
<style>
  .dropdown-toggle::after {
    display:none;
  }
  form .error {
    color: #ff0000;
    }
</style>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="handlingModal" tabindex="-1" role="dialog" aria-labelledby="handlingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="handlingModalLabel">Update handaling</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form onsubmit="return false" method="post" autocomplete="off"  name="formdata" id="formdata">
        {{ csrf_field() }}
            <input type="hidden" id="hid" name="hid">

            <div class="form-grup">
                <label for="pincode">Pincode</label><br>
                <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" require="" readonly>
            </div>
            <div class="form-grup">
              <label for="lisenceplate">License plate:</label><br>
              <input type="text" class="form-control" name="lisenceplate" id="lisenceplate" placeholder="License plate" require="">
            </div>
            <div class="form-grup">
              <label for="containernumber">Container number:</label><br>
                <input type="text" class="form-control" name="containernumber" id="containernumber" placeholder="Container number" require="">
            </div>
            <div class="form-grup">
              <label for="containertype">Container type:</label><br>
              <select name="containertype" id="containertype" class="custom-select">
                @foreach($containertype as $containertype)
                <option class="custom-select" value='{{$containertype->id}}'>{{$containertype->container_type}}</option>
                @endforeach
            </select>
          </div>
        
          <div class="form-group">
            <label for="handling">Number of handling:</label><br>
            <select class="form-control" id="handling" name="handling" >
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          
          <div class="form-grup">
            <label for="adr" style="margin: 3px;">ADR:</label>
            <input type="checkbox"  name="adr" id="adr"  placeholder="adr">
          </div>
          <div class="form-grup ">
            <label for="genset" style="margin: 3px;">Genset:</label>
            <input type="checkbox"  name="genset"  id="genset" placeholder="genset">
          </div>
      

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submit">Update</button>
        </form>
      </div>
    
    </div>
  </div>
</div>
<!-- End modal -->


<!-- data table display all data -->
<div class="table-responsive">
      <table class="GeneratedTable" id="service-table">
        <div class="input-icons">
          <div class="icon">
            <i class="fa fa-search"></i>
          </div>
          <input type="text" id="searchbox" placeholder="Search keyword.." class="input-field" >
        </div>
          {{ csrf_field() }}
            <thead>
                <th>Ticker number</th>
                <th>Kind of action</th>
                <th width="15%">Date and time </th>
                <th>Pincode</th>    
                <th>license plate</th>    
                <th>Container number</th>    
                <th>Container type</th>    
                <th>Number of handling</th>    
                <th>ADR</th>    
                <th>Genset</th>    
                <th>Actions</th>    
            </thead>
      </table>
</div>
  {{-- <script type="text/javascript"> var url="{{url('/gethandlingstatus')}}";</script> --}}
  <script type="text/javascript" src="{{ asset('container_js/handlingstatus_script.js')}}"></script>
  