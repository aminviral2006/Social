<?php
/**
 * This class is used to Store and Retrive details of Countries
 * @author Sumit Joshi
 * @version 1.0
 */
class BllCountry
{
    var $objConnection; //MySql Connection Object
    var $recordSet=array();

    function __construct(){}

    /**
     * This method is used to Return the RecordSet (Array)
     * Main use of this method is to FILL SELECT BOX in Member Profile Page.
     * @return array $this->recordSet
     */
    function BllGetCountryList()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblCountry";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);
        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllGetCountryDetails($countryid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblCountry Where ID=".$countryid;
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);
        $this->objConnection->Close();
        return $this->recordSet[0]['CountryName'];
    }
}
?>
