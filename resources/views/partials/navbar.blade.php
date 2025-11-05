<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold gradient-text" href="#home">
            <span class="fs-4">BASE</span>
            <span class="fs-6 text-muted d-block" style="font-size: 0.7rem !important; margin-top: -5px;">Business Acceleration & Support Enterprise</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#programs">Programs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#support">Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#news">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                @auth
                    <li class="nav-item ms-3">
                        <a class="btn btn-primary btn-sm rounded-pill px-4" href="{{ route('admin.dashboard') }}">
                            <i class="material-icons-round align-middle" style="font-size: 18px;">dashboard</i>
                            Dashboard
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
