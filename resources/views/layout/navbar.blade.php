  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          @if ($data->has_pis)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'pis'? 'active': ''}}">
                  <a href="{{route('pis')}}" class="nav-link">कर्मचारी ब्यबस्थापन प्रणाली</a>
              </li>
          @endif
          @if ($data->has_yojana)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'yojana'? 'active': ''}}">
                  <a href="{{route('yojana')}}" class="nav-link">योजना</a>
              </li>
          @endif
          @if ($data->has_nagadi)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'nagadi'? 'active': ''}}">
                  <a href="{{route('nagadi')}}" class="nav-link">नगदी</a>
              </li>
          @endif
          @if ($data->has_sampatikar)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'sampatikar'? 'active': ''}}">
                  <a href="#" class="nav-link">सम्पतिकर</a>
              </li>
          @endif
          @if ($data->has_malpot)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'malpot'? 'active': ''}}">
                  <a href="{{route('malpot')}}" class="nav-link">मालपोत</a>
              </li>
          @endif
          @if ($data->has_dainik)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'dainik'? 'active': ''}}">
                  <a href="#" class="nav-link">दैनिक प्रशासन</a>
              </li>
          @endif
          @if ($data->has_apangata)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'apangata'? 'active': ''}}">
                  <a href="#" class="nav-link">अपांगता</a>
              </li>
          @endif
          @if ($data->has_byabasaye)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'byabasaye'? 'active': ''}}">
                  <a  href="{{route('byabasaye')}}" class="nav-link">ब्यबसाय दर्ता</a>
              </li>
          @endif
          @if ($data->has_naksa)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'naksa'? 'active': ''}}">
                  <a href="#" class="nav-link">नक्सा</a>
              </li>
          @endif
          @if ($data->has_krishi)
              <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'krishi'? 'active': ''}}">
                  <a href="#" class="nav-link">कृषि</a>
              </li>
          @endif
      </ul>

      <!-- Right navbar links -->
      {{-- <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form class="form-inline">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" type="search" placeholder="Search"
                              aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                              class="img-size-50 mr-3 img-circle">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  Brad Diesel
                                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">Call me whenever you can...</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  John Pierce
                                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">I got your message bro</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  Nora Silvester
                                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">The subject goes here</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-envelope mr-2"></i> 4 new messages
                      <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-users mr-2"></i> 8 friend requests
                      <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-file mr-2"></i> 3 new reports
                      <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                  role="button">
                  <i class="fas fa-th-large"></i>
              </a>
          </li>
      </ul> --}}
  </nav>
  <!-- /.navbar -->
