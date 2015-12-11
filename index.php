<?php
/**
 * Created by PhpStorm.
 * User: ameya
 * Date: 11/28/2015
 * Time: 10:53 PM
 */
if(isset($_GET['zodiac_sign'])) {
    $zodiac = $_GET['zodiac_sign'];
    if (isset($_GET['format'])){
        $format=$_GET['format'].strtoupper();
    }
    else{
        $format="JSON";
    }
    $homepage = file_get_contents('http://www.psychicguild.com/Daily-Horoscope/Aries#now2');
    $first_step = explode('<div id="now2" style="">', $homepage);
    $second_step = explode("</div>", $first_step[1]);
    echo $second_step[0];
    if($format=="JSON"){}
}
else{
    $format="XML";
    $zodiac="Aries";
    $homepage = file_get_contents('http://www.psychicguild.com/Daily-Horoscope/Aries#now2');
    $first_step = explode('<div id="now2" style="">', $homepage);
    $second_step = explode("</div>", $first_step[1]);
   // echo $second_step[0];
    if($format=="JSON"){
        $json_data=' "information":["zodiac_Sign":"'.$zodiac.'","horoscope":"'.$second_step[0].'"]';
        echo $json_data;
    }
    else
    {if($format=="XML"){
       // $xml_data="<?xml version='1.0' encoding='UTF-8'
        $string ="
        <information>
    <zodiac>$zodiac</zodiac><br>
    <horoscopre>$second_step[0]</horoscopre><br>
    </information>";

       $doc = new DOMDocument('1.0');
// we want a nice output
        $doc->formatOutput = true;

        $root = $doc->createElement('information');
        $root = $doc->appendChild($root);

        $title = $doc->createElement('zodiac');
        $title = $root->appendChild($title);

        $text = $doc->createTextNode($zodiac);
        $text = $title->appendChild($text);

        $title1 = $doc->createElement('horoscope');
        $title1 = $root->appendChild($title1);

        $text1 = $doc->createTextNode($second_step[0]);
        $text1 = $title1->appendChild($text1);

        echo $doc->saveXML();



        /*echo "<xsl:output method='xml' version='1.0' encoding='UTF-8' indent='yes'/>";
        echo "<zodiac>".$zodiac."</zodiac>";
        echo "<xsl:stylesheet>";*/
    }
    }
}
?>
