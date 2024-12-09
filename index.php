<?php $page_title = 'Home';
 include 'includes/header.html'; 
 ?>
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<div class="containerA">
    <div class="announcement">
        <section class="announce">
            <h1>Announcements</h1>
        </section>

        <section class="info">
            <p>Show Date & Musicians</p>
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
        // Fetch events on page load
        fetchEvents();
    </script>

        </section>
    </div>
</div>

<?php include 'includes/footer.html'; ?>

   
    
