console.clear();
var now = new Date();
console.log("Ngày giờ hiện tại: " + now);

var targetDate = new Date(2024, 1, 10, 0, 0, 1, 0); // Set date to 10/02/2024 00:01:00.000
var targetDate_end = new Date(2024, 1, 10, 0, 30, 0, 0);
console.log("Ngày giờ đích: " + targetDate);
var delay = targetDate.getTime() - now.getTime();
var delay_end = targetDate_end.getTime() - now.getTime();
console.log("Thời gian còn lại: " + delay);

var html_tet = document.getElementById('phaohoa');
html_tet.style.display = 'none';
if (delay_end > 0) {
    setTimeout(function () {
        location.reload();
    }, delay_end);
    var audio = document.getElementById('audio_tet');
    if (delay > 0) {
        setTimeout(function () {
            html_tet.style.display = 'block';
            var script = document.createElement('script');
            script.src = '/assets/js/quanmod/phaohoa.js';
            document.body.appendChild(script);

            var script1 = document.createElement('script');
            script1.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/329180/Stage%400.1.4.js';
            document.body.appendChild(script1);

            var script2 = document.createElement('script');
            script2.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/329180/MyMath.js';
            document.body.appendChild(script2);

            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = '/assets/css/tet.css';
            document.head.appendChild(link);

            // Remove all classes from body
            document.body.className = '';

            // Add new classes to body
            document.body.classList.add('vsc-initialized', 'dark-only');

            audio.play();

        }, delay);
    } else {
        setTimeout(function () {
            html_tet.style.display = 'block';
            var script = document.createElement('script');
            script.src = '/assets/js/quanmod/phaohoa.js';
            document.body.appendChild(script);

            var script1 = document.createElement('script');
            script1.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/329180/Stage%400.1.4.js';
            document.body.appendChild(script1);

            var script2 = document.createElement('script');
            script2.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/329180/MyMath.js';
            document.body.appendChild(script2);

            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = '/assets/css/tet.css';
            document.head.appendChild(link);

            // Remove all classes from body
            document.body.className = '';

            // Add new classes to body
            document.body.classList.add('vsc-initialized', 'dark-only');

            audio.play();
        }, 1000);
    }
} else {
    document.getElementById('phaohoa').innerHTML = '';

    var pictureSrc = "https://1.bp.blogspot.com/-CXx9jt2JMRk/Vq-Lh5fm88I/AAAAAAAASwo/XivooDn_oSY/s1600/hoamai.png"; //the location of the snowflakes
    var pictureWidth = 15; //the width of the snowflakes
    var pictureHeight = 15; //the height of the snowflakes
    var numFlakes = 10; //the number of snowflakes
    var downSpeed = 0.01; //the falling speed of snowflakes (portion of screen per 100 ms)
    var lrFlakes = 10; //the speed that the snowflakes should swing from side to side
    if (typeof (numFlakes) != 'number' || Math.round(numFlakes) != numFlakes || numFlakes < 1) {
        numFlakes = 10;
    }
    //draw the snowflakes
    for (var x = 0; x < numFlakes; x++) {
        if (document.layers) { //releave NS4 bug
            document.write('<layer id="snFlkDiv' + x + '"><imgsrc="' + pictureSrc + '" height="' + pictureHeight + '"width="' + pictureWidth + '" alt="*" border="0"></layer>');
        } else {
            document.write('<div style="position:absolute; z-index:9999;"id="snFlkDiv' + x + '"><img src="' + pictureSrc + '"height="' + pictureHeight + '" width="' + pictureWidth + '" alt="*"border="0"></div>');
        }
    }
    //calculate initial positions (in portions of browser window size)
    var xcoords = new Array(),
        ycoords = new Array(),
        snFlkTemp;
    for (var x = 0; x < numFlakes; x++) {
        xcoords[x] = (x + 1) / (numFlakes + 1);
        do {
            snFlkTemp = Math.round((numFlakes - 1) * Math.random());
        } while (typeof (ycoords[snFlkTemp]) == 'number');
        ycoords[snFlkTemp] = x / numFlakes;
    }
    //now animate
    function flakeFall() {
        if (!getRefToDivNest('snFlkDiv0')) {
            return;
        }
        var scrWidth = 0,
            scrHeight = 0,
            scrollHeight = 0,
            scrollWidth = 0;
        //find screen settings for all variations. doing this every time allows for resizing and scrolling
        if (typeof (window.innerWidth) == 'number') {
            scrWidth = window.innerWidth;
            scrHeight = window.innerHeight;
        } else {
            if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                scrWidth = document.documentElement.clientWidth;
                scrHeight = document.documentElement.clientHeight;
            } else {
                if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                    scrWidth = document.body.clientWidth;
                    scrHeight = document.body.clientHeight;
                }
            }
        }
        if (typeof (window.pageYOffset) == 'number') {
            scrollHeight = pageYOffset;
            scrollWidth = pageXOffset;
        } else {
            if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
                scrollHeight = document.body.scrollTop;
                scrollWidth = document.body.scrollLeft;
            } else {
                if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
                    scrollHeight = document.documentElement.scrollTop;
                    scrollWidth = document.documentElement.scrollLeft;
                }
            }
        }
        //move the snowflakes to their new position
        for (var x = 0; x < numFlakes; x++) {
            if (ycoords[x] * scrHeight > scrHeight - pictureHeight) {
                ycoords[x] = 0;
            }
            var divRef = getRefToDivNest('snFlkDiv' + x);
            if (!divRef) {
                return;
            }
            if (divRef.style) {
                divRef = divRef.style;
            }
            var oPix = document.childNodes ? 'px' : 0;
            divRef.top = (Math.round(ycoords[x] * scrHeight) + scrollHeight) + oPix;
            divRef.left = (Math.round(((xcoords[x] * scrWidth) - (pictureWidth / 2)) + ((scrWidth / ((numFlakes + 1) * 4)) * (Math.sin(lrFlakes * ycoords[x]) - Math.sin(3 * lrFlakes * ycoords[x])))) + scrollWidth) + oPix;
            ycoords[x] += downSpeed;
        }
    }
    //DHTML handlers
    function getRefToDivNest(divName) {
        if (document.layers) {
            return document.layers[divName];
        } //NS4
        if (document[divName]) {
            return document[divName];
        } //NS4 also
        if (document.getElementById) {
            return document.getElementById(divName);
        } //DOM (IE5+, NS6+, Mozilla0.9+, Opera)
        if (document.all) {
            return document.all[divName];
        } //Proprietary DOM - IE4
        return false;
    }
    window.setInterval('flakeFall();', 100);
}