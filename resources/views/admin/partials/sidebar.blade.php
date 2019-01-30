<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src='{{ asset(getAvatarUser("$loggedUser->avatar")) }}' class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $loggedUser->first_name . ' ' . $loggedUser->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search_all" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat">
						<i class="fa fa-search"></i>
					</button>
				</span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">SIDEBAR MENU</li>

            <li class="active">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span> Dashboard</span>
                </a>
            </li>

            <li class="true">
                <a href="{{ route('get.menu') }}">
                    <i class="fa fa-list"></i>
                    <span> Menu</span>
                </a>
            </li>

            <li class="true">
                <a href="{{ route('get.food') }}">
                    <i class="fa fa-coffee"></i>
                    <span> Food</span>
                </a>
            </li>

            <li class="true">
                <a href="{{ route('get.location') }}">
                    <i class="fa fa-map-signs"></i>
                    <span> Location</span>
                </a>
            </li>
        </ul>
    </section>
</aside>