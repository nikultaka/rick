<script type="text/javascript">
          var BASE_URL="{{url('/')}}";
    </script>
    <style>
        hr.solid {
                    border-top: 3px solid #bbb;
                 }
        form .error {
                color: #ff0000;
                }
    </style>
    <div class="corporateinfofullwidth">
       <div class="corporateinfoTable" >
        <h3>Address</h3>
        <form  method="post" class="form-horizontal" id="corporateform" name="corporateform">
        {{ csrf_field() }}
        
            <div class="form-group row">
                <div  class="col-xs-4">
                     <input type="text" class="form-control" id="address1" placeholder="address1" name="address1" value="{{isset($data->address1) ? $data->address1 : ''}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                     <input type="text" class="form-control" id="address2" placeholder="address2" name="address2" value="{{isset($data->address2) ? $data->address2 : ''}}">
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-4">
                    <input type="text" class="form-control" id="state" placeholder="state" name="state" value="{{isset($data->state) ? $data->state : ''}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <input type="text" class="form-control" id="city" placeholder="city" name="city" value="{{isset($data->city) ? $data->city : ''}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                      <input type="text" class="form-control" id="vatnumber" placeholder="vat number" name="vatnumber" value="{{isset($data->vatnumber) ? $data->vatnumber : ''}}">
                </div>
            </div>
            {{-- <div class="form-group">
                <div>
                      <input type="text" class="form-control" id="clientid" placeholder="clientid" name="clientid" value="{{isset($data->clientid) ? $data->clientid : ''}}">
                </div>
            </div> --}}
        <hr class="solid">
        <h3>Email Settings</h3>
            <div class="form-group">
                <div class="col-xs-4">
                    <input type="email" class="form-control" id="weighingslipsemail" placeholder="Weighing Slips Email" name="weighingslipsemail" value="{{isset($data->weighingslipsemail) ? $data->weighingslipsemail : ''}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                     <input type="email" class="form-control" id="storageemail" placeholder="Storage Email" name="storageemail" value="{{isset($data->storageemail) ? $data->storageemail : ''}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <input type="email" class="form-control" id="invoiceemail" placeholder="Invoice Email" name="invoiceemail" value="{{isset($data->invoiceemail) ? $data->invoiceemail : ''}}">
                </div>
            </div>
            <div class="form-group">
         <button type="submit" id="save" name="save" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
  </div>

    <script type="text/javascript" src="{{ asset('container_js/corporate_information.js')}}"></script>
