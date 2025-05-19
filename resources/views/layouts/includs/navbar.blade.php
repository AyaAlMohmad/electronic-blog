<div class="navbar-wrapper">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                    href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item">
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    <img class="brand-logo" alt="Logo" src="{{ asset('assets/logo1.png') }}"
                        style="max-width: 50px; max-height: 50px">

                </a>
            </li>
            <li class="nav-item d-md-none">
                <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                        class="fa fa-ellipsis-v"></i></a>
            </li>
        </ul>
    </div>
    <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
                <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="ft-menu"></i></a></li>
           
                <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                            class="ficon ft-maximize"></i></a></li>
           
            </ul>
            <ul class="nav navbar-nav float-right">
              <li class="dropdown dropdown-language nav-item">
                  <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="flag-icon flag-icon-{{ app()->getLocale() == 'ar' ? 'sa' : 'gb' }}"></i>
                      <span class="selected-language">
                          {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                      </span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{ route('admin.lang.switch', 'en') }}">
                        <i class="flag-icon flag-icon-gb"></i> English
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.lang.switch', 'ar') }}">
                        <i class="flag-icon flag-icon-sa"></i> العربية
                    </a>
                  </div>
              </li>
          
              <li class="dropdown dropdown-user nav-item">
                  <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                      <span class="avatar avatar-online">
                          <img src="{{ asset('app-assets/images/portrait/small/avatar5.png') }}" alt="avatar"><i></i>
                      </span>
                      <span class="user-name">{{ auth()->user()->name }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="{{ route('profile.edit') }}">
                          <i class="ft-user"></i> {{ __('Edit Profile') }}
                      </a>
                      <div class="dropdown-divider"></div>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault(); this.closest('form').submit();">
                              <i class="ft-power"></i> {{ __('Logout') }}
                          </a>
                      </form>
                  </div>
              </li>
          </ul>
          
        </div>
    </div>
</div>
