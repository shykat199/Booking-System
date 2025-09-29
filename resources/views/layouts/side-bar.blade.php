<aside class="page-sidebar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">

            <li class="sidebar-list {{request()->routeIs('tasks') ? 'active' : ''}}">
                <a class="sidebar-link user-task" href="javascript:void(0)">
                    <i class="fa-solid fa-list-check"></i>
                    <h6>User Task</h6>
                </a>
                <ul class="sidebar-submenu" style="display: {{request()->routeIs('tasks') ? 'block' : 'none'}};">
                    <li>
                        <a class="{{request()->routeIs('tasks') ? 'active' : ''}}" href="{{ route('tasks') }}">Task List</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-list {{ request()->routeIs(['blog','create-blog','save-blog','update-blog','delete-blog']) ? 'active' : '' }}">
                <a class="sidebar-link user-task" href="javascript:void(0)">
                    <i class="fa-solid fa-list-check"></i>
                    <h6>Blog List</h6>
                </a>
                <ul class="sidebar-submenu" style="display: {{ request()->routeIs(['blog','create-blog','save-blog','edit-blog']) ? 'block' : 'none' }};">
                    <li>
                        <a class="{{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Blog List</a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('create-blog') ? 'active' : '' }}" href="{{ route('create-blog') }}">Create Blog</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-list {{request()->routeIs('country') ? 'active' : ''}}">
                <a class="sidebar-link user-task" href="javascript:void(0)">
                    <i class="fa-solid fa-list-check"></i>
                    <h6>Country</h6>
                </a>
                <ul class="sidebar-submenu" style="display: {{request()->routeIs('country') ? 'block' : 'none'}};">
                    <li>
                        <a class="{{request()->routeIs('country') ? 'active' : ''}}" href="{{ route('country') }}">Country List</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
