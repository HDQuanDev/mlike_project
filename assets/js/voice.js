var message = document.querySelector('#message');

var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

var grammar = '#JSGF V1.0;'

var recognition = new SpeechRecognition();
var speechRecognitionList = new SpeechGrammarList();
speechRecognitionList.addFromString(grammar, 1);
recognition.grammars = speechRecognitionList;
recognition.lang = 'vi-VN';
recognition.interimResults = false;

recognition.onresult = function (event) {
    var lastResult = event.results.length - 1;
    var content = event.results[lastResult][0].transcript;
    message.textContent = 'Bạn vừa nói: ' + content + '.';
    mess = content.toLowerCase();
    if (mess.indexOf('hứa đức quân') !== -1) {
        window.location = "https://fb.com/quancp72h";
    } else if (mess.indexOf('like facebook') !== -1) {
        window.location = "https://mlike.vn/service/like.php";
    } else if (mess.indexOf('anh quang') !== -1) {
        window.location = "https://www.facebook.com/profile.php?id=100053007754458";
    }
};

recognition.onspeechend = function () {
    recognition.stop();
    $("#btnTalk")
        .prop("disabled", false);
        $('#btnTalk')['html']('Nhấn để nói...');
};

recognition.onerror = function (event) {
    message.textContent = 'Error occurred in recognition: ' + event.error;
}

document.querySelector('#btnTalk').addEventListener('click', function () {
    recognition.start();
    $("#btnTalk")
        .prop("disabled", true);
        $('#btnTalk')['html']('Vui lòng chờ...');
});