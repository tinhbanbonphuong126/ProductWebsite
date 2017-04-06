#!/usr/local/bin/perl

#��������������������������������������������������������������������
#�� KEY SEARCH : admin.cgi - 2012/12/15
#�� Copyright (c) KentWeb
#�� http://www.kent-web.com/
#��������������������������������������������������������������������

# �⥸�塼�����
use strict;
use CGI::Carp qw(fatalsToBrowser);
use lib "./lib";
use Jcode;

# Jcode���֥�������
my $j = new Jcode;

# ����ե�����ǧ��
require "./init.cgi";
my %cf = &init;

# �ǡ�������
my %in = &parse_form;

# ǧ��
&check_passwd;

# �����⡼��
my (%upd,%noc,%chg,%new);
if ($in{conf_idx}) { &conf_idx; }
if ($in{mode_log}) { &mode_log; }
&mode_idx;

#-----------------------------------------------------------
#  ����ǥå�������
#-----------------------------------------------------------
sub mode_idx {
	# ����ǥå�������
	if ($in{mkidx} or $in{check}) {
		&check_input;
		&make_index;

	# ����Τ���¸
	} elsif ($in{save_set}) {
		&check_input;
		&save_set;
	}

	# ����ե������ɤ߼��
	open(IN,"$cf{datadir}/set.dat") or error("open err: set.dat");
	my @set = <IN>;
	close(IN);

	# ��������
	my ($upd,$all) = split(/<>/, $set[0]);

	# ����ե�����ʬ��
	my ($dir,$url,$ext,$nodir,$nod2) = split(/<>/, $set[1]);
	$ext =~ s/\\//g;

	&header("����ǥå�������");
	&menu_btn;
	print <<EOM;
<div class="body">
<p class="ttl">�� ����ǥå�������</p>
<ul>
<li>�����Ƥ����Ϥ���<span class="red">��</span>������ɬ�ܡˡ��֥����å��ץܥ���ǳ�ǧ���ޤ���
<li>�Ǹ�ˡֺ������ϡץܥ���򲡤��Ƥ���������
</ul>
<form action="$cf{admin_cgi}" method="post">
<input type="hidden" name="pass" value="$in{pass}">
<table class="form-tbl">
<tr>
	<th>�����Υ���ǥå���</th>
	<td>
		�������� <b>$upd</b><br>
		ʸ����� <b>$all</b>�ե�����<br>
		<input type="submit" name="conf_idx" value="���Ƴ�ǧ">
		�ʸ����Υ���ǥå������Ƥ��ǧ��
	</td>
</tr><tr>
	<th>(1)�оݥǥ��쥯�ȥ� <span class="red">��</span></th>
	<td>
		���� ../�˥ץ������֤���Υѥ����̾�ϥȥåץڡ�������ꡣ<br>
		<input type="text" name="dir" value="$dir" size="65">
	</td>
</tr><tr>
	<th>(2)�оݥǥ��쥯�ȥ��URL <span class="red">��</span></th>
	<td>
		���� http://www.example.com/��(1)�ǻ��ꤹ��URL<br>
		<input type="text" name="url" value="$url" size="65">
	</td>
</tr><tr>
	<th>(3)�оݥե�����γ�ĥ�� <span class="red">��</span></th>
	<td>
		���� .html .htm�˥ɥåȤ���񤯡����ڡ������ޤ�ʣ����<br>
		<input type="text" name="ext" value="$ext" size="65">
	</td>
</tr><tr>
	<th>(4)���оݥǥ��쥯�ȥ�<br>�ʥѥ��դ���</th>
	<td>
		���� ../private/�˥ץ������֤���Υѥ������ڡ������ޤ�ʣ����<br>
		<input type="text" name="nodir" value="$nodir" size="65">
	</td>
</tr><tr>
	<th>(5)���оݥǥ��쥯�ȥ�<br>�ʥǥ��쥯�ȥ�̾�Τߡ�</th>
	<td>
		���� private�˥ǥ��쥯�ȥ�̾�Τ߻��ꡣ���ڡ������ޤ�ʣ����<br>
		<input type="text" name="nodir2" value="$nod2" size="65">
	</td>
</tr>
</table>
<input type="submit" name="check" value="�����å�">
&nbsp; �� &nbsp;
<input type="submit" name="mkidx" value="��������">
&nbsp;
�ʡ֥����å��פ��оݥե��������ꤷ���Ǹ�ˡֺ������ϡץܥ���򲡤���
</form>
<div class="notes">
α�ջ���
<ul>
<li>�ɥå�2�Ĥϡ�1�ľ�Υǥ��쥯�ȥ���̣���ޤ���
	<ul>
	<li>1�ľ�Υǥ��쥯�ȥ� �� ../
	<li>2�ľ�Υǥ��쥯�ȥ� �� ../../
	</ul>
<li>�� : ksearch.cgi���ȥåץڡ�����1�Ĳ��ˤ�����
	<ul>
	<li>index.html�ʥȥåס�<br>�� search / search.cgi
	<li>���оݥǥ��쥯�ȥ�פϡ�../�ס����оݥǥ��쥯�ȥ��URL�פϡ�HP�ȥåפ�URL�פ�񤯡�
	</ul>
<li>�����оݥǥ��쥯�ȥ�פǤϡ�(4)���ե������ľ�ܻ��ꤹ��Τ��Ф��ơ�(5)�ϥǥ��쥯�ȥ�̾����ꤹ��Τߡ�
	�񤭤䤹�����ǵ��Ҥ��Ƥ���������ξ�����ꤷ�Ƥ�褤��
</ul>
</div>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  ����ǥå�������
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

	# ���оݥǥ��쥯�ȥ�
	my %nod;
	foreach ( split(/\s+/, $in{nodir}) ) {
		s|/$||;
		$nod{$_}++;
	}
	my %nod2;
	foreach ( split(/\s+/, $in{nodir2}) ) {
		$nod2{$_}++;
	}

	# �����ΤȤ�
	if ($in{mkidx}) {

		# ����ǥå������ɤ߹���
		%upd = ();
		open(DAT,"$cf{datadir}/index.dat") or error('open err: index.dat');
		while(<DAT>) {
			my ($page,$time,undef,undef) = split(/\t/);

			# �ƥե�����λ��֤�Ф��Ƥ���
			$upd{$page} = $time;
		}
		close(DAT);
	}

	# �оݥǥ��쥯�ȥ���ɤ߼��
	opendir(DIR, "$in{dir}");
	my @dir = readdir(DIR);
	closedir(DIR);

	# �Хåե�������
	$| = 1;

	# �إå���
	&header('����ǥå�������');
	print "<p>�����򳫻Ϥ��ޤ�����</p>\n";
	print "<ol>\n" if ($in{check});

	# ���顼�೫��
	$SIG{ALRM} = \&handler;
	alarm 10;

	# ��������Ÿ��
	foreach (@dir) {
		next if ($_ eq '.');
		next if ($_ eq '..');

		# �оݤ�ѥ��դ����
		my $dir = "$in{dir}/$_";
		my $pat = "/$_";

		# �ǥ��쥯�ȥ�ΤȤ�
		if (-d $dir) {

			# ���оݥǥ��쥯�ȥ�ʤ饹���å�
			next if (defined($nod{$dir}));
			next if (defined($nod2{$_}));

			# �Ƶ��򷫤��֤�
			&opendir($dir,$pat);

		# �ե�����ΤȤ�
		} else {
			# ��Ȳ���
			&openfil($dir,$pat);
		}
	}

	# ���顼����
	alarm 0;

	# �����ΤȤ�
	if ($in{mkidx}) {

		# ����ե�����ؽ񤭽Ф�
		my ($noc,$chg,$new,$del) = (0,0,0,0);
		open(IN,"$cf{datadir}/index.dat") or error("open err: index.dat");
		open(OUT,"+> $cf{tempdir}/$$.dat") or error("write err: $$.dat");
		while(<IN>) {
			my ($page,undef,undef,undef) = split(/\t/);

			# ��¸�����Ĺ����ʤ�
			if ($noc{$page}) {
				$noc++;
				print OUT $_;

			# ��¸�����Ĺ�������ʺ����ؤ�)
			} elsif (defined($chg{$page})) {
				$chg++;
				print OUT $chg{$page};

			# ���
			} else {
				$del++;
			}
		}

		# �����ɲ�ʬ
		foreach ( keys %new ) {
			$new++;
			print OUT $new{$_};
		}
		close(OUT);
		close(IN);

		# ����ե�����򥽡��Ȥ������֥ե�����˹���
		&sort_file("$cf{tempdir}/$$.dat","$cf{datadir}/index.dat");

		# ����/�ե������
		my $date = &date(time);
		my $all = $noc + $chg + $new;

		# ������󹹿�
		$in{ext} =~ s/\\//g;
		open(DAT,"+> $cf{datadir}/set.dat") or error('write err: set.dat');
		print DAT "$date<>$all<>\n";
		print DAT "$in{dir}/<>$in{url}/<>$in{ext}<>$nodir<>$in{nodir2}<>\n";
		close(DAT);

		# ���ɽ��
		print qq|<p>������λ���ޤ�����</p>\n|;
		print qq|���إե����롧 <b>$chg</b><br>\n|;
		print qq|����ե����롧 <b>$del</b><br>\n|;
		print qq|�ɲåե����롧 <b>$new</b><br>\n|;
		print qq|����ǥå�����ס� <b>$all</b>\n|;

	# �ƥ��ȥ⡼�ɤΤȤ�
	} else {
		print "</ol>\n";
		print "<p>�ʾ�Ǥ���</p>\n";
	}

	# �������
	print qq|<form action="$cf{admin_cgi}" method="post">\n|;
	print qq|<input type="hidden" name="pass" value="$in{pass}">\n|;

	if ($in{check}) {
		foreach ('dir','url','ext','nodir','nodir2') {
			print qq|<input type="hidden" name="$_" value="$in{$_}">\n|;
		}
		print qq|<input type="submit" name="save_set" value="�������Ƥ��������¸">\n|;
		print qq|<input type="submit" value="�������¸���������">\n|;
	} else {
		print qq|<input type="submit" value="�������̤����">\n|;
	}

	print qq|</form>\n|;
	print qq|</body></html>\n|;
	exit;
}

#-----------------------------------------------------------
#  �¹����å�����
#-----------------------------------------------------------
sub handler {
    print "������Ǥ���<br>\n";
    alarm 10;
}

#-----------------------------------------------------------
#  �ǥ��쥯�ȥ����ɼ�
#-----------------------------------------------------------
sub opendir {
	my ($dir,$pat) = @_;
	$dir =~ s|/$||;
	$pat =~ s|/$||;

	# ���оݥǥ��쥯�ȥ�
	my %nod;
	foreach ( split(/\s+/, $in{nodir}) ) {
		$nod{$_}++;
	}
	my %nod2;
	foreach ( split(/\s+/, $in{nodir2}) ) {
		$nod2{$_}++;
	}

	# ����ǥ��쥯�ȥ���ɤ�
	opendir(DIR, "$dir");
	my @dir = readdir(DIR);
	closedir(DIR);

	# Ÿ��
	my @ret;
	foreach (@dir) {
		next if ($_ eq '.');
		next if ($_ eq '..');

		# �оݤ�ѥ��դ����
		my $dir = "$dir/$_";
		my $pat = "$pat/$_";

		# �ǥ��쥯�ȥ�ΤȤ�
		if (-d $dir) {

			# ���о�
			next if (defined($nod{$dir}));
			next if (defined($nod2{$_}));

			&opendir($dir,$pat);

		# �ե�����ΤȤ�
		} else {
			&openfil($dir,$pat);
		}
	}
}

#-----------------------------------------------------------
#  �ե������ɤ߼��
#-----------------------------------------------------------
sub openfil {
	my ($dir,$pat) = @_;

	# �оݥե�������ĥ�Ҥ�����
	my $flg;
	foreach ( split(/\s+/, $in{ext}) ) {
		$flg = 0;
		if ($dir =~ /$_$/i) { $flg++; last; }
	}
	next if (!$flg);

	# �����å��⡼��
	if ($in{check}) {
		print "<li>$dir\n";
		next;
	}

	# ����������
	my $upd = (stat $dir)[9];

	## --- �����������ѤΤ�Τ��󹹿�
	if (defined($upd{$pat}) and $upd == $upd{$pat}) {
		$noc{$pat}++;
		return;
	}

	# HTML���ɤ߹���
	open(IN,"$dir");
	my $html = join('', <IN>);
	close(IN);

	# �������Ѵ�
	$html = $j->set($html)->euc;

	# �����ȥ����
	$html =~ m|<title>(.+)</title>|si;
	my $ttl = $1 || '̵��';

	# head�ΰ��ӽ�
	$html =~ s|<head[^>]*>.+</head>||si;

	# �������ӽ�
	$html =~ s/<!(?:--[^-]*-(?:[^-]+-)*?-(?:[^>-]*(?:-[^>-]+)*?)??)*(?:>|$(?!\n)|--.*$)//g;

	# �������������ν���
	$html =~ s/<.*?>//g;
	$html =~ s/\t//g;
	$html =~ s/[\r\n]+/ /g;
	$html =~ s/(&nbsp;)+/ /g;
	$html =~ s/^\s+//;

	# �ʹ���ɽ��
	print "�� \n";

	# ����
	if (defined($upd{$pat})) {
		$chg{$pat} = "$pat\t$upd\t$ttl\t$html\n";

	# �ɲ�
	} else {
		$new{$pat} = "$pat\t$upd\t$ttl\t$html\n";
	}
}

#-----------------------------------------------------------
#  ����ǥå�������
#-----------------------------------------------------------
sub conf_idx {
	open(IN,"$cf{datadir}/set.dat") or error("open err: set.dat");
	my @set = <IN>;
	close(IN);

	my ($dir,$url,$ext,$nodir,$nod2) = split(/<>/, $set[1]);
	$dir =~ s|/$||;
	$url =~ s|/$||;

	&header("����ǥå�������");
	&menu_btn;
	print <<EOM;
<div class="body">
<p class="ttl">�� ����ǥå�������</p>
<p>���ߥ���ǥå���������Ƥ���ե�����ϼ��ΤȤ���Ǥ���</p>
<table class="conf-tbl">
<tr>
	<th>�����ȥ�̾</th>
	<th>�ե�����</th>
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
#  ������¸
#-----------------------------------------------------------
sub save_set {
	$in{ext} =~ s/\\//g;

	# ������󹹿�
	open(DAT,"+< $cf{datadir}/set.dat") or error('open err: set.dat');
	my @set = <DAT>;
	seek(DAT, 0, 0);
	print DAT $set[0];
	print DAT "$in{dir}/<>$in{url}/<>$in{ext}<>$in{nodir}<>$in{nodir2}<>\n";
	truncate(DAT, tell(DAT));
	close(DAT);
}

#-----------------------------------------------------------
#  ����������
#-----------------------------------------------------------
sub mode_log {
	&header("����������");
	&menu_btn;
	print <<EOM;
<div class="body">
<p class="ttl">�� ����������</p>
<p>�ʲ��ϸ������Ǥ��ʺ���$cf{maxlog}��ˡ�</p>
EOM

	my @cond = ('OR','AND');

	open(DAT,"$cf{datadir}/log.dat") or error("open err: log.dat");
	while(<DAT>) {
		my ($time,$q,$hit,$cond,$addr) = split(/\t/);

		print qq|<hr><b>$q</b> &nbsp; ������$time &nbsp; ��$cond[$cond] &nbsp; �ҥåȿ���$hit &nbsp; IP��$addr<br>\n|;
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
#  HTML�إå���
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
#  �ѥ����ǧ��
#-----------------------------------------------------------
sub check_passwd {
	# �ѥ���ɤ�̤���Ϥξ������ϥե��������
	if ($in{pass} eq "") {
		&enter_form;

	# �ѥ����ǧ��
	} elsif ($in{pass} ne $cf{password}) {
		&error("ǧ�ڤǤ��ޤ���");
	}
}

#-----------------------------------------------------------
#  ��������
#-----------------------------------------------------------
sub enter_form {
	&header("��������");
	print <<EOM;
<div align="center">
<form action="$cf{admin_cgi}" method="post">
<table width="380" style="margin-top:50px">
<tr>
	<td height="40" align="center">
		<fieldset><legend>�����ѥ��������</legend><br>
		<input type="password" name="pass" value="" size="20">
		<input type="submit" value=" ǧ�� "><br><br>
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
#  ���顼
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
<input type="button" value="�����̤����" onclick="history.back()">
</form>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  ��λ��å�����
#-----------------------------------------------------------
sub message {
	my $msg = shift;

	&header("��λ");
	print <<EOM;
<div align="center" style="margin-top:3em;">
<hr width="350">
<p class="msg">$msg</p>
<hr width="350">
<form action="$cf{admin_cgi}" method="post">
<input type="hidden" name="pass" value="$in{pass}">
<input type="submit" value="�������̤����">
</form>
</div>
</body>
</html>
EOM
	exit;
}

#-----------------------------------------------------------
#  ���ϥ����å�
#-----------------------------------------------------------
sub check_input {
	my $err;
	if ($in{dir} eq '') { $err .= "�оݥǥ��쥯�ȥ꤬̤���ϤǤ���<br>"; }
	if ($in{url} eq '') { $err .= "�оݥǥ��쥯�ȥ��URL��̤���ϤǤ���<br>"; }
	if ($in{ext} eq '') { $err .= "�оݥե�����γ�ĥ�Ҥ�̤���ϤǤ���<br>"; }
	&error($err) if ($err);
}

#-----------------------------------------------------------
#  ��˥塼�ܥ���
#-----------------------------------------------------------
sub menu_btn {
	my %menu = (
		mode_idx => '����ǥå�������',
		conf_idx => '����ǥå�������',
		mode_log => '����������',
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
	<th><input type="button" value="�������̤����" onclick=window.open("$cf{search_cgi}","_top")></th>
</tr><tr>
	<th><input type="button" value="������" onclick=window.open("$cf{admin_cgi}","_top")></th>
</tr>
</table>
</form>
</div>
EOM
}

#-----------------------------------------------------------
#  �ե����륽����
#-----------------------------------------------------------
sub sort_file {
	my ($in,$out) = @_;

	# �ɤ߹���
	my %sort;
	open(IN,"$in") or error("open err: $in");
	while (<IN>) {

		# �ǡ�����2������ܤ򸫤�ʻ��֥ǡ�����
		my $key = ( split(/\t/) )[1];

		# �����˥ǡ������Ϣ�դ�
		push(@{$sort{$key}},$_);

		# 100ñ��
		if (@{$sort{$key}} == 100) {

			# ����ե�����˽񤭽Ф�
			open(OUT,">> $cf{tempdir}/$key.tmp") or error("write err: $key.tmp");
			print OUT @{$sort{$key}};
			close(OUT);

			# ���ꥢ
			@{$sort{$key}} = ();
		}
	}
	close(IN);

	# �񤭹���
	open(OUT,"+> $out") or error("write err: $out");

	# ���֤�߽�˥�����
	foreach my $key ( sort { $b <=> $a } keys(%sort) ) {
		if (-e "$cf{tempdir}/$key.tmp") {

			# ����ե�������ɤ߽Ф������֥ե�����˽�
			open(IN,"$cf{tempdir}/$key.tmp") or error("open err: $key.tmp");
			print OUT while <IN>;
			close(IN);

			# ����ե�������
			unlink("$cf{tempdir}/$key.tmp");
		}
		# �Ĥ��ü���ˤ�񤭽Ф�
		print OUT @{$sort{$key}} if (@{$sort{$key}});
	}
	close(OUT);

	# �ɤ߽Ф��ե��������
	unlink($in);
}

