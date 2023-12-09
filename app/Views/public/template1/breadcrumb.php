<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><?= $breadcrumb; ?></li>
            <li class="breadcrumb-item active"><?= isset($breadcrumb_active) ? $breadcrumb_active : ''; ?></li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->