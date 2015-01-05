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
		'yum', 'apt', 'rpm', 'gem', 'pear', 'pecl', 'npm',
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
