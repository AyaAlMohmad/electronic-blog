<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item {{ Route::is('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}">
                <i class="ft-home"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
     <li class="nav-item {{ Route::is('admin.sections.index') ? 'active' : '' }}">
            <a href="{{ route('admin.sections.index') }}">
                <i class="ft-bar-chart-2"></i>
                <span>{{ __('Sections') }}</span>
            </a>
        </li>
           <li class="nav-item {{ Route::is('admin.subsections.index') ? 'active' : '' }}">
            <a href="{{ route('admin.subsections.index') }}">
                <i class="ft-list"></i>
                <span>{{ __('sub Sections') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Route::is('admin.about_us.index') ? 'active' : '' }}">
            <a href="{{ route('admin.about_us.index') }}">
                <i class="ft-info"></i>
                <span>{{ __('About Us') }}</span>
            </a>
        </li>
          <li class="nav-item {{ Route::is('admin.contact_us.index') ? 'active' : '' }}">
            <a href="{{ route('admin.contact_us.index') }}">
                <i class="ft-info"></i>
                <span>{{ __('Contact Us') }}</span>
            </a>
        </li>
        
    </ul>
</div>
