let isPrincipalExpanded = false;
let isManagerExpanded = false;

function renderText(text, elementId) {
    const messageElement = document.getElementById(elementId);
    const words = text.split(" ");
    messageElement.innerHTML = words
        .map((word, index) => `<span class="fade-in" style="animation-delay: ${index * 0.1}s;">${word}&nbsp;</span>`)
        .join("");
}

function toggleMessage() {
    isPrincipalExpanded = !isPrincipalExpanded;
    const fullText = principalMessageText || "";
    const truncatedText = fullText.slice(0, 150) + "...";
    renderText(isPrincipalExpanded ? fullText : truncatedText, "principal-message");
    document.getElementById("toggle-button").innerText = isPrincipalExpanded ? "Show less" : "Read more";
}

function mngrtoggleMessage() {
    isManagerExpanded = !isManagerExpanded;
    const fullText = managerMessageText || "";
    const truncatedText = fullText.slice(0, 150) + "...";
    renderText(isManagerExpanded ? fullText : truncatedText, "manager-message");
    document.getElementById("mntoggle-button").innerText = isManagerExpanded ? "Show less" : "Read more";
}

document.addEventListener("DOMContentLoaded", function () {
    renderText((principalMessageText || "").slice(0, 150) + "...", "principal-message");
    renderText((managerMessageText || "").slice(0, 150) + "...", "manager-message");
});
