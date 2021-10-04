<?php include dirname(__FILE__) . '/../Partials/_header.php'; ?>

<h1>Авторизация</h1>

<form method="POST" action="">
    <div class="mb-3">
        <label for="username" class="form-label">Логин</label>
        <input type="text" name="username" class="form-control" id="username" value="<?php echo !empty($username) ? htmlspecialchars($username) : ''; ?>">
        <?php if (!empty($errors['username'])): ?>
        <div class="form-text"><?php echo $errors['username']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo !empty($password) ? htmlspecialchars($password) : ''; ?>">
        <?php if (!empty($errors['password'])): ?>
        <div class="form-text"><?php echo $errors['password']; ?></div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>

<?php include dirname(__FILE__) . '/../Partials/_footer.php'; ?>

