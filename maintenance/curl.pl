#!/usr/bin/perl

$stop = 1;
$count = 0;

sub get_letter()  {
	@letters = (
		"A", "B", "C", "D", "E", "F", "G", "H",
		"I", "J", "K", "L", "M", "N", "O", "P",
		"Q", "R", "S", "T", "U", "V", "W", "X",
		"Y", "Z", "*"
	);
	$index = int(rand(27));
	return $letters[$index];
}

sub get_number()  {
	return int(rand(10));
}

while ($stop)  {
	$id = "";
	while (length($id) < 7)  {
		if (length($id) == 0)  {
			$id .= get_letter();
		}  else  {
			$num = get_number();
			$str = sprintf("$num");
			$id .= $str;
		}
	}

	$url = 'curl -d "state=colorado&id='.$id.'" http://activist2/cam/testform/17';
	$result = system($url);
	print "\n".$url."\n";
	if ($count > 1000)  {
		$stop = 0;
	}
	sleep(1);
	$count++;
}
