< x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-yellow-400 leading-tight">
            <center><b>{{ __('VISITOR MANAGEMENT DASHBOARD') }}</b></center>
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

            <form autocomplete="off" method="POST" action="{{ route('dashboard.store') }}">
                <div class=class="d-flex flex-column align-items-center justify-content-center">
                    @csrf

                    <label style="color:yellow">VISITOR NAME:</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="name_visitor" id="name_visitor" placeholder="NAME OF VISITOR" value=""></p>

                    <label style="color:yellow">{{ __('MODE OF TRANSPORTATION :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='visitor_type' name='visitor_type' onchange="{{ (isset($Onchange)) }}">
                            <option id='defaultOption' value="">{{ __('SELECT MODE OF TRANSPORTATION') }}</option>
                            @if(isset($visitorTypes))
                            @foreach ( $visitorTypes as $visitorType )
                            <option {{ (isset($selectedId) && $selectedId == $visitorType->id ) ? 'selected' : '' }} value="{{ $visitorType->name ?? '' }}">{{ __($visitorType->name ?? '' ) }}
                            </option>
                            @endforeach
                            @endif

                        </select>
                        @error('visitor_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>


                    <label style="color:yellow">{{ __('STATUS AUTHORISATION :') }}</label>

                    <p class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id='status_authorisation' name='status_authorisation' onchange="{{ (isset($Onchange)) }}">
                            <option id='defaultOption' value="">{{ __('SELECT AUTHORISATION STATUS') }}</option>
                            @if(isset($authorisationStatus))
                            @foreach ( $authorisationStatus as $authorisationStatus )
                            <option {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }} value="{{ $authorisationStatus->name ?? '' }}">{{ __($authorisationStatus->name ?? '' ) }}
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
                    <label style="color:yellow">LICENSE PLATE #</label>
                    <p class="form-group col-md-6"><input onfocus="this.value=''" class="form-control" type="text" style="text-align:left;" name="license_plate" id="license_plate" placeholder="LICENSE PLATE NUMBER" value=""></p>


                    <BR>

                    <center class="col-md-6"><button type="submit" class="btn btn-success">Submit</button> </center>

            </form>






        </div>

        <div class="col-md-6"> </div>


    </div>

    </div>
    <!-- TABLE BEGINS-->
    <div id="table" class="p-1 mx-1 bg-white row  overflow-hidden shadow sm:rounded-lg">
        <div id="visitList">
            <table class="border-separate table table-striped yajra-datatable" value="testme" type="button" onclick="test()">
                <thead>
                    <tr>
                        <th>
                            <center>VISITOR NAME</center>
                        </th>
                        <th>
                            <center>VISITOR TYPE</center>
                        </th>
                        <th>
                            <center>ENTRY STATUS</center>
                        </th>
                        <th>
                            <center>LICENSE </center>
                        </th>
                        <th>
                            <center>CREATED BY</center>
                        </th>
                        <th>
                            <centeR>CREATED DATE</center>
                        </th>
                        <th>
                            <center>ACTION</center>
                        </th>
                        <th>
                            <center>ACTION</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($visits as $visit)

                        <td>{{ $visit->name }}</td>
                        <td>{{ $visit->visitor_type }}</td>
                        <td>{{ $visit->status_authorisation }}</td>
                        <td>{{ $visit->license_plate }}</td>
                        <td>{{ $visit->user_name }}</td>
                        <td>{{ $visit->created_at }}</td>
                        <td> <a href="{{ route("dashboard.edit",[
                                                                                                'id' => $visit->id,
                                                                                                'visitorname' => $visit->name,
                                                                                                'visitorType' => $visit->visitor_type,
                                                                                                'authorisationStatus' => $visit->status_authorisation,
                                                                                                'licensePlate' => $visit->license_plate
                                                                                            ]) }}">
                                <button role="button" class="btn btn-warning">Edit</button>


                        <td>




                            <form action="{{ route("dashboard.destroy",['id' => $visit->id]) }}" method="POST">
                                @csrf
                                @method("Delete")
                                <button role="button" class="btn btn-danger">Delete</button>
                            </form>

                        </td>
        </div>

        </tr>
        @endforeach
        </tbody>
        </table>



    </div>
    <!--MAIN CONTAINER BACKGROUND ENDS-->





    <script>
        function test() {
            var table = document.getElementById("visitList");
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
                el('name_visitor').value = row.cells[0].innerHTML;
                el('visitor_type').value = row.cells[1].innerHTML
                el('status_authorisation').value = row.cells[2].innerHTML
                el('license_plate').value = row.cells[3].innerHTML



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
    </script>


    </x-app-layout>