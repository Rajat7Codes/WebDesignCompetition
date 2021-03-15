var html = ace.edit("html");
ace.require("ace/ext/language_tools");

html.session.setMode("ace/mode/html");


var css = ace.edit("css");
css.session.setMode("ace/mode/css");


var js = ace.edit("js");
js.session.setMode("ace/mode/javascript");


var output = document.getElementById("output").contentWindow.document;

function compile() {
    var outputCode = "";
    document.body.onkeyup = function() {
        output.open();
        outputCode = `<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title> NextGenCoder </title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <style> `+ css.getValue() +` </style>
        </head>`;
        outputCode += `<body> ` +html.getValue() +`</body>`;
        outputCode += "<script>" + js.getValue() + "</script>";
        output.writeln( outputCode);
        output.close();
    };
    output.open();
        outputCode = `<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title> NextGenCoder </title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <style> `+ css.getValue() +` </style>
        </head>`;
        outputCode += `<body> ` +html.getValue() +`</body>`;
        outputCode += "<script>" + js.getValue() + "</script>";
        output.writeln( outputCode);
        output.close();
}