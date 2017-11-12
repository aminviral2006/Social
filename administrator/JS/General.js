/**
 * This checkbox related function is for Tags Form
 */
function CheckAll()
{    
    if(document.frmTag.checkmain.checked==true)
    {
        var ch=document.getElementsByName("checktags[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = true ;
    }
    else
    {
        var ch=document.getElementsByName("checktags[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = false ;
    }

}
function SingleUnChecked()
{
    document.frmTag.checkmain.checked=false;
}

function CheckAllTags()
{
    document.getElementById("checkmain").checked=true;
    var ch=document.getElementsByName("checktags[]");
    for (i = 0; i < ch.length; i++)
        ch[i].checked = true ;
}
/* Ends here */

function CheckTag()
{
    if(document.getElementById("txttagname").value.trim()=="")
    {
        document.getElementById("errtagname").innerHTML="TagName cannot be blank.";
        return false;
    }
    return true;
}
/* Tag Information Ends Here*/

/**
 * This checkbox related function is for Category Form
 */
function CheckAllCategory()
{
    if(document.frmCategory.checkmain.checked==true)
    {
        var ch=document.getElementsByName("checkcategory[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = true ;
    }
    else
    {
        var ch=document.getElementsByName("checkcategory[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = false ;
    }

}
function SingleUnCheck()
{
    document.frmCategory.checkmain.checked=false;
}

function CheckAllCategories()
{
    document.getElementById("checkmain").checked=true;
    var ch=document.getElementsByName("checkcategory[]");
    for (i = 0; i < ch.length; i++)
        ch[i].checked = true ;
}

function CheckCategoryTitle()
{
    if(document.getElementById("txttagname").value.trim()=="")
    {
        document.getElementById("errtagname").innerHTML="TagName cannot be blank.";
        return false;
    }
    return true;
}
/* Category Information Ends Here*/

/**
 * This checkbox related function is for Stuff Form
 */
function CheckAllStuff()
{
    if(document.frmStuff.checkmain.checked==true)
    {
        var ch=document.getElementsByName("checkstuff[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = true ;
    }
    else
    {
        var ch=document.getElementsByName("checkstuff[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = false ;
    }

}
function SingleUnCheckStuff()
{
    document.frmStuff.checkmain.checked=false;
}

function CheckAllStuffs()
{
    document.getElementById("checkmain").checked=true;
    var ch=document.getElementsByName("checkstuff[]");
    for (i = 0; i < ch.length; i++)
        ch[i].checked = true ;
}

function CheckCategoryTitle()
{
    if(document.getElementById("txttagname").value.trim()=="")
    {
        document.getElementById("errtagname").innerHTML="TagName cannot be blank.";
        return false;
    }
    return true;
}
/* Category Information Ends Here*/

/*Loading Selected Stuff Description*/
var xmlhttp=null;
var xhr=null;
function GetXMLHttp()
{
    try
    {
        xmlhttp=new ActiveX("Microsoft.XMLHTTP");
    }
    catch(e)
    {
        xmlhttp=new XMLHttpRequest();
    }
    return xmlhttp;
}
function LoadSelectedDescription(id)
{
    url="LoadSelectedDescription.php?id="+id;
    xhr=new GetXMLHttp();
    xhr.onreadystatechange=SelectedDescriptionStateChanged;
    xhr.open('GET',url,true);
    xhr.send(null);
}
function SelectedDescriptionStateChanged()
{
    if(xhr.readyState==4)
    {
        document.getElementById("txtAddDescription").innerHTML=xhr.responseText;
    }
}
/*Ends here*/

/*Delete Image from Stuff Detail Page from Admin*/
var types="";
function DeleteDescriptionImageComments(id,stuffid,type)
{
    url="DeleteDescriptionImageComments.php?id="+id+"&stuffid="+stuffid+"&type="+type;
    types=type;
    xhr=new GetXMLHttp();
    xhr.onreadystatechange=DeleteDescriptionImageCommentsStateChanged;
    xhr.open('GET',url,true);
    xhr.send(null);
}
function DeleteDescriptionImageCommentsStateChanged()
{
    if(xhr.readyState==4)
    {
        if(types=="image")
            document.getElementById("stuffimagelist").innerHTML=xhr.responseText;
        else if(types=="comment")
            document.getElementById("stuffcommentlist").innerHTML=xhr.responseText;
    }
}
/*Ends*/

/**
 * This checkbox related function is for Members Form
 */
function CheckAllMembers()
{
    if(document.frmMemberRegistration.checkmain.checked==true)
    {
        var ch=document.getElementsByName("checkmember[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = true ;
    }
    else
    {
        var ch=document.getElementsByName("checkmember[]");
        for (i = 0; i < ch.length; i++)
            ch[i].checked = false ;
    }

}
function SingleUnCheckedMember()
{
    document.frmMemberRegistration.checkmain.checked=false;
}

function CheckAllMemberList()
{
    document.getElementById("checkmain").checked=true;
    var ch=document.getElementsByName("checkmember[]");
    for (i = 0; i < ch.length; i++)
        ch[i].checked = true ;
}
/* Ends here */