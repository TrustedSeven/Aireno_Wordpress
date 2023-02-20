var KTAppChat = function () {
    var sendMessage = function (messenger) {
        var messages = messenger.querySelector('[data-kt-element="messages"]'),
            msgField = messenger.querySelector('[data-kt-element="input"]');
        if (0 !== msgField.value.length) {
            var oClone, oTemplate = messages.querySelector('[data-kt-element="template-out"]'),
                iTemplate = messages.querySelector('[data-kt-element="template-in"]');
            (oClone = oTemplate.cloneNode(!0)).classList.remove("d-none"), oClone.querySelector('[data-kt-element="message-text"]').innerText = msgField.value, msgField.value = "", messages.appendChild(oClone), messages.scrollTop = messages.scrollHeight, setTimeout((function () {
                (oClone = iTemplate.cloneNode(!0)).classList.remove("d-none"), oClone.querySelector('[data-kt-element="message-text"]').innerText = "Thank you for your awesome support!", messages.appendChild(oClone), messages.scrollTop = messages.scrollHeight
            }), 2e3)
        }
    };
    return {
        init: function (messenger) {
            !function (chatMessenger) {
                if (chatMessenger) {
                    KTUtil.on(chatMessenger, '[data-kt-element="input"]', "keydown", (function (event) {
                        if (13 == event.keyCode) return sendMessage(chatMessenger), event.preventDefault(), !1
                    }));
                    KTUtil.on(chatMessenger, '[data-kt-element="send"]', "click", (function (n) {
                        sendMessage(chatMessenger)
                    }));
                    KTUtil.on(chatMessenger, '[data-kt-element="send"]', "click", (function (n) {
                        sendMessage(chatMessenger)
                    }));
                }
            }(messenger)
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAppChat.init(document.querySelector("#kt_drawer_chat_messenger"))
}));

var myDropzone = new Dropzone("#kt_drawer_chat_attachment", {
    url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 10,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "wow.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    }
});