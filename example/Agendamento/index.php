<?php include 'header.php' ?>

<!--==================== MAIN ====================-->
<main class="main">
    <!--==================== WHO ====================-->
    <section class="who section" id="who">
        <span class="section__subtitle">Funcionário</span>
        <h2 class="section__title">Quais são!</h2>

        <div class="who__container container grid">
            <?php while ($rows = mysqli_fetch_assoc($resultFunc)) { ?>
                <article class="who__card">
                    <img src="../assets/img/favicon.png" alt="popula image" class="who__img">

                    <h3 class="who__name"><?php echo $rows['nomeFuncionario']; ?></h3>
                    <span class="who__description">Apenas corto cabelo e faço barba.</span>

                    <span class="who__price">Terça - Quarta</span>
                </article>
            <?php } ?>
            <a href="Agendar" class="button agendar">
              Agendar Agora<i class="ri-arrow-right-circle-line"></i></a>
        </div>

    </section>
</main>


<?php include 'footer.php' ?>