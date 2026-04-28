document.addEventListener('DOMContentLoaded', function() {
    // Event details for calendar
    const eventDetails = {
        title: "Tubing, Camping, Yelling.",
        description: "Come celebrate with food, drinks, and fun! No gifts necessary, just your presence. We'll meet up, go tubing or canoeing, then back and have a bonfire and BBQ. Tent up in the yard, and stay the night!",
        location: "7860 Fish Lake Road, Siren, WI",
        start: new Date("2025-06-21T11:00:00"),
        end: new Date("2025-06-22T11:00:00"),
    };
    
    const modalElement = document.getElementById('response-modal');
    const modal = UIkit.modal(modalElement);
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    
    // Handle RSVP form submission
    document.getElementById('rsvp-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Show loading in modal
        modalTitle.textContent = "Submitting...";
        modalMessage.textContent = "Please wait while we process your RSVP...";
        modalElement.classList.remove('uk-modal-success', 'uk-modal-error');
        modal.show();
        
        // Log the form data for debugging
        console.log("Form data being sent:");
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        // Send the form data to the server
        fetch('save_rsvp.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log("Response status:", response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("Response data:", data);
            if (data.success) {
                modalTitle.textContent = "RSVP Successful!";
                modalMessage.textContent = "Thank you for your RSVP! We look forward to seeing you.";
                modalElement.classList.add('uk-modal-success');
                
                // Clear the form on success
                document.getElementById('rsvp-form').reset();
                
                // Reload the page to update the guest list
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
            } else {
                modalTitle.textContent = "RSVP Error";
                modalMessage.textContent = "There was an error submitting your RSVP: " + data.message;
                modalElement.classList.add('uk-modal-error');
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
            modalTitle.textContent = "RSVP Error";
            modalMessage.textContent = "There was an error submitting your RSVP: " + error.message;
            modalElement.classList.add('uk-modal-error');
        });
    });
    
    // Handle Google Calendar button
    document.getElementById('google-calendar').addEventListener('click', function() {
        const { title, description, location, start, end } = eventDetails;
        
        const startTime = start.toISOString().replace(/-|:|\.\d+/g, '');
        const endTime = end.toISOString().replace(/-|:|\.\d+/g, '');
        
        const url = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&details=${encodeURIComponent(description)}&location=${encodeURIComponent(location)}&dates=${startTime}/${endTime}`;
        
        window.open(url, '_blank');
    });
    
    // Handle ICS download button
    document.getElementById('ics-download').addEventListener('click', function() {
        const { title, description, location, start, end } = eventDetails;
        
        // Format dates for ICS file
        const formatDate = (date) => {
            return date.toISOString().replace(/-|:|\.\d+/g, '').substring(0, 15) + 'Z';
        };
        
        const startDate = formatDate(start);
        const endDate = formatDate(end);
        const now = formatDate(new Date());
        
        // Create ICS content
        const icsContent = 
            'BEGIN:VCALENDAR\n' +
            'VERSION:2.0\n' +
            'PRODID:-//Tubing Camping Event//EN\n' +
            'CALSCALE:GREGORIAN\n' +
            'BEGIN:VEVENT\n' +
            `UID:${now}-tubing-event\n` +
            `DTSTAMP:${now}\n` +
            `DTSTART:${startDate}\n` +
            `DTEND:${endDate}\n` +
            `SUMMARY:${title}\n` +
            `DESCRIPTION:${description}\n` +
            `LOCATION:${location}\n` +
            'END:VEVENT\n' +
            'END:VCALENDAR';
        
        // Create and download the file
        const blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'tubing_camping_event.ics';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});