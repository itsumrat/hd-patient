<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
                <img src="assets/img/favicon/logo_terminabfrage.png" width="" height="30" />
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-item {{ request()->is('/besuche/*') || request()->path() == 'besuche' ? 'active' : '' }} open">
            <a href="{{ url('/besuche') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-calendar-clock"></i>
                <div data-i18n="Dashboards">Meine Termine</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('/agb/*') || request()->path() == 'agb' ? 'active' : '' }} open">


            <a class="menu-link" href="/agb">
                <span style="float:left; font-size: 20px; margin: 0 7px;">§</span>
                Unsere AGB´s
            </a>
        </li>

        <li class="menu-item {{ request()->is('/archiv/*') || request()->path() == 'archiv' ? 'active' : '' }} open">


            <a class="menu-link" href="/archiv">
                <span class="mdi mdi-archive-clock" style="float:left; font-size: 20px; margin: 0 7px;"></span>
                Archiv
            </a>
        </li>

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Form Elements">Another Menu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="category.html" class="menu-link">
                        <div data-i18n="Basic Inputs">Sub-menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="product-create.html" class="menu-link">
                        <div data-i18n="Basic Inputs">Sub-menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="product-list.html" class="menu-link">
                        <div data-i18n="Input groups">Sub-menu</div>
                    </a>
                </li>
            </ul>
        </li> --}}

    </ul>

</aside>
