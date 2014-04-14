<nav>
	<ul>
		<li><?= $paginator->sort('投稿時間順', 'Sheet.created') ?></li>
		<li><?= $paginator->sort('表示回数順', 'Sheet.view') ?></li>
	</ul>
</nav>
<?= $paginator->numbers(true) ?>
<? foreach ($sheets as $sheet): ?>
	<?= $this->element('sheet_list', array('sheet' => $sheet)) ?>
<? endforeach ?>
<?= $paginator->numbers(true) ?>

