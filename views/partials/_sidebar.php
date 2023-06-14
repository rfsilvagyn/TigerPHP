<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="<?php echo BASE_URL.$_SESSION['ffUsuario']; ?>" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo $_SESSION['nnUsuario']; ?></span>
          <span class="text-secondary text-small">Cargo</span>
        </div>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo BASE_URL ?>">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <!-- Inicio Menu Cadastro -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#cadastros" aria-expanded="false" aria-controls="cadastros">
        <span class="menu-title">Cadastros</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-crosshairs-gps menu-icon"></i>
      </a>
      <div class="collapse" id="cadastros">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>usuarios">Usuários</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>permissoes">Permissões</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>clientes">Clientes</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>fornecedores">Fornecedores</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>planos">Planos</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>produtos">Produtos</a></li>
        </ul>
      </div>
    </li>
    <!-- Fim Menu Cadastro -->

    <!-- Inicio Menu Financeiro -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#financeiro" aria-expanded="false" aria-controls="financeiro">
        <span class="menu-title">Financeiro</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-bank menu-icon"></i>
      </a>
      <div class="collapse" id="financeiro">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>pagar">Contas a Pagar</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>receber/filtroremessa">Remessa Bancária</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>">Retorno Bancária</a></li>
        </ul>
      </div>
    </li>
    <!-- Fim Menu Financeiro -->

    <!-- Inicio Menu Estoque -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#estoque" aria-expanded="false" aria-controls="estoque">
        <span class="menu-title">Estoque</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-stocking menu-icon"></i>
      </a>
      <div class="collapse" id="estoque">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>estoque">Movimentação de Estoque</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>estoque/entrada">Entrada de Material</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL;?>estoque/saida">Saida de Material</a></li>
        </ul>
      </div>
    </li>
    <!-- Fim Menu Estoque -->

    <li class="nav-item">
      <a class="nav-link" href="<?php echo BASE_URL;?>clientes/ficha">
        <span class="menu-title">Vendas</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link" href="<?php echo BASE_URL;?>comprovantes">
        <span class="menu-title">Comprovantes</span>
        <i class="mdi mdi-cash-usd menu-icon"></i>
      </a>
    </li>

  </ul>
</nav>
