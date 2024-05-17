<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Model Data</title> 
</head>
<body>
	<h1>Data returned from SQLite DB </h1>  
        <?php for ($i=0; $i <count ($data); $i++){ ?>

            <ul>
                <li class="<?php echo strtolower($data[$i]['brand'])."-card" ?>">Brand: <?php echo $data[$i]['brand'] ?></li>
                <li>Model Title: <?php echo $data[$i]['modelTitle'] ?></li>
                <li>Model Subtitle: <?php echo $data[$i]['modelSubtitle'] ?></li>
                <li>Model Description: <?php echo $data[$i]['modelDescription'] ?></li>
            </ul>
    
    	<?php } ?>
</body>
</html>