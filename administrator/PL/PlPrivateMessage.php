<?php
/**
 * 
 */
class PlPrivateMessage
{
    var $objPrivateMsg;
    var $row;

    function  __construct() {}

    function PlAddPrivateMessage(BoPrivateMessage $objBo)
    {
        $this->objPrivateMsg=new BllPrivateMessage();
        $msg=$this->objPrivateMsg->BllAddPrivateMessage($objBo);
        return $msg;
    }
    function PlShowPrivateMessageInbox(BoPrivateMessage $objBo)
    {
        $Inbox=array();
        $this->objPrivateMsg=new BllPrivateMessage();
        $InboxRecord=$this->objPrivateMsg->BllShowPrivateMessageInbox($objBo);
        return $InboxRecord;
    }
    function PlShowPrivateMessageSent(BoPrivateMessage $objBo)
    {
        $this->objPrivateMsg=new BllPrivateMessage();
        $SentRecord=$this->objPrivateMsg->BllShowPrivateMessageSent($objBo);
        return $SentRecord;
    }

    function PlUnreadMessageCount()
    {
        $this->objPrivateMsg=new BllPrivateMessage();
        $Count=$this->objPrivateMsg->BllUnreadMessageCount();
        return $Count;
    }

    function PlPageDetail(BoPrivateMessage $objBo)
    {
        $this->objPrivateMsg=new BllPrivateMessage();
        $MemberName=$this->objPrivateMsg->BllPageDetail($objBo);
        return $MemberName;
    }

    function PlDeletePrivateMessage(BoPrivateMessage $objBo)
    {
        $this->objPrivateMsg=new BllPrivateMessage();
        $result=$this->objPrivateMsg->BllDeletePrivateMessage($objBo);
        return $result;
    }

    function PlSendMessageToAllByAdmin($message)
    {
        $this->objPrivateMsg=new BllPrivateMessage();
        $result=$this->objPrivateMsg->BllSendMessageToAllByAdmin($message);
        return $result;
    }
}
?>
