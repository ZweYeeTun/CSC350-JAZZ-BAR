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
            <table border="1" class="tb">
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
                <th>${announcement.title}</th>
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
                fetchEvents();
                fetchAnnouncements();
            </script>

        </section>
        <div class="music">
        <div class="musicOn">
            <audio id="player" autoplay loop>
                <source src="deepinit.mp3" type="audio/mp3">
            </audio>
        </div>
        <div class="tgl-btn1">
            <a class="tgl-btn2" href="#"><i class="fa-solid fa-volume-xmark"></i></a>
        </div>
    </div>
    </div>
    
</div>
<script>
    let audio = document.getElementById("player");
    audio.volume = 0.2;

    let on_off = document.querySelector('.tgl-btn1 .tgl-btn2');
    let audio1 = document.querySelector('.musicOn audio');

    on_off.onclick = function () {
        audio1.paused ? audio1.play() : audio1.pause();
    }

    // let btn = document.querySelector(".tgl-btn2");
    // let icon = btn.querySelector("fa-volume-xmark");

    // btn.onclick = function () {
    //     if (icon.classList.contains("fa-volume-xmark")) {
    //         icon.classList.replace("fa-volume-xmark", "fa-volume-high");
    //     }
    //     else {
    //         icon.classList.replace("fa-volume-high", "fa-volume-xmark");
    //     }
    // }
</script>
<?php include 'includes/footer.html'; ?>