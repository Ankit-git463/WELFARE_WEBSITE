document.getElementById("bus-request-form").onsubmit = function() {
    let timeSlot = document.getElementById("time-slot").value;
    if (timeSlot === "") {
        alert("Please select a time slot");
        return false;
    }
    return true;
};
