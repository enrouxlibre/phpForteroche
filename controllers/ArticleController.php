<?php

class ArticleController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showArticle(): void
    {

        // Récupération de l'id de l'article demandé.
        $id = Utils::request("id", -1);

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        $articleManager->incrementViews($id);

        $commentManager = new CommentManager();


        // CHeck if user is connected
        $editionMode = isset($_SESSION['user']);
        $commentId = Utils::request("commentId", -1);
        $commentToDelete = ($commentId > -1) ? $commentManager->getCommentById($commentId) : null;

        if ($commentToDelete && $editionMode) {
            $result = $commentManager->deleteComment($commentToDelete);
            $message = ($result) ? "Commentaire supprimé." : "Le commentaire n'a pas pu être supprimé.";
        }

        $comments = $commentManager->getAllCommentsByArticleId($id);

        $view = new View($article->getTitle());
        $view->render("detailArticle", ['article' => $article, 'comments' => $comments, 'editionMode' => $editionMode, 'message' => $message ?? null]);
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle(): void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos()
    {
        $view = new View("A propos");
        $view->render("apropos");
    }
}
