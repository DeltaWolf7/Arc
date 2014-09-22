/* 
 * The MIT License
 *
 * Copyright 2014 Craig.
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
 */

function updateStatus(data) {
    var dataArray = data.split("|");
    if (dataArray.length > 1) {
        updateStatusDiv(dataArray[1], dataArray[0]);
    } else {
        updateStatusDiv(data, '');
    }
}
;

function updateStatusDiv(content, status) {
    var element = document.getElementById("status");
    element.innerHTML = content;
    element.style.display = "block";
    element.className = "alert alert-" + status;
    $('html,body').animate({scrollTop: $("#status").offset().top},'slow');
}
;