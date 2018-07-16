
<!DOCTYPE HTML>
<html>  
<body>
<p> Instructions: <br> Please input the elements of your input space into the textbox. Each element should be followed by a comma. Please list the most important element of your input space first. Afterwards, please press "add characteristic." Repeat until you have listed all of your input spaces. Once you have specified your input spaces, click on the combination strategy.</p>
<textarea id="input" rows="10" cols="30">

</textarea>
<button type=button onclick="store()">add characteristic</button>

<p>characteristics:</p>
<p id="array"></p>

<button type="button" onclick="aoC()">ACoC</button>
<button type="button" onclick="eCC()">ECC</button>
<button type="button" onclick="bCC()">BCC</button>

<p>Requirements: </p>
<p id="req"></p>

<script>
var num_spaces = 0;
var data = [];
var amounts = []

function store()
{	
	var str = document.getElementById("input").value;
	
	if(str == "")
		return;
	
	document.getElementById("array").innerHTML = document.getElementById("array").innerHTML + "{" + str + "}<br>";
	document.getElementById("input").value = "";
	
	var len = str.length;
	var ctr = 1;
	var itr = 0;
	for(var i = 0; i < len; i++)
	{
		if(str.charAt(i) == ',')
		{	
			data.push(str.substring(itr, i));
			itr = i + 1;
			ctr++;
		}		
	}
	
	data.push(str.substring(itr, len));
	num_spaces++;
	data.toString;
	amounts.push(ctr);
	amounts.toString;
	
	console.log(data);
	console.log(amounts);
}

function aoC()
{
	document.getElementById("req").innerHTML = "";
	enumerate(0, "<", 0);
}

function enumerate(x, str, start)
{
	var num = amounts[x];
	
	if(x == num_spaces - 1)
	{
		for(var i = 0; i < num; i++)
		{	
			document.getElementById("req").innerHTML = document.getElementById("req").innerHTML + str + data[start + i] + "> <br>";
		}
		return;
	}
		
	for(var i = 0; i < num; i++)
		enumerate(x + 1, str + data[start + i] + ", ", start + num);
	
}

function bCC()
{
	var start = 0;
	var def = "<";
	
	document.getElementById("req").innerHTML = "";
	
	for(var i = 0; i < num_spaces; i++)
	{
		def = def + data[start] + ", ";
		start += amounts[i];
	}
	def = def + ">";
	var len = def.length
	
	start = 0;
	pos = 1;
	var res, num, elem, len_elem;
	
	for(var i = 0; i < num_spaces; i++)
	{
		num = amounts[i];
		len_elem = data[start].length;
		for(var j = 0; j < num; j++)
		{
			elem = data[start + j];
			
			res = def.substring(0, pos) + elem + def.substring(pos + len_elem, len);
			document.getElementById("req").innerHTML = document.getElementById("req").innerHTML + res + "<br>";
		}
		pos += data[start].length + 2;
		start += num;
	}	
}

function eCC()
{
	document.getElementById("req").innerHTML = "";
	var res;
	var max = amounts[0];
	for(var i = 0; i < num_spaces; i++)
		max = Math.max(max, amounts[i]);
	
	console.log(max);
	var num = 0;
	var start;
	for(var i = 0; i < max; i++)
	{
		res = "<";
		start = 0;
		for(var j = 0; j < num_spaces; j++ )
		{
			num = amounts[j];
			if(i < num)
				res = res + data[start + i] + ", ";
			
			else
				res = res + data[start] + ", ";
			
			start += num;
		}
		document.getElementById("req").innerHTML = document.getElementById("req").innerHTML + res + "><br>";
	}
	
}
</script>

</body>
</html>