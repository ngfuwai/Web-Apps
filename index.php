
<!DOCTYPE HTML>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
img {
	max-width:100%;
	height:auto;
}  
</style> 
<body>
<p> Instructions: <br> Please enter your characteristics into the first text field and click "add characteristics." 
Then select the desired criterion for your requirements. For BCC, please enter the base cases into the second text field. </p>
<p>
Characteristics 
ie. 
{b, c, d}
{2, 3, 4}
{B, C, D}
	</p>
<textarea id="input" rows="10" cols="30">

</textarea>
<button type=button onclick="store()">add characteristics</button>
<br>
Base Cases (ie. a, 1, A):<br>
<textarea id="base_cases" rows="1" cols="30">

</textarea>

<p>characteristics:</p>
<p id="array"></p>

<button type="button" onclick="aoC()">ACoC</button>
<button type="button" onclick="eCC()">ECC</button>
<button type="button" onclick="bCC()">BCC</button>

<p>Requirements: </p>
<p id="req"></p>

<script>

var num_spaces = 0;
var data = []; //This is where all the input spaces are stored
var amounts = []; //This is where I keep track of the number of spaces for each characteristic

function store()
{	
	data = [];
	amounts = [];
	num_spaces = 0;
	var str = document.getElementById("input").value;
	var len = str.length;
	var count = 0;
	var in_brackets = false;
	var comma_ind = 0;
	var x, c = "";
	var ch_str = "{";
	document.getElementById("array").innerHTML = "";
	
	for(var i = 0; i < len; i++)
	{
		x = str.charAt(i);
		if(x == '{')
		{
			in_brackets = true;
			comma_ind = i;
		}
		else if(in_brackets && x == ',')
		{
			c = str.substring(comma_ind + 1, i);
			data.push(c);
			comma_ind = i;
			count++;
			ch_str = ch_str + c + ", ";
		}
		
		else if(x == '}' && in_brackets)
		{
			c = str.substring(comma_ind + 1, i);
			in_brackets = false;
			data.push(c);
			count++;
			amounts.push(count);
			count = 0;
			num_spaces++;
			
			document.getElementById("array").innerHTML = document.getElementById("array").innerHTML + ch_str + c + "} <br>"
			ch_str = "{";
		}			
		
	
	}
	
	data.toString;
	amounts.toString;
	console.log(data);
	console.log(amounts);
	console.log(num_spaces);
	
	document.getElementById("input").value = "";
	
	if(num_spaces == 0)
		document.getElementById("array").innerHTML = "invalid input";
	
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
	console.log("aoc called");
}

function enumerate(x, str, start)
{
	console.log("enumerate called");
	var num = amounts[x];
	
	if(x == num_spaces - 1)
	{
		for(var i = 0; i < num; i++)
		{	
			document.getElementById("req").innerHTML = document.getElementById("req").innerHTML + str + data[start + i] + "> <br>";
		}
		console.log("bottomed out");
		return;
	}
		
	for(var i = 0; i < num; i++)
		enumerate(x + 1, str + " " + data[start + i] + ", ", start + num);
	
}

function bCC()
{
	document.getElementById("req").innerHTML = "";
	var inval = document.getElementById("base_cases").value;
	var inval_len = inval.length;
	var count = 0;//number of base cases
	var char_count = 0; //used for counting the number of characters in an element
	var str = "";
	var num_char = []; // used for storing the character counts
	var output = "< ";
	
	var isElement = false;
	var c;
	for(var i = 0; i < inval_len; i++)
	{
		c = String(inval.charAt(i));
		
		if(i == inval_len - 1)
		{
			if(c != "\n" && c!= ",")
			{
				str = str + c;
				char_count++;
			}
			output = output + str + ">";
			num_char.push(char_count);
			char_count = 0;
			count++;
		}
		
		else if(!isElement && c != " ") // come back to account for all white space types.
		{
			if(c != "\n" && c != "\t")
			{
				 char_count++;
				str = str + c;
			}
			isElement = true;
		}
		else if(isElement && c == ',')
		{
			isElement = false;
			output = output + str + ", ";
			num_char.push(char_count);
			char_count = 0;
			count++;
			str = "";
		}
		else if(isElement)
			if(c != "\n" && c != "\t")
			{
				char_count++;
				str = str + c;	
			}		
	}
	
	if(count != num_spaces)
		document.getElementById("req").innerHTML = "(invalid input)";
	else{
		console.log(output);
		document.getElementById("req").innerHTML = output + "<br>";
		
	var p = 2, q, start = 0;
	var output_len = output.length;
	var str1 = "";
	
	for(var i = 0; i < num_spaces; i++)
	{
		num_items = amounts[i];
		q = num_char[i];
		for(var j = 0; j < num_items; j++)
		{	
			str1 = output.substring(0, p) + data[start + j] + output.substring(p + q, output_len) + "<br>";
			document.getElementById("req").innerHTML = document.getElementById("req").innerHTML + str1;
		}	
		p += q + 2;
		start += amounts[i];
	}
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
				res = res + " " + data[start + i] + ", ";
			
			else
				res = res + " " +data[start] + ", ";
			
			start += num;
		}
		document.getElementById("req").innerHTML = document.getElementById("req").innerHTML + res.substring(0, res.length - 2) + "><br>";
	}
	
}
</script>

</body>
</html>