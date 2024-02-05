<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    
    require '../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // Sélectionnez les colonnes de la table que vous souhaitez exporter
    $query = "SELECT titre, budget, date_mise_a_jour FROM jeux_videos";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    // Créer le fichier Excel
    $filename = 'budget.xlsx';

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Écrire les noms de colonnes dans le fichier
    $columns = array("Titre", "Budget", "date_mise_a_jour");
    $columnIndex = 1;
    foreach ($columns as $col) {
        $sheet->setCellValueByColumnAndRow($columnIndex, 1, $col);
        $columnIndex++;
    }

    // Écrire les données dans le fichier
    $rowIndex = 2;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $columnIndex = 1;
        foreach ($row as $value) {
            $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $value);
            $columnIndex++;
        }
        $rowIndex++;
    }

    // Enregistrez le fichier Excel dans le dossier de téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    // Fermer la connexion à la base de données
    $conn = null;

    // Terminer le script
    exit;
?>
