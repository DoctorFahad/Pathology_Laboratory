// Function to set a cookie
function setCookie(name, value, daysToExpire) {
    var expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + daysToExpire);

    var cookie = `${name}=${value}; expires=${expirationDate.toUTCString()}; path=/`;
    document.cookie = cookie;
}

// Function to get the value of a cookie by name
function getCookie(name) {
    var cookies = document.cookie.split('; ');

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        if (cookie[0] === name) {
            return cookie[1];
        }
    }
    return null;
}

// Function to delete a cookie by name
function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

/*
    Example usage
    setCookie('username', 'john_doe', 7); // Set a cookie named 'username' with value 'john_doe' that expires in 7 days
    var username = getCookie('username'); // Get the value of the 'username' cookie
    console.log('Username:', username);

    Uncomment the line below to delete the 'username' cookie
    deleteCookie('username');
    console.log('Username cookie deleted.');
*/