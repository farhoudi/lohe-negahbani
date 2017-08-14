var NOVIN = {};

NOVIN.ajax = function (url, method, data, callback, async) {
    url = (typeof url !== 'undefined') ? url : window.location.href;
    async = async || false;
    //var req = NOVIN.createXMLHTTPObject();
    var req = new XMLHttpRequest();
    if (!req) return;
    req.open(method, url, true);
    //req.setRequestHeader('X-CSRF-Token', getCsrfToken());
    req.onreadystatechange = function () {
        if (req.status == 200) {
            var response = req.responseText.trim();
            response = JSON.parse(response);
            callback(response);
        }
    };
    req.send(data);
};
NOVIN.XMLHttpFactories = [
    function () {return new XMLHttpRequest()},
    function () {return new ActiveXObject("Msxml2.XMLHTTP")},
    function () {return new ActiveXObject("Msxml3.XMLHTTP")},
    function () {return new ActiveXObject("Microsoft.XMLHTTP")}
];
NOVIN.createXMLHTTPObject = function() {
    var xmlhttp = false;
    for (var i=0;i<NOVIN.XMLHttpFactories.length;i++) {
        try {
            xmlhttp = NOVIN.XMLHttpFactories[i]();
        }
        catch (e) {
            continue;
        }
        break;
    }
    return xmlhttp;
};
