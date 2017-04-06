#!/usr/local/bin/perl

#┌─────────────────────────────────
#│ KEY SEARCH : ksearch.cgi - 2014/06/15
#│ copyright (c) KentWeb
#│ http://www.kent-web.com/
#└─────────────────────────────────

# モジュール宣言
use strict;
use CGI::Carp qw(fatalsToBrowser);
use lib "./lib";
use Jcode;

# 設定ファイル認識
require "./init.cgi";
my %cf = init();

# データ受理
my %in = parse_form();

# 検索
if ($in{q} ne '') { search(); }
note_page();

#-----------------------------------------------------------
#  検索実行
#-----------------------------------------------------------
sub search {
	# 数字以外を排除
	$in{pg} =~ s/\D//g;
	$in{cond} =~ s/\D//g;
	$in{logs} =~ s/\D//g;
	$in{sort} =~ s/\D//g;

	# ページ数定義
	my $pg = $in{pg} || 0;

	# 表示件数定義
	if ($in{logs} <= 0) { $in{logs} = 10; }

	# 条件式
	my $cond = $in{cond} eq '0' ? 0 : 1;

	# ソート定義
	my $sort = $in{sort} eq '0' ? 0 : 1;

	# キーワード処理
	my @q = keyword();

	# キーワードマッチ準備
	# ref: http://www.din.or.jp/~ohzaki/perl.htm
	my $eucpre  = qr{(?<!\x8F)};
	my $eucpost = qr{
    	(?=
		(?:[\xA1-\xFE][\xA1-\xFE])*	# JIS X 0208 が 0文字以上続いて
		(?:[\x00-\x7F\x8E\x8F]|\z)	# ASCII, SS2, SS3 または終端
		)
	}x;

	# 初期化
	my $i = 0;
	my @log;

	# 検索実行（新規順）
	if ($sort == 1) {
		open(IN,"$cf{datadir}/index.dat") or error("open err: index.dat");
		while(<IN>) {
			my ($page,$time,$ttl,$body) = split(/\t/);

			# キーワードマッチ
			my ($flg,$wd,$bk,$nx);
			foreach my $q (@q) {
				if ($body =~ /(.{0,100})$eucpre\Q$q\E$eucpost(.{0,100})/si) {
					($wd,$bk,$nx) = ($q,$1,$2);
					$flg++;
					if ($cond == 0) { last; }
				} else {
					if ($cond == 1) { $flg = 0; last; }
				}
			}
			next if (!$flg);

			$i++;
			next if ($i < $pg + 1);
			next if ($i > $pg + $in{logs});

			my ($b,$n) = &hilight($bk,$nx);
			push(@log,"$page\t$ttl\t$time\t$wd\t$b\t$n");
		}
		close(IN);

	# 古い順
	} else {

		# ref: http://www.din.or.jp/~ohzaki/perl.htm#File_Reverse
		my ($pos,$buf,$buf_tmp,@lines);
		my $bufsize = 1024;
		open(FILE, "< $cf{datadir}/index.dat");
		binmode(FILE);
		my $size = (-s FILE) / $bufsize;
		$pos += $size <=> ($pos = int($size));
		while ($pos--) {
			seek(FILE, $bufsize * $pos, 0);
			read(FILE, $buf, $bufsize);
			$buf .= $buf_tmp;
			($buf_tmp, @lines) = $buf =~ /[^\x0D\x0A]*\x0D?\x0A?/g;
			pop(@lines);
			foreach (reverse @lines) {
				my ($page,$time,$ttl,$body) = split(/\t/);

				# キーワードマッチ
				my ($flg,$wd,$bk,$nx);
				foreach my $q (@q) {
					if ($body =~ /(.*)$eucpre\Q$q\E$eucpost(.*)/si) {
						($wd,$bk,$nx) = ($q,$1,$2);
						$flg++;
						if ($cond == 0) { last; }
					} else {
						if ($cond == 1) { $flg = 0; last; }
					}
				}
				next if (!$flg);

				$i++;
				next if ($i < $pg + 1);
				next if ($i > $pg + $in{logs});

				my ($b,$n) = &hilight($bk,$nx);
				push(@log,"$page\t$ttl\t$time\t$wd\t$b\t$n");
			}
		}
		close(FILE);

		if ($buf_tmp) {
			my ($page,$time,$ttl,$body) = split(/\t/, $buf_tmp);

			# キーワードマッチ
			my ($flg,$wd,$bk,$nx);
			foreach my $q (@q) {
				if ($body =~ /(.*)$eucpre\Q$q\E$eucpost(.*)/si) {
					($wd,$bk,$nx) = ($q,$1,$2);
					$flg++;
					if ($cond == 0) { last; }
				} else {
					if ($cond == 1) { $flg = 0; last; }
				}
			}
			if ($flg) {
				$i++;
				unless ($i < $pg + 1 && $i > $pg + $in{logs}) {
					my ($b,$n) = hilight($bk,$nx);
					push(@log,"$page\t$ttl\t$time\t$wd\t$b\t$n");
				}
			}
		}
	}

	# 繰越ボタン作成
	my ($pgbtn,$list) = make_pgbtn($i,$pg);

	# オプション
	my %op;
	my @cond = qw(OR AND);
	my @sort = qw(古い順 新しい順);
	foreach (1,0) {
		if ($cond == $_) {
			$op{cond} .= qq|<option value="$_" selected>$cond[$_]\n|;
		} else {
			$op{cond} .= qq|<option value="$_">$cond[$_]\n|;
		}
	}
	foreach (@{$cf{op_logs}}) {
		if ($in{logs} == $_) {
			$op{logs} .= qq|<option value="$_" selected>$_件\n|;
		} else {
			$op{logs} .= qq|<option value="$_">$_件\n|;
		}
	}
	foreach (1,0) {
		if ($sort == $_) {
			$op{sort} .= qq|<option value="$_" selected>$sort[$_]\n|;
		} else {
			$op{sort} .= qq|<option value="$_">$sort[$_]\n|;
		}
	}

	# 設定ファイル
	open(IN,"$cf{datadir}/set.dat") or error("open err: set.dat");
	my @set = <IN>;
	close(IN);

	# 分解
	my ($upd,$all) = split(/<>/,$set[0]);
	my ($url) = (split(/<>/,$set[1]))[1];
	$url =~ s|/$||;

	# テンプレート
	open(IN,"$cf{tmpldir}/search.html") or error("open err: search.html");
	my $tmpl = join('', <IN>);
	close(IN);

	# 結果メッセージ
	my $result;
	if ($i == 0) {
		$result = $cf{result_ng};
	} else {
		$result = $cf{result_ok};
		$result =~ s/!hit!/$i/g;
	}
	my $hit = $i;

	# 文字置き換え
	$tmpl =~ s/!(\w+_cgi)!/$cf{$1}/g;
	$tmpl =~ s/!word!/$in{q}/g;
	$tmpl =~ s/!result!/$result/g;
	$tmpl =~ s/<!-- op_(\w+) -->/$op{$1}/g;
	$tmpl =~ s/!page!/$pgbtn/g;
	$tmpl =~ s/!list!/$list/g;
	$tmpl =~ s/!update!/$upd/g;
	$tmpl =~ s/!all!/$all/g;
	$tmpl =~ s/!topurl!/$cf{topurl}/g;

	# テンプレート分割
	my ($head,$loop,$foot) = $tmpl =~ /(.+)<!-- loop_begin -->(.+)<!-- loop_end -->(.+)/s
			? ($1,$2,$3) : error("テンプレート不正");

	# 結果
	my $i = $pg;
	my $body;
	foreach (@log) {
		my ($page,$ttl,$time,$wd,$bk,$nx) = split(/\t/);
		$i++;

		my $tmp = $loop;
		$tmp =~ s/!num!/$i/g;
		$tmp =~ s/!title!/$ttl/g;
		$tmp =~ s/!url!/$url$page/g;
		$tmp =~ s|!doc!|$bk<b>$wd</b>$nx|g;
		$tmp =~ s/!date!/&date($time)/eg;
		$body .= $tmp;
	}

	# ログ取得
	&save_log($hit,$cond) if ($cf{maxlog} > 0);

	# 画面表示
	print "Content-type: text/html; charset=euc-jp\n\n";
	print $head,$body;
	&footer($foot);
	exit;
}

#-----------------------------------------------------------
#  ハイライト
#-----------------------------------------------------------
sub hilight {
	my ($back,$next) = @_;

	# 前文
	my $jcode = new Jcode($back,'euc');
	my @j = $jcode->jfold($cf{hi_len_f});
	$back = $j[$#j];

	# 後文
	my $jcode = new Jcode($next,'euc');
	my @j = $jcode->jfold($cf{hi_len_b});
	$next = $j[0];
	if ($j[1] ne '') { $next .= '...'; }

	return ($back,$next);
}

#-----------------------------------------------------------
#  繰越ボタン作成
#-----------------------------------------------------------
sub make_pgbtn {
	my ($i,$pg) = @_;

	# ヒット総数
	my $all = $i;

	# URLエンコード
	my $q = url_encode($in{q});

	# ページ繰越定義
	my $next = $pg + $in{logs};
	my $back = $pg - $in{logs};

	# ページ繰越ボタン作成
	my $pg_btn;
	if ($back >= 0 || $next < $i) {
		my ($x, $y) = (1, 0);
		while ($i > 0) {
			if ($pg == $y) {
				$pg_btn .= qq(| <b>$x</b> );
			} else {
				$pg_btn .= qq(| <a href="$cf{search_cgi}?pg=$y&logs=$in{logs}&cond=$in{cond}&sort=$in{sort}&q=$q">$x</a> );
			}
			$x++;
			$y += $in{logs};
			$i -= $in{logs};
		}
		$pg_btn .= "|";
	}

	# リスト定義
	my $fr = $i == 0 ? 0 : $pg + 1;
	my $to = $all <= $next ? $all : $next;
	my $list = "$fr - $to件";

	return ($pg_btn,$list);
}

#-----------------------------------------------------------
#  フッター
#-----------------------------------------------------------
sub footer {
	my $foot = shift;

	# 著作権表記（削除・改変禁止）
	my $copy = <<EOM;
<div style="margin-top:0.5em;text-align:center;font-family:Verdana,Helvetica,Arial;font-size:10px;">
- <a href="http://www.kent-web.com/" target="_top">$cf{version}</a> -
</div>
EOM

	if ($foot =~ /(.+)(<\/body[^>]*>.*)/si) {
		print "$1$copy$2\n";
	} else {
		print "$foot$copy\n";
		print "</body></html>\n";
	}
	exit;
}

#-----------------------------------------------------------
#  URLエンコード
#-----------------------------------------------------------
sub url_encode {
	my $str = shift;

	$str =~ s/([^\w ])/'%'.unpack('H2', $1)/eg;
	$str =~ tr/ /+/;
	return $str;
}

#-----------------------------------------------------------
#  検索方法ページ
#-----------------------------------------------------------
sub note_page {
	# オプション
	my @cond = qw|OR AND|;
	my @sort = qw|古い順 新しい順|;
	my %op;
	foreach (1,0) {
		$op{cond} .= qq|<option value="$_">$cond[$_]\n|;
	}
	my $op_logs;
	foreach (@{$cf{op_logs}}) {
		$op{logs} .= qq|<option value="$_">$_件\n|;
	}
	foreach (1,0) {
		$op{sort} .= qq|<option value="$_">$sort[$_]\n|;
	}

	# 設定ファイル
	open(IN,"$cf{datadir}/set.dat") or error("open err: set.dat");
	my $set = <IN>;
	close(IN);

	# 分解
	my ($upd,$all) = split(/<>/, $set);

	# テンプレート
	open(IN,"$cf{tmpldir}/note.html") or error("open err: note.html");
	my $tmpl = join('', <IN>);
	close(IN);

	$tmpl =~ s/!(\w+_cgi)!/$cf{$1}/g;
	$tmpl =~ s/<!-- op_(\w+) -->/$op{$1}/g;
	$tmpl =~ s/!update!/$upd/g;
	$tmpl =~ s/!all!/$all/g;
	$tmpl =~ s/!topurl!/$cf{topurl}/g;

	# 画面表示
	print "Content-type: text/html; charset=euc-jp\n\n";
	&footer($tmpl);
	exit;
}

#-----------------------------------------------------------
#  ログ保存
#-----------------------------------------------------------
sub save_log {
	my $hit = shift;

	# 時間/ブラウザ情報
	my $time = &date(time);
	my $agent = $ENV{HTTP_USER_AGENT};
	$agent =~ s/[<>&"']//g;

	# ログ保存
	my ($i,@log);
	open(DAT,"+< $cf{datadir}/log.dat") or error("open err: log.dat");
	eval "flock(DAT, 2);";
	while(<DAT>) {
		$i++;
		push(@log,$_);

		last if ($i >= $cf{maxlog} - 1);
	}
	unshift(@log,"$time\t$in{q}\t$hit\t$in{cond}\t$ENV{REMOTE_ADDR}\t$agent\t\n");
	seek(DAT, 0, 0);
	print DAT @log;
	truncate(DAT, tell(DAT));
	close(DAT);
}

#-----------------------------------------------------------
#  キーワード処理
#-----------------------------------------------------------
sub keyword {
	# コード解析
	my $code;
	if ($in{code} eq "\x8a\xbf\x8e\x9a") { # sjis
		$code = "sjis";
	} elsif ($in{code} eq "\x1b\x24\x42\x34\x41\x3b\x7a\x1b\x28\x42") { # jis
		$code = "jis";
	} elsif ($in{code} eq "\xb4\xc1\xbb\xfa") { # euc
		$code = "euc";
	} elsif ($in{code} eq "\xe6\xbc\xa2\xe5\xad\x97") { # utf8
		$code = "utf8";
	}

	# EUC以外であれば変換する
	if ($code ne 'euc') {
		$in{q} = Jcode->new($in{q},$code)->euc;
	}

	# 全角スペースは半角変換
	$in{q} =~ s/　/ /g;

	# 禁止ワードチェック
	my $flg;
	foreach( split(/,/,$cf{no_word}) ) {
		if (index($in{q},$_) >= 0) {
			$flg++;
			last;
		}
	}
	if ($flg) { note_page(); }

	# 配列で返す
	return split(/\s+/,$in{q});
}

