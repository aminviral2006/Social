<?php
/**
 * This class is used to Handle Member Profile
 * @author Sumit Joshi
 * @version 1.0
 */
class PlMemberProfile
{
    var $objBllMemberProfile; //Business Logic Layer object
    var $objBllCountry; //Business Logic Layer object
    var $recordSet=array(); //array

    function __construct(){}

    /**
     * This method is used to Return a RecordSet in form of an Array to Edit Profile Page
     * @param BoMemberProfile $objBo
     * @return array $this->recordSet
     */
    function PlGetMemberProfileDetails(BoMemberProfile $objBo)
    {
        $this->objBllMemberProfile=new BllMemberProfile();
        $this->recordSet=$this->objBllMemberProfile->BllGetMemberProfileDetail($objBo);
        return $this->recordSet;
    }

    /**
     * This method is used Update Member Profile.
     * This method accepts Busines Object of Member Profile and Passed it to Business Logic Layer Method
     * @param BoMemberProfile $objBo
     */
    function PlUpdateMemberProfile(BoMemberProfile $objBo)
    {
        $this->objBllMemberProfile=new BllMemberProfile();
        $msg=$this->objBllMemberProfile->BllUpdateMemberProfile($objBo);
        return $msg;
    }

    /**
     * This method is used to Fill Gender Select Box based on value of gender passed from Database's Gender field.
     * @param string $gen
     * @return string $gender
     */
    function PlFillGender($gen='')
    {
        $arrGender=array('N'=>'None Selected','M'=>'Male','F'=>'Female');
        $gender= "<select id='sltgender' name='sltgender'>";
        foreach($arrGender as $key => $value)
        {
            if($gen==$key)
                $gender.= "<option value='$key' selected='selected'>$value</option>";
            else
                $gender.= "<option value='$key'>$value</option>";
        }
        $gender.= "</select>";
        return $gender;       
    }

    /**
     * This method is used to Fill Birth Year Select Box
     * @param int $yr 2006 to 1906
     * @return string $year Select Box with Birth Year List
     */
    function PlFillBirthYear($yr=0)
    {
        $year="<select id='sltyear' name='sltyear'>";
        $year.="<option value=''>&nbsp;</option>";
        
        for($i=2006;$i>=1906;$i--)
        {
            if($i==$yr)
                $year.="<option value='$i' selected='selected'>$i</option>";
            else
                $year.="<option value='$i'>$i</option>";
        }
        $year.="</select>";        
        return $year;
    }

    /**
     * This method is used to Fill Birth Month Select Box
     * @param int $mn January to December
     * @return string $month Select Box with Birth Month List
     */
    function PlFillBirthMonth($mn=0)
    {
        $arrMonth=array(''=>'','1'=>'January','2'=>'Febuary','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
        $month="<select id='sltmonth' name='sltmonth'>";
        foreach($arrMonth as $key => $value)
        {
            if($key==$mn)
                $month.="<option value='$key' selected='selected'>$value</option>";
            else
                $month.="<option value='$key'>$value</option>";
        }
        $month.="</select>";
        return $month;
    }

    /**
     * This method is used to Fill Birth Day Select Box
     * @param int $d 1 to 31
     * @return string $day Select Box with Birth Day List
     */
    function PlFillBirthDay($d=0)
    {
        $day="<select id='sltday' name='sltday'>";
        $day.="<option value=''></option>";
        for($i=1;$i<=31;$i++)
        {
            if($i==$d)
                $day.="<option value='$i' selected='selected'>$i</option>";
            else
                $day.="<option value='$i'>$i</option>";
        }
        $day.="</select>";
        return $day;
    }

    /**
     * This method is used to Fill Country Select Box
     * @param int $id
     * @return string Select Box
     */
    function PlFillCountry($id=0)
    {
        $this->objPlCountry=new PlCountry();
        return $this->objPlCountry->PlFillCountryBox($id);
    }

    /**
     * This method is used to Fill Relationship Select Box based on value of Relationship passed from Database's Relationship field.
     * @param string $rel
     * @return string $relationship
     */
    function PlFillRelationshipStatus($rel='')
    {
        $arrRelationship=array('N'=>'None Selected','S'=>'Single','I'=>'In Relationship');
        $relationship= "<select id='sltrelationship' name='sltrelationship'>";
        foreach($arrRelationship as $key => $value)
        {
            if($rel==$key)
                $relationship.= "<option value='$key' selected='selected'>$value</option>";
            else
                $relationship.= "<option value='$key'>$value</option>";
        }
        $relationship.= "</select>";
        return $relationship;
    }

    function PlFillEducation($ed='')
    {
        $arrEducation=array('N'=>'None Selected','High School'=>'High School','Some College'=>'Some College','Graduate'=>'Graduate','Post Graduate'=>'Post Graduate');
        $education= "<select id='slteducation' name='slteducation'>";
        foreach($arrEducation as $key => $value)
        {
            if($ed==$key)
                $education.= "<option value='$key' selected='selected'>$value</option>";
            else
                $education.= "<option value='$key'>$value</option>";
        }
        $education.= "</select>";
        return $education;
    }

    /**
     * This method is used to Print Member's Visible Info on Member's Profile Page
     * @param int $memberid
     * @return string $output
     */
    function PlShowMemberInfoOnProfilePage(BoMemberProfile $objBo)
    {
        $this->objBllMemberProfile=new BllMemberProfile();
        $this->recordSet=$this->objBllMemberProfile->BllGetMemberProfileDetail($objBo);
        $output="<table>";
        
        //Gender
        if($this->recordSet[0]['GenderVisibility']=="Y" && $this->recordSet[0]['Gender']=="M")
            $output.="<tr><td><span class='ProfileLabel'>Gender:</span>Male</td></tr>";
        else if($this->recordSet[0]['GenderVisibility']=="Y" && $this->recordSet[0]['Gender']=="F")
                    $output.="<tr><td><span class='ProfileLabel'>Gender:</span>Female</td></tr>";
        //BirthDate
        if($this->recordSet[0]['BirthDateVisibility']=="Y")
            $output.="<tr><td><span class='ProfileLabel'>BirthDate:</span>".$this->recordSet[0]['BirthDate']."</td></tr>";
        //Country
        if($this->recordSet[0]['CountryVisibility']=="Y")
        {
            $objCountry=new BllCountry();
            $countryname=$objCountry->BllGetCountryDetails($this->recordSet[0]['CountryID']);
            $output.="<tr><td><span class='ProfileLabel'>Country:</span>".$countryname."</td></tr>";
        }
        //SexualPreference
        if($this->recordSet[0]['SexualVisibility']=="Y")
            $output.="<tr><td><span class='ProfileLabel'>Sexual Preference:</span>".$this->recordSet[0]['SexualPreference']."</td></tr>";
        //Relationship Status
        if($this->recordSet[0]['RelationshipVisibility']=="Y" && $this->recordSet[0]['RelationshipStatus']=="I")
            $output.="<tr><td><span class='ProfileLabel'>Relationship Status:</span>In Relationship</td></tr>";
        else if($this->recordSet[0]['RelationshipVisibility']=="Y" && $this->recordSet[0]['RelationshipStatus']=="S")
            $output.="<tr><td><span class='ProfileLabel'>Relationship Status:</span>Single</td></tr>";
        else if($this->recordSet[0]['RelationshipVisibility']=="Y" && $this->recordSet[0]['RelationshipStatus']=="N")
            $output.="<tr><td><span class='ProfileLabel'>Relationship Status:</span>None Selected</td></tr>";
        //Education 
        if($this->recordSet[0]['EducationVisibility']=="Y")
            $output.="<tr><td><span class='ProfileLabel'>Education:</span>".$this->recordSet[0]['Education']."</td></tr>";
        //Children
        if($this->recordSet[0]['ChildrenVisibility']=="Y" && $this->recordSet[0]['Children']=="N")
            $output.="<tr><td><span class='ProfileLabel'>Children:</span>No</td></tr>";
        else if($this->recordSet[0]['ChildrenVisibility']=="Y" && $this->recordSet[0]['Children']=="Y")
            $output.="<tr><td><span class='ProfileLabel'>Children:</span>Yes</td></tr>";
        $output.="</table>";

        return $output;
    }    
}
?>
