@if (session('success'))
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
@endif

@if (session('error'))
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    </div>
</div>
@endif