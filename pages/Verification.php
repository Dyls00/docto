<?php

session_start();

if (!isset($_SESSION["connecte"])) {
    $_SESSION["connecte"] = false;
}

include("/wamp64/doctolib/shared/header.php");
include("/wamp64/doctolib/shared/navBar.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css"></link>
    <title>Verification des informations</title>
</head>
<body>
    <div class="basis-[608px] py-40 px-48 dl-rounded-borders">
        <button class="Tappable-inactive dl-button-small-neutral dl-button dl-button-size-medium" type="button" data-design-system="oxygen" data-design-system-component="Button" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); user-select: none; cursor: pointer;"
            onclick="history.back();">
            <span class="dl-button-label">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="dl-icon dl-button-left-icon dl-icon-xsmall" data-icon-name="regular/arrow-left" data-design-system="oxygen" data-design-system-component="Icon">
                    <path d="M7.04 12.36 2.913 8.421A.565.565 0 0 1 2.75 8a.55.55 0 0 1 .164-.398L7.04 3.664c.234-.21.586-.21.797.024a.56.56 0 0 1-.024.796L4.696 7.438h7.97c.327 0 .562.257.562.562a.57.57 0 0 1-.563.563h-7.97l3.117 2.976a.56.56 0 0 1 .024.797.56.56 0 0 1-.797.023Z"></path>
                </svg>Étape précédente
            </span>
        </button>
        <div class="dl-view dl-view-translucid dl-position-relative" data-design-system="base">
            <div class="dl-scrollable px-16 pb-24" data-design-system="base">
                <div class="dl-full-height">
                    <div data-design-system="oxygen" data-design-system-component="Backdrop"></div>
                    <div class="dl-card dl-card-bg-white dl-card-variant-default mt-16" data-design-system="oxygen" data-design-system-component="Card">
                        <div class="dl-card-content">
                            <div class="dl-flex-column dl-flex-center">
                                <div class="dl-text dl-text-body dl-text-regular dl-text-s dl-text-center dl-text-neutral-130" data-design-system="oxygen" data-design-system-component="Text" aria-live="polite"></div>
                                <button class="Tappable-inactive dl-button-tertiary-danger dl-button dl-button-block dl-button-size-medium"
                                    onclick="confirmerEtRediriger()">Confirmer
                                </button>

                                <script>
                                    function confirmerEtRediriger() {
                                        if (confirm("Voulez-vous vraiment confirmer ?")) {
                                            // Si l'utilisateur clique sur OK dans l'alerte, redirigez-le vers la nouvelle URL.
                                            window.location.href = "/pages/search.php";
                                        } else {
                                            // Si l'utilisateur clique sur Annuler, ne faites rien ou effectuez une autre action.
                                            window.location.href="/pages/Verification.php"
                                        }
                                    }
                                </script>
                                <button class="Tappable-inactive dl-button-tertiary-danger dl-button dl-button-block dl-button-size-medium" type="button" data-design-system="oxygen" data-design-system-component="Button" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); user-select: none; cursor: pointer;"
                                    Onclick=window.location.href="/pages/search.php" class="dl-button-label">Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>