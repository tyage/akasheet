<?php
class SheetFormatHelper extends AppHelper {
	var $helpers = array('Html', 'Text', 'Javascript');
	
	function beforeRender() {
		require_once('Format/Wiki.php');
		$this->wiki = new Text_Wiki();
		$this->wiki->setFormatConf("Xhtml", "translate", HTML_SPECIALCHARS);
		
		require_once('Format/HatenaSyntax.php');
		require_once('Format/markdown.php');
	}
	
	function body($sheet, $search = null) {
		$text = $sheet['Sheet']['text'];
		
		if (!empty($sheet['Sheet']['method'])) {
			switch ($sheet['Sheet']['method']) {
				case 1:
					// hatena
					$text = $this->Hatena($text);
					break;
				case 2:
					// wiki
					$text = $this->Wiki($text);
					break;
				case 3:
					// markdown
					$text = $this->Markdown($text);
					break;
			}
		} else {
			$text = h($text);
		}
		
		if ($search) {
			$text = $this->Text->highlight($text, $search);
		}
		
		$text = $this->sheet($text);
		
		return $text;
	}
	function Hatena($text) {
		return HatenaSyntax::render($text);
	}
	function Wiki($text) {
		return $this->wiki->transform($text);
	}
	function Markdown($text) {
		$text = h($text);
		return Markdown($text);
	}
	
	function sheet($text) {
		// ?? choice1 ? choice2 ? choice3 ??
		$pattern = '/\?\?((.|\n)*?)\?\?/';
		$text = preg_replace_callback($pattern, array($this, 'sheetChoice'), $text);
		
		// ?word?
		$pattern = '\?((.|\n)*?)\?';
		$replacement = '<span class="word">\1</span>';
		$text = mb_ereg_replace($pattern, $replacement, $text);
		
		return $text;
	}
	
	function sheetChoice($matches) {
		$choices = array();
		$matches = explode('?', $matches[1]);
		foreach ($matches as $match) {
			$choices[] = trim($match);
		}
		
		$choiceData = $this->Javascript->object($choices);
		$text = '<span class="word" data-choices=\''.$choiceData.'\'>'.$choices[0].'</span>';
		return $text;
	}
}
