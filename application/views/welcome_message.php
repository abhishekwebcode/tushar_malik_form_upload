<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<form class="form">
    <div class="input-field col s6">
        <input placeholder="Placeholder" id="first_name" type="text" class="validate" required name="first_name">
        <label for="first_name">First Name</label>
    </div>
    <div class="input-field col s6">
        <input placeholder="Placeholder" id="last_name" type="text" class="validate" required name="last_name">
        <label for="last_name">Last Name</label>
    </div>
    <div class="input-field col s6">
        <input placeholder="Placeholder" id="email" type="email" class="validate" required name="email">
        <label for="email">Email</label>
    </div>
    <div class="input-field col s6">
        <input type="text" class="datepicker validate date"  required id="date" name="date">
        <label for="date">Date</label>
    </div>

        <div class="file-field input-field">
            <div class="btn">
                <span>File</span>
                <input type="file" name="file">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" required name="file">
            </div>
        </div>
    <div class="col s6">
        <a class="waves-effect waves-light btn submit">Submit</a>
    </div>
</form>

<style>
    .error {
        color:red;
    }
</style>
<script>
    window.form1=$(`form`).validate({
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    })
    $(document).ready(function(){
        $('.datepicker').datepicker();
    });
    $(`.submit`).click(function () {
        if (!form1.checkForm()) {
            form1.showErrors();
            return;
        }
        formData=new FormData($(`form`)[0]);
        formData.set("date", (new Date($(".date").val())).toISOString().split("T")[0] )
        $.ajax({
            url: 'welcome/upload',
            data: formData,
            type: 'POST',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success:function (data) {
                console.log(data);
            }
        });
    })
</script>
</body>
</html>