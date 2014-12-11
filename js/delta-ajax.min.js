/* 
 * The MIT License (MIT)
 * 
 * Copyright (c) 2011-2014 Twitter, Inc
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * Written by Craig Longford (deltawolf7@gmail.com)
 * http://www.deltasblog.co.uk
 * 
 * Version 0.1 - 13-08-14
 */

var ajax = {};
/*
 * Send AJAX request
 */
ajax.send = function(type, data, url, callback, sync) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                if (callback != null) {
                    callback(xmlhttp.responseText);
                }
            }
        }
    };
    if (type == 'POST') {
        xmlhttp.open(type, url, sync);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(this.buildQuery(data));
    } else {
        xmlhttp.open(type, url + '?' + this.buildQuery(data), sync);
        xmlhttp.send(null);
    }
};

/*
 * Build query
 */
ajax.buildQuery = function(data) {
    var query = [];
    for (var key in data) {
        var input = encodeURIComponent(key) + '=';
        if (data[key].startsWith('#')) {
            try {
                var element = document.getElementById(data[key].substring(1));
                if (element.type == "select") {
                    input += encodeURIComponent(element.options[element].value);
                } else if (element.type == "checkbox") {
                    input += encodeURIComponent(element.checked);
                } else {
                    input += encodeURIComponent(element.value);
                }
            } catch (error) {
                throw new Error("Element not found '" + data[key].substring(1) + "'.");
            }
        } else {
            input += encodeURIComponent(data[key]);
        }
        query.push(input);
    }
    return query.join('&');
};

/*
 * Add starts with function to the Javascript script type.
 */
String.prototype.startsWith = function(prefix) {
    return this.indexOf(prefix) === 0;
};