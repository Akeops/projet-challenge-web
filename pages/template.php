<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portfolio Andoni</title>
        <link rel="icon" href="../source/images/logoPortfolio.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/app.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php require("menu.php"); ?>
        <?= $content ?>
        <footer class="footer" id="footer">
            <div class="inner">
                <div class="column is-logo">
                    <ul>
                        <div class="logo">
                            <img src="../source/images/logoPortfolio.png" alt="logo" width="50px">
                        </div>
                        <div class="logo-info">
                            <div class="footer_text">LALANNE-BERDUTICQ Andoni</div>
                            <span class="copyright">© 2023. All rights reserved.</span>
                        </div>
                    </ul>
                </div>
                <div class="column is-nav">
                    <ul>
                        <div class="column-title">Navigation</div>
                        <li class="liFooter"><a href="index.php#presentation" class="footer_a">Présentation</a></li>
                        <li class="liFooter"><a href="index.php#expPro" class="footer_a">Parcours Professionnel</a></li>
                        <li class="liFooter"><a href="index.php#competencesPro" class="footer_a">Compétences</a></li>
                    </ul>
                </div>
                <div class="column is-nav">  
                    <ul>
                        <div class="column-title">Contact</div>
                        <li class="liFooter"><a href="mailto:lalanne.andoni1@gmail.com" class="footer_a"><i class="fa fa-envelope-open"></i>
                                lalanne.andoni1@gmail.com</a></li>
                        <li class="liFooter"><a href="#footer" class="footer_a"><i class="fa fa-phone"></i> 0662455792</a></li>
                        <li class="liFooter"><a href="https://www.linkedin.com/in/andoni-lalanne-berdouticq-240104179/" rel="noreferrer" class="footer_a"><i
                                    class="fa fa-linkedin"></i> LinkedIn</a></li>
                    </ul>
                    
                </div>
                <div class="column is-nav">
                    <ul>
                    <div class="column-title">Informations</div>
                        <li class="liFooter"><a href="./mentionsLegales.php" class="footer_a">Mentions Légales</a></li>
                        <li class="liFooter"><a href="#" class="footer_a">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>

<!-- je suis andoni