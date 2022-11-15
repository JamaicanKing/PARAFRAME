<x-app-layout>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            {!! session('status') !!}
        </div>
    @endif

    <!-- Page content -->


    <form method="POST" action="{{ route("resident.store") }}" enctype="multipart/form-data">
        @csrf
        <div>
            <h3>Filled In Resident Detail</h3>
        </div>
        <h6 class="heading-small text-muted mb-4">User information</h6>
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group focused">
                        <label class="form-control-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control form-control-alternative"
                            placeholder="Full name" value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                        <label class="form-control-label" for="email">Email</label>
                        <input type="Email" id="email" name="email"
                            class="form-control form-control-alternative" placeholder="" value="">
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <!-- Address -->
        <h6 class="heading-small text-muted mb-4">Contact information</h6>
        <div class="pl-lg-4">

            <div class="row">
                @include('components.common.dropDown', [
                    'fieldLabel' => 'Communities :',
                    'fieldName' => 'id_communities',
                    'defaultDropDownOption' => 'Please Select Community',
                    'options' => $communities,
                ])


                <label style="color:black">Please select Resident Address</label>
                <div class="form-group col-md-6"><select class="form-control" id='address_id' type="text"
                        style="text=align:center" name="address_id">
                        <option id='defaultOption' value="">Please Select an address</option>
                    </select>
                </div>

                <label class="form-control-label" for="input-first-name">Lot Number</label>
                    <div class="form-group col-md-2">
                        <input type="integer" id="lot_number" name="lot_number"
                            class="form-control form-control-alternative" placeholder="" value="">
                    </div>
                    

            </div>

            <div class="mt-4">
                <x-label for="pin" :value="__('Enter PIN ')" />

                <x-input id="pin" class="block mt-1 w-full" type="password" name="pin" maxlength="4" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="pin" :value="__('Confirm PIN ')" />

                <x-input id="pin_confirmation" class="block mt-1 w-full" type="password" name="pin_confirmation" maxlength="4" required
                    autocomplete="confirmed-new-password" />
            </div>


            <button type="submit" class="m-20 btn btn-primary">Submit</button>

    </form>

    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6 m-auto text-center">
                <div class="copyright">
                    <p>Made By GLC Dashboard </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('id_communities').addEventListener('change', async function() {


            const community_id = document.getElementById('id_communities').value;
            const response = await fetch('http://127.0.0.1:8000/api/api/v1/addresses/' + community_id + '');
            const myJson = await response.json();
            console.log(myJson);
            const select = document.getElementById("address_id");
            while (select.hasChildNodes()) {
                select.removeChild(select.firstChild);
            }
            myJson.forEach(element => {

                opt = document.createElement("option");
                opt.value = element.id;
                opt.textContent = element.name;
                select.appendChild(opt);
            });


        })
    </script>

</x-app-layout>
