<?php
$pageTitle = "Schedule Appointment";
include_once("_header.php");
?>
<link rel="stylesheet" href="css/appointment.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="appointment-page">
    <h1>Schedule Your Service</h1>

    <div class="appointment-container">
        <div class="calendar-section">
            <h2>Select Date & Time</h2>
            <input type="text" id="calendar" placeholder="Click to select date/time" readonly>
            <div id="calendar-container"></div>
        </div>

        <div class="form-section">
            <h2>Your Information</h2>
            <form id="appointment-form">
                <input type="hidden" id="selected-datetime" name="datetime">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" required>
                </div>
                <div class="form-group">
                    <label>Service Needed</label>
                    <select name="service" required>
                        <option value="">Select Service</option>
                        <option>Oil Change</option>
                        <option>Brake Service</option>
                        <option>Tire Rotation</option>
                        <option>Diagnostic Check</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Vehicle Make/Model</label>
                    <input type="text" name="vehicle" required>
                </div>
                <button type="submit" class="submit-btn">Confirm Appointment</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendar = flatpickr("#calendar", {
            inline: true,
            minDate: "today",
            maxDate: new Date().fp_incr(30), // 30 days from now
            enableTime: true,
            time_24hr: true,
            minuteIncrement: 30,
            dateFormat: "F j, Y H:i",
            onChange: function(selectedDates, dateStr) {
                document.getElementById('selected-datetime').value = dateStr;
            },
            onReady: function(selectedDates, dateStr, instance) {
                // Initialize with current date/time
                document.getElementById('selected-datetime').value = instance.formatDate(new Date(), "F j, Y H:i");
            }
        });
    });
</script>

<?php include_once("footer.php"); ?>