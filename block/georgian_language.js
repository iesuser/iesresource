// JavaScript Document

//-------------------------------Qartulze Gadayvana---------------------------
var eng=new Array(97, 98, 103, 100, 101, 118, 122, 84, 105, 107, 108, 109, 110, 111, 112,
	74, 114, 115, 116, 117, 102, 113, 82, 121, 83, 67, 99, 90, 119, 87, 120, 106, 104);

var geo=new Array(4304, 4305, 4306, 4307, 4308, 4309, 4310, 4311, 4312, 4313, 4314, 4315,
	 4316, 4317, 4318, 4319, 4320, 4321, 4322, 4323, 4324, 4325, 4326, 4327, 4328, 4329,
	 4330, 4331, 4332, 4333, 4334, 4335, 4336);

var len=eng.length

function qartulze(e, tid)
{
if (document.getElementById('gi')==undefined) return;
if (!document.getElementById('gi').checked) return;

if (e.keyCode && document.getElementById(tid).selectionStart!=undefined)
	for (var i=0; i<len; i++)
		{
		if (e.keyCode==eng[i])
			{
			var b1=document.getElementById(tid).selectionStart;
			var b2=document.getElementById(tid).selectionEnd;
			var str=document.getElementById(tid).value		
			document.getElementById(tid).value=str.substring(0,b1)+String.fromCharCode(geo[i])+str.substring(b2);
			document.getElementById(tid).setSelectionRange(b1+1, b1+1);
			document.getElementById(tid).focus();
			return false
			}	
		}

if (e.keyCode)
	for (var i=0; i<len; i++)
		{
		if (e.keyCode==eng[i])
			{
			e.keyCode=geo[i]
			return true
			}
		}
else
if (e.charCode)
	for (var i=0; i<len; i++)
		{
		if (e.charCode==eng[i])
			{
			var b1=document.getElementById(tid).selectionStart;
			var b2=document.getElementById(tid).selectionEnd;
			var str=document.getElementById(tid).value		
			document.getElementById(tid).value=str.substr(0,b1)+String.fromCharCode(geo[i])+str.substr(b2);
			document.getElementById(tid).setSelectionRange(b1+1, b1+1);
			document.getElementById(tid).focus();
			return false
			}
		}
return true
}
