
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview @yield('menu_show_faculty') ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            कर्मचारी विवरण
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: @yield('s_child_faculty')">
                        <li class="nav-item">
                            <a href="{{ route('staff_form') }}" class="nav-link @yield('new_staff')">
                                <i class="far fa-circle nav-icon"></i>
                                <p> नयाँ कर्मचारी</p>
                            </a>
                        </li>

                       @hasanyrole('cao|admin')
                        <li class="nav-item">
                            <a href="{{route('staff-search')}}" class="nav-link @yield('staff_search')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>कर्मचारी खोज</p>
                            </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{ route('staff-reg-request-list') }}" class="nav-link @yield('staff_new_reg')">
                               <i class="far fa-circle nav-icon"></i>
                               <p> नयाँ कर्मचारी दर्ता अनुरोध सुची</p>
                           </a>
                       </li>
                        @endrole

                        <li class="nav-item">
                            <a href="{{ route('my-sheetroll',auth()->user()->id) }}" class="nav-link @yield('staff_details')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>विवरण हेर्नुहोस</p>
                            </a>
                        </li>


                        {{-- <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>कर्मचारी रवाना/अवकास सुची</p>
                            </a>
                        </li> --}}


                    </ul>
                </li>




           
               <li class="nav-item has-treeview @yield('menu_show_anurodh')">
                <a href="#" class="nav-link">
                    <i class="fa-light fa-arrow-left"></i>  
                    <p>
                    अनुरोध
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: @yield('s_child_slider')">


                    <li class="nav-item has-treeview @yield('menu_show_bida')">
                        <a href="#" class="nav-link">
                         <i class="fa-solid fa-file"></i>
                           <p>
                            विदाको निवेदन
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: @yield('s_child_slider')">
                            <li class="nav-item">
                                <a href="{{route('leave-application')}}" class="nav-link @yield('leave_application')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>विदाकोलागी निवेदन</p>
                                </a>
                            </li>
     
                            @hasanyrole('cao|admin')
                            <li class="nav-item">
                                <a href="{{route('leave-approval')}}" class="nav-link @yield('leave_approval')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>विदाकोलागी स्वीकृति</p>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </li>

                    <li class="nav-item has-treeview @yield('menu_show_maag_form')">
                        <a href="#" class="nav-link">
                         <i class="fa-solid fa-file"></i>
                           <p>
                            माग फारम
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: @yield('s_child_maag')">
                            <li class="nav-item">
                                <a href="{{route('buy-maag-form')}}" class="nav-link @yield('maag_form')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>माग फारम भर्नुहोस</p>
                                </a>
                            </li>
     
                            <li class="nav-item">
                                <a href="{{ route('maag-form-list') }}" class="nav-link @yield('search_maag_form')">
                                    <i class="far fa-circle nav-icon"></i>
                                   <p>माग फारम सुची</p>
                               </a>
                           </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview @yield('menu_show_marmat_aadesh')">
                        <a href="#" class="nav-link">
                           <i class="fas fa-tools"></i>
                           <p>
                                मर्मत आदेश
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: @yield('s_child_marmat')">
                            <li class="nav-item">
                                <a href="{{route('marmat-aadesh-form')}}" class="nav-link @yield('marmat_form')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>मर्मत आदेश फारम भर्नुहोस</p>
                                </a>
                            </li>
    
                            <li class="nav-item">
                               <a href="{{route('marmat-form-list')}}" class="nav-link @yield('marmat_form_list')">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>मर्मत आदेश सुची</p>
                               </a>
                           </li>
                        </ul>
                    </li>



                    <li class="nav-item has-treeview @yield('menu_show_bhramad') ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bus"></i>
                            <p>
                                भ्रमण प्रतिवेदन
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: @yield('s_child_bhraman')">
     
                            {{-- <li class="nav-item">
                                <a href="{{route('bhraman-aadesh-form')}}" class="nav-link @yield('bhramad_aadesh_form')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>भ्रमण आदेश फारम भर्नुहोस</p>
                                </a>
                            </li> --}}
     
                            <li class="nav-item">
                                <a href="{{route('bhraman-list')}}" class="nav-link @yield('bhramad_aadesh_list')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>भ्रमण</p>
                                </a>
                            </li>
     {{-- 
                            <li class="nav-item">
                                <a href="{{route('bhraman-kharcha-form')}}" class="nav-link @yield('bhramad_kharcha_bill')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>भ्रमण खर्च विल</p>
                                </a>
                            </li> --}}
     
                            {{-- <li class="nav-item">
                                <a href="{{route('bhraman-pratiwedan-form')}}" class="nav-link @yield('bhramad_form')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>भ्रमण प्रतिवेदन फारम भर्नुहोस</p>
                                </a>
                            </li> --}}
     
                            {{-- <li class="nav-item">
                                <a href="{{route('bhraman-pratiwedan-list')}}" class="nav-link @yield('bhramad_list')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>भ्रमण प्रतिवेदन सुची </p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
     

                  
                </ul>
            </li>

                                <li class="nav-item has-treeview @yield('menu_show_task') ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-briefcase"></i>
                           <p>
                                कार्य
                            <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: @yield('s_child_task')">
                            <li class="nav-item">
                               <a href="{{route('task-list')}}" class="nav-link @yield('task_list')">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>कार्य सुची</p>
                               </a>
                           </li>
                        </ul>
                    </li>


             



               
               @hasanyrole('cao|admin')

                <li class="nav-item {{ (request()->is('setting*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            सेट्टिङ्स
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($data as $setting)
                            <li class="nav-item">
                                <a href="{{ route('setting',[$setting->slug]) }}" class="nav-link {{ (request()->is('setting/'. $setting->slug)) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{$setting->name}}</p>
                                </a>
                            </li>
                        @endforeach

                        <li class="nav-item">
                           <a href="{{route('leave-setting')}}" class="nav-link ">
                               <i class="far fa-circle nav-icon"></i>
                               <p>बिदा</p>
                           </a>
                       </li>

                       @foreach ($pis_settings as $item)
                       <li class="nav-item">
                           <a href="{{route('pis-setting',$item->id)}}" class="nav-link ">
                               <i class="far fa-circle nav-icon"></i>
                               <p>{{$item->name}}</p>
                           </a>
                       </li>
                       @endforeach

                       <li class="nav-item">
                           <a href="{{route('setting-bhatta')}}" class="nav-link ">
                               <i class="far fa-circle nav-icon"></i>
                               <p>भत्ता</p>
                           </a>
                       </li>

                    </ul>
                </li>
                @endrole
                {{-- <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                        <i class="far fa-file nav-icon"></i>
                        <p>रिपोर्ट</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
