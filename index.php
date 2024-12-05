<?php $page_title = 'Home';
 include 'includes/header.html'; 
 ?>

<div class="containerA">
    <div class="announcement">
        <section class="announce">
            <h1>Announcements</h1>
        </section>

        <section class="info">
            <p>Show Date & Musicians</p>
        </section>

        <section class="title">
            <p>10:30pm Monday THE GIGGOLOS</p>
        </section>
    </div>
</div>
<audio id="player" autoplay loop>
    <source src="Moanin.mp3"  type="audio/mp3">
</audio>
<script>
    let audio=document.getElementById("player");
    audio.volume =0.2;
</script>
<?php include 'includes/footer.html'; ?>