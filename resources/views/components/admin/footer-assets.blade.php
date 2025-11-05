{{-- Admin Footer Assets - JavaScript Libraries --}}

<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Core JS Files -->
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

<!-- PerfectScrollbar polyfill -->
<script>
  // Provide empty PerfectScrollbar to prevent errors on pages without scrollable containers
  window.PerfectScrollbar = window.PerfectScrollbar || function() {};
</script>

<!-- Chart.js -->
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Material Dashboard JS -->
<script src="{{ asset('js/material-dashboard.js') }}"></script>

<!-- Admin Global JS -->
<script src="{{ asset('js/admin-global.js') }}"></script>
