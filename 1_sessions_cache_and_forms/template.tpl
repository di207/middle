 <div class="container mt-5">
    <div class="row">
        <div class="col-sm">
            <div class="list-group">
                <a href="/" class="list-group-item list-group-item-action">Назад</a>
                <a href="/1_sessions_cache_and_forms/" class="list-group-item list-group-item-action active">1. Сессии, кеши, сложные формы</a>
                <a href="/2_try_catch_simple_classes/" class="list-group-item list-group-item-action">2. Трай, кетч, простые классы </a>
                <a href="/3_trait_interface_class_inheritance/" class="list-group-item list-group-item-action">3. Трейты, интерфейсы, наследование классов</a>
                <a href="/4_code_review/" class="list-group-item list-group-item-action">4. Code review</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm">
            <div class="col-md-5 mx-auto">
                <form class="form-login" id="form-login" method="post" action="">
                    <?php if (isset($_SESSION['fails']) && count($_SESSION['fails']) > 0) { ?>
                        <?php foreach ($_SESSION['fails'] as $fail) { ?>
                            <p class="text-danger"><?php echo $fail; ?></p>
                        <?php } ?>
                    <?php } ?>

                    <h2 class="form-login-heading text-center">Login</h2>

                    <input type="hidden" name="action" value="login" />

                    <div class="form-group">
                        <label for="login">Enter your email</label>
                        <input id="login" type="text" class="form-control" name="email" required/>
                    </div>

                    <div class="form-group">
                        <label for="input-password">Enter your password</label>
                        <input id="input-password" type="password" class="form-control" name="password" value="" required/>
                    </div>

                    <?php if ($_SESSION['validation'] == 'sms') { ?>
                    <div class="form-group">
                        <label for="sms">Enter code from SMS (in demo mode default is: <?php echo CHECK_SMS;?> )</label>
                        <input id="sms" type="text" class="form-control" name="sms" value="<? (isset($_POST['email'])? $_POST['email']:'' ?>" required/>
                    </div>
                    <?php } elseif ($_SESSION['validation'] == 'email') { ?>
                    <div class="form-group">
                        <label for="code_email">Enter code from EMAIL (in demo mode default is: <?php echo CHECK_EMAIL;?> )</label>
                        <input id="code_email" type="text" class="form-control" name="code_email" value="" required/>
                    </div>
                    <?php } elseif ($_SESSION['validation'] == 'captcha') { ?>
                    <div class="form-group">
                        <label for="captcha">Enter code from CAPTCHA (in demo mode default is: <?php echo CHECK_CAPTCHA;?> )</label>
                        <input id="captcha" type="text" class="form-control" name="captcha" value="" required/>
                    </div>
                    <?php } ?>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

