var html = ace.edit("html");
ace.require("ace/ext/language_tools");

html.setTheme("ace/theme/monokai");
html.session.setMode("ace/mode/html");
html.setValue(`<h1 onclick='giveAlert()'> Hello </h1>`);

var css = ace.edit("css");
css.setTheme("ace/theme/monokai");
css.session.setMode("ace/mode/css");
css.setValue(`h1 {
    color: red;
}`);

var js = ace.edit("js");
js.setTheme("ace/theme/monokai");
js.session.setMode("ace/mode/javascript");
js.setValue(`function giveAlert() {
    alert('Alert Msg is Called');
}`);

function compile() {
    var output = document.getElementById("output").contentWindow.document;

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

compile();