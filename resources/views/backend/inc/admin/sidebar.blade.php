<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ areActiveRoutes(['admin.home'])}}">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="fa fa-tachometer menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Navigations</li>

        <li class="nav-item {{ areActiveRoutes(['vehicles.index','vehicles.create','vehicles.edit'])}}">
            <a class="nav-link" href="{{route('vehicles.index')}}">
                <i class="fa fa-motorcycle menu-icon"></i>
                <span class="menu-title">Vehicles</span>
            </a>
        </li>

        <li class="nav-item {{ areActiveRoutes(['maintenances.index','maintenances.create','maintenances.edit'])}}">
            <a class="nav-link" href="{{route('maintenances.index')}}">
                <i class="fa fa-car-crash menu-icon"></i>
                <span class="menu-title">Maintenances</span>
            </a>
        </li>  

        <li class="nav-item {{ areActiveRoutes(['companies.index','companies.create','companies.edit'])}}">
            <a class="nav-link" href="{{route('companies.index')}}">
                <i class="fa fa-building menu-icon"></i>
                <span class="menu-title">Companies</span>
            </a>
        </li> 

        <li class="nav-item {{ areActiveRoutes(['rentalvehicles.index','rentalvehicles.create','rentalvehicles.edit'])}}">
            <a class="nav-link" href="{{route('rentalvehicles.index')}}">
                <i class="fa fa-motorcycle menu-icon"></i>
                <span class="menu-title">Rental vehicle</span>
            </a>
        </li> 

        
        <li class="nav-item {{ areActiveRoutes(['bills.index','bills.create','bills.edit'])}}">
            <a class="nav-link" href="{{route('bills.index')}}">
                <i class="fas fa-money-check-alt menu-icon"></i>
                <span class="menu-title">Billing & Invoice</span>
            </a>
        </li> 

        <li class="nav-item {{ areActiveRoutes(['bssstations.index','bssstations.create','bssstations.edit'])}}">
            <a class="nav-link" href="{{route('bssstations.index')}}">
                <i class="fas fa-charging-station menu-icon"></i>
                <span class="menu-title">BSS Station</span>
            </a>
        </li>

        <li class="nav-item {{ areActiveRoutes(['evconvertstations.index','evconvertstations.create','evconvertstations.edit'])}}">
            <a class="nav-link" href="{{route('evconvertstations.index')}}">
                <i class="fas fa-tire menu-icon"></i>
                <span class="menu-title">EV Convert Station</span>
            </a>
        </li>
 
    
        <li class="nav-item {{ areActiveRoutes(['companylogs.index'])}}">
            <a class="nav-link" href="{{route('companylogs.index')}}">
                <i class="fa fa-history menu-icon"></i>
                <span class="menu-title">Assing Logs</span>
            </a>
        </li> 
        
    </ul>
</nav>