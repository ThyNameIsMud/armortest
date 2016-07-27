<?

$config = array(
		'base' => '/Users/lweber/Sites/armor',
		'users' => array()
	);

// Get da datas
if(file_exists($config['base'].'/model/data.csv'))
{
	$file = fopen($config['base'].'/model/data.csv', 'r');
	$tries = 1;
	while(!$file && $tries<5)
	{
		$file = fopen($config['base'].'/model/data.csv', 'r');
		$tries++;
	}

	if($tries == 5)
	{
		die("Unable to open file: {$logFile}");
	}

	if($file)
	{
		$count = -2;

		while(($row = fgetcsv($file)) !== false)
		{
			$count++;
			if($count === -1 || $row[0] == "") continue;

			$config['users'][$count]['name']			 = $row[0];
			$config['users'][$count]['serve_accuracy']   = $row[1];
			$config['users'][$count]['serve_spin'] 		 = $row[2];
			$config['users'][$count]['return_skill'] 	 = $row[3];
			$config['users'][$count]['return_accuracy']  = $row[4];
			$config['users'][$count]['return_spin'] 	 = $row[5];
			$config['users'][$count]['notes'] 			 = $row[6];
		}

		fclose($file);
	}
}
else
{
	die("Datas Not Found");
}

$file = fopen($config['base'].'/model/users.json', 'w');
$tries = 1;
while(!$file && $tries<5)
{
	$file = fopen($config['base'].'/model/users.json', 'w');
	$tries++;
}

if($tries == 5)
{
	die("Unable to open file: {$logFile}");
}

$contents = json_encode($config['users']);

fwrite($file,$contents);
fflush($file);
fclose($file)

?>