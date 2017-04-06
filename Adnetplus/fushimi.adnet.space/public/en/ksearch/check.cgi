#!/usr/local/bin/perl

#��������������������������������������������������������������������
#�� KEY SEARCH : check.cgi - 2012/04/1
#�� Copyright (c) KentWeb
#�� http://www.kent-web.com/
#��������������������������������������������������������������������

# �⥸�塼�����
use strict;
use CGI::Carp qw(fatalsToBrowser);

# �����ե����������
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
<li>Perl�С������ : $]
EOM

if ($] >= 5.005) {
	print "<li>Perl�С������ : OK\n";
} else {
	print "<li>Perl�С������ : NG\n";
}

# �ե�����
my %log = ('index.dat' => '����ǥå����ե�����', 'set.dat' => '����ե�����');
foreach ( keys(%log) ) {
	if (-e "$cf{datadir}/$_") {
		print "<li>$log{$_}�ѥ� : OK\n";

		if (-r "$cf{datadir}/$_" && -w "$cf{datadir}/$_") {
			print "<li>$log{$_}�ѡ��ߥå���� : OK\n";
		} else {
			print "<li>$log{$_}�ѡ��ߥå���� : NG\n";
		}
	} else {
		print "<li>$log{$_}�ѥ� : NG\n";
	}
}

# ����ǥ��쥯�ȥ�
if (-d $cf{tempdir}) {
	print "<li>����ǥ��쥯�ȥ�ѥ� : OK\n";
	if (-r $cf{tempdir} && -w $cf{tempdir} && -x $cf{tempdir}) {
		print "<li>����ǥ��쥯�ȥ�ѡ��ߥå���� : OK\n";
	} else {
		print "<li>����ǥ��쥯�ȥ�ѡ��ߥå���� : NG\n";
	}
} else {
	print "<li>����ǥ��쥯�ȥ�ѥ� : NG\n";
}

# �ƥ�ץ졼��
my @tmpl = qw|search note error|;
foreach (@tmpl) {
	if (-f "$cf{tmpldir}/$_.html") {
		print "<li>�ƥ�ץ졼��( $_.html ) : OK\n";
	} else {
		print "<li>�ƥ�ץ졼��( $_.html ) : NG\n";
	}
}

print <<EOM;
</ul>
</body>
</html>
EOM
exit;

