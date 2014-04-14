<header class="sheet-header clearfix">
	<h3 class='sheet-title'>
		<?= $html->link($sheet['Sheet']['title'], '/sheets/view/'.$sheet['Sheet']['id']) ?>
	</h3>
	<p class='sheet-user'>
		<? if (!empty($sheet['User']['id'])): ?>
			<?= $html->link($sheet['User']['username'], '/users/view/'.$sheet['User']['id'], array('class' => 'sheet-user')) ?>
		<? endif ?>
	</p>
	<div class="sheet-action">
		<ul class="inline">
			<? if ($Self and $Self['User']['id'] === $sheet['User']['id']): ?>
				<li><?= $html->link('編集', array('controller' => 'sheets', 'action' => 'edit', $sheet['Sheet']['id'])) ?></li>
				<li><?= $html->link('削除', array('controller' => 'sheets', 'action' => 'delete', $sheet['Sheet']['id']), array('class' => 'confirm')) ?></li>
			<? endif ?>
			<li><?= $html->link('フォーク', array('controller' => 'sheets', 'action' => 'fork', $sheet['Sheet']['id'])) ?></li>
			<li><a href="#" class='sheet-open'>全て開く</a></li>
			<li><a href="#" class='sheet-hide'>全て隠す</a></li>
			<li><a href="#" class='sheet-random'>ランダム</a></li>
		</ul>
	</div>
</header>

<?= $this->element('sheet_body', array('sheet' => $sheet)) ?>

<footer class='sheet-footer'>
	<nav class='sheet-tags'>
		<? foreach ($sheet['Tag'] as $tag): ?>
			[
			<?= $html->link($tag['name'], array('controller' => 'sheets', 'action' => 'index', 'tags' => $tag['name'])) ?>
			]
		<? endforeach ?>
	</nav>
	<span class='sheet-view'>(<?= $sheet['Sheet']['view'] ?>view)</span>
	<time class='sheet-time'><?= $sheet['Sheet']['created'] ?></time>
</footer>
