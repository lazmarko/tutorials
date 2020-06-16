function validate()
{
	
	var regFirst=/^[a-z]{3,20}$/;

	
	var error=new Array();
	
	var name=document.getElementById("korisnickoIme").value;

	
	if(regFirst.test(name)) { 
	
		document.getElementById("korisnickoIme").style.border="solid green 2px";
		
	 }
	 else {document.getElementById("tbName").style.border="solid red 2px"; error.push("Error");}
	
	if(error.length==0){
	window.location="mailto:"+email+"";}
}