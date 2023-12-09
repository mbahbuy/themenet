<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="login-page dark-mode">
	<div class="login-box">
		<!-- <div class="login-logo">
				<a href="javascript:void(0)"><b>Admin</b>LTE</a>
		</div> -->
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg"><?=lang('Auth.register')?></p>
				
				<form action="<?= url_to('register') ?>" method="post">
					<?= csrf_field() ?>
					<div class="input-group mb-3">
						<input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?=lang('Auth.email')?>" <?php if (old('email')) : ?> value="<?= old('email'); ?>" <?php endif ?> required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
                    <div class="input-group mb-3">
						<input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" <?php if (old('username')) : ?> value="<?= old('username'); ?>" <?php endif ?> required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
                    <div class="input-group mb-3">
						<input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary d-inline"><?=lang('Auth.register')?></button>
                        </div>
                    </div>
				</form>

                <p><?=lang('Auth.alreadyRegistered')?> <a href="<?= url_to('login') ?>"><?=lang('Auth.signIn')?></a></p>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
</div>

<?= $this->endSection() ?>
