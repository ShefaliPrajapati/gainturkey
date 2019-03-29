<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array, $download = "")
    {  $array=array_values($array);
	
	
	$f = fopen($download, 'w+') or show_error("Can't open php://output");
        $n = 0;    $str="";    

        foreach ($array as $line)
        { $i=0;if(count($line[$i])>0)
		  { 
		 while($i<count($line))
		 { 

		 
		    foreach($line[$i] as $key=>$val)
			{
			if($val!="")
			{
			$val=str_replace(array(",",";"),"  " ,$val);
			$str.=$val.",";
			}
			else
			$str.="NIL,";
            } 
			substr($str,0,strlen($str)-1);
			$i++; $str.="\n";
			}
//			$str.=implode(",",$line[0]);
			
			
        }}

		if ($download != "")
        {    
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
			print_r($str);
        }}
}

if ( ! function_exists('query_to_csv'))
{
    function query_to_csv($query, $headers = TRUE, $download = "")
    {
        if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
        {
            show_error('invalid query');
        }
        
        $array = array();
        
        if ($headers)
        {
            $line = array();
            foreach ($query->list_fields() as $name)
            {
                $line[] = $name;
            }
            $array[] = $line;
        }
        
        foreach ($query->result_array() as $row)
        {
            $line = array();
            foreach ($row as $item)
            {
                $line[] = $item;
            }
            $array[] = $line;
        }

        echo array_to_csv($array, $download);
    }
	
	
}
if ( ! function_exists('capitalizeArraywords'))
{
 function capitalizeArraywords($array)
	{
	foreach($array as $key=>$val)
	{
	 
	  $val=str_replace("_"," ",$val);
	 $val=ucwords($val);
	 $array[$key]=$val;
	}
	return $array;
	}
}
?>