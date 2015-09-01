<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MethodsConstants{
    public static $domain = "http://rfid.dev";
    
    public static function dateTimeMexicoCenter($date)
    {
	$datetime = new DateTime($date);
	$datetime->modify('-5 hour');
	return $datetime->format('Y-m-d H:i:s');        
    }
        
    public static function nameDayEnglishToEspanish($name)
    {
        switch($name)
        {
            case "Monday": return "Lunes";
            case "Tuesday": return "martes";
            case "Wednesday": return "Miércoles";
            case "Thursday": return "Jueves";
            case "Friday": return "Viernes";
            case "Saturday": return "Sábado";
            case "Sunday": return "Domingo";       
        }
        return "";
    }
    
    public static function nameMonthEnglishToEspanish($name)
    {
        switch($name)
        {
            case "January": return "Enero";
            case "February": return "Febrero";
            case "March": return "Marzo";
            case "April": return "Abril";
            case "May": return "Mayo";
            case "June": return "Junio";
            case "July": return "Julio";       
            case "August": return "Agosto";       
            case "September": return "Septiembre";       
            case "October": return "Octube";       
            case "November": return "Noviembre";        
            case "December": return "Diciembre";  
        }
        return "";
    }    
 
    /*
     * Covert to strin array of date times in english to
     * array bidemensional in spanish
     */
    public static function datesTimesStrEnglishToEspanishArray($dateTimes)
    {        
        $dateTimesArray = array();
        foreach($dateTimes as $dateTime)
        {
            $dtt = explode(" ", $dateTime->entrance);     
            $dtt2 = explode("-", $dtt[1]);
            $array = array('name_day'=> MethodsConstants::nameDayEnglishToEspanish($dtt[0]),
                'number_day'=>$dtt2[0],'month'=>MethodsConstants::nameMonthEnglishToEspanish($dtt2[1]),
                'year'=>$dtt2[2],'time'=>$dtt[2]);
            array_push($dateTimesArray, $array);
        }
        return $dateTimesArray;
    }    
    
}
