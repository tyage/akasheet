<!DOCTYPE html>
<html lang='ja'>
	<head>
		<meta charset="UTF-8">
		<title><?= $title_for_layout ? $title_for_layout.' - 赤シート++' : '赤シート++' ?></title>
		
		<?= $html->css('reset'); ?>
		<?= $html->css('common'); ?>
		<?= $html->css('hatena') ?>
		
		<?= $html->script('html5'); ?>
		<?= $html->script('cssua'); ?>
		<?= $html->script('http://www.google.com/jsapi'); ?>
		<script type="text/javascript">
			google.load('jquery', '1');
		</script>
		<?= $html->script('jquery.elastic'); ?>
		<?= $html->script('jquery.textarea'); ?>
		<?= $html->script('jquery.tmpl'); ?>
		<?= $html->script('common'); ?>
		<?= $scripts_for_layout ?>
	</head>
	<body>
		<script id="test" type="text/x-jquery-tmpl">
			<div class="test">
				<header>
					<a href="" class="end"></a>
				</header>
				<div class="answer">
					{{if choices}}
						{{each choices}}
							<p class="choice {{if $value === answer}}correct{{/if}}">
								${$value}
							</p>
						{{/each}}
					{{else}}
						<input type="input" class="input" />
					{{/if}}
				</div>
				<footer>
					<nav>
						<input type="button" class="answer" />
						<input type="button" class="next" />
					</nav>
				</footer>
			</div>
		</script>
		<script id="result" type="text/x-jquery-tmpl">
			<div class="result">
				<header>
					<a href="" class="end"></a>
				</header>
				<h3>結果</h3>
				<p>正解：${correct}</p>
				<p>誤答：${wrong}</p>
				<footer>
					<a href="" class="end"></a>
				</footer>
			</div>
		</script>
		
		<div id="SheetDraft" class='clearfix'>
			<p id="SheetDraftSet">下書きに戻す</p>
			<p id="SheetDraftDelete">×</p>
		</div>
		
		<div id='Content'>
			<header id='Header'>
				<h1>
					<? if (empty($title_for_layout)): ?>
						<span class='red'>赤</span>シート<span class='plus'>++</span>
					<? else: ?>
						<?= $title_for_layout ?>
					<? endif ?>
				</h1>
				<nav id='HeaderNav'>
					<ul id='UserNav'>
						<? if(empty($Self)): ?>
							<li><?= $html->link('ログイン', '/users/login/') ?></li>
							<li><?= $html->link('新規登録', '/users/add/') ?></li>
						<? else: ?>
							<li>ようこそ<?= $html->link($Self['User']['username'], '/users/view/'.$Self['User']['id']) ?>さん</li>
							<li><?= $html->link('ログアウト', '/users/logout/') ?></li>
							<li><?= $html->link('編集', '/users/edit/') ?></li>
						<? endif ?>
						<li><?= $html->link('トップページ', '/') ?></li>
					</ul>
					<?= $form->create('Sheet', 
						array('action' => 'index', 'inputDefaults' => array('div' => false, 'label' => false)), 
						$this->params['pass']) ?>
					<?
						if (empty($search)) {
							$search = '';
						}
					?>
					<?= $form->input('Sheet.text', array('type' => 'text', 'value' => $search)) ?>
					<?= $form->submit('検索', array('div' => false)) ?>
					<?= $form->end() ?>
				</nav>
			</header>
			
			<?= $this->Session->flash() ?>
			<?= $content_for_layout ?>
			
			<footer id='Footer'>
				<nav id='FooterNav'>
					<ul>
						<li><?= $html->link('赤シート++', '/') ?></li>
						<li><?= $html->link('最近の投稿', '/sheets/') ?></li>
						<li><?= $html->link('使い方', '/pages/usage/') ?></li>
					</ul>
				</nav>
			</footer>
		</div>
	</body>
</html>
