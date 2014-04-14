<?php
$search = null;
if (!empty($this->data['Sheet']['text'])) {
	$search = $this->data['Sheet']['text'];
}
$sheet['Sheet']['body_html'] = $this->SheetFormat->body($sheet, $search);
?>
<?= $xml->serialize($sheet) ?>