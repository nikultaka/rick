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
                    <th width="10%">Ticker number</th>
                    <th width="10%">Reference</th>
                    <th width="10%">Date and time </th>
                    <th width="10%">Pincode</th>
                    <th width="10%">Lisence plate</th>
                    <th width="10%">Container number</th>
                    <th width="10%">Container type</th>
                    <th width="10%">Vol/Leeg/papieren</th>
                    <th width="10%">ADR</th>
                    <th width="10%">Genset</th>
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
