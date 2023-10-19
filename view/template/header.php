<header>
    <a href="home.php">
        <img src="../public/img/icon.png" alt="icon">
        Dislexia App
    </a>
    <nav>
        <ul>
            <li>
                <i class="fa-regular fa-envelope"></i>
                Contacto
                <span></span>
            </li>
            <li>
                <i class="fa-solid fa-circle-question"></i>
                Ayuda
                <span></span>
            </li>
            <li id="sub-menu">
                <?php echo $_SESSION["user_name"];?>
                <i class="fa-solid fa-chevron-down"></i>
                <span></span>
            </li>
        </ul>
        <div class="dropdown" id="dropdown">
            <ul>
                <a href="home.php">
                    <li>
                    <i class="fa-solid fa-house"></i>
                        Inicio
                        <span></span>
                    </li>
                </a>
                <a href="groups.php">
                    <li>
                    <i class="fa-solid fa-group-arrows-rotate"></i>
                        Grupos
                        <span></span>
                    </li>
                </a>
                <a href="newStudent.php">
                    <li>
                    <i class="fa-solid fa-circle-plus"></i>
                        Nuevo alumno
                        <span></span>
                    </li>
                </a>
                <a href="newGroup.php">
                    <li>
                    <i class="fa-solid fa-circle-plus"></i>
                        Nuevo grupo
                        <span></span>
                    </li>
                </a>
                <li id="logout">
                    <i class="fa-solid fa-person-walking-arrow-right fa-flip-horizontal"></i>
                    Salir
                    <span></span>
                </li>
            </ul>
        </div>
    </nav>
    <div class="colchon" id="colchon">
        <i class="fa-solid fa-bars" id="colchon-icon"></i>
    </div>
</header>