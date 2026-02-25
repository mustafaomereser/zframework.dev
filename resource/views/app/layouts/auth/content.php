<?php if (\zFramework\Core\Facades\Auth::check()) : ?>
    <div class="nav-avatar" id="navAvatarBtn" title="Hesabım"><?= strtoupper(substr(\zFramework\Core\Facades\Auth::user()['username'], 0, 2)) ?></div>
    <div class="user-dropdown" id="userDropdown">
        <div class="user-dropdown-header">
            <div class="user-dropdown-name"><?= \zFramework\Core\Facades\Auth::user()['username'] ?></div>
            <div class="user-dropdown-email"><?= \zFramework\Core\Facades\Auth::user()['email'] ?></div>
        </div>
        <a href="#" class="user-dropdown-item">
            <span class="dd-icon"><i class="fas fa-user"></i></span>Profilim
        </a>
        <a href="#" class="user-dropdown-item">
            <span class="dd-icon"><i class="fas fa-pen-alt"></i></span>Konularım
        </a>
        <a href="#" class="user-dropdown-item">
            <span class="dd-icon"><i class="fas fa-bookmark"></i></span>Kaydettiklerim
        </a>
        <div class="user-dropdown-sep"></div>
        <a href="#" class="user-dropdown-item">
            <span class="dd-icon"><i class="fas fa-cog"></i></span>Ayarlar
        </a>
        <div class="user-dropdown-sep"></div>
        <a href="javascript:;" class="user-dropdown-item danger" onclick="$.system.signout(this);">
            <span class="dd-icon"><i class="fas fa-sign-out-alt"></i></span><?= _l('lang.signout') ?>
        </a>
    </div>
    <script>
        $(() => {
            const navUser = document.getElementById('auth-content');
            const navAvatarBtn = document.getElementById('navAvatarBtn');
            const userDropdown = document.getElementById('userDropdown');

            function openDropdown() {
                navUser.classList.add('open');
            }

            function closeDropdown() {
                navUser.classList.remove('open');
            }

            function toggleDropdown() {
                navUser.classList.toggle('open');
            }

            navAvatarBtn.addEventListener('click', e => {
                e.stopPropagation();
                toggleDropdown();
            });
            document.addEventListener('click', e => {
                if (!navUser.contains(e.target)) closeDropdown();
            });
        });
    </script>
<?php else : ?>
    <a class="btn-new" data-modal="<?= route('auth-form') ?>"><?= _l('lang.signin') ?></a>
<?php endif ?>