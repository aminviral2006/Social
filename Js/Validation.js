var flags=new Array()
var xmlHttp=null;
var xhrHttp=null;
/**
 * A Function Prototype for Trimming the blank spaces
 */
String.prototype.trim = function()
{
    return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
}

function ValidateMemberForm()
{
    var count=0;
    
    checkNickName();
    checkEmail();
    checkVerifyEmail();
    checkPassword();
    checkVerifyPassword();
    updatePage();    
    
    for(i=0;i<flags.length;i++)
    {
        if(flags[i]==1)
        {
            //alert(i);
            count=1;
            //break;
        }
    }
    //alert(count);
    if(count==1)
        return false;
    else
    {
        document.frmSignUp.task.value="save";
        return true;
    }
    
}

function checkNickName()
{
    if(document.frmSignUp.txtnickname.value.trim()=="")
    {
        flags[0]=1;
        document.getElementById("errnickname").innerHTML="required";
        //return false;
    }
    else
    {
        flags[0]=0;
        document.getElementById("errnickname").innerHTML="&nbsp;";
    }
    
}

function checkEmail()
{
    var str=document.frmSignUp.txtemail.value.trim()
    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if(str!="")
    {
        if(filter.test(str))
        {
            flags[1]=0;
            document.getElementById("erremail").innerHTML="&nbsp;";
        }
        else
        {
            flags[1]=1;
            document.getElementById("erremail").innerHTML="Invalid Email";
            //return false;
        }
    }
    else
    {
        flags[1]=1
        document.getElementById("erremail").innerHTML="required";
        //return false;
    }    
}

function checkVerifyEmail()
{
    var str=document.frmSignUp.txtverifyemail.value.trim()
    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if(str!="")
    {
        if(filter.test(str))
        {
            var vemail=document.frmSignUp.txtemail.value.trim()
            if(str==vemail)
            {
                flags[2]=0;
                document.getElementById("errverifyemail").innerHTML="&nbsp;";
            }
            else
            {
                flags[2]=1;
                document.getElementById("errverifyemail").innerHTML="Email is not verified";
                //return false;
            }
        }
        else
        {
            flags[2]=1;
            document.getElementById("errverifyemail").innerHTML="Invalid Email";
            //return false;
        }
    }
    else
    {
        flags[2]=1
        document.getElementById("errverifyemail").innerHTML="required";
        //return false;
    }
    
}

function checkPassword()
{
    var pswd=document.frmSignUp.txtpassword.value.trim();
    if(pswd!="")
    {
        pslen=pswd.length;
        if(pslen < 6 || pslen >10)
        {
            flags[3]=1;
            document.getElementById("errpassword").innerHTML="Password must be between 6 to 10 characters";
            //return false;
        }
        else
        {
            flags[3]=0;
            document.getElementById("errpassword").innerHTML="&nbsp;";
        }
    }
    else
    {
        flags[3]=0;
        document.getElementById("errpassword").innerHTML="required";
        //return false;
    }
    
}

function checkVerifyPassword()
{
    var vfpswd=document.frmSignUp.txtverifypassword.value.trim();
    var pswd=document.frmSignUp.txtpassword.value.trim();
    if(vfpswd!="")
    {
        if(vfpswd!=pswd)
        {
            flags[4]=1;
            document.getElementById("errverifypassword").innerHTML="Password does not matched";
            //return false;
        }
        else
        {
            flags[4]=0;
            document.getElementById("errverifypassword").innerHTML="&nbsp;";
        }
    }
    else
    {
        flags[4]=1;
        document.getElementById("errverifypassword").innerHTML="required";
        //return false;
    }
    
}

function GetXmlHttpObject()
{
    if (window.XMLHttpRequest)
    {
      // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp= new XMLHttpRequest();
    }
    if (window.ActiveXObject)
    {

        // code for IE6, IE5
        xmlHttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlHttp;
}

function checkIsUserExist(str)
{
    checkNickName();
    if(flags[0]==0)
    {
        xhrHttp=GetXmlHttpObject();
        url="IsUserExist.php?nickname="+str;
        xhrHttp.onreadystatechange=checkUserExist;
        xhrHttp.open('GET',url,true);
        xhrHttp.send(null);
    }
}

function checkUserExist()
{
    //alert(xhrHttp.responseText);
    if(xhrHttp.readyState==4 && xhrHttp.status==200)
    {
        str=xhrHttp.responseText;
        if(str.trim()=="Exist".trim())
        {
            flags[0]=1;
            var errstr="<img src='../Images/errorred.jpg' width='18px' height='18px'/>Nickname exist";
            document.getElementById("errnickname").innerHTML=errstr;
        }
        else
        {
            flags[0]=0
            document.getElementById("errnickname").innerHTML="&nbsp;";
        }
    }
    else
    {
        flags[0]=1;
        var errstr="<img src='../Images/008.gif' width='32px' height='32px'/>";
        document.getElementById("errnickname").innerHTML=errstr;
    }
}

function checkIsEmailExist(str)
{
    checkEmail();
    if(flags[1]==0)
    {
        xhrHttp=GetXmlHttpObject();
        url="IsUserExist.php?email="+str;
        xhrHttp.onreadystatechange=checkEmailExist;
        xhrHttp.open('GET',url,true);
        xhrHttp.send(null);
    }
}

function checkEmailExist()
{
    if(xhrHttp.readyState==4 && xhrHttp.status==200)
    {
        str=xhrHttp.responseText;
        if(str.trim()=="Exist".trim())
        {
            flags[1]=1;
            var errstr="<img src='../Images/errorred.jpg' width='18px' height='18px'>Email exist";
            document.getElementById("erremail").innerHTML=errstr;
        }
        else
        {
            flags[1]=0;
            document.getElementById("erremail").innerHTML="&nbsp;";
        }
    }
    else
    {
        flags[1]=1;
        var errstr="<img src='../Images/008.gif' width='32px' height='32px'/>";
        document.getElementById("erremail").innerHTML=errstr;
    }
}

/**
 * For Captcha Handling
 *
 */
//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject()
{
 if (window.XMLHttpRequest)
 {
    return new XMLHttpRequest(); //Mozilla, Safari ...
 }
 else if (window.ActiveXObject)
 {
    return new ActiveXObject("Microsoft.XMLHTTP"); //IE
 }
 else
 {
    //Display our error message
    alert("Your browser doesn't support the XmlHttpRequest object.");
 }
}

//Our XmlHttpRequest object
var receiveReq = getXmlHttpRequestObject();

//Initiate the AJAX request
function makeRequest(url, param)
{
//If our readystate is either not started or finished, initiate a new request
    //alert(receiveReq.readyState);
    if (receiveReq.readyState == 4 || receiveReq.readyState == 0)
    {

        //Set up the connection to captcha_test.html. True sets the request to asyncronous(default)
        receiveReq.open("POST", url, true);
        //Set the function that will be called when the XmlHttpRequest objects state changes
        receiveReq.onreadystatechange = updatePage;

        receiveReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        receiveReq.setRequestHeader("Content-length", param.length);
        receiveReq.setRequestHeader("Connection", "close");

        //Make the request
        receiveReq.send(param);
    }
}

//Called every time our XmlHttpRequest objects state changes
function updatePage()
{
    //Check if our response is ready
    //alert("updatepage:"+receiveReq.readyState);
    if (receiveReq.readyState == 4)
    {
        //Set the content of the DIV element with the response text
        //document.getElementById('errcaptcha').innerHTML = receiveReq.responseText;
        var res=receiveReq.responseText;
        if(res.trim()=="Success".trim())
        {
            flags[5]=0;
            //alert("success:"+flags[5]);
            //document.getElementById("errcaptcha").style.color="blue";
            document.getElementById("errcaptcha").innerHTML="Matched";            
        }
        else
        {
            flags[5]=1;
            document.getElementById("errcaptcha").innerHTML="Failed";
            ChangeCaptcha();            
        }
    }
    else if(document.frmSignUp.txtCaptcha.value.trim()=="")
    {
        flags[5]=1;
        document.getElementById("errcaptcha").innerHTML="required";
    }
    else
    {
        flags[5]=1;
        var errstr="<img src='../images/008.gif' width='32px' height='32px'/>";
        document.getElementById("errcaptcha").innerHTML=errstr;
    }
}

function ChangeCaptcha()
{
    //Get a reference to CAPTCHA image
    img = document.getElementById('imgCaptcha');
    //Change the image
    img.src = 'create_image.php?' + Math.random();
}

//Called every time when form is perfomed
function getParam(theForm)
{
    //Set the URL
     var url = 'captcha.php';
     //flags[5]=1;
    //Set up the parameters of our AJAX call
    var postStr = theForm.txtCaptcha.name + "=" + encodeURIComponent( theForm.txtCaptcha.value );
    if(document.frmSignUp.txtCaptcha.value.trim()=="")
    {
        flags[5]=1;
        document.getElementById("errcaptcha").innerHTML="required";
    }
    //Call the function that initiate the AJAX request
    else
        makeRequest(url, postStr);
}
/**
 * Ends Here
 */


/*function checkCaptcha()
{
    if(document.frmSignUp.txtcaptcha.value.trim()=="")
    {
        flags[5]=1;
        document.getElementById("errcaptcha").innerHTML="required";
        //return false;
    }
    else
    {
        //alert("in checkcaptcha function");
        str=document.frmSignUp.txtcaptcha.value.trim();
        url="CheckCaptcha.php?txtcaptcha="+str;
        xhrHttp=GetXmlHttpObject();
        xhrHttp.onreadystatechange=checkResult;
        xhrHttp.open("GET",url,true);
        /*xhrHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrHttp.setRequestHeader("Content-length", param.length);
        xhrHttp.setRequestHeader("Connection", "close");
        xhrHttp.send("txtcapth="+str);
        xhrHttp.send(null);
    }
}

function checkResult()
{
    if(xhrHttp.readyState==4 && xhrHttp.status==200)
    {
        var res=xhrHttp.responseText;
        alert(res);
        if(res.trim()=="Success".trim())
        {
            flags[5]=0;
            //alert("success:"+flags[5]);
            //document.getElementById("errcaptcha").style.color="blue";
            document.getElementById("errcaptcha").innerHTML="Matched";
            xhrHttp=null;
            xmlHttp=null;
        }
        else
        {
            flags[5]=1;
            document.getElementById("errcaptcha").innerHTML=res;
            //changeCaptcha();
        }
    }
    else
    {
        //document.getElementById("errcaptcha").innerHTML="&nbsp;";
    }
}
var xhrCaptcha=null;
function changeCaptcha()
{
    url="ChangeCaptcha.php";
    xhrCaptcha=GetXmlHttpObject();
    xhrCaptcha.onreadystatechange =statechange;
    xhrCaptcha.open("GET",url,true);
    xhrCaptcha.send(null);
}

function statechange()
{
    //alert("hello");

    if(xhrCaptcha.readyState==4 && xhrCaptcha.status==200)
    {   alert(xhrCaptcha.responseText);
        //xhrCaptcha.getElementById("captchasection").innerHTML=xhrCaptcha.responseText;
        img=document.getElementById("imgcaptcha");
        img.src=xhrCaptcha.responseText;
    }
}*/
