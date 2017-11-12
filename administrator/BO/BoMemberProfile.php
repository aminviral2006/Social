<?php
/**
 * This class is used for Member Profile settings.
 *
 * @author Sumit Joshi
 * @version 1.0
 */
class BoMemberProfile
{
    var $id; //int P.K. tblMemberProfile
    var $memberid; //int F.K. Reference tblMemberRegistration
    var $profileimagepath; //string Path of Member Profile Image
    var $gender; //enum 'M' or 'F'
    var $gendervisibility; //enum 'Y' or 'N'
    var $birthdate; //date Birth Date of Member
    var $birthdatevisibility; //enum 'Y' or 'N'
    var $country; //string Country of Member
    var $countryvisibility; //enum 'Y' or 'N'
    var $sexulapreference; //enum 'M' or 'W'
    var $sexulavisibility; //enum 'Y' or 'N'
    var $relationshipstatus; //enum 'N'-None, 'S'-Single, 'I'-In Relationship
    var $relationshipvisibility; //enum 'Y' or 'N'
    var $education; //string Education of Member
    var $educationvisibility; //enum 'Y' or 'N'
    var $children; //enum 'Y' or 'N'
    var $childrenvisibility; //enum 'Y' or 'N'
    var $about; //varbinary Description about Member him/her self

    //Setters
    function setId($value) { $this->id=$value; }
    function setMemberId($value) { $this->memberid=$value; }
    function setProfileImagePath($value) { $this->profileimagepath=$value; }
    function setGender($value) { $this->gender=$value; }
    function setGenderVisibility($value) { $this->gendervisibility=$value; }
    function setBirthDate($value) { $this->birthdate=$value; }
    function setBirthDateVisibility($value) { $this->birthdatevisibility=$value; }
    function setCountry($value) { $this->country=$value; }
    function setCountryVisibility($value) { $this->countryvisibility=$value; }
    function setSexualPreference($value) { $this->sexulapreference=$value; }
    function setSexualVisibility($value) { $this->sexulavisibility=$value; }
    function setRelationshipStatus($value) { $this->relationshipstatus=$value; }
    function setRelationshipVisibility($value) { $this->relationshipvisibility=$value; }
    function setEducation($value) { $this->education=$value; }
    function setEducationVisibility($value) { $this->educationvisibility=$value; }
    function setChildren($value) { $this->children=$value; }
    function setChildrenVisibility($value) { $this->childrenvisibility=$value; }
    function setAbout($value) { $this->about=$value; }

    //Getters
    function getId() { return $this->id; }
    function getMemberId() { return $this->memberid; }
    function getProfileImagePath() { return $this->profileimagepath; }
    function getGender() { return $this->gender; }
    function getGenderVisibility() { return $this->gendervisibility; }
    function getBirthDate() { return $this->birthdate; }
    function getBirthDateVisibility() { return $this->birthdatevisibility; }
    function getCountry() { return $this->country; }
    function getCountryVisibility() { return $this->countryvisibility; }
    function getSexualPreference() { return $this->sexulapreference; }
    function getSexualVisibility() { return $this->sexulavisibility; }
    function getRelationshipStatus() { return $this->relationshipstatus; }
    function getRelationshipVisibility() { return $this->relationshipvisibility; }
    function getEducation() { return $this->education; }
    function getEducationVisibility() { return $this->educationvisibility; }
    function getChildren() { return $this->children; }
    function getChildrenVisibility() { return $this->childrenvisibility; }
    function getAbout() { return $this->about; }
}
?>