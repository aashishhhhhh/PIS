 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ auth()->user()->name }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <li class="nav-item">
                     <a href="{{ route('budget-sources') }}" class="nav-link">
                         <i class="nav-icon fas fa-money-bill"></i>
                         <p>
                             {{ __('बजेट श्रोत') }}
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('plan.index') }}" class="nav-link @yield('plan')">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             {{ __('योजना/कार्यक्रम') }}
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('new-plan') }}" class="nav-link @yield('new_plan')">
                         <i class="fa-solid fa-plus nav-icon"></i>
                         <p>
                             {{ __('नयाँ योजना/कार्यक्रम दर्ता') }}
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('samiti-gathan.index') }}" class="nav-link @yield('tole_bikas_samiti')">
                         <i class="fa-solid fa-users nav-icon"></i>
                         <p>
                             {{ __('समिति गठन') }}
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('plan-operate.index') }}" class="nav-link @yield('operate_plan')">
                         <i class="fa-solid fa-rotate nav-icon"></i>
                         <p>
                             {{ __('योजना संचालन प्रक्रिया') }}
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('setting.list') }}" class="nav-link @yield('setting_yojana')">
                         <i class="fa-solid fa-gears nav-icon"></i>
                         <p>
                             {{ __('मास्टर सेटिङ') }}
                         </p>
                     </a>
                 </li>
                 <li class="nav-item @yield('child_setting')">
                     <a href="#" class="nav-link">
                         <i class="fa-solid fa-gears nav-icon"></i>
                         <p>
                             {{ __('सेटिङ्ग') }}
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item ml-1">
                             <a href="{{ route('setting_bank') }}" class="nav-link @yield('setting_slug')">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>{{ __('बैंक') }}</p>
                             </a>
                         </li>
                         <li class="nav-item ml-1">
                             <a href="{{ route('contingency.index') }}" class="nav-link @yield('setting_contingency')">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>{{ __('कन्टेनजेन्सी') }}</p>
                             </a>
                         </li>
                         @foreach (App\Models\SharedModel\Setting::query()->where('can_be_updated_in_' . session('active_app'), 1)->get()
    as $setting)
                             <li class="nav-item ml-1">
                                 <a href="{{ route('setting', $setting->slug) }}"
                                     class="nav-link @yield($setting->slug)">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>{{ $setting->name }}</p>
                                 </a>
                             </li>
                         @endforeach
                     </ul>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
