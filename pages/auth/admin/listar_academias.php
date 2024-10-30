<?php
session_start();

if (isset($_SESSION["verificador"])) {
  include "cabecalho_admin.php";
  include "sidebar_admin.php";
?>


  <div class="main-content-lista">
    <div class="list-container">
      <h2>Lista de Academias Cadastradas</h2>
      <table class="academia-table">
        <thead>
          <tr>
            <th>Nome da Academia</th>
            <th>Endereço</th>
            <th>Capacidade Máxima</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-label="Nome da Academia">Academia X</td>
            <td data-label="Endereço">Rua A, 123</td>
            <td data-label="Capacidade Máxima">50</td>
            <td data-label="Status">Ativa</td>
          </tr>
          <tr>
            <td data-label="Nome da Academia">Academia Y</td>
            <td data-label="Endereço">Rua B, 456</td>
            <td data-label="Capacidade Máxima">100</td>
            <td data-label="Status">Inativa</td>
          </tr>


          <?php
          /*
                require_once "../../../config/Dao.php";

                $query = "SELECT razao_social, endereco_id, capacidade_max, status_academia, descricao FROM academia";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . ($row['razao_social']) . "</td>";
                        echo "<td>" . ($row['endereco_id']) . "</td>";
                        echo "<td>" . ($row['capacidade_max']) . "</td>";
                        echo "<td>" . ($row['status_academia']) . "</td>";
                        echo "<td>" . ($row['descricao']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma academia cadastrada.</td></tr>";
                }
                $conn->close(); 
                */
          ?>

        </tbody>
      </table>
    </div>
  </div>

<?php
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php";
?>