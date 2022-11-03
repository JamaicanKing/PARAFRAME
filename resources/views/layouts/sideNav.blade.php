<!-- partial:index.partial.html -->
<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <img class="rounded-pill img-fluid" width="65"
            src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148907008/medium/1501685726/enhance"
            alt="">
        <div class="ms-2">
            <h5 class="fs-6 mb-0">
                <a class="text-decoration-none" href="#">
                    <div>{{ Auth::user()->name }}</div>
                </a>
            </h5>
            <p class="mt-1 mb-0">{{ Auth::user()->getRoles()[0] }}</p>
        </div>
    </div>

    <div class="search position-relative text-center px-4 py-3 mt-2">
        <input type="text" class="form-control w-100 border-0 bg-transparent" placeholder="Search here">
        <i class="fa fa-search position-absolute d-block fs-6"></i>
    </div>

    <ul class="categories list-unstyled">
        <li class="">
            <i class="uil-estate"></i><a href="{{ route('dashboard') }}"> Dashboard</a>
        </li>

        <li class="">
            <i class="uil-estate"></i><a href="{{ route('resident.index') }}"> Resident</a>
        </li>

        <!--<li class="">
            <i class="uil-estate"></i><a href=""> Resident</a>
        </li>-->

        
        @if(Auth::user()->hasRole('ADMINISTRATOR|SECURITY'))
        <li class="has-dropdown">
            <i class="uil-estate"></i><a href="#"> Communities</a>
            <ul class="sidebar-dropdown list-unstyled">
                <li>
                    <a class="dropdown-item" href="{{ route('address.index') }}">
                        {{ __('Edit Addresses') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('community.index') }}">
                        {{ __('Edit Communities') }}
                    </a>
                </li>
            </ul>
        </li>

        <li class="has-dropdown">
            <i class="uil-estate fa-fw"></i><a href="#">Visitor Types</a>
            <ul class="sidebar-dropdown list-unstyled">
                <li>
                    <a class="dropdown-item" href="{{ route('authorisationStatus.index') }}">
                        {{ __('Authorisation Statuses') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('visitorType.index') }}">
                        {{ __('Visitor Types') }}
                    </a>
                </li>
            </ul>
        </li>
        @endif

       
       
    </ul>
</aside>
