#!/usr/bin/perl

my $dir = '/var/www/activist2/img/';
opendir my $dh, $dir or die "Could not open '$dir' for reading: $!\n";

while (my $file = readdir $dh) {
	if ($file !~ m/(gray|thankyou)/)  {  ## convert <image> -alpha on -channel a -evaluate set 25% result.png
		@new_file = split(/\./, $file);
		$newfile = $new_file[0]."_thumb.jpg";
		####
		## Convert color image to grayscale
		## $command = "convert ".$dir.$file." -set colorspace Gray -separate -average ".$dir.$newfile;
		####
		## Lighten grayed image watermark effect
		## $command = "convert ".$dir.$file." -fill white -colorize 85% ".$dir.$newfile;
		####
		## Thummbnail state and country seals
		## $command = "convert ".$dir.$file." -resize 40x40 ".$dir.$newfile;
		####
		## Logo for actifish


		#### $result = system($command);
		## print $command."\n";
		#### print $result."\n";
	}
}
		## $command = "convert -size 150x45 xc:transparent -font Candice -pointsize 46 ".
		##	"-stroke black -strokewidth 4 -fill white ".
		##	"-stroke black -annotate  +5+37 A  -stroke none -annotate  +5+37 A ".
		##	"-stroke black -annotate  +35+37 c  -stroke none -annotate  +35+37 c ".
		##	"-stroke black -annotate +55+37 t  -stroke none -annotate +55+37 t ".
		##	"-stroke black -annotate +70+37 i  -stroke none -annotate +70+37 i ".
		##	"-stroke black -annotate 180x180+95+5 f  -stroke none -annotate 180x180+95+5 f ".
		##	"-stroke black -annotate +95+37 i  -stroke none -annotate +95+37 i ".
		##	"-stroke black -annotate +105+37 s  -stroke none -annotate +105+37 s ".
		##	"-stroke black -annotate +125+37 h  -stroke none -annotate +125+37 h ".
		##	"logo.png";

print $command."\n";
$result = system($command);


