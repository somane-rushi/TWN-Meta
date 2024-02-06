<?php
/**
 * Template Name: FAQ template
 *
 * @package WordPress
 */
get_header(); ?>
<section class="container-fluid section section-faq-hero-container">
    <div class="container">
        <div class="row align-items-end">
            <div class="col col-lg-6">
                <h2>Foire<br/> aux questions</h2>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid section section-faq-container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12" role="tablist">
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading1">
                        <a class="d-flex justify-content-between" data-toggle="collapse" href="#faqQuestion1"
                           role="button" aria-expanded="true" aria-controls="faqQuestion1">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Comment postuler ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion1" class="collapse show" role="tabpanel"
                         aria-labelledby="faqQuestionHeading1">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                En haut à droite vous trouverez un bouton Postuler qui vous emmènera sur un questionnaire. Une fois le questionnaire rempli et validé votre candidature sera bien prise en compte.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading2">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion2" role="button" aria-expanded="false" aria-controls="faqQuestion2">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Quand recevrai-je les résultats?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion2" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading2">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Une fois votre candidature soumise, vous recevrez les résultats de la première étape de sélection dans les semaines suivant la clôture de l'appel à candidatures, soit courant mars.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading3">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion3" role="button" aria-expanded="false" aria-controls="faqQuestion3">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Quelles sont les différentes étapes du processus de sélection ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion3" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading3">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                <ol>
                                    <li>
                                        Questionnaire à remplir <a class="blue-primary" href="https://apply-startup-garage.selecteev.io/submissions?utm_source=startup-inpage&utm_medium=faq&utm_content=fr" target="_blank">ICI</a>
                                    </li>
                                    <li>
                                        Nous reviendrons vers vous pour vous informer du succès de cette première étape courant mars.
                                    </li>
                                    <li>
                                        Appel Téléphonique : Si le résultat est positif nous vous proposerons un rendez-vous téléphonique. Un deuxième rendez-vous téléphonique peut être envisagé pour compléter certaines de nos questions, courant mars-avril.
                                    </li>
                                    <li>
                                        Nous reviendrons vers vous pour vous informer du succès de cette deuxième étape
                                    </li>
                                    <li>
                                        La dernière étape est une rencontre dans nos bureaux à Paris courant mars-avril
                                    </li>
                                    <li>
                                        Nous reviendrons vers vous pour vous informer si vous êtes accepté au Startup Garage Saison 2
                                    </li>
                                    <li>
                                        La saison débutera en mai 2018
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading4">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion4" role="button" aria-expanded="false" aria-controls="faqQuestion4">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">J'ai déjà postulé à la première saison mais je n’ai pas été pris, puis-je re-postuler ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion4" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading4">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Bien sûr, nous serons heureux de voir votre évolution.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading5">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion5" role="button" aria-expanded="false" aria-controls="faqQuestion5">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Quand est-ce que le programme commence ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion5" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading5">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Le programme de la saison 2 commence en mai 2018.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading6">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion6" role="button" aria-expanded="false" aria-controls="faqQuestion6">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Comment puis-je bien me préparer au programme ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion6" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading6">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                La meilleure façon de se préparer au programme est tout d’abord de réfléchir précisément à quels sont vos objectifs sur les 6 prochains mois. En fonction de ces objectifs, assurez-vous que vous avez les ressources humaines nécessaires à leur réalisation ou que vous êtes en train de les obtenir. Nous invitons les startups à avoir une idée claire des KPIs sur lesquelles elles veulent se concentrer durant le programme. Ces KPIs pourront être précisés avec les mentors en début de programme afin de déterminer une trajectoire cohérente et un plan d’exécution, même court-terme.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading7">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion7" role="button" aria-expanded="false" aria-controls="faqQuestion7">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Que puis-je espérer du programme ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion7" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading7">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Startup Garage est un cadre crée afin de soutenir votre startup pendant une phase critique de son développement. Vous aurez accès à du soutien et des conseils des meilleurs experts de Facebook ainsi que d’un accompagnement stratégique par votre mentor pour travailler à la croissance de vos KPIs. Startup Garage vous permet de professionnaliser certaines de vos activités avec des méthodologies et des process testés par Facebook. Vous serez également dans un environnement dynamique et connecté avec un accès privilégié à l’entreprise Facebook. Cependant, Facebook ne peut s’engager à partager des informations confidentielles, à utiliser ou privilégier votre solution de quelque manière que ce soit. <br/>
                                <br/>Il est important de préciser que Startup Garage ne peut garantir le succès de votre startup mais fera tout pour y contribuer, vous restez les maîtres à bord et les seuls responsables de votre réussite.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading8">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion8" role="button" aria-expanded="false" aria-controls="faqQuestion8">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Je suis data driven, mais je ne collecte pas de données personnelles. Puis-je postuler ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion8" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading8">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Non. Nous n’acceptons que des startups qui gèrent des données personnelles. Une partie du programme est destinée à accompagner les startups dans la création d’une relation de confiance et de transparence avec leurs utilisateurs. Nous réfléchissons ensemble aux meilleures manières de remettre l’utilisateur au cœur du service et en contrôle de ses données. Notre approche est celle dite de « Privacy By Design » : comment penser aux enjeux de la confidentialité des données personnelles de mes utilisateurs dès la conception de mon produit et intégrer mes considérations dans ma roadmap.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading9">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion9" role="button" aria-expanded="false" aria-controls="faqQuestion9">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Je crée des solutions liées au RGPD, est ce que je peux postuler ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion9" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading9">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Oui, nous acceptons les entreprises qui créent des solutions innovantes en lien avec les clauses du RGPD : privacy engineering, data portability, data security, data privacy etc.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading10">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion10" role="button" aria-expanded="false" aria-controls="faqQuestion10">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Qu'est-ce qu'une startup qui crée de la valeur autour des données personnelles ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion10" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading10">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Les participants au programme Startup Garage sont sélectionnés parce qu’ils représentent l’avant-garde de l’innovation basée sur les données personnelles avec des objectifs visant à aider les gens à gérer leurs données, à prendre de meilleures décisions et à obtenir des résultats de manière plus efficace. Par exemple, The Fabulous est une application de coaching santé et bien-être qui aide les gens à adopter et conserver de bonnes habitudes de santé en s’appuyant sur les principes de l’économie comportementale.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading11">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion11" role="button" aria-expanded="false" aria-controls="faqQuestion11">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Mon équipe n'est pas sur Paris, puis-je postuler ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion11" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading11">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Nous recommandons vivement aux équipes d'être basée à Station F, car cela encourage la sérendipité et permet d'être plus agile et réactif au cours de votre accompagnement. Nous traitons les demandes au cas par cas.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading12">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion12" role="button" aria-expanded="false" aria-controls="faqQuestion12">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Est-ce que Facebook a des projets d'investissement ou de rachat des startups ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion12" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading12">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Facebook ne choisit pas des startups dans le programme avec l'intention d'investir dans les entreprises ou de les racheter. Notre objectif est de soutenir les startups grâce à du mentoring et d'autres types de bénéfices.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading13">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion13" role="button" aria-expanded="false" aria-controls="faqQuestion13">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Est-ce que le programme aide à lever des fonds ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion13" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading13">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Le programme n’est pas conçu pour vous accompagner dans la levée de fonds. En revanche nous sommes en contact avec un certain nombre d’investisseurs et seront ravis de pouvoir vous faire des introductions le cas échéant.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading14">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion14" role="button" aria-expanded="false" aria-controls="faqQuestion14">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Pourquoi Facebook fait cela ? Qu'est-ce que Facebook gagne dans le Garage ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion14" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading14">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Facebook soutient l’écosystème de startups et de développeurs depuis sa création à travers sa branche Partenariats et des évènements comme F8. Nous nous efforçons de créer des solutions et des produits créatifs et enthousiasmant pour les entrepreneurs et les développeurs. Aujourd’hui nous souhaitons aller plus loin et utiliser nos ressources et notre capital humain pour accompagner au plus près les entrepreneurs dans la réussite de leurs projets.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading15">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion15" role="button" aria-expanded="false" aria-controls="faqQuestion15">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Que se passe-t-il après la fin du programme ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion15" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading15">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                A la fin du programme vous rejoignez notre communauté d’Alumni qui ne fait que d’augmenter à travers le monde. Nous avons des incubateurs dans plusieurs pays Corée du Sud, Mexico, Brésil, Inde, UK et continuons d’en ouvrir. Nous espérons rester en forte connexion avec toutes les startups passées par nos programmes.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading16">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion16" role="button" aria-expanded="false" aria-controls="faqQuestion16">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Est-ce que Startup Garage recrute ?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion16" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading16">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Suivez-nous sur notre page Facebook pour suivre toutes les actualités à ce sujet.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-card">
                    <div class="faq-card-header" role="tab" id="faqQuestionHeading17">
                        <a class="d-flex justify-content-between collapsed" data-toggle="collapse"
                           href="#faqQuestion17" role="button" aria-expanded="false" aria-controls="faqQuestion17">
                            <h4><span class="blue-secondary">Q. </span><span class="blue-primary">Quels critères de sélection utilisons-nous pour évaluer les candidatures?</span>
                            </h4>
                            <img src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div id="faqQuestion17" class="collapse" role="tabpanel" aria-labelledby="faqQuestionHeading17">
                        <div class="faq-card-body">
                            <h4>A.</h4>
                            <div class="faq-answer col-lg-6">
                                Nous essayons de choisir les startups qui bénéficieront le plus des offres du programme. Voici ce que nous recherchons:</br>
                                - Une équipe de fondateurs talentueuse- Un produit adéquat au marché existant (product-market fit)</br>
                                - Un produit qui fournit un service basé sur l’usage de données personnelles</br>
                                - Un financement suffisant pour un minimum de 12 mois (les équipes qui sont en phase intense de recherche de fonds ou qui sont limitées en termes de ressources ne seront probablement pas en mesure de profiter au maximum de tout ce que le programme a à offrir)</br>
                                - Une équipe opérant en France</br>
                                - Une équipe capable d'être à Paris pour la durée entière du programme de 6 mois
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
