<?php
$search = null;
if (!empty($this->data['Sheet']['text'])) {
	$search = $this->data['Sheet']['text'];
}
$text = $this->SheetFormat->body($sheet, $search);
?>
<? if ($sheet['Sheet']['method'] == 0): ?>
	<div class='sheet-body'>
		<pre class='sheet-text'><?= $text ?></pre>
	</div>
<? elseif ($sheet['Sheet']['method'] == 1): ?>
	<div class='sheet-body hatena'>
		<div class='day'>
			<div class='body'>
				<div class="sheet-text hatena">
					<?= $text ?>
				</div>
			</div>
		</div>
	</div>
<? elseif ($sheet['Sheet']['method'] == 2): ?>
	<div class='sheet-body wiki'>
		<div class='sheet-text wiki'><?= $text ?></div>
	</div>
<? elseif ($sheet['Sheet']['method'] == 3): ?>
	<div class='sheet-body markdown'>
		<div class='sheet-text markdown'><?= $text ?></div>
	</div>
<? endif ?>
