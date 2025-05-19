<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item {{ Route::is('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}">
                <i class="ft-home"></i>
                <span>{{ __('sidebar.dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('admin.sections.index') ? 'active' : '' }}">
            <a href="{{ route('admin.sections.index') }}">
                <i class="ft-bar-chart-2"></i>
                <span>{{ __('sidebar.sections') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('admin.subsections.index') ? 'active' : '' }}">
            <a href="{{ route('admin.subsections.index') }}">
                <i class="ft-list"></i>
                <span>{{ __('sidebar.sub_sections') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('admin.posts.pending') ? 'active' : '' }}">
            <a href="{{ route('admin.posts.pending') }}">
                <i class="ft-file-text"></i>
                <span>{{ __('sidebar.posts') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('admin.about_us.index') ? 'active' : '' }}">
            <a href="{{ route('admin.about_us.index') }}">
                <i class="ft-info"></i>
                <span>{{ __('sidebar.about_us') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Route::is('admin.contact_us.index') ? 'active' : '' }}">
            <a href="{{ route('admin.contact_us.index') }}">
                <i class="ft-phone"></i>
                <span>{{ __('sidebar.contact_us') }}</span>
            </a>
        </li>
        <li class="nav-item has-submenu {{ Route::is('admin.users.*') ? 'active' : '' }}">
            <a href="#">
                <i class="ft-users"></i>
                <span>{{ __('sidebar.users') }}</span>
            </a>
            <ul class="submenu">
                <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="ft-user"></i>
                        <span>{{ __('sidebar.all_users') }}</span>
                    </a>
                </li>
                <li class="{{ Route::is('admin.writers.pending') ? 'active' : '' }}">
                    <a href="{{ route('admin.writers.pending') }}">
                        <i class="fa fa-pencil"></i>
                        <span>{{ __('sidebar.writers') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
