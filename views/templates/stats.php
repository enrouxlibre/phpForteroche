<?php

/** 
 * Affichage des statistiques des articles 
 */
?>

<a href="index.php?action=admin" class="nav-link">Retour à l'administration</a>

<h2>Statistiques des articles</h2>

<table class="articleStats">
    <thead>
        <tr>
            <th><a href="index.php?action=stats&sortBy=title<?= ($sortBy == 'title' && $ascending != "0" ? '&ascending=0' : '') ?>">Titre</a></th>
            <th><a href="index.php?action=stats&sortBy=views<?= ($sortBy == 'views' && $ascending != "0" ? '&ascending=0' : '') ?>">Vues</a></th>
            <th><a href="index.php?action=stats&sortBy=comment_count<?= ($sortBy == 'comment_count' && $ascending != "0" ? '&ascending=0' : '') ?>">Commentaires</a></th>
            <th><a href="index.php?action=stats&sortBy=date_creation<?= ($sortBy == 'date_creation' && $ascending != "0" ? '&ascending=0' : '') ?>">Date</a></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) {
        ?>
            <tr>
                <td><?= $article->getTitle() ?></td>
                <td><?= $article->getViews() ?></td>
                <td><?= $article->getCommentCount() ?></td>
                <td><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>