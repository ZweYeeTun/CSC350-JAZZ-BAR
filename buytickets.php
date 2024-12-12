<?php $page_title = 'buytickets';
include 'includes/header.html';
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <h1 class="header_ticket">Buy Tickets</h1>
    <form class="ticket-form" action="process_ticket.php" method="POST">
        <!-- Customer Details -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <!-- Event Details -->
        <label for="event_date">Select Date:</label>
        <select id="event_date" name="event_date" required>
            <!-- Dynamically populated -->
        </select><br><br>

        <label for="artist_time">Choose Artist and Time:</label>
        <select id="artist_time" name="artist_time" required>
            <!-- Dynamically populated -->
        </select><br><br>

        <!-- Ticket Quantity -->
        <label for="ticket_quantity">Quantity:</label>
        <select id="ticket_quantity" name="ticket_quantity" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br><br>

        <!-- Payment Method -->
        <label>Payment Method:</label>
        <input type="radio" id="apple_pay" name="payment_method" value="Apple Pay" required>
        <label for="apple_pay">Apple Pay</label>

        <input type="radio" id="visa" name="payment_method" value="Visa" required>
        <label for="visa">Visa</label><br><br>

        <button type="submit">Buy Ticket</button>
    </form>

    <script>
        // Fetch event data from the backend
        async function loadEvents() {
            const response = await fetch('fetch_events.php');
            const events = await response.json();

            const dateSelect = document.getElementById('event_date');
            const artistTimeSelect = document.getElementById('artist_time');

            // Populate date dropdown
            const dates = [...new Set(events.map(event => event.event_date))];
            dates.forEach(date => {
                const option = document.createElement('option');
                option.value = date;
                option.textContent = date;
                dateSelect.appendChild(option);
            });

            // Update artist-time dropdown based on selected date
            dateSelect.addEventListener('change', () => {
                artistTimeSelect.innerHTML = '';
                const selectedDate = dateSelect.value;
                events
                    .filter(event => event.event_date === selectedDate)
                    .forEach(event => {
                        const option = document.createElement('option');
                        option.value = event.id;
                        option.textContent = `${event.artist_name} - ${event.event_time}`;
                        artistTimeSelect.appendChild(option);
                    });
            });

            // Trigger initial load for the first date
            if (dates.length > 0) {
                dateSelect.value = dates[0];
                dateSelect.dispatchEvent(new Event('change'));
            }
        }

        loadEvents();
    </script>

<?php include 'includes/footer.html'; ?>