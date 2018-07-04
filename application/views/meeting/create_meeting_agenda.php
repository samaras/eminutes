<div class="container">
	<div id="container">
		<p>
			<span class="article-header">Create Agenda</span>
		</p>

		<br />
		<div class="two">
			<button class="name" onclick="titleBoxCreate()">Add Agenda Title</button>
			<button class="email" onclick="itemBoxCreate()">Add Agenda SubItem</button>
		</div>
			
		<div class="third">
			<form action="" id="mainform" method="get" name="mainform">
				<p id="myForm"></p><input type="submit" value="Submit">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	// FormGet Online Form Builder JS Code
	// Creating and Adding Dynamic Form Elements.
	var i = 1; // Global Variable for Name
	var j = 1; // Global Variable for E-mail
	/*
	=================
	Creating Text Box for name field in the Form.
	=================
	*/
	function titleBoxCreate(){
	var y = document.createElement("INPUT");
		y.setAttribute("type", "text");
		y.setAttribute("Placeholder", "Title_" + i);
	y.setAttribute("Title", "Title_" + i);
	document.getElementById("myForm").appendChild(y);
	i++;
	}
	/*
	=================
	Creating Text Box for email field in the Form.
	=================
	*/
	function itemBoxCreate(){
	var y = document.createElement("INPUT");
	var t = document.createTextNode("Item");
	y.appendChild(t);
	y.setAttribute("Placeholder", "Item_" + j);
	y.setAttribute("Name", "Item_" + j);
	document.getElementById("myForm").appendChild(y);
	j++;
	}
</script>