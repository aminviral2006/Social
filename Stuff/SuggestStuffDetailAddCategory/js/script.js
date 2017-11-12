/*
   Script name  : Ajax Auto Suggest
   File Name 	: script.js
   Developed By : Amit Patil (India)
   Email Id 	: amitpatil321@gmail.com
   last Updated : 9 June 2009
         This program is freeware.There is no any fucking copyright and bla bla bla.
   You can use it for your personal use.You can also make any changes to this script.
   But before using this script i would appericiate your mail.That will encourage me a lot.
   Any suggestions are always welcome.
         Have a fun with programming.   
*/
$(document).ready(function(){
	$(document).click(function(){
		$("#ajax_response_addcategory").fadeOut('slow');
	});
	$("#txtAddCategory").focus();
	var offset = $("#txtAddCategory").offset();
	var width = $("#txtAddCategory").width()-2;
	$("#ajax_response_addcategory").css("left",offset.left);
	$("#ajax_response_addcategory").css("width",width);
	$("#txtAddCategory").keyup(function(event){
		 //alert(event.keyCode);
		 var txtAddCategory = $("#txtAddCategory").val();
		 if(txtAddCategory.length)
		 {
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $("#loading").css("visibility","visible");
				 $.ajax({
				   type: "POST",
				   url: "SuggestStuffDetailAddCategory/ajax_server.php",
				   data: "data="+txtAddCategory,
				   success: function(msg){	
					if(msg != 0)
					  $("#ajax_response_addcategory").fadeIn("slow").html(msg);
					else
					{
					  $("#ajax_response_addcategory").fadeIn("slow");
					  $("#ajax_response_addcategory").html('<div style="text-align:right;">No Matches Found</div>');
					}
					$("#loading").css("visibility","hidden");
				   }
				 });
			 }
			 else
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
                                     //alert(event.keyCode);                                     
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$("#ajax_response_addcategory").fadeOut("slow");
					$("#txtAddCategory").val($("li[class='selected'] a").text());
				 break;
				}
			 }
		 }
		 else
			$("#ajax_response_addcategory").fadeOut("slow");
	});
	$("#ajax_response_addcategory").mouseover(function(){
		$(this).find("li a:first-child").mouseover(function () {
			  $(this).addClass("selected");
		});
		$(this).find("li a:first-child").mouseout(function () {
			  $(this).removeClass("selected");
		});
		$(this).find("li a:first-child").click(function () {
			  $("#txtAddCategory").val($(this).text());
			  $("#ajax_response_addcategory").fadeOut("slow");
		});
	});
});