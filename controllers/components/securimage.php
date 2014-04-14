<?php
class SecurimageComponent extends Object
{
	function startup(&$controller) {
		$this->controller = $controller;
	}

	function render() {
		App::import('Vendor','Securimage');
		$securimage = new Securimage();
		$securimage->ttf_file = VENDORS.'/securimage/MigMix-1P-regular.ttf';
		//$securimage->charset = 'ABCDEFGHKLMNPRSTUVWYZ23456789';
		$securimage->charset = 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやゆよらりるれろわをんがぎぐげござじずぜぞだぢづでど一右雨円王音下火花貝学気九休玉金空月犬見五口校左三山子四糸字耳七車手十出女小上森人水正生青夕石赤千川先早草足村大男竹中虫町天田土二日入年白八百文木本名目立力林六';
		$securimage->image_width = 200;			// 175
		$securimage->image_height = 50; 		// 45
		$securimage->font_size = 45;
		$securimage->code_length = 3;
		$securimage->num_lines = 3;
		$securimage->show();
	}
 
	function checkCaptcha($captcha) {
		App::import('Vendor','Securimage');
		$securimage = new Securimage();
 
		if ($securimage->check($captcha) === false) {
			return false;
		}
		return true;
	}
}
