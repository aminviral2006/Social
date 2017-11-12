<?php
/**
 * This Class upload the files specified on the targeted location.
 * @Author       : Sumit Joshi
 * @Date Created : 27-Mar-2009
 */
class FileUploader
{
    var $fileName;
    var $fileType;
    var $fileSize;
    var $fileError;
    var $fileTempName;

    function __construct($file="")
    {
        $this->fileName=$_FILES[$file]['name'];
        $this->fileType=$_FILES[$file]['type'];
        $this->fileSize=$_FILES[$file]['size'];
        $this->fileError=$_FILES[$file]['error'];
        $this->fileTempName=$_FILES[$file]['tmp_name'];
    }

    /**
     * This method will check uploaded file type and upload it.
     * @param string $fileTypeToUpload -- Pdf,Text,Document-Word,Image
     * @param string $targetDirectory -- Target Directory Name
     * @return string $message
     */
    /*function checkUploadedFileType($fileTypeToUpload,$targetDirectory)
    {

        if(ucfirst($fileTypeToUpload)=="Image")
        {
            $this->uploadFile($targetDirectory);
        }
        elseif(ucfirst($fileTypeToUpload)=="Document")
        {
            $this->uploadFile($targetDirectory);
        }
        elseif(ucfirst($fileTypeToUpload)=="Text")
        {
            $this->uploadFile($targetDirectory);
        }
        elseif(ucfirst($fileTypeToUpload)=="Pdf")
        {
            $this->uploadFile($targetDirectory);
        }
        elseif(ucfirst($fileTypeToUpload)=="All")
        {
            $this->uploadFile($targetDirectory);
        }
        else
        {
            $message="Your file type is ".$this->fileType ." and it is not allowed";
            return $message;
        }
        $message="File uploaded successfully.";
        return $message;
    }*/

    function uploadFile($targetDirectory,$defaultname="")
    {
        if($defaultname=="")
            $defaultname="default.jpg";
        else
            $defaultname=$_SESSION['memberid']."jpg";
        @move_uploaded_file($this->fileTempName,$targetDirectory."//".$defaultname);
        @unlink($this->fileName);
    }
}
?>
