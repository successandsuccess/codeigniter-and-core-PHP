#!/usr/bin/perl
use strict;
use warnings;
use File::Path;

#my $text = `cat ARBGetSubscriptionRequest.php`;
#my $sub = `cat appendSetCode.txt`;
#$text =~ s|(.+)}|$1$sub|xms;
#print 'Result : '.$text."\n";

#mkdir 'backup';
while (<>) {
    chomp;
    my $filepath = "lib/net/authorize/api/contract/";
    my $filename = $filepath."v1/".$_;
    my $text = `cat $filename`;
#    print $filename;
    my $backupdir = "$filepath"."backup/$_";
    $backupdir =~ s/(.*)\/.*$/$1/;
    mkpath($backupdir) unless -d $backupdir;
    open(my $fh, '>', "$filepath"."backup/$_");
    print $fh $text;
    close $fh;
#    print 'Result : '.$text."\n";
}
#unless(mkdir 'backup') {
#        die "Unable to create directory backup\n";
#    }
#open(my $fh, '>', 'backup/ARBGetSubscriptionRequest copy2.php');
#print $fh "My first report generated by perl\n";
#close $fh;
