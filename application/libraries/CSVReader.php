<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class CSVReader {


function csv_to_array($Filepath)
{
    //Get csv file content
    $csvData = file_get_contents($Filepath);

    //Remove empty lines
    $csvData = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\r\n", $csvData);

    //String convert in array formate and remove double quote(")
    $array = array();
    $array = $this->escape_string(preg_split('/\r\n|\r|\n/', $csvData));
    $new_content_in_array = array();
    if($array)
    {
        //Get array key
        $array_keys = array();
        $array_keys = array_filter(array_map('trim', explode(';',$array[0])));

        //Get array value
        $array_values = array();
        for ($i=1;$i<count($array);$i++)
        {
            if($array[$i])
            {
                $array_values[] = array_filter(array_map('trim', explode(';',$array[$i])));
            }
        }

        //Convert in associative array
        if($array_keys && $array_values)
        {
            $assoc_array = array();
            foreach ($array_values as $ky => $val)
            {           
                for($j=0;$j<count($array_keys);$j++){
                    if($array_keys[$j] != "" && $val[$j] != "" && (count($array_keys) == count($val)))
                    {
                        $assoc_array[$array_keys[$j]] = $val[$j];
                    }
                }
                $new_content_in_array[] = $assoc_array;
            }
        }
    }
    return $new_content_in_array;
}

function escape_string($data){
    $result =   array();
    foreach($data as $row){
        $result[]   = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", str_replace('"', '',$row));
    }
    return $result;
}
    }
?>