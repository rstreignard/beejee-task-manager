<?php include dirname(__FILE__) . '/../Partials/_header.php'; ?>

<h1>Список задач</h1>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>
                    <?php echo sortableColumn('name', 'Имя'); ?>
                </th>
                <th>
                    <?php echo sortableColumn('email', 'E-Mail'); ?>
                </th>
                <th>Задача</th>
                <th>
                    <?php echo sortableColumn('is_complete', 'Статус'); ?>
                </th>
                <th>Отредактировано</th>
                <?php if (isLoggedIn()): ?>
                <th></th>
                <?php endif; ?>         
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['id']; ?></td>
                    <td><?php echo $task['name']; ?></td>
                    <td><?php echo $task['email']; ?></td>
                    <td><?php echo $task['body']; ?></td>
                    <td>
                        <?php echo $task['is_complete'] ? '<span class="badge bg-success">Выполнено</span>' : '<span class="badge bg-danger">Не выполнено</span>'; ?>
                    </td>
                    <td><?php echo $task['is_modified'] ? '<span class="badge bg-success">Отредактировано</span>' : ''; ?></td>
                    <?php if (isLoggedIn()): ?>
                    <td class="d-grid gap-2">
                        <a class="btn btn-sm btn-primary" href="/tasks/<?php echo $task['id']; ?>/edit">Редактировать</a>
                        <a class="btn btn-sm btn-danger" href="/tasks/<?php echo $task['id']; ?>/delete">Удалить</a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination justify-content-end">
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo '?orderBy='.$orderBy.'&order='.$order.'&page='.$page; ?>">
                    <?php echo $page; ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>


</div>  

<?php include dirname(__FILE__) . '/../Partials/_footer.php'; ?>

