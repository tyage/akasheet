$(function() {
	// テキストエリア拡張
	$('textarea').elastic().tabby();
	
	// 単語開閉
	$('.word').click(function() {
		$(this).toggleClass('open');
	});
	
	$('.sheet-open').click(function(e) {
		e.preventDefault();
		$(this).closest('.sheet').find('.word').wordOpen();
	});
	$('.sheet-hide').click(function(e) {
		e.preventDefault();
		$(this).closest('.sheet').find('.word').wordHide();
	});
	$('.sheet-random').click(function(e) {
		e.preventDefault();
		$(this).closest('.sheet').find('.word').each(function() {
			Math.random()*2 > 1 ? $(this).wordOpen() : $(this).wordHide();
		});
	});
	
	// 削除などで確認を行う
	$('.confirm').click(function() {
		if (confirm('本当によろしいですか？')) {
			return true;
		} else {
			return false;
		}
	});
	
	// オプション開閉
	$('#option-trigger').click(function() {
		$(this).toggleClass('open');
		$('#option-content').slideToggle();
	});
	$('#option-content').hide();
	
	// 下書き機能
	$('#SheetAddForm #SheetText, #SheetEditForm #SheetText').keyup(function() {
		if (window.localStorage) {
			var storage = window.localStorage,
				action = $(this).closest('form').attr('action'),
				key = 'akasheet.'+action;
			storage.setItem(key, $(this).val());
		}
	});
	$('#SheetAddForm, #SheetEditForm').each(function() {
		var storage = window.localStorage,
			action = $(this).attr('action'),
			key = 'akasheet.'+action,
			draft = storage.getItem(key);
		if (draft) {
			$('#SheetDraft')
				.data('draft', draft).data('key', key)
				.show().insertBefore($(this).find('#SheetText'));
		}
	});
	$('#SheetDraftSet').click(function() {
		var draft = $(this).closest('#SheetDraft').data('draft');
		$(this).closest('form').find('#SheetText').val(draft).elastic();
		$(this).closest('#SheetDraft').fadeOut();
	});
	$('#SheetDraftDelete').click(function() {
		var key = $(this).closest('#SheetDraft').data('key');
		window.localStorage.removeItem(key);
		$(this).closest('#SheetDraft').fadeOut();
	});
	$('#SheetAddForm, #SheetEditForm').submit(function() {
		var storage = window.localStorage,
			action = $(this).attr('action'),
			key = 'akasheet.'+action;
		// captcha失敗を考慮して消さない
		// storage.removeItem(key);
	});
	
	// テスト機能
	$('.sheet-test').click(function() {
		$(this).closest('.sheet')
			.find('.word').wordHide()
			.end().test();
	});
	$('.test .next').live('click', function() {
		$(this).closest('.sheet').test();
	});
	$('.test .end').live('click', function() {
		$(this).closest('.test').remove();
		$(this).closest('.result').remove();
		$(this).closest('.sheet').find('.word')
			.removeClass('correct wrong solved');
	});
	$('.test .answer').live('click', function() {
		var $test = $(this).closest('.test');
		var choices = $test.data('choices');
		
		$test.addClass('answer');
		if ($choices.length > 0) {
			var answer = $choices.filter('.selected').text();
		} else {
			var answer = $('.input', this).val();
		}
		if (answer === $(this).data('answer')) {
			$test.addClass('correct');
			$(this).data('word').addClass('correct');
		} else {
			$test.addClass('wrong');
			$(this).data('word').addClass('wrong');
		}
	});
});

$.fn.extend({
	wordOpen: function() {
		return this.each(function() {
			$(this).addClass('open');
		});
	},
	wordHide: function() {
		return this.each(function() {
			$(this).removeClass('open');
		});
	},
	test: function() {
		return this.each(function() {
			var $words = $(this).find('.word:not(.solved)');
			if (words) {
				var index = parseInt(words.length * Math.random());
				var $word = $words[index];
				$word.addClass('.solved').viewTest();
			} else {
				$(this).viewResult();
			}
		});
	},
	viewTest: function() {
		return this.each(function() {
			var $sheet = $(this).closest('.sheet');
			$sheet.find('.test').remove();
			
			var answer = $(this).text();
			var choices = $(this).data('choices');
			$('#test').tmpl({
				choices: choices,
				answer: answer
			}).appendTo($sheet)
			.data({
				word: this,
				answer: answer,
				choices: choices
			});
			
			// scroll to Test
		});
	},
	viewResult: function() {
		$('#test-result').tmpl({
			correct: correct,
			wrong: wrong
		}).appendTo(this);
	}
});
