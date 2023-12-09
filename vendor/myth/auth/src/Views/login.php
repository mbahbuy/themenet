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
				<p class="login-box-msg"><?=lang('Auth.loginTitle')?></p>
				
				<form action="<?= url_to('login') ?>" method="post">
					<?= csrf_field() ?>
					<div class="input-group mb-3">
						<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.email')?>" <?php if (old('login')) : ?> value="<?= old('login'); ?>" <?php endif ?> required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
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
					<?php if($config->allowRemembering): ?>
						<div class="row">
							<div class="col-8">
								<div class="icheck-primary">
									<input type="checkbox" name="remember" id="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
									<label for="remember">
										<?=lang('Auth.rememberMe')?>
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-4">
								<button type="submit" class="btn btn-primary"><?=lang('Auth.loginAction')?></button>
							</div>
							<!-- /.col -->
						</div>
					<?php else : ?>
						<div class="row">
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary d-inline"><?=lang('Auth.loginAction')?></button>
							</div>
						</div>
					<?php endif; ?>
				</form>
		
				<?php if ($config->allowRegistration) : ?>
					<p class="mb-1"><a href="<?= url_to('register') ?>"><?=lang('Auth.needAnAccount')?></a></p>
				<?php endif; ?>
				<?php if ($config->activeResetter): ?>
					<p class="mb-0"><a href="<?= url_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a></p>
				<?php endif; ?>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
</div>

<?= $this->endSection() ?>
