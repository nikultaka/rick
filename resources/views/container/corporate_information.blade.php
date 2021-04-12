<script type="text/javascript">
          var BASE_URL="{{url('/')}}";
    </script>
    <style>
        hr.solid {
                    border-top: 3px solid #bbb;
                    margin-bottom: 5px;
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
                     <input type="text" class="form-control" id="address1" placeholder="address1" name="address1" value="{{isset($data->address1) ? $data->address1 : ''}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                     <input type="text" class="form-control" id="address2" placeholder="address2" name="address2" value="{{isset($data->address2) ? $data->address2 : ''}}" disabled>
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-4">
                    <input type="text" class="form-control" id="state" placeholder="state" name="state" value="{{isset($data->state) ? $data->state : ''}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <input type="text" class="form-control" id="city" placeholder="city" name="city" value="{{isset($data->city) ? $data->city : ''}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                      <input type="text" class="form-control" id="vatnumber" placeholder="vat number" name="vatnumber" value="{{isset($data->vatnumber) ? $data->vatnumber : ''}}" disabled>
                </div>
            </div>
           
        <hr class="solid">
        <div class="row">
        <h3 class="col-3" style="margin-top: 10px;">Email Settings</h3>
            <div class="col-1 edit_save_info">
                <a onclick = "removedisabledfield()" class="pointer"><img src="{{asset('stylecontainer/images/Pencil.png')}}" id="pencilimg" alt="img-title" style="width:40%; margin-top: 20px;"></a>
            </div>
            <div class="col-1 edit_save_info">
                <button type="submit" id="save" name="save" class="save_infor_button"><img src="{{asset('stylecontainer/images/Save.png')}}" id="saveeimg" alt="img-title" style="width:100%; margin-top: 20px;"></button>
                {{-- <a onclick = "savecorporatedata()" class="pointer"></a> --}}
            </div>
        </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <input type="email" class="form-control" id="weighingslipsemail" placeholder="Weighing Slips Email" name="weighingslipsemail" value="{{isset($data->weighingslipsemail) ? $data->weighingslipsemail : ''}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                     <input type="email" class="form-control" id="storageemail" placeholder="Storage Email" name="storageemail" value="{{isset($data->storageemail) ? $data->storageemail : ''}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <input type="email" class="form-control" id="invoiceemail" placeholder="Invoice Email" name="invoiceemail" value="{{isset($data->invoiceemail) ? $data->invoiceemail : ''}}" disabled>
                </div>
            </div>
        </form>
    </div>
  </div>

    <script type="text/javascript" src="{{ asset('container_js/corporate_information.js')}}"></script>
