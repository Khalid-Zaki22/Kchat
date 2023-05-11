// sending messages
let sendBtn = document.querySelector(".send");
let message = document.querySelector(".txt");
let userName = document.querySelector("h3 span");

sendBtn.onclick = function () {

    let formData = new FormData();
    let file = document.querySelector(".photo");
    formData.append('message', message.value);
    formData.append('username', userName.innerText);
    formData.append('file', file.files[0]);
    fetch("addmessage.php", {
        method: "POST",
        body: formData
    });
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
                    let messageImg = document.createElement("img");
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
                    if (json[index].messagePhoto != "") {
                        messageBox.append(messageImg);
                        messageImg.setAttribute("src", "./imgs/" + json[index].messagePhoto);
                        messageImg.style.width = "700px";
                        messageImg.style.maxWidth = "100%";

                    }
                    messages.scrollTop = messages.scrollHeight;
                   
                }
                count = json.length;
               
            }
           

        }

    }

    getMessagesRequest.open("POST", "getmessages.php", true)
    getMessagesRequest.send();
    
}
setInterval(getMessages,1000);

