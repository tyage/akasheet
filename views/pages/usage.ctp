<section>
	<h2>基本</h2>
	
	<p><?= $html->link('トップページ', '/') ?>から以下のように打ちます。</p>
	<? $text = '暗記をするときには?赤?シートを使うとよい。' ?>
	<div class="sheet">
		<pre class='sheet-text plain'><?= $text ?></pre>
	</div>
	<p>投稿すると以下のようなシートが作成されます。</p>
	<? $text = $this->SheetFormat->body(array('Sheet' => array('text' => $text))); ?>
	<div class="sheet">
		<pre class='sheet-text'><?= $text ?></pre>
	</div>
</section>

<section>
	<h2>その他</h2>
	
	<ul>
		<li>はてな記法、wiki記法、Markdown記法に対応</li>
		<li>ユーザー登録することで、作成したシートを管理できます</li>
		<li>タグや本文による検索が可能です</li>
	</ul>
</section>

<section>
	<h2>API</h2>
	
	<?= $html->link('APIの仕様はこちら', '/pages/api/') ?>
</section>

<section>
	<h2>御礼</h2>
	
	<ul>
		<li><a href='//hibana.rgr.jp/'>ヒバナ</a></li>
		<li><a href="http://nimpad.jp/hatenasyntax/">home: README + 簡単な使い方 + サポートする記法 - HatenaSyntaxマニュアル</a></li>
		<li><a href="http://pear.php.net/package/Text_Wiki/">Text_Wiki</a></li>
		<li><a href="http://michelf.com/projects/php-markdown/">PHP Markdown</a></li>
		<li><a href="//cakedc.com/downloads/view/cakephp_tags_plugin">CakePHP Tags Plugin</a></li>
		<li><a href="//cakedc.com/downloads/view/cakephp_search_plugin">CakePHP Search Plugin</a></li>
		<li><a href="http://www.unwrongest.com/projects/elastic/">Elastic - Dynamic Height Textarea Jquery Plugin</a></li>
		<li><a href="http://plugins.jquery.com/project/TextareaTabs">Tabby Tabs in Textareas jQuery Plugin | jQuery Plugins</a></li>
	</ul>
</section>