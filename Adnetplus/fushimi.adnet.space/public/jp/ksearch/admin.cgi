#!/usr/local/bin/perl

#┌─────────────────────────────────
#│ KEY SEARCH : admin.cgi - 2012/12/15
#│ Copyright (c) KentWeb
#│ http://www.kent-web.com/
#└─────────────────────────────────

# モジュール宣言
use strict;
use CGI::Carp qw(fatalsToBrowser);
use lib "./lib";
use Jcode;

# Jcodeオブジェクト
my $j = new Jcode;

# 設定ファイル認識
require "./init.cgi";
my %cf = &init;

# データ受理
my %in = &parse_form;

# 認証
&check_passwd;

# 管理モード
my (%upd,%noc,%chg,%new);
if ($in{conf_idx}) { &conf_idx; }
if ($in{mode_log}) { &mode_log; }
&mode_idx;

#-----------------------------------------------------------
#  インデックス管理
#-----------------------------------------------------------
sub mode_idx {
	# インデックス更新
	if ($in{mkidx} or $in{check}) {
		&check_input;
		&make_index;

	# 設定のみ保存
	} elsif ($in{save_set}) {
		&check_input;
		&save_set;
	}

	# 設定ファイル読み取り
	open(IN,"$cf{datadir}/set.dat") or error("open err: set.dat");
	my @set = <IN>;
	close(IN);

	# 更新日等
	my ($upd,$all) = split(/<>/, $set[0]);

	# 設定ファイル分解
	my ($dir,$url,$ext,$nodir,$nod2) = split(/<>/, $set[1]);
	$ext =~ s/\\//g;

	&header("インデックス管理");
	&menu_btn;
	print <<EOM;
<div class="body">
<p class="ttl">■ インデックス管理</p>
<ul>
<li>各内容を入力し（<span class="red">＊</span>は入力必須）、「チェック」ボタンで確認します。
<li>最後に「作成開始」ボタンを押してください。
</ul>
<form action="$cf{admin_cgi}" method="post">
<input type="hidden" name="pass" value="$in{pass}">
<table class="form-tbl">
<tr>
	<th>現状のインデックス</th>
	<td>
		更新日： <b>$upd</b><br>
		文書数： <b>$all</b>ファイル<br>
		<input type="submit" name="conf_idx" value="内容確認">
		（現状のインデックス内容を確認）
	</td>
</tr><tr>
	<th>(1)対象ディレクトリ <span class="red">＊</span></th>
	<td>
		（例 ../）プログラム位置からのパス。通常はトップページを指定。<br>
		<input type="text" name="dir" value="$dir" size="65">
	</td>
</tr><tr>
	<th>(2)対象ディレクトリのURL <span class="red">＊</span></th>
	<td>
		（例 http://www.example.com/）(1)で指定するURL<br>
		<input type="text" name="url" value="$url" size="65">
	</td>
</tr><tr>
	<th>(3)対象ファイルの拡張子 <span class="red">＊</span></th>
	<td>
		（例 .html .htm）ドットから書く。スペースで挿み複数可<br>
		<input type="text" name="ext" value="$ext" size="65">
	</td>
</tr><tr>
	<th>(4)非対象ディレクトリ<br>（パス付き）</th>
	<td>
		（例 ../private/）プログラム位置からのパス。スペースで挿み複数可<br>
		<input type="text" name="nodir" value="$nodir" size="65">
	</td>
</tr><tr>
	<th>(5)非対象ディレクトリ<br>（ディレクトリ名のみ）</th>
	<td>
		（例 private）ディレクトリ名のみ指定。スペースで挿み複数可<br>
		<input type="text" name="nodir2" value="$nod2" size="65">
	</td>
</tr>
</table>
<input type="submit" name="check" value="チェック">
&nbsp; → &nbsp;
<input type="submit" name="mkidx" value="作成開始">
&nbsp;
（「チェック」で対象ファイルを確定し、最後に「作成開始」ボタンを押す）
</form>
<div class="notes">
留意事項
<ul>
<li>ドット2つは、1つ上のディレクトリを意味します。
	<ul>
	<li>1つ上のディレクトリ → ../
	<li>2つ上のディレクトリ → ../../
	</ul>
<li>例 : ksearch.cgiがトップページの1つ下にある場合
	<ul>
	<li>index.html（トップ）<br>└ search / search.cgi
	<li>「対象ディレクトリ」は「../」、「対象ディレクトリのURL」は「HPトップのURL」を書く。
	</ul>
<li>「非対象ディレクトリ」では、(4)がファイルを直接指定するのに対して、(5)はディレクトリ名を指定するのみ。
	書きやすい方で記述してください。両方指定してもよい。
</ul>
</div>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  インデックス作成
#-----------------------------------------------------------
sub make_index {
	$in{dir} =~ s|/$||;
	$in{url} =~ s|/$||;
	my $nodir = $in{nodir};

	$in{ext} =~ s/\s+/ /g;
	$in{ext} =~ s/^\s//g;
	$in{ext} =~ s/\s$//g;
	$in{ext} =~ s/\./\\\./g;
	$nodir   =~ s/\s+/ /g;
	$nodir   =~ s/^\s//g;
	$nodir   =~ s/\s$//g;

	# 非対象ディレクトリ
	my %nod;
	foreach ( split(/\s+/, $in{nodir}) ) {
		s|/$||;
		$nod{$_}++;
	}
	my %nod2;
	foreach ( split(/\s+/, $in{nodir2}) ) {
		$nod2{$_}++;
	}

	# 作成のとき
	if ($in{mkidx}) {

		# インデックスを読み込む
		%upd = ();
		open(DAT,"$cf{datadir}/index.dat") or error('open err: index.dat');
		while(<DAT>) {
			my ($page,$time,undef,undef) = split(/\t/);

			# 各ファイルの時間を覚えておく
			$upd{$page} = $time;
		}
		close(DAT);
	}

	# 対象ディレクトリを読み取る
	opendir(DIR, "$in{dir}");
	my @dir = readdir(DIR);
	closedir(DIR);

	# バッファリング停止
	$| = 1;

	# ヘッダー
	&header('インデックス更新');
	print "<p>処理を開始しました。</p>\n";
	print "<ol>\n" if ($in{check});

	# アラーム開始
	$SIG{ALRM} = \&handler;
	alarm 10;

	# 内部要素展開
	foreach (@dir) {
		next if ($_ eq '.');
		next if ($_ eq '..');

		# 対象をパス付で定義
		my $dir = "$in{dir}/$_";
		my $pat = "/$_";

		# ディレクトリのとき
		if (-d $dir) {

			# 非対象ディレクトリならスキップ
			next if (defined($nod{$dir}));
			next if (defined($nod2{$_}));

			# 再帰を繰り返す
			&opendir($dir,$pat);

		# ファイルのとき
		} else {
			# 中身解析
			&openfil($dir,$pat);
		}
	}

	# アラーム解除
	alarm 0;

	# 作成のとき
	if ($in{mkidx}) {

		# 一時ファイルへ書き出す
		my ($noc,$chg,$new,$del) = (0,0,0,0);
		open(IN,"$cf{datadir}/index.dat") or error("open err: index.dat");
		open(OUT,"+> $cf{tempdir}/$$.dat") or error("write err: $$.dat");
		while(<IN>) {
			my ($page,undef,undef,undef) = split(/\t/);

			# 既存あり且つ更新なし
			if ($noc{$page}) {
				$noc++;
				print OUT $_;

			# 既存あり且つ更新あり（差し替え)
			} elsif (defined($chg{$page})) {
				$chg++;
				print OUT $chg{$page};

			# 削除
			} else {
				$del++;
			}
		}

		# 新規追加分
		foreach ( keys %new ) {
			$new++;
			print OUT $new{$_};
		}
		close(OUT);
		close(IN);

		# 一時ファイルをソートし、本番ファイルに更新
		&sort_file("$cf{tempdir}/$$.dat","$cf{datadir}/index.dat");

		# 時間/ファイル数
		my $date = &date(time);
		my $all = $noc + $chg + $new;

		# 設定情報更新
		$in{ext} =~ s/\\//g;
		open(DAT,"+> $cf{datadir}/set.dat") or error('write err: set.dat');
		print DAT "$date<>$all<>\n";
		print DAT "$in{dir}/<>$in{url}/<>$in{ext}<>$nodir<>$in{nodir2}<>\n";
		close(DAT);

		# 結果表示
		print qq|<p>処理を完了しました。</p>\n|;
		print qq|差替ファイル： <b>$chg</b><br>\n|;
		print qq|削除ファイル： <b>$del</b><br>\n|;
		print qq|追加ファイル： <b>$new</b><br>\n|;
		print qq|インデックス合計： <b>$all</b>\n|;

	# テストモードのとき
	} else {
		print "</ol>\n";
		print "<p>以上です。</p>\n";
	}

	# 選択画面
	print qq|<form action="$cf{admin_cgi}" method="post">\n|;
	print qq|<input type="hidden" name="pass" value="$in{pass}">\n|;

	if ($in{check}) {
		foreach ('dir','url','ext','nodir','nodir2') {
			print qq|<input type="hidden" name="$_" value="$in{$_}">\n|;
		}
		print qq|<input type="submit" name="save_set" value="この内容で設定を保存">\n|;
		print qq|<input type="submit" value="設定を保存せずに戻る">\n|;
	} else {
		print qq|<input type="submit" value="管理画面に戻る">\n|;
	}

	print qq|</form>\n|;
	print qq|</body></html>\n|;
	exit;
}

#-----------------------------------------------------------
#  実行中メッセージ
#-----------------------------------------------------------
sub handler {
    print "処理中です。<br>\n";
    alarm 10;
}

#-----------------------------------------------------------
#  ディレクトリ内読取
#-----------------------------------------------------------
sub opendir {
	my ($dir,$pat) = @_;
	$dir =~ s|/$||;
	$pat =~ s|/$||;

	# 非対象ディレクトリ
	my %nod;
	foreach ( split(/\s+/, $in{nodir}) ) {
		$nod{$_}++;
	}
	my %nod2;
	foreach ( split(/\s+/, $in{nodir2}) ) {
		$nod2{$_}++;
	}

	# 指定ディレクトリを読む
	opendir(DIR, "$dir");
	my @dir = readdir(DIR);
	closedir(DIR);

	# 展開
	my @ret;
	foreach (@dir) {
		next if ($_ eq '.');
		next if ($_ eq '..');

		# 対象をパス付で定義
		my $dir = "$dir/$_";
		my $pat = "$pat/$_";

		# ディレクトリのとき
		if (-d $dir) {

			# 非対象
			next if (defined($nod{$dir}));
			next if (defined($nod2{$_}));

			&opendir($dir,$pat);

		# ファイルのとき
		} else {
			&openfil($dir,$pat);
		}
	}
}

#-----------------------------------------------------------
#  ファイル読み取り
#-----------------------------------------------------------
sub openfil {
	my ($dir,$pat) = @_;

	# 対象ファイルを拡張子で選別
	my $flg;
	foreach ( split(/\s+/, $in{ext}) ) {
		$flg = 0;
		if ($dir =~ /$_$/i) { $flg++; last; }
	}
	next if (!$flg);

	# チェックモード
	if ($in{check}) {
		print "<li>$dir\n";
		next;
	}

	# 更新日取得
	my $upd = (stat $dir)[9];

	## --- 更新日が不変のものは非更新
	if (defined($upd{$pat}) and $upd == $upd{$pat}) {
		$noc{$pat}++;
		return;
	}

	# HTMLを読み込む
	open(IN,"$dir");
	my $html = join('', <IN>);
	close(IN);

	# コード変換
	$html = $j->set($html)->euc;

	# タイトル取得
	$html =~ m|<title>(.+)</title>|si;
	my $ttl = $1 || '無題';

	# head領域排除
	$html =~ s|<head[^>]*>.+</head>||si;

	# コメント排除
	$html =~ s/<!(?:--[^-]*-(?:[^-]+-)*?-(?:[^>-]*(?:-[^>-]+)*?)??)*(?:>|$(?!\n)|--.*$)//g;

	# タグ、改行等の処理
	$html =~ s/<.*?>//g;
	$html =~ s/\t//g;
	$html =~ s/[\r\n]+/ /g;
	$html =~ s/(&nbsp;)+/ /g;
	$html =~ s/^\s+//;

	# 進行中表示
	print "・ \n";

	# 差替
	if (defined($upd{$pat})) {
		$chg{$pat} = "$pat\t$upd\t$ttl\t$html\n";

	# 追加
	} else {
		$new{$pat} = "$pat\t$upd\t$ttl\t$html\n";
	}
}

#-----------------------------------------------------------
#  インデックス閲覧
#-----------------------------------------------------------
sub conf_idx {
	open(IN,"$cf{datadir}/set.dat") or error("open err: set.dat");
	my @set = <IN>;
	close(IN);

	my ($dir,$url,$ext,$nodir,$nod2) = split(/<>/, $set[1]);
	$dir =~ s|/$||;
	$url =~ s|/$||;

	&header("インデックス閲覧");
	&menu_btn;
	print <<EOM;
<div class="body">
<p class="ttl">■ インデックス閲覧</p>
<p>現在インデックス化されているファイルは次のとおりです。</p>
<table class="conf-tbl">
<tr>
	<th>タイトル名</th>
	<th>ファイル</th>
</tr>
EOM

	open(DAT,"$cf{datadir}/index.dat") or error('open err: index.dat');
	while(<DAT>) {
		my ($page,$time,$ttl,$body) = split(/\t/);
		my $uri = qq|<a href="$url$page" target="_blank">$url$page</a>|;

		print "<tr><td>$ttl</td><td>$dir$page<br>$uri</td></tr>\n";
	}
	close(DTA);

	print <<EOM;
</table>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  設定保存
#-----------------------------------------------------------
sub save_set {
	$in{ext} =~ s/\\//g;

	# 設定情報更新
	open(DAT,"+< $cf{datadir}/set.dat") or error('open err: set.dat');
	my @set = <DAT>;
	seek(DAT, 0, 0);
	print DAT $set[0];
	print DAT "$in{dir}/<>$in{url}/<>$in{ext}<>$in{nodir}<>$in{nodir2}<>\n";
	truncate(DAT, tell(DAT));
	close(DAT);
}

#-----------------------------------------------------------
#  検索ログ閲覧
#-----------------------------------------------------------
sub mode_log {
	&header("検索ログ閲覧");
	&menu_btn;
	print <<EOM;
<div class="body">
<p class="ttl">■ 検索ログ閲覧</p>
<p>以下は検索ログです（最大$cf{maxlog}件）。</p>
EOM

	my @cond = ('OR','AND');

	open(DAT,"$cf{datadir}/log.dat") or error("open err: log.dat");
	while(<DAT>) {
		my ($time,$q,$hit,$cond,$addr) = split(/\t/);

		print qq|<hr><b>$q</b> &nbsp; 日時：$time &nbsp; 条件：$cond[$cond] &nbsp; ヒット数：$hit &nbsp; IP：$addr<br>\n|;
	}
	close(DAT);

	print <<EOM;
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  HTMLヘッダー
#-----------------------------------------------------------
sub header {
	my $ttl = shift;

	print "Content-type: text/html; charset=euc-jp\n\n";
	print <<EOM;
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-jp">
<meta http-equiv="content-style-type" content="text/css">
<style type="text/css">
<!--
body,td,th { font-size:80%; background:#f0f0f0; }
p.ttl { font-weight:bold; color:#004080; border-bottom:1px solid #004080; padding:2px; }
p.err { color:#dd0000; }
p.msg { color:#006400; }
table.form-tbl { border-collapse:collapse; margin-bottom:1em; }
table.form-tbl th { border:1px solid #333; background:#d2e9ff; padding:4px; text-align:left; font-size:12px; font-weight:normal; }
table.form-tbl td { border:1px solid #333; background:#fff; padding:4px; }
div.notes { border:1px dotted blue; background:#fff; padding:7px; width:600px; }
div.notes ul { margin-left:1.5em; margin-bottom:1em; }
table.conf-tbl { border-collapse:collapse; }
table.conf-tbl th { border:1px solid #333; background:#d2e9ff; padding:3px; }
table.conf-tbl td { border:1px solid #333; background:#fff; padding:3px; font-size:12px; }
.red { color:red; }
table.menu-btn { border-collapse:collapse; width:190px; }
table.menu-btn th { border:1px solid #383872; background:#cccce6; padding:4px; height:38px; }
table.menu-btn input { width:140px; }
div.menu { float:left; width:200px; padding:1.5em; }
div.body { float:left; padding:1.5em; }
-->
</style>
<title>$ttl</title>
</head>
<body>
EOM
}

#-----------------------------------------------------------
#  パスワード認証
#-----------------------------------------------------------
sub check_passwd {
	# パスワードが未入力の場合は入力フォーム画面
	if ($in{pass} eq "") {
		&enter_form;

	# パスワード認証
	} elsif ($in{pass} ne $cf{password}) {
		&error("認証できません");
	}
}

#-----------------------------------------------------------
#  入室画面
#-----------------------------------------------------------
sub enter_form {
	&header("入室画面");
	print <<EOM;
<div align="center">
<form action="$cf{admin_cgi}" method="post">
<table width="380" style="margin-top:50px">
<tr>
	<td height="40" align="center">
		<fieldset><legend>管理パスワード入力</legend><br>
		<input type="password" name="pass" value="" size="20">
		<input type="submit" value=" 認証 "><br><br>
		</fieldset>
	</td>
</tr>
</table>
</form>
<script language="javascript">
<!--
self.document.forms[0].pass.focus();
//-->
</script>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  エラー
#-----------------------------------------------------------
sub error {
	my $err = shift;

	&header("ERROR!");
	print <<EOM;
<div align="center">
<hr width="350">
<h3>ERROR!</h3>
<p class="err">$err</p>
<hr width="350">
<form>
<input type="button" value="前画面に戻る" onclick="history.back()">
</form>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  完了メッセージ
#-----------------------------------------------------------
sub message {
	my $msg = shift;

	&header("完了");
	print <<EOM;
<div align="center" style="margin-top:3em;">
<hr width="350">
<p class="msg">$msg</p>
<hr width="350">
<form action="$cf{admin_cgi}" method="post">
<input type="hidden" name="pass" value="$in{pass}">
<input type="submit" value="管理画面に戻る">
</form>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  入力チェック
#-----------------------------------------------------------
sub check_input {
	my $err;
	if ($in{dir} eq '') { $err .= "対象ディレクトリが未入力です。<br>"; }
	if ($in{url} eq '') { $err .= "対象ディレクトリのURLが未入力です。<br>"; }
	if ($in{ext} eq '') { $err .= "対象ファイルの拡張子が未入力です。<br>"; }
	&error($err) if ($err);
}

#-----------------------------------------------------------
#  メニューボタン
#-----------------------------------------------------------
sub menu_btn {
	my %menu = (
		mode_idx => 'インデックス管理',
		conf_idx => 'インデックス閲覧',
		mode_log => '検索ログ閲覧',
	);

	print <<EOM;
<div class="menu">
<form action="$cf{admin_cgi}" method="post">
<input type="hidden" name="pass" value="$in{pass}">
<table class="menu-btn">
EOM

	foreach ( 'mode_idx','conf_idx','mode_log' ) {
		if ($in{$_}) {
			print qq|<tr><th><input type="submit" name="$_" value="$menu{$_}" disabled></th></tr>\n|;
		} else {
			print qq|<tr><th><input type="submit" name="$_" value="$menu{$_}"></th></tr>\n|;
		}
	}

	print <<EOM;
<tr>
	<th><input type="button" value="検索画面に戻る" onclick=window.open("$cf{search_cgi}","_top")></th>
</tr><tr>
	<th><input type="button" value="ログオフ" onclick=window.open("$cf{admin_cgi}","_top")></th>
</tr>
</table>
</form>
</div>
EOM
}

#-----------------------------------------------------------
#  ファイルソート
#-----------------------------------------------------------
sub sort_file {
	my ($in,$out) = @_;

	# 読み込む
	my %sort;
	open(IN,"$in") or error("open err: $in");
	while (<IN>) {

		# データの2カラム目を見る（時間データ）
		my $key = ( split(/\t/) )[1];

		# キーにデータを関連付け
		push(@{$sort{$key}},$_);

		# 100単位
		if (@{$sort{$key}} == 100) {

			# 一時ファイルに書き出す
			open(OUT,">> $cf{tempdir}/$key.tmp") or error("write err: $key.tmp");
			print OUT @{$sort{$key}};
			close(OUT);

			# クリア
			@{$sort{$key}} = ();
		}
	}
	close(IN);

	# 書き込む
	open(OUT,"+> $out") or error("write err: $out");

	# 時間を降順にソート
	foreach my $key ( sort { $b <=> $a } keys(%sort) ) {
		if (-e "$cf{tempdir}/$key.tmp") {

			# 一時ファイルを読み出し、本番ファイルに書く
			open(IN,"$cf{tempdir}/$key.tmp") or error("open err: $key.tmp");
			print OUT while <IN>;
			close(IN);

			# 一時ファイル削除
			unlink("$cf{tempdir}/$key.tmp");
		}
		# 残り（端数）を書き出す
		print OUT @{$sort{$key}} if (@{$sort{$key}});
	}
	close(OUT);

	# 読み出しファイルを削除
	unlink($in);
}

