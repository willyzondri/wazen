<!DOCTYPE html>
<html>
<head>
	<title>Wazen Cryptograph</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
	<style type="text/css">
		* {margin: 0; padding: 0; font-family:'Ubuntu', sans-serif;}
		body {background: #f4f4fa}
		.form {display: block; width: 550px; box-shadow: 0 0 20px 0 rgba(0,0,0,.15);padding: 20px; margin: 0 auto; position: absolute;top : 50%; left: 50%; transform: translate(-50%, -50%); background: #fff}
		.form h1 {margin-bottom: 20px;}
		.xCrypt {width: 100%; height:180px; margin-bottom: 20px; border: 1px solid #f4f4fa; padding: 10px; box-sizing: border-box;line-height: 25px; font-size: 15px}
		.form input {width: 100%;padding: 10px; box-sizing: border-box; margin-bottom: 20px;border: 1px solid #f4f4fa;font-size: 15px}
		.form button {background: #1976D2; border: none; color: #fff; padding: 10px; border-radius: 3px;box-shadow: 0 5px 25px 0 rgba(0,0,0,.2); margin-bottom: 20px; cursor: pointer;float: left;}
		.btnencrypt {margin-right: 10px;background: #C2185B!important}
		.clear {float: right;padding: 10px;padding-right: 0;cursor: pointer;text-decoration: underline;}
	</style>
</head>
<body>
	<div id="app">
		<div class="form">
			<h1>WAZEN Text Encryption</h1>
			<textarea v-model="formText.text" placeholder="Encrypt/Decrypt" class="xCrypt"></textarea>
			<input v-model="formText.pass" placeholder="Password" type="password">
			<button v-on:click="posted('encrypt')" class="btnencrypt">Encrypt</button>
			<button v-on:click="posted('decrypt')">Decrypt</button>
			<span v-on:click="clear()" class="clear">Clear</span>
			<textarea v-model="x.data" placeholder="Result" class="xCrypt" readonly=""></textarea>
		</div>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js"></script>
	<script type="text/javascript">
		var apps = new Vue({
			el : "#app",
			data : {
				formText : {status : "", text : "", pass : ""}, 
				x : ""
			},
			methods : {
				posted : function ($statuse) {
					this.formText.status = $statuse;
					var formData = this.toFormData(this.formText)
					axios.post("http://localhost/lynx/lynx.php", formData)
					.then (response => this.x = response)
				},
				toFormData : function (obj) {
					var formContent = new FormData();
					for (var key in obj){
						formContent.append(key, obj[key]);
					}
					return formContent;
				},
				clear : function () {
					this.formText.status = "";
					this.formText.text = "";
					this.formText.pass = "";
					this.x = "";
				} 
			}	
		});
	</script>
</body>
</html>
