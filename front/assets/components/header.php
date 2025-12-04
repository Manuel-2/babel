<header class="header">
  <div class="header-left soft-shadow">
    <div>
      <a class="header-logo" href="dashboard.html">
        <img src="./assets/imgs/Logo.svg" alt="">
        <h3 class="h3">babel</h3>
      </a>
    </div>
    <div>
      <ul>
        <li><a class="h4" href="./dashboard.html">Inicio</a></li>
        <li><a class="h4" href="./about.html">Acerca</a></li>
      </ul>
    </div>
    <div class="burger-container">
      <label for="burger-check" class="burger"></label>
      <input type="checkbox" id="burger-check">
      <nav class="burger-nav soft-shadow h4">
        <ul>
          <li><a href="dashboard.html">Inicio</a></li>
          <li><a href="about.html">Acerca</a></li>
          <li><a href="index.html">Cerrar Sesíon</a></li>
          <li><a href="settings.html">Ajustes</a></li>
        </ul>
      </nav>
    </div>
  </div>

  <div class="header-rigth">
    <?php if(isset($_SESSION['autenticated'])){?>
    <button type="button" class="soft-shadow" id="logoutBtn"><img src="./assets/imgs/Logout Icon.svg"alt="logout"></button>
    <?php }?>
    <a href="#" class="soft-shadow h4 button">Ajustes</a>
  </div>

  <script>
    logoutBtn.addEventListener('click', async () => {
      let req = {
        method : "DELETE",
        credentials: 'include',
      };
      let res = await fetch('/api/sessions', req);
      let data = await res.json();

      if(res.status == 200){
        window.location.href = 'index.php';
      }
    });

  </script>
</header>
