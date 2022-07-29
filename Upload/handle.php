
<?php
require '/var/www/html/vendor/autoload.php';
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	// AWS Info
	$bucketName = 'cthanhass2';
	$IAM_KEY = 'AKIARD2MRBAI3MALYYW3';
	$IAM_SECRET = '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';

	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation. us-east-2 is Ohio, us-east-1 is North Virgina
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-east-1'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}

	

	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName = 'upload/' . basename($_FILES["anyfile"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// You need a local copy of the image to upload.
		// My solution: http://stackoverflow.com/questions/21004691/downloading-a-file-and-saving-it-locally-with-php
		// if (!file_exists('/tmp/tmpfile')) {
		// 	mkdir('/tmp/tmpfile');
		// }
				
		// $tempFilePath = '/tmp/tmpfile/' . basename($fileURL);
		// $tempFile = fopen($tempFilePath, "w") or die("Error: Unable to open file.");
		// $fileContents = file_get_contents($fileURL);
		// $tempFile = file_put_contents($tempFilePath, $fileContents);

		$file = $_FILES["anyfile"]['tmp_name'];
		
		$s3Obj = $s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);
		$s3url = $s3Obj['ObjectURL'];

		// WARNING: You are downloading a file to your local server then uploading
		// it to the S3 Bucket. You should delete it from this server.
		// $tempFilePath - This is the local file path.

	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
	}


	echo 'Done';

	// Now that you have it working, I recommend adding some checks on the files.
	// Example: Max size, allowed file types, etc.

	require_once "setting.php";	
	$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	
	if (!$conn) {
		echo "<p> Database connection failure</p>".mysqli_connect_error();
	} 
	else{
	
 	$title = trim($_POST["title"]);
	$date = trim($_POST["date"]);
	$description = trim($_POST["description"]);
	$keyword = trim($_POST["keywords"]);
	$reference = trim($s3url);
	$sql_table = "Photos";
	$query = "INSERT INTO $sql_table (title, date, keyword, description, reference) VALUES ('$title','$date','$keyword','$description','$reference')";
		
	$result = mysqli_query($conn,$query);
if (!$result) {					
		echo "<p> Something is wrong with query</p>";
		echo "Error: " . $query . "<br>" . mysqli_error($conn);
			}
			else {
				echo "<p>Upload successful</p>";
			}
	}
?>