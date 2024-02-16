function realTimeClock() {
    // Get the current date and time.
    var date = new Date();

    // Get the hours, minutes, and seconds.
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();

    // Format the time string.
    var timeString = `${hours}:${minutes}:${seconds}`;

    // Display the time in the clock element.
    document.getElementById("clock").innerHTML = timeString;

    // Update the clock every second.
    setInterval(realTimeClock, 1000);
}

// Call the function once to initialize the clock.
realTimeClock();
