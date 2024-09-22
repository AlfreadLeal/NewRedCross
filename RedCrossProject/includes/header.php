<link rel="stylesheet" href="css/header.css">
<nav>
    <div class="logo">
        <div class="img-logo"><img src="img/redcrosslogo.png" alt="" srcset=""></div>
        <div class="logo-text">
            <h1>Red Cross <span class="ph">Philippines</span>

            </h1>
        </div>
    </div>
    <ul id="menuList">
        <li><a href="Home.php">Home</a></li>
        <li><a href="Modules.php">Modules</a></li>
        <li><a href="">Profile</a></li>
        <li><a href="process/logout.php">Logout</a></li>

    </ul>
    <div class="menu-icon">
        <i class="fa-solid fa-bars" onclick="toggleMenu()"></i>
    </div>
</nav>


<script>
    let menuList = document.getElementById("menuList")
    menuList.style.maxHeight = "0px";

    function toggleMenu() {
        if (menuList.style.maxHeight == "0px") {
            menuList.style.maxHeight = "300px";
        } else {
            menuList.style.maxHeight = "0px";
        }
    }
</script>
<script src="https://kit.fontawesome.com/f8e1a90484.js" crossorigin="anonymous"></script>