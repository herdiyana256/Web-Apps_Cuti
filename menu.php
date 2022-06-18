			<?php
				if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
					$username = $_SESSION['username'];
					
					include("Config/config.php");
					$result = mysql_query("SELECT `nama`, `status`, `NIK` FROM `dekanat` WHERE `username` = '$username'");
					$result2 = mysql_query("SELECT `nama`, `status`, `NIK` FROM `dosen_pegawai` WHERE `username` = '$username'");
					$result3 = mysql_query("SELECT `nama`, `status`, `id_admin_tatausaha` FROM `admin_tatausaha` WHERE `username` = '$username'");
					$row = mysql_fetch_array($result);
					$row2 = mysql_fetch_array($result2);
					$row3 = mysql_fetch_array($result3);
					
					if ($row["status"] == "dekan") {
			?>
						<li><strong><a id = "padding" href="pengesahan.php">Pengesahan</a></strong></li>
			<?php
					}
					elseif ($row2["status"] == "1" || $row2["status"] == "2" || $row2["status"] == "3") {
			?>
						<li><strong><a id = "padding" href="cuti.php">Cuti</a></strong></li>
			<?php
					}
					elseif ($row3["status"] == "admin") {
			?>
						<li><strong><a id = "padding" href="kelola_data.php">Data</a></strong></li>
						<li><strong><a id = "padding" href="arsip_cuti.php">Arsip</a></strong></li>
			<?php
					}
				}
			?>
			
            <!--<li><strong><a id = "padding" href="#">Forum </a></strong></li>-->
            <li><strong><a id = "padding" href="about.php">About</a></strong></li>
            <li><strong><a id = "padding" href="help.php">Help</a></strong></li>
			
			<?php
				if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
			?>
					<li><strong><a id = "padding" href="Config/logout.php">Logout</a></strong></li>
			<?php
				}
			?>