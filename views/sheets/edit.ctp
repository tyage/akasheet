<?= $form->create() ?>
<?= $form->input('Sheet.text', array('label' => false)) ?>
<div id='sheet-option'>
	<h3 id='option-trigger'>オプション</h3>
	<div id='option-content'>
		<?= $form->input('Sheet.title', array('label' => 'タイトル', 'default' => '無題', 'size' => 40)) ?>
		<?= $form->input('Sheet.method', array('options' => $methods, 'label' => '記法')) ?>
		<?= $form->input('Sheet.tags', array('label' => 'タグ', 'after' => '　（コンマで区切ってください）')) ?>
	</div>
</div>
<?= $form->end('編集') ?>