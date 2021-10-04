<?php include dirname(__FILE__) . '/../Partials/_header.php'; ?>

<h1>Редактировать задачу</h1>

<form method="POST" action="">
    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" name="name" class="form-control" id="name" value="<?php echo !empty($name) ? htmlspecialchars($name) : ''; ?>">
        <?php if (!empty($errors['name'])): ?>
        <div class="form-text"><?php echo $errors['name']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo !empty($email) ? htmlspecialchars($email) : ''; ?>">
        <?php if (!empty($errors['email'])): ?>
        <div class="form-text"><?php echo $errors['email']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_complete" value="1" id="is_complete" <?php echo $is_complete ? 'checked' : ''; ?>>
            <label class="form-check-label" for="is_complete">
                Выполнено
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Задача</label>
        <textarea name="body" class="form-control" id="body" cols="30" rows="10"><?php echo !empty($body) ? htmlspecialchars($body) : ''; ?></textarea>
        <?php if (!empty($errors['body'])): ?>
        <div class="form-text"><?php echo $errors['body']; ?></div>
        <?php endif; ?>
    </div>
    
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>

<?php include dirname(__FILE__) . '/../Partials/_footer.php'; ?>

