import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.Echo.channel("chat-channel").listen("MessageSent", (e) => {
    console.log("LIVE:", e);

    if (e.sender_id == authUserId) {
        return;
    }

    if (
        window.selectedUserId &&
        (e.sender_id == window.selectedUserId ||
            e.receiver_id == window.selectedUserId)
    ) {
        document.getElementById("messages").innerHTML += `
            <div style="margin-bottom:5px;">
                <b>${e.sender_id == authUserId ? "Me" : e.sender_name}:</b> ${
            e.message
        }
            </div>
        `;
    }
});
