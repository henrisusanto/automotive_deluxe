<script type="text/javascript"> 					
function validation()									  	
		{		 	
		if(	document.getElementById('ptitle').value=='Enter listing title'){
			document.getElementById('cdError').innerHTML='Please listing title';
		return false;
				}		
				
		if(	document.getElementById('security_code3').value==''){
			document.getElementById('cdError').innerHTML='Please enter security text';
		return false;
				}			
		if(	document.getElementById('make').value==0){
			document.getElementById('cdError').innerHTML='Please select vehicle make';
			return false;
				}			  
		if(	document.getElementById('yearbuilt').value==0){
			document.getElementById('cdError').innerHTML='Please select Year';
			return false;
				}
		if(	document.getElementById('price').value=='Enter vehicle price'){
			document.getElementById('cdError').innerHTML='Please enter vehicle price';
		return false;
				}
		if(	document.getElementById('mileage').value=='Enter vehicle miles'){
			document.getElementById('cdError').innerHTML='Please enter vehicle miles';
		return false;
				}
		if(	document.getElementById('ext').value=='Enter exterior color'){
			document.getElementById('cdError').innerHTML='Please enter color';
		return false;
				}
		if(	document.getElementById('int').value=='Enter interior color'){
			document.getElementById('cdError').innerHTML='Please enter color';
		return false;
				}
		if(	document.getElementById('vdrive').value=='Enter vehicle drive'){
			document.getElementById('cdError').innerHTML='Please enter drive';
		return false;
				}					
		if(	document.getElementById('vin').value=='Enter VIN Number'){
			document.getElementById('cdError').innerHTML='Please enter VIN number';
		return false;
				}
		if(	document.getElementById('transm').value==0){
			document.getElementById('cdError').innerHTML='Please enter transmission type';
		return false;
				}   			
		if(	document.getElementById('vehitype').value==0){
			document.getElementById('cdError').innerHTML='Please enter vehicle type';
		return false;
				}
		if(	document.getElementById('features').value=='Separate features with commas (feature1, feature2, feature3)'){
				document.getElementById('cdError').innerHTML='Please enter vehicle features';
		return false;
				}
		if(	document.getElementById('fname').value=='Enter your first name'){
			document.getElementById('cdError').innerHTML='Please enter first name';
		return false;
				}
		if(	document.getElementById('lname').value=='Enter your last name'){
			document.getElementById('cdError').innerHTML='Please enter last name';
		return false;
				}
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				var address = document.getElementById('email').value;
				if(reg.test(address) == false) {
		document.getElementById('cdError').innerHTML='Invalid Email Address';
			return false;
				}
				document.getElementById('submitsign').style.display = 'block';
				document.getElementById('layer').style.display = 'block';									   
			return true;
			}
		var counter = 1;
		var limit = 12;
	function addInput(divName){
		if (counter == limit)  {
		alert("You have reached the limit of  " + counter + " images");}
		else 
		{
		document.getElementById('tid').value =counter;
		var newdiv = document.createElement('div');
		newdiv.innerHTML = "Upload Photo " + (counter + 1) + " <br><input class='photosubmit' type='file' name='input_"+counter +"'>";
		document.getElementById(divName).appendChild(newdiv);
		counter++;
          				
     }
}
</script>