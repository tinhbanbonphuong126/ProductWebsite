# モジュール宣言/変数初期化
use strict;
my %cf;
#┌─────────────────────────────────
#│ Key Search (EUC版) : init.cgi - 2014/06/15
#│ Copyright (c) KentWeb
#│ http://www.kent-web.com/
#└─────────────────────────────────
$cf{version} = 'KeySearch v1.2';
#┌─────────────────────────────────
#│ [注意事項]
#│ 1. このプログラムはフリーソフトです。このプログラムを使用した
#│    いかなる損害に対して作者は一切の責任を負いません。
#│ 2. 設置に関する質問はサポート掲示板にお願いいたします。
#│    直接メールによる質問は一切お受けいたしておりません。
#└─────────────────────────────────

#===========================================================
# ■ 基本設定
#===========================================================

# 管理用パスワード
$cf{password} = '0123';

# ログの最大取得件数
# → 取得しない場合は「0」を指定する
$cf{maxlog} = 300;

# 検索プログラム【URLパス】
$cf{search_cgi} = './ksearch.cgi';

# 管理プログラム【URLパス】
$cf{admin_cgi} = './admin.cgi';

# データディレクトリ【サーバパス】
$cf{datadir} = './data';

# テンプレートディレクトリ【サーバパス】
$cf{tmpldir} = './tmpl';

# 一時ディレクトリ【サーバパス】
$cf{tempdir} = './temp';

# 検索画面からの戻り先【URLパス】
$cf{topurl} = '../index.html';

# ハイライト文字数（半角換算）
$cf{hi_len_f} = 80;
$cf{hi_len_b} = 200;

# 表示件数候補
$cf{op_logs} = [10,20,30,40,50];

# 検索結果メッセージ
$cf{result_ok} = 'キーワードにマッチする<b>!hit!</b>個の文書が見つかりました。';
$cf{result_ng} = 'キーワードにマッチする文書は見つかりませんでした。';

# 無効ワード（入力キーワードで検索無効とするもの。例えば検索窓でvalueに予め入れておく文字等）
# → コンマで区切って複数指定可
$cf{no_word} = 'サイト内検索';

# １回当りの最大投稿サイズ (bytes)
$cf{maxdata} = 51200;

#===========================================================
# ■ 設定完了
#===========================================================

# 設定値を返す
sub init {
	return %cf;
}

#-----------------------------------------------------------
#  フォームデコード
#-----------------------------------------------------------
sub parse_form {
	my ($buf,%in);
	if ($ENV{REQUEST_METHOD} eq "POST") {
		&error('受理できません') if ($ENV{CONTENT_LENGTH} > $cf{maxdata});
		read(STDIN, $buf, $ENV{CONTENT_LENGTH});
	} else {
		$buf = $ENV{QUERY_STRING};
	}
	foreach ( split(/&/, $buf) ) {
		my ($key,$val) = split(/=/);
		$val =~ tr/+/ /;
		$val =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("H2", $1)/eg;

		# 無効化
		$val =~ s/&/&amp;/g;
		$val =~ s/</&lt;/g;
		$val =~ s/>/&gt;/g;
		$val =~ s/"/&quot;/g;
		$val =~ s/'/&#39;/g;
		$val =~ s/[\r\n]//g;

		$in{$key} .= "\0" if (defined($in{$key}));
		$in{$key} .= $val;
	}
	return %in;
}

#-----------------------------------------------------------
#  エラー画面
#-----------------------------------------------------------
sub error {
	my $err = shift;

	open(IN,"$cf{tmpldir}/error.html") or die;
	my $tmpl = join('', <IN>);
	close(IN);

	$tmpl =~ s/!error!/$err/g;

	print "Content-type: text/html; charset=euc-jp\n\n";
	print $tmpl;
	exit;
}

#-----------------------------------------------------------
#  日付フォーマット
#-----------------------------------------------------------
sub date {
	my $time = shift;

	# 曜日
	my @week = qw|Sun Mon Tue Wed Thu Fri Sat|;

	# フォーマット
	my ($sec,$min,$hour,$mday,$mon,$year,$wday) = (localtime($time))[0..6];
	sprintf("%04d/%02d/%02d(%s) %02d:%02d:%02d",
				$year+1900,$mon+1,$mday,$week[$wday],$hour,$min,$sec);
}


1;

