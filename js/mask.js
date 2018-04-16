function maskdatetime(event,textbox)
{
var key = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if (key == 8){return;}
var str = textbox.value;


for (var k = 0; k <= str.length; k++)
{
//<input name="startdatetime" type="text" onKeyUp="return maskdatetime(event,this);" style="width:210px;" maxlength="23">

if (k == 0) if (!(parseInt(str.substring(k,k+1)) >= 0 && 3 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 1) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 2) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 3) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 4 && (str.substring(k, k+1) != '-')) str = str.substring(0,k) + '-' + str.substring(k,str.length);
if (k == 5) if (!(parseInt(str.substring(k,k+1)) >= 0 && 2 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 6) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>= 0 && 13>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 7 && (str.substring(k, k+1) != '-')) str = str.substring(0,k) + '-' + str.substring(k,str.length);
if (k == 8) if (!(parseInt(str.substring(k,k+1)) >= 0 && 4 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 9) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 32>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 10 && (str.substring(k, k+1) != ' ')) str = str.substring(0,k) + ' ' + str.substring(k,str.length);
if (k == 11) if (!(parseInt(str.substring(k,k+1)) >= 0 && 3 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 12) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 25>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 13 && (str.substring(k, k+1) != ':')) str = str.substring(0,k) + ':' + str.substring(k,str.length);
if (k == 14) if (!(parseInt(str.substring(k,k+1)) >= 0 && 6 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 15) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 60>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 16 && (str.substring(k, k+1) != ':')) str = str.substring(0,k) + ':' + str.substring(k,str.length);
if (k == 17) if (!(parseInt(str.substring(k,k+1)) >= 0 && 6 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 18) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 60>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 19 && (str.substring(k, k+1) != '.')) str = str.substring(0,k) + '.' + str.substring(k,str.length);
if (k == 20) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 21) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 22) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
}
textbox.value = str;
}

function maskdatetimeNomsec(event,textbox)
{
//var key = window.event ? event.keyCode : event.which;
var key = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
//alert(key);

if (key == 8){return;}

var str = textbox.value;
//alert(event.keyCode);


for (var k = 0; k <= str.length; k++)
{
//<input name="startdatetime" type="text" onKeyUp="return maskdatetime(event,this);" style="width:210px;" maxlength="23">

if (k == 0) if (!(parseInt(str.substring(k,k+1)) >= 0 && 3 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 1) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 2) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 3) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 4 && (str.substring(k, k+1) != '-')) str = str.substring(0,k) + '-' + str.substring(k,str.length);
if (k == 5) if (!(parseInt(str.substring(k,k+1)) >= 0 && 2 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 6) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>= 0 && 13>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 7 && (str.substring(k, k+1) != '-')) str = str.substring(0,k) + '-' + str.substring(k,str.length);
if (k == 8) if (!(parseInt(str.substring(k,k+1)) >= 0 && 4 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 9) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 32>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 10 && (str.substring(k, k+1) != ' ')) str = str.substring(0,k) + ' ' + str.substring(k,str.length);
if (k == 11) if (!(parseInt(str.substring(k,k+1)) >= 0 && 3 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 12) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 25>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 13 && (str.substring(k, k+1) != ':')) str = str.substring(0,k) + ':' + str.substring(k,str.length);
if (k == 14) if (!(parseInt(str.substring(k,k+1)) >= 0 && 6 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 15) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 60>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 16 && (str.substring(k, k+1) != ':')) str = str.substring(0,k) + ':' + str.substring(k,str.length);
if (k == 17) if (!(parseInt(str.substring(k,k+1)) >= 0 && 6 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 18) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 60>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
}
textbox.value = str;
}

function maskdate(event,textbox)
{
var key = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

if (key == 8){return;}

var str = textbox.value;



for (var k = 0; k <= str.length; k++)
{
//<input name="startdatetime" type="text" onKeyUp="return maskdate(event,this);" style="width:210px;" maxlength="23">
if (k == 0) if (!(parseInt(str.substring(k,k+1)) >= 0 && 3 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 1) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 2) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 3) if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 4 && (str.substring(k, k+1) != '-')) str = str.substring(0,k) + '-' + str.substring(k,str.length);
if (k == 5) if (!(parseInt(str.substring(k,k+1)) >= 0 && 2 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 6) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>= 0 && 13>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
if (k == 7 && (str.substring(k, k+1) != '-')) str = str.substring(0,k) + '-' + str.substring(k,str.length);
if (k == 8) if (!(parseInt(str.substring(k,k+1)) >= 0 && 4 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
if (k == 9) if (!(parseInt(str.substring(k,k+1))>=0 && (parseInt(str.substring(k-1,k+2))>=0 && 32>parseInt(str.substring(k-1,k+2))))){str=str.substring(0,k); break;}
}
textbox.value = str;
}


function maskcode(textbox)
{
var str = textbox.value;
for (var k = 0; k <= str.length; k++)
{
	if (k == 14)
	{
		if(str.substring(k, k+1) != '.') str = str.substring(0,k) + '.' + str.substring(k,str.length);
	}
	else if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
}
textbox.value = str;
}

function maskcoordinate(textbox)
{
var str = textbox.value;
for (var k = 0; k <= str.length; k++)
{
	if (!((parseInt(str.substring(k,k+1))>=0 && 10>parseInt(str.substring(k,k+1)))||
		str.substring(k,k+1)==','||str.substring(k,k+1)==';'||str.substring(k,k+1)=='.'||str.substring(k,k+1)==' ' ))
	{
		str = str.substring(0,k); break;
	}
}
textbox.value = str;
}

function maskMagnitude(textbox)
{
var key = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if (key == 8){return;}
var str = textbox.value;

for (var k = 0; k <= str.length; k++)
{
	if (k == 1)
	{
		if(str.substring(k, k+1) != '.') str = str.substring(0,k) + '.' + str.substring(k,str.length);
	}
	else if (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1)))){str = str.substring(0,k); break;}
}
textbox.value = str;
}

function maskFloat(textbox)
{
var str = textbox.value;
var count = 0;
for (var k = 0; k <= str.length; k++)
{
	if (str.substring(k,k+1) == '.') count++;
	if (count >= 2) {str = str.substring(0,k); break;}
	if (k == 0 && str.substring(k,k+1) == '.')str="";
	if (!((parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1))) || str.substring(k,k+1) == '.' ))
	{
		str = str.substring(0,k); break;
	}
}
textbox.value = str;
}


function maskLatLong(textbox)
{
var key = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if (key == 8){return;}
var str = textbox.value;
var count = 0;
for (var k = 0; k <= str.length; k++)
{
	if (str.substring(k,k+1) == '.') count++;
	if (count >= 2) {str = str.substring(0,k); break;}
	if ( k == 0)
	{
		if((str.substring(k, k+1) != '-') && (!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1))))){str = str.substring(0,k); break;}
	}
	else if ((str.substring(k, k+1) != '.')&&(!(parseInt(str.substring(k,k+1)) >= 0 && 10 > parseInt(str.substring(k,k+1))))){str = str.substring(0,k); break;}
}
textbox.value = str;
}


function onFocus(textbox)
{
	if(textbox.value != '') return;
	var ID = textbox.id;
	
	if(ID.substring(ID.length-6,ID.length) == 'PnTime')
	{
		var snTime = document.getElementById(ID.substring(0,ID.length-6)+'SnTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-6,ID.length) == 'SnTime')
	{
		var snTime = document.getElementById(ID.substring(0,ID.length-6)+'PnTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-6,ID.length) == 'PgTime')
	{
		var snTime = document.getElementById(ID.substring(0,ID.length-6)+'SgTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-6,ID.length) == 'SgTime')
	{
		var snTime = document.getElementById(ID.substring(0,ID.length-6)+'PgTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-9,ID.length) == 'PstarTime')
	{
		var snTime = document.getElementById(ID.substring(0,ID.length-9)+'SstarTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-9,ID.length) == 'SstarTime')
	{
		
		var snTime = document.getElementById(ID.substring(0,ID.length-9)+'PstarTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-5,ID.length) == 'PTime')
	{
		
		var snTime = document.getElementById(ID.substring(0,ID.length-5)+'STime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
	else if(ID.substring(ID.length-5,ID.length) == 'STime')
	{
		
		var snTime = document.getElementById(ID.substring(0,ID.length-5)+'PTime');
		if(snTime.value.length > 11)
		{
			textbox.value = snTime.value.substring(0,11);
		}
		else textbox.value = snTime.value;
	}
}


function maskInt(textbox)
{
	var str = textbox.value;
	for (var k = 0; k <= str.length; k++)
	{
		if(!(parseInt(str.substring(k,k+1)) >= 0)&&!(10 > parseInt(str.substring(k,k+1))))
		{
			str = str.substring(0,k); break;
		}
	}
	textbox.value = str;
}




