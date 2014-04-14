<?= $form->create() ?>
<?= $form->input('User.username', array('label' => 'ユーザー名')) ?>
<?= $form->end('編集') ?>

<?= $form->create() ?>
<?= $form->input('User.password', array('label' => 'パスワード')) ?>
<?= $form->end('編集') ?>

<hr>

<p>
<?= $html->link('ユーザーを削除する', array('controller' => 'users', 'action' => 'delete'), array('class' => 'confirm')) ?>
</p>