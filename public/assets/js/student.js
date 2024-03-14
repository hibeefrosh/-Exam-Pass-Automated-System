/**
 * Main
 */

"use strict";


// Get the current hour
const currentHour = new Date().getHours();

// Get the greeting message based on the time of day
let greetingMessage;
if (currentHour >= 5 && currentHour < 12) {
    greetingMessage = "Good Morning, Scholar! 🌅📚";
} else if (currentHour >= 12 && currentHour < 18) {
    greetingMessage = "Good Afternoon, Scholar! ☀️📚";
} else {
    greetingMessage = "Good Evening, Scholar! 🌙📚";
}

// Update the greeting message in the HTML
document.getElementById("greeting-message").textContent = greetingMessage;

   

