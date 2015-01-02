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
		'yum', 'apt', 'rpm', 'gem', 'pear', 'pecl', 'npm'
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
		console.log("BBBBBBBB");
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
	
	return; // もう以下は必要無い。
	jQuery('td').each(function(){
		var td = jQuery(this);
		var html = td.html();
		// 初期改行除去
		html = html.replace(/^\n/, "");

		// 最終改行除去
		html = html.replace(/\n\t+$/i, "");

		// 一旦配列にする
		var lines = html.split(/\n/);

		// 初期インデント -> baseIndent
		var baseIndent = '';
		if(lines.length > 0){
			var m = lines[0].match(/^\t+/);
			if(m){
				baseIndent = m[0];
			}
		}

		// 構築し直し
		var re = new RegExp("^" + baseIndent);
		html = '';
		lines.forEach(function(line){
			line = line.replace(re, "");
			line = line.replace(/\t/g, "&nbsp;&nbsp;&nbsp;&nbsp;");
			html += line + "<br/>\n";
		});

		// html = html.replace(/\n/g, "<br/>\n");
		//
		// 適用
		td.html(html);
	});
});

function mytext(str){
	return str.replace(/\t/, '&nbsp;&nbsp;&nbsp;&nbsp;');
}
