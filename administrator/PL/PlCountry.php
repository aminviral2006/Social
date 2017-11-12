<?php
/**
 * This class is used to Show Country to Presentation Layer (UI)
 * @author Sumit Joshi
 * @version 1.0
 */
class PlCountry
{
    var $objBllCountry; // Business Logic Layer object
    var $recordSet=array();

    function __construct() {}

    function PlGetCountryList()
    {
        $this->objBllCountry=new BllCountry();
        $this->recordSet=$this->objBllCountry->BllGetCountryList();
    }

    function PlFillCountryBox($id=0)
    {
        $this->PlGetCountryList();
        $country="<select id='sltcountry' name='sltcountry'>";
        for($i=0;$i<count($this->recordSet);$i++)
        {
            if($this->recordSet[$i]['id']==$id)
                $country.="<option value='".$this->recordSet[$i]['id']."' selected='selected'>".$this->recordSet[$i]['CountryName']."</option>";
            else
                $country.="<option value='".$this->recordSet[$i]['id']."'>".$this->recordSet[$i]['CountryName']."</option>";
        }
        $country.="</select>";
        return $country;
    }
}
?>
