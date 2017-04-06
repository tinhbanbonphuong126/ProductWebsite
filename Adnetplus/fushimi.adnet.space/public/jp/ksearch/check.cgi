#!/usr/local/bin/perl

#┌─────────────────────────────────
#│ KEY SEARCH : check.cgi - 2012/04/1
#│ Copyright (c) KentWeb
#│ http://www.kent-web.com/
#└─────────────────────────────────

# モジュール宣言
use strict;
use CGI::Carp qw(fatalsToBrowser);

# 外部ファイル取り込み
require './init.cgi';
my %cf = &init;

print <<EOM;
Content-type: text/html; charset=euc-jp

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-jp">
<title>Check Mode</title>
</head>
<body>
<b>Check Mode: [ $cf{version} ]</b>
<ul>
<li>Perlバージョン : $]
EOM

if ($] >= 5.005) {
	print "<li>Perlバージョン : OK\n";
} else {
	print "<li>Perlバージョン : NG\n";
}

# ファイル
my %log = ('index.dat' => 'インデックスファイル', 'set.dat' => '設定ファイル');
foreach ( keys(%log) ) {
	if (-e "$cf{datadir}/$_") {
		print "<li>$log{$_}パス : OK\n";

		if (-r "$cf{datadir}/$_" && -w "$cf{datadir}/$_") {
			print "<li>$log{$_}パーミッション : OK\n";
		} else {
			print "<li>$log{$_}パーミッション : NG\n";
		}
	} else {
		print "<li>$log{$_}パス : NG\n";
	}
}

# 一時ディレクトリ
if (-d $cf{tempdir}) {
	print "<li>一時ディレクトリパス : OK\n";
	if (-r $cf{tempdir} && -w $cf{tempdir} && -x $cf{tempdir}) {
		print "<li>一時ディレクトリパーミッション : OK\n";
	} else {
		print "<li>一時ディレクトリパーミッション : NG\n";
	}
} else {
	print "<li>一時ディレクトリパス : NG\n";
}

# テンプレート
my @tmpl = qw|search note error|;
foreach (@tmpl) {
	if (-f "$cf{tmpldir}/$_.html") {
		print "<li>テンプレート( $_.html ) : OK\n";
	} else {
		print "<li>テンプレート( $_.html ) : NG\n";
	}
}

print <<EOM;
</ul>
</body>
</html>
EOM
exit;

