/*

    Lisence: osv...

*/


//definitions

//defining websocket server
let WS = new WebSocket();

function run() {
    //runs all essential functions: Html parser, Websocket setup...

}

function parseHTML() {

}

/*
    example data
    let data = {"Function" : "document.write('test');", "Cookies": {"cookie1": "test"}, "SocketID": "123"};
    data = JSON.stringify(data);
*/

function parseIncomming(data) {
    //parsing json to be feed into different functions
    console.log("Parsing: " + data);
    data = JSON.parse(data);
}