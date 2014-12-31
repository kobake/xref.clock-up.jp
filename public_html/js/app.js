function updateMode(){
	// スイッチの見た目
	jQuery('.btn-group label:not(.active)').removeClass('btn-info').addClass('btn-default');
	jQuery('.btn-group label.active').removeClass('btn-default').addClass('btn-info');
	
	// 実際の表示非表示を切り替える
	var newMode = jQuery('#mode0').prop('checked') ? 0 : 1;
	var oldMode = 1 - newMode;
	jQuery('body').removeClass('current-mode' + oldMode).addClass('current-mode' + newMode);
}
jQuery(function(){
	// 縦横スイッチ
	jQuery('.btn-group label').click(function(){
		setTimeout(function(){
			updateMode();			
		}, 0);
	});
	
	// 目次ツリー
	jQuery(function() {
		jQuery('#side-menu').metisMenu({
			toggle: false
		});
	});
	
	// 初期状態＝全部開き
	$('li.parent-li').addClass('active');
	$('ul.nav-second-level').collapse('show');
	
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
