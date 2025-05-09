// public/js/principal-message.js

document.addEventListener("DOMContentLoaded", function () {
    const fullText = principalMessageText || "";

    const truncatedText = fullText.slice(0, -1) + "...";
    let isExpanded = false;

    const messageElement = document.getElementById("principal-message");
    const toggleButton = document.getElementById("toggle-button");

    function renderText(text) {
        const words = text.split(" ");
        messageElement.innerHTML = words
            .map(
                (word, index) => `
        <span class="fade-in" style="animation-delay: ${index * 0.1}s;">
          ${word}&nbsp;
        </span>
      `
            )
            .join("");
    }

    function toggleMessage() {
        isExpanded = !isExpanded;
        renderText(isExpanded ? fullText : truncatedText);
        toggleButton.innerText = isExpanded ? "Show less" : "Read more";
    }

    if (messageElement && toggleButton) {
        toggleButton.addEventListener("click", toggleMessage);
        renderText(truncatedText);
    }
});
//manager message
document.addEventListener("DOMContentLoaded", function () {
    const fullmanagerText = managerMessageText || "";

    const truncatedText = fullmanagerText.slice(0, 150) + "...";
    let isExpanded = false;

    const messageElement = document.getElementById("manager-message");
    const toggleButton = document.getElementById("mntoggle-button");

    function renderText(text) {
        const words = text.split(" ");
        messageElement.innerHTML = words
            .map(
                (word, index) => `
        <span class="fade-in" style="animation-delay: ${index * 0.1}s;">
          ${word}&nbsp;
        </span>
      `
            )
            .join("");
    }

    function mngrtoggleMessage() {
        isExpanded = !isExpanded;
        renderText(isExpanded ? fullmanagerText : truncatedText);
        toggleButton.innerText = isExpanded ? "Show less" : "Read more";
    }

    if (messageElement && toggleButton) {
        toggleButton.addEventListener("click", mngrtoggleMessage);
        renderText(truncatedText);
    }
});
