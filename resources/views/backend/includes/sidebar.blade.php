<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">
    <a class="brand-link" href="{{ route('frontend.index') }}">
        <img src="{{ asset(get_setting('admin_logo')) }}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ app_name() }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <x-utils.link-sidebar :href="route('admin.dashboard')" :text="__('Dashboard')"
                        icon="nav-icon fas fa-tachometer-alt" :active="activeClass(Route::is('admin.dashboard'))"
                        class="nav-link" />
                </li>

                <!-- Appointments -->
                <li class="nav-item">
                    <x-utils.link :href="route('admin.appointment.search')" icon="nav-icon fas fa-calendar-check"
                        class="nav-link" :active="activeClass(Route::is('admin.appointment.*'))"
                        :text="__('Appointments')" />
                </li>

                <!-- Contact Messages -->
                <li class="nav-item">
                    <x-utils.link :href="route('admin.messaging.contact.index')" icon="nav-icon fas fa-envelope"
                        class="nav-link" :active="activeClass(Route::is('admin.messaging.contact.*'))"
                        :text="__('Contact Messages')" />
                </li>

                <!-- Site Settings Dropdown -->
                @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.setting'))
                    <li class="nav-item {{ activeClass(Route::is('admin.setting.*') || Route::is('admin.about.*') || Route::is('admin.area') || Route::is('admin.mission'), 'menu-open') }}">
                        <x-utils.link-sidebar href="#" :text="__('Site Settings')" icon="nav-icon fas fa-cogs"
                            class="nav-link" :active="activeClass(Route::is('admin.setting.*') || Route::is('admin.about.*') || Route::is('admin.area') || Route::is('admin.mission'))" rightIcon="fas fa-angle-left right" />
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.general')" icon="nav-icon fas fa-cog"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.general'))" :text="__('General Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.about.settings')" icon="nav-icon fas fa-info-circle"
                                    class="nav-link" :active="activeClass(Route::is('admin.about.settings'))" :text="__('About Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.about.committee')" icon="nav-icon fas fa-users"
                                    class="nav-link" :active="activeClass(Route::is('admin.about.committee'))" :text="__('Member Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.slider')" icon="nav-icon fas fa-images"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.slider'))" :text="__('Slider Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.service')" icon="nav-icon fas fa-concierge-bell"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.service'))" :text="__('Service Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.area')" icon="nav-icon fas fa-map-marked-alt"
                                    class="nav-link" :active="activeClass(Route::is('admin.area'))" :text="__('Add Service Area')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.testmony')" icon="nav-icon fas fa-quote-left"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.testmony'))" :text="__('Testimony Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.blog')" icon="nav-icon fas fa-blog"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.blog'))" :text="__('Blog Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.faq')" icon="nav-icon fas fa-question-circle"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.faq'))" :text="__('Faq Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.mission')" icon="nav-icon fas fa-bullseye"
                                    class="nav-link" :active="activeClass(Route::is('admin.mission'))" :text="__('Mission Settings')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.setting.gallery')" icon="nav-icon fas fa-photo-video"
                                    class="nav-link" :active="activeClass(Route::is('admin.setting.gallery'))" :text="__('Gallery Settings')" />
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Logs Dropdown -->
                @if ($logged_in_user->hasAllAccess())
                    <li class="nav-item {{ activeClass(Route::is('log-viewer::*'), 'menu-open') }}">
                        <x-utils.link-sidebar href="#" :text="__('Logs')" icon="nav-icon fas fa-list-alt" class="nav-link"
                            :active="activeClass(Route::is('log-viewer::*'))" rightIcon="fas fa-angle-left right" />
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-utils.link :href="route('log-viewer::dashboard')" icon="nav-icon fas fa-chart-line"
                                    class="nav-link" :active="activeClass(Route::is('log-viewer::dashboard'))" :text="__('Dashboard')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('log-viewer::logs.list')" icon="nav-icon fas fa-file-alt"
                                    class="nav-link" :active="activeClass(Route::is('log-viewer::logs.list'))" :text="__('Logs')" />
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>