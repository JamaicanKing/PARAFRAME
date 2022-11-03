<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <center><b>{{ __('VISITOR MANAGEMENT DASHBOARD  SECURITY VIEW') }}</b></center>
        </h2>


    </x-slot>

    @if (session('status'))
        <div class="alert alert-success">
            {!! session('status') !!}
        </div>
    @endif


    <!--MAIN CONTAINER BACKGROUND BEGINS-->
    <div class=" justify-content-center bg-white row overflow-hidden py-4">

        <!--TRANSPARENT CONTAINER FOR INPUT FIELDS (LEFT & RIGHT COLUMNS) -->
        <div id="topleft" class="p-5 mx-4 col-md-6 bg-white opacity-90 overflow-hidden shadow sm:rounded-lg">

            <form autocomplete="off" name="submitInfo" id="submitInfo" actions="" onsubmit="FillInfo()" method="GET">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    @csrf

                    <input onfocus="this.value=''" class="form-control" type="hidden" style="text-align:left;"
                        name="id_user" id="id_user" placeholder="RESIDENT ID" value="">
                    <label style="color:black">RESIDENT NAME:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text"
                            style="text-align:left;" name="name_resident" id="name_resident"
                            placeholder="NAME OF RESIDENT" value=""></p>

                    <!--LOT NUMBER-->
                    <label style="color:black">LOT NUMBER:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text"
                            style="text-align:left;" name="lot" id="lot" placeholder="NAME OF RESIDENT" value=""></p>
                    <!-- COMMUNITY NAME -->

                    <label style="color:black">{{ __('COMMUNITY NAME :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center"
                            id='community' name='community' onchange="{{ isset($Onchange) }}">
                            <option id='defaultOption' value="">{{ __('SELECT COMMUNITY NAME') }}</option>
                            @if (isset($communities))
                                @foreach ($communities as $community)
                                    <option value="{{ $community->name ?? '' }}">{{ __($community->name ?? '') }}
                                    </option>
                                @endforeach
                            @endif


                        </select>
                        @error('community')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>



                    <!-- STREET ADDRESS -->

                    <label style="color:black">{{ __('STREET ADDRESS :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center"
                            id='address' name='address' onchange="{{ isset($Onchange) }}">
                            <option id='defaultOption' value="">{{ __('SELECT STREET NAME') }}</option>
                            @if (isset($addresses))
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->name ?? '' }}">{{ __($address->name ?? '') }}
                                    </option>
                                @endforeach
                            @endif


                        </select>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>


                    <label style="color:black">VISITOR NAME:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text"
                            style="text-align:left;" name="name_visitor" id="name_visitor" placeholder="NAME OF VISITOR"
                            value=""></p>


                    <label style="color:black">{{ __('VISITOR TYPE :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center"
                            id='visitor_type' name='visitor_type' onchange="{{ isset($Onchange) }}">
                            <option id='defaultOption' value="">{{ __('SELECT VISITOR TYPE') }}</option>
                            @if (isset($visitorTypes))
                                @foreach ($visitorTypes as $visitorType)
                                    <option
                                        {{ isset($selectedId) && $selectedId == $option->id ? 'selected' : '' }}
                                        value="{{ $visitorType->name ?? '' }}">{{ __($visitorType->name ?? '') }}
                                    </option>
                                @endforeach
                            @endif


                        </select>
                        @error('visitorType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>

                    <label style="color:black">{{ __('STATUS AUTHORISATION :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center"
                            id='status_authorisation' name='status_authorisation'
                            onchange="{{ isset($Onchange) }}">
                            <option id='defaultOption' value="">{{ __('SELECT AUTHORISATION STATUS') }}</option>
                            @if (isset($authorisationStatus))
                                @foreach ($authorisationStatus as $authorisationStatus)
                                    <option
                                        {{ isset($selectedId) && $selectedId == $option->id ? 'selected' : '' }}
                                        value="{{ $authorisationStatus->name ?? '' }}">
                                        {{ __($authorisationStatus->name ?? '') }}
                                    </option>
                                @endforeach
                            @endif

                        </select>
                        @error('status_authorisation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>

                    <!-- License Plate -->
                    <label style="color:black">LICENSE PLATE #</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text"
                            style="text-align:left;" name="license_plate" id="license_plate"
                            placeholder="LICENSE PLATE NUMBER" value=""></p>


                    <BR>

                    <center class="col-md-6"><input type="button" onclick="SubmitInfo();return true"
                            class="btn btn-success" value="SUBMIT" />
                    <input type="submit" onclick="FillInfo();return true"
                            class="btn btn-warning" value="SEARCH" /></center>

            </form>





        </div>

        <div class="col-md-6"> </div>


    </div>

    </div>
    <!-- TABLE BEGINS-->
    <div id="table" class="p-1 mx-1 bg-white row  overflow-hidden shadow sm:rounded-lg">
        <div id="residentList">
            <table class="border-separate table table-striped yajra-datatable" value="testme" type="button"
                onclick="test()">

                <thead>
                    <tr>
                        <th>
                            <center>Resident ID</center>
                        </th>
                        <th>
                            <center>Resident NAME</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                        <tr>


                            <td>{{ $resident->id }}</td>
                            <td>{{ $resident->name }}</td>

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
                el('id_user').value = row.cells[0].innerHTML;
                el('name_resident').value = row.cells[1].innerHTML;
                el('lot').value = row.cells[2].innerHTML
                el('address').value = row.cells[3].innerHTML
                el('community').value = row.cells[4].innerHTML





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

        function FillInfo() {
            document.forms['submitInfo'].action = "{{ route('residentEntry') }}";
            document.forms['submitInfo'].submit();
        }

        function SubmitInfo() {
            document.forms['submitInfo'].action = "{{ route('dashboard/store') }}";
            document.forms['submitInfo'].submit();
        }
    </script>


</x-app-layout>
