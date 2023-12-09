<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="login-page dark-mode">
    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void(0)"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
      <h2 class="card-header"><?=lang('Auth.forgotPassword')?></h2>
        <div class="card-body login-card-body">

          <p class="login-box-msg"><?=lang('Auth.enterEmailForInstructions')?></p>
    
          <form action="<?= url_to('forgot') ?>" method="post">
            <?= csrf_field() ?>
            <div class="input-group mb-3">
              <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary"><?=lang('Auth.sendInstructions')?></button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
</div>

<?= $this->endSection() ?>
