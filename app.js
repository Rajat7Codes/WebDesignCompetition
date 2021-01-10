var html = ace.edit("html");
ace.require("ace/ext/language_tools");
html.setTheme("ace/theme/monokai");
html.session.setMode("ace/mode/html");

var css = ace.edit("css");
css.setTheme("ace/theme/monokai");
css.session.setMode("ace/mode/css");

var js = ace.edit("js");
js.setTheme("ace/theme/monokai");
js.session.setMode("ace/mode/javascript");



function compile() {
    var code = document.getElementById("code").contentWindow.document;
    document.body.onkeyup = function() {
        code.open();
        code.writeln(
        html.getValue() +
            "<style>" +
            css.getValue() +
            "</style>" +
            "<script>" +
            js.getValue() +
            "</script>"
        );
        code.close();
    };
}

compile();