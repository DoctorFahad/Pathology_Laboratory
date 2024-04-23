function hideToast()
{
    var toastContainer = document.getElementById("toast-container");
    // Hide the toast container
    toastContainer.style.display = "none";
}


function showToast(data)
{
    var toastContainer = document.getElementById("toast-container");
    var toastMessage = document.getElementById("toast-message");
    // Set your desired message
    var message = data;
    // Set the message content
    toastMessage.innerText = message;
    // Show the toast container
    toastContainer.style.display = "block";
    // Hide the toast after 3 seconds (adjust as needed)
    setTimeout(function() {
        hideToast();
    }, 5000);    
}

