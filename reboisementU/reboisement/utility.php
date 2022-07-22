<?php
//require_once 'modele.php';



/*function base_url(){   

// first get http protocol if http or https

$base_url = (isset($_SERVER['HTTPS']) &&

$_SERVER['HTTPS']!='off') ? 'https://' : 'http://';

// get default website root directory

$tmpURL = dirname(__FILE__);

// when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",

//convert value to http url use string replace, 

// replace any backslashes to slash in this case use chr value "92"

$tmpURL = str_replace(chr(92),'/',$tmpURL);

// now replace any same string in $tmpURL value to null or ''

// and will return value like /localhost/my_website/ or just /my_website/

$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);

// delete any slash character in first and last of value

$tmpURL = ltrim($tmpURL,'/');

$tmpURL = rtrim($tmpURL, '/');


// check again if we find any slash string in value then we can assume its local machine

    if (strpos($tmpURL,'/')){

// explode that value and take only first value

       $tmpURL = explode('/',$tmpURL);

       $tmpURL = $tmpURL[0];

      }

// now last steps

// assign protocol in first value

   if ($tmpURL !== $_SERVER['HTTP_HOST'])

// if protocol its http then like this

      $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';

    else

// else if protocol is https

      $base_url .= $tmpURL.'/';

// give return value

return $base_url; 

}


function home_base_url(){   

// first get http protocol if http or https

$base_url = (isset($_SERVER['HTTPS']) &&

$_SERVER['HTTPS']!='off') ? 'https://' : 'http://';

// get default website root directory

$tmpURL = dirname(__FILE__);

// when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",

//convert value to http url use string replace, 

// replace any backslashes to slash in this case use chr value "92"

$tmpURL = str_replace(chr(92),'/',$tmpURL);

// now replace any same string in $tmpURL value to null or ''

// and will return value like /localhost/my_website/ or just /my_website/

$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);

// delete any slash character in first and last of value

$tmpURL = ltrim($tmpURL,'/');

$tmpURL = rtrim($tmpURL, '/');


// check again if we find any slash string in value then we can assume its local machine

    if (strpos($tmpURL,'/')){

// explode that value and take only first value

       $tmpURL = explode('/',$tmpURL);

       $tmpURL = $tmpURL[0];

      }

// now last steps

// assign protocol in first value

   if ($tmpURL !== $_SERVER['HTTP_HOST'])

// if protocol its http then like this

      $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';

    else

// else if protocol is https

      $base_url .= $tmpURL.'/';

// give return value

return $base_url.'assets/'; 

}*/

function createFormulaire($lstChamps,$maxPerRow){

	
	$itemCount = 0; 
	$itemInRow = 0;

	$outputHtml='';

	$outputHtml=$outputHtml.' <form id="frmAction">';
	$outputHtml=$outputHtml.' <table style="width:100%;font-family: tahoma;
    font-size: 11px;" >';
	$outputHtml=$outputHtml.' <tr sytle="text-align: left;">';

	/*$inputText=$inputText."<form id=frmAction>";
	$inputText=$inputText. '<br>';*/

	foreach ($lstChamps as $item):
	 if ($item['type']!=='affichage'){
		$itemCount ++;
		$itemInRow  ++;
		$outputHtml=$outputHtml.'<td style="font-family: tahoma;font-size: 11px;" >';

		switch ($item['type']) {
			  case "input":
			  	$outputHtml=$outputHtml.'<label '.' for='.$item['nom'].' >'.$item['libelle'].':'.'</label> <br>';
			  	$outputHtml=$outputHtml.'<input class="form-control mx-1 border-success" '.' id='.$item['nom'].' name='.$item['nom'].' >'.'</input>';
			    break;
			  case "date":
			  	$outputHtml=$outputHtml.'<label '.' for='.$item['nom'].' >'.$item['libelle'].':'.'</label> <br>';
			  	$outputHtml=$outputHtml.'<input class="form-control mx-1 border-success"  type="date" '.' id='.$item['nom'].' name='.$item['nom'].' >'.'</input>';
			    break;
			  case "inputDisable":
			  	//$outputHtml=$outputHtml.'<label '.' for='.$item['nom'].' class="frmLabel">'.$item['libelle'].':'.'</label> <br>';
			  	$outputHtml=$outputHtml.'<div class="mx-2"><input class="form-control  border-0 bg-white mx-10 border-success" '.' id='.$item['nom'].' name='.$item['nom'].' readonly="readonly">'.' </input> </div>';
			    break;			
			  case "textArea":
			  	$outputHtml=$outputHtml.'<label '.' for='.$item['nom'].'>'.$item['libelle'].':'.'</label> <br>';
			  	$outputHtml=$outputHtml.'<textarea class="form-control  mx-3 border-success" rows = "5" cols = "60" '.' id='.$item['nom'].' name='.$item['nom'].' >'.' </textarea>';
			    break;	    
			  case "select":
			  	$outputHtml=$outputHtml.'<label '.' for='.$item['nom'].' >'.$item['libelle'].':'.'</label> <br>';
			  	$lstKeyValue=setDropDownList($item['tableRef'],$item['key'],$item['val'],'');
			   	$outputHtml= $outputHtml.createDropdown($item['nom'],$lstKeyValue);
			  
			   break;
			   case "upload":
			  	$outputHtml=$outputHtml.'<label '.' for='.$item['nom'].' >'.$item['libelle'].':'.'</label> <br>';
			  	$outputHtml=$outputHtml.'<input class="form-control form-control mx-1 border-success" type="file"'.' id='.$item['nom'].'1 name='.$item['nom'].'1 >'.'</input>';
			  	$outputHtml=$outputHtml.'<input  type="hidden"'.' id='.$item['nom'].' name='.$item['nom'].' >'.'</input>';			  
			   break;
		}
		$outputHtml=$outputHtml.'</td>';
		if ($itemInRow==$maxPerRow ){
			$itemInRow  =0;
			$outputHtml=$outputHtml.' </tr>';
			$outputHtml=$outputHtml.' <tr>';
		}
		if ($itemCount==count($lstChamps)){
			$outputHtml=$outputHtml.' </tr>';
		}
	 }
	endforeach;
	/*$inputText= $inputText. ' </form>';

	$inputText=$inputText. '<br>';*/



	$outputHtml=$outputHtml.' <table>';

	$outputHtml=$outputHtml.' </form>';

	//$outputHtml=$outputHtml.createDropdown('test',$lstChamps);

	return $outputHtml;
	}

	function createDropdown($itemName,$lstKeyValue){

		$outputHtml='<select class="form-control border-success mx-2 selectpicker" id='.$itemName.' name='.$itemName.' >';
        foreach ($lstKeyValue as $value):
            $outputHtml=$outputHtml.'<option value='.$value['cle'].'>'.$value['valeur'].'</option>';
        endforeach;
		$outputHtml=$outputHtml.'</select>';
			//print ($outputHtml);
	    return $outputHtml;
	}
	
	
?>