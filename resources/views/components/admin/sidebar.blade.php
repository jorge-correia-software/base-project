<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white"
       id="sidenav-main" style="top: 50px; bottom: 8px; margin-top: 8px; overflow: hidden; z-index: 1000;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    </div>
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="padding-top: 1rem;">
        <ul class="navbar-nav">
            @auth
                {{-- BASE Admin Menu --}}
                <li class="nav-item text-uppercase text-xs text-secondary fw-bold mb-2 px-4">Interface</li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.dashboard')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.dashboard') }}">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <!-- Content Management -->
                <li class="nav-item text-uppercase text-xs text-secondary fw-bold mb-2 mt-3 px-4">Content Management</li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.pages.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.pages.index') }}">
                        <i class="material-symbols-rounded opacity-5">description</i>
                        <span class="nav-link-text ms-1">Pages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.posts.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.posts.index') }}">
                        <i class="material-symbols-rounded opacity-5">article</i>
                        <span class="nav-link-text ms-1">Posts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.categories.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.categories.index') }}">
                        <i class="material-symbols-rounded opacity-5">category</i>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.tags.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.tags.index') }}">
                        <i class="material-symbols-rounded opacity-5">label</i>
                        <span class="nav-link-text ms-1">Tags</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.media.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.media.index') }}">
                        <i class="material-symbols-rounded opacity-5">perm_media</i>
                        <span class="nav-link-text ms-1">Media Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.menus.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.menus.index') }}">
                        <i class="material-symbols-rounded opacity-5">menu</i>
                        <span class="nav-link-text ms-1">Menus</span>
                    </a>
                </li>

                <!-- BASE Features -->
                <li class="nav-item text-uppercase text-xs text-secondary fw-bold mb-2 mt-3 px-4">BASE Features</li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.hero-sections.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.hero-sections.index') }}">
                        <i class="material-symbols-rounded opacity-5">view_carousel</i>
                        <span class="nav-link-text ms-1">Hero Sections</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.programs.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.programs.index') }}">
                        <i class="material-symbols-rounded opacity-5">rocket_launch</i>
                        <span class="nav-link-text ms-1">Programs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.support-areas.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.support-areas.index') }}">
                        <i class="material-symbols-rounded opacity-5">support</i>
                        <span class="nav-link-text ms-1">Support Areas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.testimonials.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.testimonials.index') }}">
                        <i class="material-symbols-rounded opacity-5">format_quote</i>
                        <span class="nav-link-text ms-1">Testimonials</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.contact-submissions.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.contact-submissions.index') }}">
                        <i class="material-symbols-rounded opacity-5">mail</i>
                        <span class="nav-link-text ms-1">Contact Submissions</span>
                    </a>
                </li>

                <!-- System -->
                <li class="nav-item text-uppercase text-xs text-secondary fw-bold mb-2 mt-3 px-4">System</li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.users.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.users.index') }}">
                        <i class="material-symbols-rounded opacity-5">people</i>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-4 @if(request()->routeIs('admin.roles.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.roles.index') }}">
                        <i class="material-symbols-rounded opacity-5">shield</i>
                        <span class="nav-link-text ms-1">Roles & Permissions</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 pb-2">
        <ul class="navbar-nav">
            <li class="nav-item mb-2">
                @auth
                    <a class="nav-link ps-4 pt-2 pb-2 @if(request()->routeIs('admin.settings.*')) active bg-gradient-dark text-white @else text-dark @endif" href="{{ route('admin.settings.index') }}">
                        <i class="material-symbols-rounded opacity-5">settings</i>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                @endauth
            </li>
        </ul>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="mx-3 text-center mb-3">
            <span class="text-xs text-dark opacity-5">BASE CMS v1.0.0</span>
        </div>
    </div>
</aside>
