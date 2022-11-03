<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <center><b>{{ __('ENTRY MANAGEMENT DASHBOARD - SECURITY VIEW') }}</b></center>
        </h2>


    </x-slot>

    @if (session('status'))
    <div class="alert alert-success">
        {!! session('status') !!}
    </div>
    @endif


    <!--MAIN CONTAINER BACKGROUND BEGINS-->
    <div class="bg-black row overflow-hidden py-4">
    


        <!--TRANSPARENT CONTAINER FOR INPUT FIELDS (LEFT & RIGHT COLUMNS) -->
        <div id="topleft" class="p-5 mx-4 col-md-6 bg-black opacity-90 overflow-hidden shadow sm:rounded-lg">

            <form autocomplete="off" name="submitInfo" id="submitInfo" actions="" onsubmit="FillInfo()" method="GET"  >
                <div class= "d-flex flex-column align-items-center justify-content-center">
                    @csrf
<!-- ID USER -->
                    <input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="visit_id" id="visit_id" placeholder="ID USER" value="">
<!-- VISITOR NAME -->
                    <label style="color:yellow">VISITOR NAME:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="name_visitor" id="name_visitor" placeholder="NAME OF VISITOR" value=""></p>
<!-- AUTHORISATION STATUS -->                  
                    <label style="color:yellow">AUTHORISATION STATUS:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="status_authorisation" id="status_authorisation" placeholder="AUTHORISATION STATUS" value=""></p>
<!-- VISITORY TYPE -->                    
                    <label style="color:yellow">MODE OF TRANSPORTATION:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="visitor_type" id="visitor_type" placeholder="MODE OF TRANSPORTATION" value=""></p>
<!-- RESIDENT NAME -->                    
                    <label style="color:yellow">RESIDENT NAME:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="name_resident" id="name_resident" placeholder="NAME OF RESIDENT" value=""></p>
<!-- COMMUNITY NAME -->
                    <label style="color:yellow">COMMUNITY:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="community" id="community" placeholder="COMMUNITY" value=""></p>
<!-- LOT NUMBER -->                    
                    <label style="color:yellow">LOT NUMBER:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="lot" id="lot" placeholder="LOT NUMBER" value=""></p>
<!-- STREET ADDRESS-->
                    <label style="color:yellow">STREET / AVENUE:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="address" id="address" placeholder="STREET/AVENUE" value=""></p>
<!-- LICENSE PLATE-->
                    <label style="color:yellow">LICENSE PLATE #</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="license_plate" id="license_plate" placeholder="LICENSE PLATE NUMBER" value=""></p>

<!-- VEHICLE-->                 
                    <label style="color:yellow">{{ __('VEHICLE TYPE :') }}</label>
                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='vehicle' name='vehicle' onchange="{{ (isset($Onchange)) }}">
                            <option id='defaultOption' value="">{{ __('SELECT VEHICLE TYPE') }}</option>
                            @if(isset($vehicle))
                            @foreach ( $vehicle as $vehicle )
                            <option {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }} value="{{ $vehicle->name ?? '' }}">{{ __($vehicle->name ?? '' ) }}
                            </option>
                            @endforeach
                            @endif

                        </select>
                        @error('vehicle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p> 

                
<!--VEHICLE TYPES -->
                    <label style="color:yellow">{{ __('VEHICLE MAKE :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='vehicle_type' name='vehicle_type' onchange="{{ (isset($Onchange)) }}">
                            <option id='defaultOption' value="">{{ __('SELECT VEHICLE MAKE') }}</option>
                            @if(isset($vehicleTypes))
                            @foreach ( $vehicleTypes as $vehicleTypes )
                            <option {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }} value="{{ $vehicleTypes->name ?? '' }}">{{ __($vehicleTypes->name ?? '' ) }}
                            </option>
                            @endforeach
                            @endif

                        </select>
                        @error('vehicle_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p> 

            

<!--VEHICLE COLOR -->
                    <label style="color:yellow">{{ __('VEHICLE COLOR :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='vehicle_color' name='vehicle_color' onchange="{{ (isset($Onchange)) }}">
                            <option id='defaultOption' value="">{{ __('SELECT VEHICLE COLOR') }}</option>
                            @if(isset($vehicleColors))
                            @foreach ( $vehicleColors as $vehicleColors )
                            <option {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }} value="{{ $vehicleColors->name ?? '' }}">{{ __($vehicleColors->name ?? '' ) }}
                            </option>
                            @endforeach
                            @endif

                        </select>
                        @error('vehicle_color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p> 
<BR>
                    <center class="col-md-6"><input type="button" onclick="SubmitInfo();return true"class="btn btn-success" value="SUBMIT"/></center>
                    <center class="col-md-6"><input type="submit" onclick="FillInfo();return true" class="btn btn-success" value="SEARCH"/></center>

            </form>


           


        </div>

        <div class="col-md-6"> </div>


    </div>

    </div>
    <!-- TABLE BEGINS-->
    <div id="table" class="p-1 mx-1 bg-white row  overflow-hidden shadow sm:rounded-lg">
        <div id="residentList">
            <table class="border-separate table table-striped yajra-datatable" value="testme" type="button" onclick="test()">
                <thead>
                    <tr>
                        <th>
                            <center>VISIT ID</center>
                        </th>
                        <th>
                            <center>VISITOR NAME</center>
                        </th>
                        <th>
                            <center>AUTHORISATION STATUS</center>
                        </th>
                        <th>
                            <center>VISITOR TYPE</center>
                        </th>
                        <th>
                            <center>LICENSE PLATE </center>
                        </th>
                        <th>
                            <center>RESIDENT NAME </center>
                        </th>
                        <th>
                        
                    </tr>
                </thead>
                <tbody>
                <@foreach($visits as $visit)
                    <tr>

                        <td>{{ $visit->visit_id }}</td>
                        <td>{{ $visit->name_visitor }}</td>
                        <td>{{ $visit->status_authorisation }}</td>
                        <td>{{ $visit->visitor_type }}</td>
                        <td>{{ $visit->license_plate }}</td>
                        <td>{{ $visit->name }}</td>
                    </tr>
        @endforeach
        </tbody>
        </table>
        </div>


        // SEARCH DATABASE



    </div>
    <!--MAIN CONTAINER BACKGROUND ENDS-->





    <script>
        function test() {
            var table = document.getElementById("residentList");
            var thead = document.getElementsByTagName("thead")[0];
            var tbody = table.getElementsByTagName("tbody")[0];
            var ishigh;

            tbody.onclick = function(e) {
                e = e || window.event;
                var td = e.target || e.srcElement
                var row = td.parentNode;
                if (ishigh && ishigh != row) {
                    ishigh.className = '';
                }
                row.className = row.className === "highlighted" ? "" : "highlighted";
                ishigh = row;

                populateFields(row);
            }

            document.onkeydown = function(e) {
                e = e || event;
                var code = e.keyCode,
                    rowslim = table.rows.length - 2,
                    newhigh;
                if (code === 38) { //up arraow
                    newhigh = rowindex(ishigh) - 2;
                    if (!ishigh || newhigh < 0) {
                        return GoTo('visitList', rowslim);
                    }
                    return GoTo('visitList', newhigh);
                } else if (code === 40) { //down arrow
                    newhigh = rowindex(ishigh);
                    if (!ishigh || newhigh > rowslim) {
                        return GoTo('visitList', 0);
                    }
                    return GoTo('visitList', newhigh);
                }
            }

            function GoTo(id, nu) {
                var obj = document.getElementById(id),
                    trs = obj.getElementsByTagName('TR');
                nu = nu + 1;
                if (trs[nu]) {
                    if (ishigh && ishigh != trs[nu]) {
                        ishigh.className = '';
                    }
                    trs[nu].className = trs[nu].className == "highlighted" ? "" : "highlighted";
                    ishigh = trs[nu];
                }

                populateFields(trs[nu]);
            }

            function rowindex(row) {
                var rows = table.rows,
                    i = rows.length;
                while (--i > -1) {
                    if (rows[i] === row) {
                        return i;
                    }
                }
            }

            function el(id) {
                return document.getElementById(id);
            }


            function populateFields(row) {
                el('visit_id').value = row.cells[0].innerHTML
                el('name_visitor').value = row.cells[1].innerHTML
                el('status_authorisation').value = row.cells[2].innerHTML
                el('visitor_type').value = row.cells[3].innerHTML
                el('license_plate').value = row.cells[4].innerHTML
                el('name_resident').value = row.cells[5].innerHTML
                el('community').value = row.cells[6].innerHTML
                el('lot').value = row.cells[7].innerHTML
                el('address').value = row.cells[8].innerHTML
                





                /*var e = el('visitor_type').options;
                console.log(e)


                
                
                var e = row.cells[1].innerHTML;
                var e = el('visitor_type').options.innerHTML
                    
                
                    
                
                  var e = el('visitor_type').options[4].innerHTML;
                  console.log(e);

                var x = document.getElementById("visitor_type");
                var txt = [];
                var i;
                for (i = 0; i < x.length; i++) {
                    txt = txt + x.options[i].innerHTML +' '
                    
                }
                
                console.log(txt);*/
            }

            function disable_f5(e) {
                if ((e.which || e.keyCode) == 116) {
                    e.preventDefault();
                }
            }

            $(document).ready(function() {
                $(document).bind("keydown", disable_f5);
            });




        }

        function FillInfo(){
            document.forms['submitInfo'].action = "{{ route('entry') }}";
           document.forms['submitInfo'].submit();
        }

        function SubmitInfo(){
            document.forms['submitInfo'].action = "{{ route('entry/store') }}";
           document.forms['submitInfo'].submit();
        }
    </script>


</x-app-layout>