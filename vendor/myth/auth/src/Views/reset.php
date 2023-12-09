<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="login-page dark-mode">
    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void(0)"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <h2 class="card-header"><?=lang('Auth.resetYourPassword')?></h2>
        <div class="card-body login-card-body">

          <p class="login-box-msg"><?=lang('Auth.enterCodeEmailPassword')?></p>
    
          <form action="<?= url_to('reset-password') ?>" method="post">
            <?= csrf_field() ?>
            <div class="input-group mb-3">
              <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?=lang('Auth.token')?>" value="<?= old('token', $token ?? '') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-input-numeric"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?=lang('Auth.newPassword')?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="<?=lang('Auth.newPasswordRepeat')?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary"><?=lang('Auth.resetPassword')?></button>
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
