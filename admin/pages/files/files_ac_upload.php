<?phpsession_start();include("../functions.php");include("../bd.php");$desc = trim(strip_tags($_POST['desc']));if(strlen($desc)<5){	error("Описание меньше 5 символов!");	die();}function translitIt($str) {    $tr = array(        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"," "=>"_"    );    return strtr($str,$tr);} $uploaddir = '../../../exams/'; // Relative path under webroot $ran = rand(111111,999999); $name = $_FILES['file_upload']['name']; $name = translitIt($name);  $link = $ran."_".$name;  $uploadfile = $uploaddir.$ran."_".$name; if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploadfile) && 	mys("INSERT INTO `files` (`link`,`descrip`) VALUES ('$link','$desc')")) {	error("Файл успешно загружен!");   die(); } else {   error("Не удалось загрузить файл!".$uploadfile);   die(); }?>