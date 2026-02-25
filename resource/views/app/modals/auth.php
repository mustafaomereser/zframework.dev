<script>
    currentModal.find('.modal-title').addClass('w-100').css('font-size', '.9rem');
    currentModal.find('.modal-header').css('padding', '10px');
    modalTitle(currentModal, `
        <div class="nav nav-pills gap-2" role="tablist">
            <div class="nav-item" style="flex: auto;" role="presentation">
                <button class="nav-link active w-100" data-bs-toggle="pill" data-bs-target="#tab-signin" type="button" role="tab" aria-selected="true">
                    <i class="fas fa-sign-in-alt me-1"></i><?= _l('lang.signin') ?>
                </button>
            </div>
            <div class="nav-item" style="flex: auto;" role="presentation">
                <button class="nav-link w-100" data-bs-toggle="pill" data-bs-target="#tab-signup" type="button" role="tab">
                    <i class="fas fa-user-plus me-1"></i><?= _l('lang.signup') ?>
                </button>
            </div>
        </div>
    `);
</script>

<div class="modal-body">

    <!-- Alert strip -->
    <div class="auth-alert d-none" id="authAlert">
        <i class="fas fa-exclamation-circle"></i>
        <span id="authAlertMsg"></span>
    </div>

    <div class="tab-content">

        <!-- Giriş Yap -->
        <div class="tab-pane fade show active" id="tab-signin" role="tabpanel">
            <form id="signin-form" autocomplete="off">
                <?= csrf() ?>

                <div class="auth-field">
                    <label><?= _l('lang.email') ?></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-envelope ai"></i>
                        <input type="email" class="form-control auth-input" name="email"
                            placeholder="ornek@mail.com" required>
                    </div>
                </div>

                <div class="auth-field">
                    <label><?= _l('lang.password') ?></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-lock ai"></i>
                        <input type="password" class="form-control auth-input has-toggle"
                            name="password" id="signin-pw" placeholder="••••••••" required>
                        <button type="button" class="pw-toggle" data-target="signin-pw">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <a href="<?= route('forgot-password') ?>" class="auth-forgot">
                    <?= _l('lang.forgot-password') ?>
                </a>

                <div class="mb-3">
                    <input type="checkbox" name="keep-logged-in" id="keep-logged-in" class="form-check-input">
                    <label for="keep-logged-in" class="auth-check-label"><?= _l('lang.keep-logged-in') ?></label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary w-100 auth-submit" id="signin-btn">
                        <span class="auth-spin"></span>
                        <span class="btn-label">
                            <i class="fas fa-sign-in-alt me-1"></i><?= _l('lang.signin') ?>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Kayıt Ol -->
        <div class="tab-pane fade" id="tab-signup" role="tabpanel">
            <form id="signup-form" autocomplete="off">
                <?= csrf() ?>

                <div class="auth-field">
                    <label><?= _l('lang.username') ?></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-user ai"></i>
                        <input type="text" class="form-control auth-input" name="username"
                            placeholder="kullanici_adi" required>
                    </div>
                </div>

                <div class="auth-field">
                    <label><?= _l('lang.email') ?></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-envelope ai"></i>
                        <input type="email" class="form-control auth-input" name="email"
                            placeholder="ornek@mail.com" required>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <div class="auth-field">
                            <label><?= _l('lang.password') ?></label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-lock ai"></i>
                                <input type="password" class="form-control auth-input has-toggle"
                                    name="password" id="signup-pw" placeholder="••••••••" required>
                                <button type="button" class="pw-toggle" data-target="signup-pw">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="auth-field">
                            <label><?= _l('lang.re-password') ?></label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-lock ai"></i>
                                <input type="password" class="form-control auth-input has-toggle"
                                    name="re-password" id="signup-pw2" placeholder="••••••••" required>
                                <button type="button" class="pw-toggle" data-target="signup-pw2">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                    <label for="terms" class="auth-check-label">
                        <a href="<?= route('terms') ?>"><?= _l('lang.terms') ?></a>
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary w-100 auth-submit" id="signup-btn">
                        <span class="auth-spin"></span>
                        <span class="btn-label">
                            <i class="fas fa-user-plus me-1"></i><?= _l('lang.signup') ?>
                        </span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    // Alert helpers
    function showAuthAlert(msg, type = 'danger') {
        $('#authAlert')
            .removeClass('d-none alert-danger alert-success')
            .addClass('alert alert-' + type + ' show')
            .find('#authAlertMsg').text(msg);
    }

    function clearAuthAlert() {
        $('#authAlert').addClass('d-none').removeClass('alert alert-danger alert-success show');
    }

    // Tab değişince alert temizle
    currentModal.find('[data-bs-toggle="pill"]').on('shown.bs.tab', function() {
        clearAuthAlert();
    });

    // Password toggle — currentModal üzerinden bağla, DOM hazır olsun
    currentModal.on('click', '.pw-toggle', function(e) {
        e.preventDefault();
        var input = currentModal.find('#' + $(this).data('target'));
        var icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Sign In
    $('#signin-form').sbmt((form, btn) => {
        clearAuthAlert();
        $.core.btn.spin(btn);
        $.post(`<?= route('sign-in') ?>`, $.core.SToA(form), e => {
            if (!e.status) {
                $.core.btn.unset(btn);
                showAuthAlert(e.alerts?.[0]?.[1] ?? 'Giriş başarısız.');
            } else {
                currentModal.modal('hide');
                $.system.loadAuthContent();
            }
            $.showAlerts(e.alerts);
        });
    });

    // Sign Up
    $('#signup-form').sbmt((form, btn) => {
        clearAuthAlert();
        var pw = $(form).find('[name="password"]').val();
        var pw2 = $(form).find('[name="re-password"]').val();
        if (pw !== pw2) {
            showAuthAlert('Şifreler eşleşmiyor.');
            return;
        }
        $.core.btn.spin(btn);
        $.post(`<?= route('sign-up') ?>`, $.core.SToA(form), e => {
            if (!e.status) {
                $.core.btn.unset(btn);
            } else {
                clearAuthAlert();
                currentModal.reopen();
            }
            $.showAlerts(e.alerts);
        });
    });
</script>