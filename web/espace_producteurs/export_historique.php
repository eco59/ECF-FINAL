<?php
    // Connexion à la base de données
    require_once '../connexion_bdd/connexion_bdd.php';

    // Démarrer la session
    session_start();


    // Inclure la bibliothèque PhpSpreadsheet
    require '../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // Création d'un nouveau classeur Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // En-têtes de colonne
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Titre du jeu');
    $sheet->setCellValue('C1', 'Ancien Budget');
    $sheet->setCellValue('D1', 'Nouveau Budget');
    $sheet->setCellValue('E1', 'Commentaire');

    // Récupération des données de l'historique avec le titre du jeu
    $requeteHistorique = "SELECT h.id, j.titre AS titre_jeu, h.ancien_budget, h.nouveau_budget, h.commentaire
    FROM modification h
    INNER JOIN jeux_videos j ON h.id_jeux_videos = j.id";
    $resultatHistorique = $bdd->query($requeteHistorique);

    // Remplissage des données dans le classeur Excel
    $row = 2;
    while ($rowHistorique = $resultatHistorique->fetch(PDO::FETCH_ASSOC)) {
        $sheet->setCellValue('A' . $row, $rowHistorique['id']);
        $sheet->setCellValue('B' . $row, $rowHistorique['titre_jeu']);
        $sheet->setCellValue('C' . $row, $rowHistorique['ancien_budget']);
        $sheet->setCellValue('D' . $row, $rowHistorique['nouveau_budget']);
        $sheet->setCellValue('E' . $row, $rowHistorique['commentaire']);
        $row++;
    }

    // Configuration des en-têtes pour télécharger le fichier Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="historique_modifications.xlsx"');
    header('Cache-Control: max-age=0');

    // Envoi du fichier Excel généré au navigateur
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    // Fermeture de la connexion à la base de données
    $bdd = null;

    // Fin du script
    exit;
?>