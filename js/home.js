// sending messages
let sendBtn = document.querySelector(".send");
let message = document.querySelector(".txt");
let userName = document.querySelector("h3 span");

sendBtn.onclick = function () {
    let addRequest = new XMLHttpRequest();
    addRequest.onreadystatechange = function () {
        if (addRequest.readyState == 4 && addRequest.status == 200) {

        }
    }
    addRequest.open("POST", "addmessage.php", true)
    addRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    addRequest.send(`message=${message.value}&username=${userName.innerText}`);
    message.value = "";
}





// get messages 
let messages = document.querySelector(".messages");
let count = 0;
function getMessages() {
    let getMessagesRequest = new XMLHttpRequest();
    getMessagesRequest.onreadystatechange = function () {
        if (getMessagesRequest.readyState == 4 && getMessagesRequest.status == 200) {
            let json = JSON.parse(this.responseText);
            if (count < json.length) {
                for (let index = count; index < json.length; index++) {
                    let messageContainer = document.createElement("div");
                    let messageBox = document.createElement("div");
                    let messageSender = document.createElement("h6");
                    let messageTxt = document.createElement("p");
                    let messageDate = document.createElement("h6");
                    messages.append(messageContainer);
                    messageContainer.classList.add("message-container");
                    messageContainer.append(messageBox);
                    if (userName.innerText == json[index].sender) {
                        messageContainer.classList.add("justify-content-end");
                        messageBox.classList.add("my-message");
                    }
                    else {
                        messageBox.classList.add("message-box");
                    }
                    messageBox.append(messageSender);
                    messageSender.innerText = json[index].sender;
                    messageBox.append(messageTxt);
                    messageTxt.innerText = json[index].messageText;
                    messageBox.append(messageDate);
                    messageDate.innerText = json[index].messageTime;
                    messages.scrollTo(0, 3000);
                }
                count = json.length;
               
            }
           

        }

    }

    getMessagesRequest.open("POST", "getmessages.php", true)
    getMessagesRequest.send();
    
}
setInterval(getMessages,10);

