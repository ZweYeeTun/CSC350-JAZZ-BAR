<?php $page_title = 'Home';
include 'includes/header.html';
?>

<div class="content">
    <div class="containerA">
        <div class="announcement">
            <section class="announce">
                <h1>Announcements</h1>
            </section>

            <section class="info">
                <p>Show Date & Musicians</p>
            </section>

            <section class="title">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Musicians</th>
                    </tr>

                    <tr>
                        <td>12.12.24</td>
                        <td>12:40pm</td>
                        <td>Giggolos</td>
                    </tr>
                    <tr>
                        <td>12.12.24</td>
                        <td>12:40pm</td>
                        <td>Giggolos</td>
                    </tr>
                    <tr>
                        <td>12.12.24</td>
                        <td>12:40pm</td>
                        <td>Giggolos</td>
                    </tr>
                    <tr>
                        <td>12.12.24</td>
                        <td>12:40pm</td>
                        <td>Giggolos</td>
                    </tr>
                    <tr>
                        <td>12.12.24</td>
                        <td>12:40pm</td>
                        <td>Giggolos</td>
                    </tr>
                    <tr>
                        <td>12.12.24</td>
                        <td>12:40pm</td>
                        <td>Giggolos</td>
                    </tr>
                </table>
            </section>
        </div>
    </div>
    <audio id="player" autoplay loop>
    <source src="deepinit.mp3"  type="audio/mp3">
</audio>
</div>
<script>
    let audio = document.getElementById("player");
    audio.volume = 0.2;
</script>
<?php include 'includes/footer.html'; ?>