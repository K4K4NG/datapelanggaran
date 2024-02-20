    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">DATA PELANGGAR</span> </a>
                <div class="nav_list">
                    <a href="index.php" class="nav_link active"> 
                        <i class='bx bx-grid-alt nav_icon'></i> 
                        <span class="nav_name">Home</span> 
                    </a>
                    <a href="admin.php" class="nav_link">
                        <i class='bx bx-user nav_icon'></i> 
                        <span class="nav_name">Admin</span> 
                    </a> <a href="data.php" class="nav_link"> 
                        <i class='bx bx-message-square-detail nav_icon'></i> 
                        <span class="nav_name">Data siswa</span> 
                    </a> 
                    <a href="peraturan.php" class="nav_link"> 
                        <i class='bx bx-bookmark nav_icon'></i> 
                        <span class="nav_name">Peraturan</span> 
                </div>
                <a href="javascript:void(0);" class="nav_link" id="logout-link">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">Sign Out</span>
                </a>
            </nav>
        </div>
        <div class="logout-confirm">
            <div class="card p-3 shadow">
                <h5>Konfirmasi Logout</h5>
                <p>Anda yakin ingin keluar?</p>
                <button class="btn btn-primary" id="logout-yes">Yes</button>
                <button class="btn btn-secondary" id="logout-no">No</button>
            </div>
        </div>
    <style>
    .logout-confirm {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        padding: 20px;
        box-shadow: 10px 16px 10px #CCC;
        z-index: 9999;
    }

    .logout-confirm button {
        margin: 0 10px;
        margin-top: 10px;
    }
    </style>


<script>
    const logoutLink = document.getElementById("logout-link");
    const logoutConfirm = document.querySelector(".logout-confirm");
    const logoutYes = document.getElementById("logout-yes");
    const logoutNo = document.getElementById("logout-no");

    logoutLink.addEventListener("click", function () {
        logoutConfirm.style.display = "block";
    });

    logoutNo.addEventListener("click", function () {
        logoutConfirm.style.display = "none";
    });
    logoutYes.addEventListener("click", function () {
        window.location.href = "logout.php";
    });
</script>
