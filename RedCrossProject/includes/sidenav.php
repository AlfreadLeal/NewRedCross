<link rel="stylesheet" href="css/sidenav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>


    <div class="nav-container">
        <div class="icon-container">
            <div class="home-bar" onclick="navigateToPage('#home')">
                <div class="homec"><img src="icons/home-icon.png" alt="" srcset=""></div>
                <div class="home-text">
                    <p>Home</p>
                </div>
            </div>
            <div class="module-bar" onclick="navigateToPage('#module')">
                <div class="modulesc"><img src="icons/modules-icon.png" alt="" srcset=""></div>
                <div class="module-text">
                    <p> Modules</p>
                </div>
            </div>
            <div class="profile-bar" onclick="navigateToPage('#profile')">
                <div class="profilec"><img src="icons/profile-icon.png" alt="" srcset=""></div>
                <div class="profile-text">
                    <p>Profile</p>
                </div>
            </div>
            <div class="logout-bar" onclick="navigateToPage('#logout')">
                <div class="logoutc"><img src="icons/logout-icon.png" alt="" srcset=""></div>
                <div class="logout-text">
                    <p>Logout</p>
                    </logout>
                </div>
            </div>
        </div>
        <!-- <div class="locked-module">
            <div class="message-text">
                <h1>
                    <div class="tooltip-container">
                        <i class="fa-solid fa-lock"></i>
                        <div class="tooltip-text">You need to complete all modules first and avail premium
                            modules. </div>
                    </div>
                </h1>
            </div>
        </div> -->



    </div>

    <script>
        function navigateToPage(url) {
            window.location.href = url;
        }
    </script>

</body>