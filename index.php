<?php $page_title = 'Home';
 include 'includes/header.html'; 
 ?>
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<div class="containerA">
    <div class="announcement">
        <section class="announce">

            <marquee id="announcements"></marquee>
        </section>

        <section class="title">
        <table border="1">
        <thead>
            <tr>
                
                <th>Date</th>
                <th>Artist</th>
                <th>Time</th>
                <th>Tickets</th>
            </tr>
        </thead>
        <tbody id="eventsTableBody">
        
            <!-- Dynamically populated -->
        </tbody>
    </table>
    <script>
             // Function to fetch events
             async function fetchEvents() {
            const response = await axios.get('fetch_events.php');
            const events = response.data;
            const eventsTableBody = document.getElementById('eventsTableBody');
            eventsTableBody.innerHTML = '';

            events.forEach(event => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    
                    <td>${event.event_date}</td>
                    <td>${event.artist_name}</td>
                    <td>${event.event_time}</td>
                    <td><a href="buytickets.html
				">Buy Tickets</a></td>

                    
                    
                `;
                eventsTableBody.appendChild(row);
            });
        }
        async function fetchAnnouncements() {
    try {
        // Fetch data from the backend
        const response = await axios.get('fetch_announcement.php');
        const announcements = response.data;

        // Get the table body where announcements will be displayed
        const announcementsTableBody = document.getElementById('announcements');
        announcementsTableBody.innerHTML = '';

        // Loop through the announcements and create table rows
        announcements.forEach(announcement => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <th>${announcement.title}   </th>
                &nbsp;
                &nbsp;
                <td>${announcement.description}</td>
            `;
            announcementsTableBody.appendChild(row);
        });
    } catch (error) {
        console.error('Error fetching announcements:', error);
    }
}




       
    // fetch('fetch_announcement.php')
    //        .then(response => response.json())
    //         .then(data => {
    //            const announcementsDiv = document.getElementById('announcements');

    //             Populate the announcements
    //             data.forEach(announcement => {
    //                const announcementDiv = document.createElement('div');
    //                 announcementDiv.classList.add('announcement');
    //                announcementDiv.innerHTML = `
    //                    <h2>${announcement.title}</h2>
    //                    <p>${announcement.description}</p>
    //                     <sma//ll>${new Date(announcement.date).toLocaleDateString()}</small>
    //                 `;
    //                announcementsDiv.appendChild(announcementDiv);
    //             });
    //         })
    //         .catch(error => console.error('Error fetching announcements:', error))
        //Fetch events on page load
        fetchEvents();
        fetchAnnouncements();
    </script>

        </section>
    </div>
</div>

<?php include 'includes/footer.html'; ?>

   
    
