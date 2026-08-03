<!-- Navbar -->
@php
    $contactTable = Schema::hasTable('contacts') ? 'contacts' : 'contact';
    $hasIsView = Schema::hasColumn($contactTable, 'is_view');
    $unreadMessagesCount = $hasIsView 
        ? DB::table($contactTable)->where('is_view', 0)->count() 
        : 0;
    $unreadMessagesList = $hasIsView 
        ? DB::table($contactTable)->where('is_view', 0)->latest()->limit(4)->get() 
        : collect();
    
    $pendingApptsCount = DB::table('appointments')->where(function($q){
        $q->whereNull('status')->orWhere('status', 'not connected');
    })->count();
@endphp

<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom shadow-sm px-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="pushmenu" href="#" role="button" title="Toggle Sidebar">
                <i class="fas fa-bars fa-lg"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block ml-2">
            <a href="{{ route('frontend.index') }}" class="btn btn-sm btn-outline-primary font-weight-bold" target="_blank" style="border-radius: 20px;">
                <i class="fas fa-external-link-alt mr-1"></i> Visit Website
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        
        <!-- Appointments Quick Notification -->
        <li class="nav-item mr-2">
            <a class="nav-link position-relative text-secondary" href="{{ route('admin.appointment.search') }}" title="Appointments">
                <i class="fas fa-calendar-alt fa-lg text-primary"></i>
                @if($pendingApptsCount > 0)
                    <span class="badge badge-danger navbar-badge font-weight-bold">{{ $pendingApptsCount }}</span>
                @endif
            </a>
        </li>

        <!-- Contact Messages Dropdown -->
        <li class="nav-item dropdown mr-2">
            <a class="nav-link position-relative text-secondary" data-toggle="dropdown" href="#" title="Messages">
                <i class="fas fa-envelope fa-lg text-warning"></i>
                @if($unreadMessagesCount > 0)
                    <span class="badge badge-warning navbar-badge font-weight-bold" style="color: #000 !important;">{{ $unreadMessagesCount }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
                <div class="dropdown-header bg-light font-weight-bold text-dark d-flex justify-content-between align-items-center py-2 px-3">
                    <span><i class="fas fa-comments text-warning mr-1"></i> Contact Messages</span>
                    @if($unreadMessagesCount > 0)
                        <span class="badge badge-warning text-dark">{{ $unreadMessagesCount }} New</span>
                    @endif
                </div>
                <div class="dropdown-divider m-0"></div>
                
                @if($unreadMessagesList->isEmpty())
                    <div class="p-3 text-center text-muted small">
                        <i class="fas fa-check-circle text-success mb-1 d-block" style="font-size: 20px;"></i>
                        No unread contact messages.
                    </div>
                @else
                    @foreach($unreadMessagesList as $msg)
                        <a href="{{ route('admin.messaging.contact.show', $msg->id) }}" class="dropdown-item py-2 px-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 34px; height: 34px; font-weight: bold; flex-shrink: 0;">
                                    {{ strtoupper(substr($msg->name ?? 'C', 0, 1)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark small text-truncate" style="max-width: 130px;">{{ $msg->name ?? 'Visitor' }}</strong>
                                        <span class="text-muted" style="font-size: 10px;">{{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-muted mb-0 small text-truncate" style="max-width: 200px; font-size: 11.5px;">
                                        {{ $msg->message ?? 'No message snippet...' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
                
                <div class="dropdown-divider m-0"></div>
                <a href="{{ route('admin.messaging.contact.index') }}" class="dropdown-item dropdown-footer text-center text-primary font-weight-bold py-2">
                    See All Messages <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </li>

        <!-- Fullscreen Button -->
        <li class="nav-item mr-3 d-none d-md-block">
            <a class="nav-link text-secondary" data-widget="fullscreen" href="#" role="button" title="Full Screen">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center py-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="position-relative mr-2">
                    <img src="{{ $logged_in_user->avatar }}" class="img-circle elevation-1" style="width: 34px; height: 34px; object-fit: cover;" alt="User Avatar">
                    <span class="position-absolute bg-success rounded-circle" style="width: 9px; height: 9px; bottom: 0; right: 0; border: 2px solid #fff;"></span>
                </div>
                <span class="d-none d-md-inline-block font-weight-bold text-dark small">
                    {{ $logged_in_user->name }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow-lg border-0" style="border-radius: 12px; min-width: 210px;">
                <div class="dropdown-header text-center bg-light py-3 border-bottom">
                    <img src="{{ $logged_in_user->avatar }}" class="img-circle mb-2 elevation-1" style="width: 48px; height: 48px; object-fit: cover;" alt="User Avatar">
                    <h6 class="font-weight-bold text-dark mb-0">{{ $logged_in_user->name }}</h6>
                    <small class="text-muted">{{ $logged_in_user->email }}</small>
                </div>

                <div class="py-1">
                    @if ($logged_in_user->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item py-2">
                            <i class="fas fa-tachometer-alt text-primary mr-2"></i> @lang('Administration')
                        </a>
                    @endif

                    @if ($logged_in_user->isUser())
                        <a href="{{ route('frontend.user.dashboard') }}" class="dropdown-item py-2">
                            <i class="fas fa-user-circle text-info mr-2"></i> @lang('Dashboard')
                        </a>
                    @endif

                    <a href="{{ route('frontend.user.account') }}" class="dropdown-item py-2">
                        <i class="fas fa-user-cog text-secondary mr-2"></i> @lang('My Account')
                    </a>

                    <a href="{{ route('admin.setting.general') }}" class="dropdown-item py-2">
                        <i class="fas fa-cog text-warning mr-2"></i> @lang('General Settings')
                    </a>
                </div>

                <div class="dropdown-divider my-0"></div>

                <a href="#" class="dropdown-item text-danger font-weight-bold py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> @lang('Logout')
                    <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
