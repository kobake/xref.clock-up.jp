// スイッチの見た目更新(ON/OFF)
function updateButtonStyles() {
	jQuery('.btn-group label:not(.active)').removeClass('btn-info').addClass('btn-default');
	jQuery('.btn-group label.active').removeClass('btn-default').addClass('btn-info');
}

// 縦横モード反映
function updateMode(){
	var newMode = jQuery('#mode0').prop('checked') ? 0 : 1;
	var oldMode = 1 - newMode;
	jQuery('body').removeClass('current-mode' + oldMode).addClass('current-mode' + newMode);
}

// エンジン選択反映
function updateEngine(){
	var modes = [
		'mysql', 'oracle', 'postgresql', 'sqlite',
		'yum', 'apt', 'rpm', 'gem', 'pear', 'pecl', 'npm', 'pip',
		'cpp', 'csharp', 'java', 'vb', 'php', 'js', 'ruby', 'python', 'perl'
	];
	modes.forEach(function(mode){
		jQuery('body').removeClass('current-engine-' + mode + '-on');
		jQuery('body').removeClass('current-engine-' + mode + '-off');
		if (jQuery('#engine-' + mode).prop('checked')) {
			jQuery('body').addClass('current-engine-' + mode + '-on');
		}
		else{
			jQuery('body').addClass('current-engine-' + mode + '-off');
		}
	});
}

// 初期処理：イベント登録等
jQuery(function(){
	// 初期モード
	var defaultMode = 0;
	for(var i = 0; i < 2; i++){
		jQuery('body').removeClass('current-mode' + i);
		jQuery('#mode' + i).prop('checked', false);
		jQuery('#mode' + i).parent().removeClass('btn-info').removeClass('active').addClass('btn-default');
	}
	jQuery('body').addClass('current-mode' + defaultMode);
	jQuery('#mode' + defaultMode).prop('checked', true);
	jQuery('#mode' + defaultMode).parent().removeClass('btn-default').addClass('btn-info').removeClass('active');
	
	// 縦横スイッチ
	jQuery('#mode-buttons label').click(function(){
		console.log("AAAAAAA");
		setTimeout(function(){
			updateButtonStyles();
			updateMode();			
		}, 0);
	});
	
	// エンジンスイッチ
	jQuery('#engine-buttons label').click(function() {
		setTimeout(function() {
			updateButtonStyles();
			updateEngine();
		}, 0);
	});
	
	// マウスホイール抑制
	var f = function (eo, delta, deltaX, deltaY) {
		var scrollTop = $(this).scrollTop();
		var scrollHeight = $(this).get(0).scrollHeight;
		var height = $(this).height();
		var pad = parseInt($(this).css('padding-top')) + parseInt($(this).css('padding-bottom'));

		if (scrollHeight === 0) {
			return true; // スクロールする
		}

		// 未来のscrollTop
		var newScrollTop = scrollTop - deltaY;

		// スクロール抑制
		// console.log(newScrollTop + "," + height + "," + scrollHeight);
		// console.log((newScrollTop + height) + " > " + scrollHeight + " ?");
		if (newScrollTop + height + pad > scrollHeight) { // 下方向のスクロール抑制
			return false;
		}
		else if (newScrollTop < 0) { // 上方向のスクロール抑制
			return false;
		}
		return true;
	};
	$(".sidebar").mousewheel(f);
	
	/*
	// 目次ツリー
	jQuery(function() {
		jQuery('#side-menu').metisMenu({
			toggle: false
		});
	});
	
	// 初期状態＝全部開き
	$('li.parent-li').addClass('active');
	$('ul.nav-second-level').collapse('show');
	*/
});

function mytext(str){
	return str.replace(/\t/, '&nbsp;&nbsp;&nbsp;&nbsp;');
}
