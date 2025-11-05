<nav class="navbar navbar-main navbar-expand-lg position-fixed top-0 w-100 px-4 py-2 shadow"
     style="background: linear-gradient(90deg, #2A3050 0%, #3A416F 100%); z-index: 1000; height: 50px;">
    <div class="container-fluid">
        <!-- Logo/Brand -->
        @auth
            <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('admin.dashboard') }}">
                <div class="bg-white d-flex align-items-center justify-content-center me-2"
                     style="width: 32px; height: 32px; border-radius: 6px;">
                    <span class="text-dark font-weight-bold" style="font-size: 16px;">B</span>
                </div>
                <span class="font-weight-bold">BASE</span>
            </a>
        @endauth

        <!-- Search Bar (Center) -->
        <div class="flex-grow-1 d-flex justify-content-center">
            <div class="input-group input-group-outline border-radius-md"
                 style="max-width: 450px; width: 100%; background-color: rgba(26, 32, 48, 0.8); border: 1px solid rgba(255,255,255,0.2);">
                <span class="input-group-text bg-transparent border-0 text-white">
                    <i class="material-symbols-rounded opacity-7">search</i>
                </span>
                <input type="text" class="form-control border-0 bg-transparent text-white" placeholder="Search..."
                       style="color: #e5e5e5;">
            </div>
        </div>

        <!-- Right Side Items -->
        <ul class="navbar-nav ms-auto d-flex align-items-center flex-row">
            <!-- Notifications -->
            <li class="nav-item dropdown pe-3">
                <a href="#" class="nav-link text-white position-relative p-2 d-flex align-items-center" id="dropdownNotifications"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-symbols-rounded" style="font-size: 24px;">notifications</i>
                    <span class="position-absolute badge rounded-pill bg-danger"
                          style="top: 5px; right: 0; font-size: 10px; padding: 2px 5px;">
                        3
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0 border-radius-lg" aria-labelledby="dropdownNotifications" style="min-width: 300px; overflow: hidden;">
                    <!-- Header -->
                    <li style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                        <h6 class="text-dark font-weight-bolder d-flex align-items-center mb-0 px-3 py-2">
                            <i class="material-symbols-rounded me-2" style="font-size: 20px;">notifications</i>
                            Notifications
                        </h6>
                    </li>

                    <!-- Body -->
                    <li style="max-height: 300px; overflow-y: auto;">
                        <div class="px-3 py-2">
                            <a class="dropdown-item border-radius-md p-2" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="bg-gradient-info shadow border-radius-md me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="material-symbols-rounded text-white" style="font-size: 20px;">description</i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New application</span> submitted
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="material-symbols-rounded opacity-5" style="font-size: 14px;">schedule</i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item border-radius-md p-2" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="bg-gradient-success shadow border-radius-md me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="material-symbols-rounded text-white" style="font-size: 20px;">check_circle</i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Application approved</span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="material-symbols-rounded opacity-5" style="font-size: 14px;">schedule</i>
                                            2 hours ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item border-radius-md p-2" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="bg-gradient-warning shadow border-radius-md me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="material-symbols-rounded text-white" style="font-size: 20px;">key</i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">License expiring soon</span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="material-symbols-rounded opacity-5" style="font-size: 14px;">schedule</i>
                                            5 hours ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>

                    <!-- Footer -->
                    <li style="border-top: 1px solid #e9ecef;">
                        <div class="text-center py-2">
                            <a class="text-sm font-weight-bold text-dark" href="#" style="text-decoration: none; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                View all notifications
                            </a>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- User Profile -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link text-white d-flex align-items-center pe-0"
                   id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                    @auth
                        <span class="d-none d-sm-inline me-2">{{ auth()->user()->name }}</span>
                        <img src="{{ asset('img/team-4.jpg') }}" alt="{{ auth()->user()->name }}"
                             class="avatar" style="width: 1.875rem; height: 1.875rem; object-fit: cover;">
                    @endauth
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUser">
                    @auth
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.settings.index') }}">
                                <div class="d-flex">
                                    <i class="material-symbols-rounded opacity-5 me-2">settings</i>
                                    <span>Settings</span>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.users.edit', auth()->user()->id) }}">
                                <div class="d-flex">
                                    <i class="material-symbols-rounded opacity-5 me-2">person</i>
                                    <span>Profile</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="#"
                               onclick="event.preventDefault(); document.getElementById('signout-form').submit();">
                                <div class="d-flex">
                                    <i class="material-symbols-rounded opacity-5 me-2">logout</i>
                                    <span>Sign Out</span>
                                </div>
                            </a>
                            <form id="signout-form" method="POST" action="{{ route('admin.signout') }}" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </li>
        </ul>
    </div>
</nav>
