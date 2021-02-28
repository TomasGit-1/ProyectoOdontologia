function validaCampos()
{

	document.getElementById('mensaje5').innerHTML="";
	document.getElementById('mensaje6').innerHTML="";
	document.getElementById('mensaje7').innerHTML="";
	document.getElementById('mensaje8').innerHTML="";
	document.getElementById('mensaje9').innerHTML="";
	document.getElementById('mensaje10').innerHTML="";
	 var gradAcademico=document.getElementById('gradoAcademico').value;
	var areaTrabajo=document.getElementById('areaTrabajo').selectedIndex;
	var numHoras=document.getElementById('numHoras').value;
	var expLaboral=document.getElementById('expLaboral').value;
		
  		if (gradAcademico ==" ") 
	 	{
			document.getElementById('mensaje1').innerHTML="  * Completa este Campo";
			return false;
	 	} 
		if(areaTrabajo ==" ")
		{
			document.getElementById('mensaje1').innerHTML=" ";
			document.getElementById('mensaje2').innerHTML="   * Completa este Campo";
			return false;
		}
		if(numHoras==0)
		{
			document.getElementById('mensaje2').innerHTML="    ";
			document.getElementById('mensaje3').innerHTML="   * Completa este Campo";
		    return false;
		}
		if(expLaboral.length==0)
		{
            document.getElementById('mensaje3').innerHTML="  ";
		    document.getElementById('mensaje4').innerHTML="   * Completa este Campo";
	        return false;
		}
		else 
		{	
			document.getElementById('mensaje4').innerHTML="  ";
			return true;
		}		
}