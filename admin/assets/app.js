var html = ace.edit("html");
ace.require("ace/ext/language_tools");

html.setTheme("ace/theme/monokai");
html.session.setMode("ace/mode/html");

var css = ace.edit("css");
css.setTheme("ace/theme/monokai");
css.session.setMode("ace/mode/css");


var js = ace.edit("js");
js.setTheme("ace/theme/monokai");


var output = document.getElementById("output").contentWindow.document;

function compile() {
    var outputCode = "";
    document.body.onkeyup = function() {
        output.open();
        outputCode = html.getValue();
        outputCode += "<style>" + css.getValue() + "</style>";
        outputCode += "<script>" + js.getValue() + "</script>";
        output.writeln( outputCode);
        output.close();
    };
}