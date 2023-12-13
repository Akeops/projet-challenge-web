<?php ob_start();
?>
<!-- Présentation de ma personne -->
<section id="presentation">
    <div class="container text-center">
        <div class="row divPresentation">
            <div class="col-12 col-xl-6  presentation">
                <img src="../source/images/photoPresentation.png" class="card-img-top img-fluid" alt="photo de moi">
            </div>
            <div class="col-12 col-xl-6 presentationDescription shadow-lg text-start">
                    <p>Bonjour, je suis Andoni Lalanne-Berdouticq, passionné de développement informatique et titulaire d'un BTS en SIO avec une spécialisation en SLAM. Ayant récemment repris mes études à l'Efrei, je me concentre actuellement sur le développement Full-Stack. Mon parcours m'a conféré des compétences robustes en PHP, Bootstrap, CSS et Javascript. À ce stade, je suis particulièrement enthousiaste à l'idée de me former sur une stack polyvalente, me permettant d'exceller aussi bien dans le frontend que dans le backend du développement informatique.</p>
            </div>
        </div>
        <div class="col-12 text-center boutonCV">
            <a class="btn rounded-pill monBouton" href="../source/pdf/Lalanne-Berdouticq-CV.pdf" download="Lalanne-Berdouticq-Andoni">Télécharger mon CV</a>
        </div>
    </div>
</section>
 


<?php
    $content = ob_get_clean();
?>

