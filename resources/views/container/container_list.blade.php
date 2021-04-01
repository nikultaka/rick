{{-- <div class="dashbord-wrapper">
  <div class="dashbord-container">
    <div class="right-content"> --}}
            <table class="table GeneratedTable" id="service-table">
                {{ csrf_field() }}
                <div class="input-icons">
                    <div class="icon">
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" id="searchbox" placeholder="Search keyword.." class="input-field">
                </div>
                <thead>
                  <tr>
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
                  </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        {{-- </div>
    </div>
</div> --}}

<script type="text/javascript">
    var url = "{{ url('/getListContainer') }}";
</script>
<script type="text/javascript" src="{{ asset('container_js/container_script.js') }}"></script>
