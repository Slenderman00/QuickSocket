/*

    Lisence: osv...

*/


//definitions

let WS;

function run() {
    //runs all essential functions: Html parser, Websocket setup...
    configureWebsocket();
    parseHTML();

}

function Filename() {
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if(filename == "" || filename == null) {
        filename = "index.php";
    }
    return filename;
}

function configureWebsocket() {
    WS = new WebSocket('ws://' + window.location.hostname + ':8080');

    //setting event listener
    WS.onmessage = function(e) {parseIncomming(e)};
    WS.onopen = function() {submit()};
}

var variables = {};

function variable(name, data) {
    variables[name] = data;
}

function Clear() {
    variables = {};
}

function submit() {
    console.log(variables);
    var data = {};
    data["file"] = Filename();
    data["var"] = variables; 
    console.log(data);
    console.log(JSON.stringify(data))
    WS.send(JSON.stringify(data));
}

function collectFormData(form) {
    var elements = form.getElementsByTagName("input");
    
    for(i = 0;i < elements.length; i++)
    {
        Variable(elements[i].name, elements[i].value);
    }
}

function parseHTML() {
    //fetching <html>...</html> from document
    let html = document.getElementsByTagName("html")[0];

    //fetching compatible forms from html...
    let matches = html.querySelectorAll("form[method=SOCKET]");
    matches.forEach(match => {
        var elements = match.getElementsByTagName("input");
        for(i = 0;i < elements.length; i++)
        {
            if(elements[i].type == "submit") {
                elements[i].addEventListener("click", function(event){
                    event.preventDefault();
                    collectFormData(match);
                    submit();
                });
            }
        }
    }, this);
}

/*
    example data
    let data = {"Function" : "document.write('test');", "Cookies": {"cookie1": "test"}, "SocketID": "123"};
    data = JSON.stringify(data);
*/

function parseIncomming(e) {
    //parsing json to be feed into different functions
    console.log("Parsing: " + e.data);
    data = JSON.parse(e.data);

    //executing js
    executeJavascript(extractFunction(data["Function"]), window, extractArguments(data["Function"]));
}

function extractArguments(_function) {
    //finding all the arguments
    let args = _function.match(/([\'])(?:(?=(\\?))\2.)*?\1/g);


    //un-shittyftying arguments

    for(i = 0; i <= Object.keys(args).length - 1; i++) {
        console.log('test');
        args[i] = args[i].replace("'", "");
        args[i] = args[i].replace("'", "");
    }

    return args;
}

function extractFunction(_function) {
    _function = _function.match(/([a-zA-Z1-9_])\w+/g);
    return _function[0];
}

function executeJavascript(functionName, context, args) {
    const namespaces = functionName.split(".");
    const func = namespaces.pop();
    for (let i = 0; i < namespaces.length; i++) {
      context = context[namespaces[i]];
    }
    return context[func].apply(context, args);
}