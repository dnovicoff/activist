#!/usr/bin/perl

$stop = 1;
$count = 0;

sub ips()  {
	@addrs = (
		"3.128.0.4", "3.128.0.4", "3.128.6.238", "3.128.4.32", "3.128.0.26",
		"9.32.12.244", "9.32.194.122", "9.32.138.112", "9.32.51.214", "9.32.15.245",
		"13.52.12.244", "13.52.38.211", "13.52.111.82", "13.52.183.23", "13.52.166.1",
		"15.64.93.14", "15.68.44.1", "15.66.34.22", "15.65.33.18", "15.64.13.99"
	);
	$index = int(rand(50));
	return $addrs[$index];
}

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
