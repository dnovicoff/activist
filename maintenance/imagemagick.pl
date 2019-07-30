#!/usr/bin/perl

my $dir = '/var/www/activist2/img/';
opendir my $dh, $dir or die "Could not open '$dir' for reading: $!\n";

while (my $file = readdir $dh) {
	if ($file !~ m/(gray|thankyou)/)  {  ## convert <image> -alpha on -channel a -evaluate set 25% result.png
		@new_file = split(/\./, $file);
		$newfile = $new_file[0]."_thumb.jpg";
		####
		## Convert color image to grayscale
		####
		## $command = "convert ".$dir.$file." -set colorspace Gray -separate -average ".$dir.$newfile;
		####
		## Lighten grayed image watermark effect
		####
		## $command = "convert ".$dir.$file." -fill white -colorize 85% ".$dir.$newfile;
		####
		## Thummbnail state and country seals
		####
		$command = "convert ".$dir.$file." -resize 40x40 ".$dir.$newfile;
		#### $result = system($command);
		print $command."\n";
		#### print $result."\n";
	}
}


