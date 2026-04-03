@if(session('success'))
<div class="alert alert-success alert-dismissible fade show position-fixed"
     style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 320px;"
     role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show position-fixed"
     style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 320px;"
     role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<script>
    setTimeout(function () {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 2000); 
</script>