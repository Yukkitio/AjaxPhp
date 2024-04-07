<!DOCTYPE html>
<html>

    <head>
        <title>Exemple MVC</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>


    <body>
        <div class="container">
            <h2>Utilisateurs</h2>
            <table id="tableUtilisateurs" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Date d'inscription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($utilisateur['name']); ?></td>
                            <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                            <td><?php echo htmlspecialchars($utilisateur['registration_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="container mt-1">
            <h2>Nombre d'inscriptions par mois</h2>
            <canvas id="inscriptionsChart"></canvas>
        </div>
        <script>
        $(document).ready(function() {
            $('#tableUtilisateurs').DataTable();
        });

        // Conversion des données PHP en JSON pour JavaScript
        var inscriptionsParMois = <?php echo json_encode($inscriptionsParMois); ?>;

        var ctx = document.getElementById('inscriptionsChart').getContext('2d');
        var inscriptionsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: inscriptionsParMois.map(data => convNumToMonthName(data.mois)),
                datasets: [{
                    label: 'Inscriptions par mois',
                    data: inscriptionsParMois.map(data => data.total),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function convNumToMonthName(mois) {
            const nomsDesMois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            return nomsDesMois[mois - 1];
        }
        </script>

    </body>

</html>
