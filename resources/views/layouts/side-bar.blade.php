<aside class="page-sidebar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">

            <li class="sidebar-list {{request()->routeIs('tasks') ? 'active' : ''}}">
                <a class="sidebar-link" href="javascript:void(0)">
                    <i class="fa-solid fa-list-check"></i>
                    <h6>User Task</h6>
                </a>
                <ul class="sidebar-submenu" style="display: {{request()->routeIs('tasks') ? 'block' : 'none'}};">
                    <li>
                        <a class="{{request()->routeIs('tasks') ? 'active' : ''}}" href="{{ route('tasks') }}">Task List</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
