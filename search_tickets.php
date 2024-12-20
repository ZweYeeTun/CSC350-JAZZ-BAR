<?php $page_title = 'buytickets';
include 'includes/header.html';
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <h1 class="search_tickets">Search for Tickets</h1>
    
    <!-- Form to Input First Name and Email -->
    <form id="searchForm">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Search</button>
    </form>

    <h2 class="ticket_head">Tickets</h2>
    <table class="ticket_info" >
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Payment Method</th>
                <th>Ticket Quantity</th>
                <th>Artist</th>
                <th>Event Date</th>
                <th>Event Time</th>
            </tr>
        </thead>
        <tbody id="ticketsTableBody">
            <!-- Tickets will be displayed here -->
        </tbody>
    </table>

    <script>
      // Function to fetch tickets based on user input
      async function fetchTickets(firstName, email) {
    console.log('Fetching tickets for:', firstName, email); // Debug

    try {
        const response = await axios.post('fetch_tickets.php', {
            first_name: firstName,
            email: email
        });

        console.log('Response:', response.data); // Debug response data

        return response.data;
    } catch (error) {
        console.error('Error fetching tickets:', error); // Debug error
        return [];
    }
}

async function updateTicketsTable(firstName, email) {
    console.log('Updating tickets table for:', firstName, email); // Debug

    const tickets = await fetchTickets(firstName, email);

    console.log('Fetched tickets:', tickets); // Debug fetched data

    const ticketsTableBody = document.getElementById('ticketsTableBody');
    ticketsTableBody.innerHTML = '';

    if (tickets.length > 0) {
        tickets.forEach(ticket => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${ticket.first_name}</td>
                <td>${ticket.last_name}</td>
                <td>${ticket.email}</td>
                <td>${ticket.payment_method}</td>
                <td>${ticket.ticket_quantity}</td>
                <td>${ticket.artist_name}</td>
                <td>${ticket.event_date}</td>
                <td>${ticket.event_time}</td>
            `;
            ticketsTableBody.appendChild(row);
        });
    } else {
        ticketsTableBody.innerHTML = '<tr><td colspan="6">No tickets found.</td></tr>';
    }
}

document.getElementById('searchForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevent form reload

    console.log('Form submitted!'); // Debugging: Check if this is logged

    const firstName = document.getElementById('first_name').value.trim();
    const email = document.getElementById('email').value.trim();

    console.log('First Name:', firstName, 'Email:', email); // Debug input values

    await updateTicketsTable(firstName, email);
});


    </script>
<?php include 'includes/footer.html'; ?>
