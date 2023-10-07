<?php include 'header.php' ?>

<!--==================== MAIN ====================-->
<main class="main">
    <br>
    <!--==================== WHO ====================-->
    <section class="who section" id="who">
        <span class="section__subtitle">Agendar</span>
        <h2 class="section__title"> Agora preencha os dados para marcar seu horario!!</h2>


        <div class="container">
            <form action="POST">
                <input type="radio" id="html" name="fav_language" value="HTML">
                  <label for="html">HTML</label><br>
                  <input type="radio" id="css" name="fav_language" value="CSS">
                  <label for="css">CSS</label><br>
                  <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                  <label for="javascript">JavaScript</label><br><br>
                <input type="submit" value="Submit">
            </form>
        </div>


    </section>
</main>


<?php include 'footer.php' ?>