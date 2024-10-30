
<?php 
session_start();

if (isset($_SESSION["verificador"])) {
include "cabecalho_admin.php";
include "sidebar_admin.php"; 
?>


  <body class="b_dashboard">
    
  <div class="dashboard">
      <div class="card">
         <!-- <img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->  
        <h2>Refunds</h2>
        <h3>This month</h3>
        <var>
          6k
          <abbr>USD</abbr>
        </var>
      </div>
      <div class="card ">
         <!--<img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->   
        <h2>Sales</h2>
        <h3>This month</h3>
        <var>
          50k
          <abbr>USD</abbr>
        </var>
      </div>
      <div class="card">
        <!--<img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->      
        <h2>Profit</h2>
        <h3>This month</h3>
        <var>
          11k
          <abbr>USD</abbr>
        </var>
      </div>
      <div class="card">
        <h2>Progress</h2>
        <div class="card-progress">
          <progress value="50" max="100"></progress>
          <var>
            16k
            <abbr>TASKS</abbr>
          </var>
        </div>
      </div>
      <div class="card">
        <h2>Products</h2>
        <div class="card-icon">
          <img src="../../../estilizacao/images/svg/cog.svg" />
          <div>
            <h3>Total</h3>
            <var> 41k </var>
          </div>
        <!--<img src="../../../estilizacao/images/svg/chevron.svg" /> -->      
        </div>
      </div>
      <div class="card">
        <h2>Reviews</h2>
        <div class="card-icon">
          <img src="../../../estilizacao/images/svg/heart.svg" />
          <div>
            <h3>Rating</h3>
            <var> 71% </var>
          </div>
        <!--<img src="../../../estilizacao/images/svg/chevron.svg" />  -->  
        </div>
      </div>
    </div>

    </body>

<?php 
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php"; 
?>