<?php
putenv("TZ=Asia/Tokyo");
error_reporting(0);
ini_set('display_errors', 0);
set_time_limit(300);
ini_set('memory_limit', '1024M');
?>
<head>
<title>Backdoor Scanner Refixed By Dzone</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features)
}

function checkAllFunctions() {
    var checkboxes = document.getElementsByName('functions[]');
    var selectAll = document.getElementById('select_all').checked;
    
    for(var i=0; i<checkboxes.length; i++) {
        checkboxes[i].checked = selectAll;
    }
}

function filterTable() {

    var filterType = document.getElementById('type_filter').value.toLowerCase().trim();
    var filterOwner = document.getElementById('owner_filter').value.toLowerCase().trim();

    var rows = document.getElementById('result_table').getElementsByTagName('tr');
    var visibleCount = 0;

    for(var i=1; i<rows.length-1; i++) {

        var cols = rows[i].getElementsByTagName('td');
        if(cols.length < 7) continue;

        var typeText = cols[1].innerText.toLowerCase().replace(/\s+/g,' ').trim();
        var ownerText = cols[4].innerText.toLowerCase().replace(/\s+/g,' ').trim();

        var typeMatch = (filterType === "all") || typeText.includes(filterType);
        var ownerMatch = (filterOwner === "all") || ownerText.includes(filterOwner);

        if(typeMatch && ownerMatch){
            rows[i].style.display="";
            visibleCount++;
        }else{
            rows[i].style.display="none";
        }
    }

    updateTableCounts(visibleCount);
}

function updateTableCounts(visibleCount) {
    var rows = document.getElementById('result_table').getElementsByTagName('tr');
    if(rows.length < 2) return;
    
    var totalRow = rows[rows.length-1];
    if(!totalRow) return;
    
    var totalFiles = rows.length - 3; // Kurangi 2 baris header + 1 baris footer
    
    if(totalRow.cells && totalRow.cells[0] && totalRow.cells[0].colSpan == 7) {
        totalRow.cells[0].innerHTML = '<center><b>Total files scanned: ' + totalFiles + 
                                       ' | Suspicious files found: ' + visibleCount + 
                                       ' | Hidden: ' + (totalFiles - visibleCount) + '</b></center>';
    }
}

function resetFilters() {
    document.getElementById('type_filter').value = 'all';
    document.getElementById('owner_filter').value = 'all';
    filterTable();
}

// Fungsi untuk menghapus baris dari tabel berdasarkan file path
function removeFileRow(filePath) {
    var rows = document.getElementById('result_table').getElementsByTagName('tr');
    
    for(var i=2; i<rows.length; i++) {
        var linkCell = rows[i].getElementsByTagName('td')[2];
        if(linkCell) {
            var link = linkCell.getElementsByTagName('a')[0];
            if(link && link.href.indexOf(encodeURIComponent(filePath)) !== -1) {
                rows[i].parentNode.removeChild(rows[i]);
                break;
            }
        }
    }
    
    // Hitung ulang setelah menghapus
    var visibleCount = 0;
    for(var i=2; i<rows.length-1; i++) {
        if(rows[i].style.display !== 'none') {
            visibleCount++;
        }
    }
    updateTableCounts(visibleCount);
}
//-->
</script>
<style type="text/css">
<!--
body {
  font-family: Arial, sans-serif;
  background-color: #222;
  color: #fff;
  margin: 0;
  padding: 20px;
}

.container {
  max-width: 800px;
  margin: 50px auto;
  padding: 20px;
  background-color: #333;
  border-radius: 8px;
}

.title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 8px;
}

.button:hover {
  background-color: #45a049;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.table th {
  background-color: #4CAF50;
  color: white;
}

.table tr:nth-child(even) {
  background-color: #f2f2f2;
}

.table tr:hover {
  background-color: #ddd;
}

.single{
   border: 1px solid #37517e;
   padding: 5px;
}
a:visited {
   color: #33333;
   font-size: 11px;
   font-family: tahoma;
   text-decoration: none;
}
   
a:hover {
   color: #ccff00;
   text-decoration: none;
   }
.abunai {
   color: red;
   text-decoration: none;
   }
.xxx {
   color: blue;
   text-decoration: none;
   }
a { 
   color: #47b2e4;
   font-size: 11px;
   font-family: tahoma;
   text-decoration: none;
}  
td {
   border-style: solid;
   border-width: 0 0 1px 0;
   font-size:11px; font-family:Tahoma,Verdana,Arial; color:#47b2e4; 
}
.me  {
   font-size:11px; font-family:Tahoma,Verdana,Arial; color:#47b2e4; 
   border: 0px;
   padding: 5px;
}
.isi:disabled{
   padding: 2px;
   border:1px solid #333333;
   font-family: Tahoma;
   color: #333333;
   background-color: #000000;
   font-size: 10px;
   font-weight: bold;
}
.isi{
   padding: 2px;
   border:1px solid #666666;
   font-family: Tahoma;
   color: #47b2e4;
   background-color: #666666;
   font-size: 10px;
   font-weight: bold;
}
.permission {
   font-family: monospace;
   font-size: 11px;
}
.permission-merah {
   color: #ff6b6b;
}
.permission-hijau {
   color: #6bff6b;
}
.filter-box {
   margin: 10px 0;
   padding: 15px;
   background-color: #333;
   border-radius: 5px;
   color: #47b2e4;
   text-align: left;
}
.filter-item {
   display: inline-block;
   margin-right: 20px;
}
.filter-item select {
   margin-left: 10px;
   padding: 5px;
   background-color: #444;
   color: #fff;
   border: 1px solid #47b2e4;
   border-radius: 3px;
}
.filter-item button {
   padding: 5px 15px;
   background-color: #47b2e4;
   color: #222;
   border: none;
   border-radius: 3px;
   cursor: pointer;
   font-weight: bold;
}
.filter-item button:hover {
   background-color: #5bc0de;
}

/* Perbaikan untuk header tabel */
#result_table tr:first-child td {
   text-align: center !important;
   vertical-align: middle !important;
   font-weight: bold;
   background-color: #4CAF50;
   color: white;
}

/* Untuk konten di dalam sel */
td {
   vertical-align: middle;
}

.scan-info {
   text-align: center;
   margin: 20px auto;
   padding: 15px;
   background-color: #333;
   border-radius: 8px;
   max-width: 95%;
   color: #47b2e4;
   font-size: 14px;
   border: 1px solid #47b2e4;
}

.file-list {
   max-height: 200px;
   overflow-y: auto;
   background: #000;
   padding: 10px;
   margin-top: 10px;
}

.warning-box {
   background: #332200;
   padding: 15px;
   margin: 15px auto;
   color: #ffaa00;
   border: 1px solid #ffaa00;
   border-radius: 5px;
   font-family: monospace;
   max-width: 95%;
   text-align: left;
}
-->
</style>
<style type="text/css">
#patch {position:absolute; height:1; width:1px; top:0; left:0;}
</style>
</head>
<body>
<center><br><font color="#37517e" size="14" face="arial">Backdoor Scanner</font></center><br>
<?php
// Fungsi untuk mendapatkan permission
function getFilePermissions($file) {
    if(!file_exists($file)) return 'N/A';
    
    $perms = fileperms($file);
    
    if (($perms & 0xC000) == 0xC000) $info = 's';
    elseif (($perms & 0xA000) == 0xA000) $info = 'l';
    elseif (($perms & 0x8000) == 0x8000) $info = '-';
    elseif (($perms & 0x6000) == 0x6000) $info = 'b';
    elseif (($perms & 0x4000) == 0x4000) $info = 'd';
    elseif (($perms & 0x2000) == 0x2000) $info = 'c';
    elseif (($perms & 0x1000) == 0x1000) $info = 'p';
    else $info = 'u';
    
    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));
    
    // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));
    
    // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));
    
    return $info;
}

// Fungsi untuk klasifikasi permission
function getPermissionClass($perms) {
    // HIJAU untuk permission normal
    if($perms == '0644' || $perms == '644' || 
       $perms == '0755' || $perms == '755' ||
       $perms == '0640' || $perms == '640' ||
       $perms == '0600' || $perms == '600' ||
       $perms == '0664' || $perms == '664' ||
       $perms == '0775' || $perms == '775') {
        return 'permission-hijau';
    }
    
    // MERAH jika: 777 (terlalu terbuka) atau 444/000 (read-only/tidak bisa diedit)
    if(strpos($perms, '777') !== false || substr($perms, -3) == '777') {
        return 'permission-merah';
    } elseif(substr($perms, -3) == '444' || substr($perms, -3) == '000' || substr($perms, -3) == '400') {
        return 'permission-merah';
    } elseif(substr($perms, -2, 1) == '0' || substr($perms, -2, 1) == '4') {
        $owner_write = substr($perms, -2, 1);
        if($owner_write == '0' || $owner_write == '4') {
            return 'permission-merah';
        }
    }
    
    return 'permission-hijau'; // Default hijau
}

// Fungsi untuk mendapatkan owner
function getFileOwner($file) {
    if(!file_exists($file)) return 'N/A';
    
    $owner = fileowner($file);
    $group = filegroup($file);
    
    if(function_exists('posix_getpwuid')) {
        $owner_name = posix_getpwuid($owner);
        $owner = $owner_name['name'] ?? $owner;
    }
    
    if(function_exists('posix_getgrgid')) {
        $group_name = posix_getgrgid($group);
        $group = $group_name['name'] ?? $group;
    }
    
    return $owner . ':' . $group;
}

// Fungsi scan file - VERSI DIPERBAIKI DENGAN HANDLE FILE BESAR
function scanFiles($dir, $recursive = true, $ext_filter = 'php') {
    $files = array();
    
    if(!is_dir($dir)) return $files;
    
    if($dh = @opendir($dir)) {
        while(($file = readdir($dh)) !== false) {
            if($file == "." || $file == "..") continue;
            
            $fullpath = $dir . "/" . $file;
            
            // CEK FILE DAHULU sebelum cek directory
            if(is_file($fullpath)) {
                // Filter berdasarkan ekstensi
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                
                if($ext_filter == 'all') {
                    $files[] = $fullpath;
                } elseif($ext_filter == 'php' && ($ext == 'php' || $ext == 'php3' || $ext == 'php4' || $ext == 'php5' || $ext == 'phtml')) {
                    $files[] = $fullpath;
                } elseif($ext_filter == 'js' && $ext == 'js') {
                    $files[] = $fullpath;
                } elseif($ext_filter == 'html' && ($ext == 'html' || $ext == 'htm')) {
                    $files[] = $fullpath;
                } elseif($ext_filter == 'txt' && $ext == 'txt') {
                    $files[] = $fullpath;
                }
            }
            
            // CEK DIRECTORY untuk rekursif
            if(is_dir($fullpath) && $recursive) {
                $sub_files = scanFiles($fullpath, $recursive, $ext_filter);
                $files = array_merge($files, $sub_files);
            }
        }
        @closedir($dh);
    }
    
    return $files;
}

// Fungsi untuk mengumpulkan unique owner dari hasil scan
function getUniqueOwners($fileList, $selected_functions, $custom_keyword) {
    $owners = array();
    
    if(is_array($fileList) && count($fileList) > 0) {
        foreach($fileList as $file) {
            // Cek apakah file masih ada
            if(!file_exists($file)) continue;
            
            // Skip file besar untuk efisiensi
            if(@filesize($file) > 5 * 1024 * 1024) continue;
            
            $ops = @file_get_contents($file);
            if($ops !== false) {
                $op = strtolower($ops);
                $sis = 0;
                
                // Check for known backdoors
                $arr = array('c99_buff_prepare', 'abcr57');
                foreach($arr as $key) {
                    if(@preg_match("/" . preg_quote($key, '/') . "/", $op)) {
                        $sis = 1;
                    }
                }
                
                // Check for hidden shell
                if($sis != 1) {
                    if(@preg_match("/system\((.*?)\)/", $op) && @preg_match("/<pre>/", $op) && @preg_match("/empty\((.*?)\)/", $op)) {
                        $sis = 1;
                    }
                }
                
                // Check for user selected functions
                if($sis == 0 && !empty($selected_functions)) {
                    foreach($selected_functions as $bugs) {
                        if(!empty($bugs) && @preg_match("/" . preg_quote($bugs, '/') . "\((.*?)\)/", $op)) {
                            $sis = 1;
                        }
                    }
                }
                
                // Check for custom text
                if($sis == 0 && !empty($custom_keyword)) {
                    if(@preg_match("/" . preg_quote($custom_keyword, '/') . "/", $op)) {
                        $sis = 1;
                    }
                }
                
                if($sis == 1) {
                    $owner = getFileOwner($file);
                    if(!in_array($owner, $owners)) {
                        $owners[] = $owner;
                    }
                }
            }
        }
    }
    
    sort($owners);
    return $owners;
}

// Main logic
if(isset($_REQUEST['edit']) && $_REQUEST['edit'] == 'file') {
    // Edit file section
    if(isset($_POST['yes'])) {
        $filename = isset($_GET['file']) ? $_GET['file'] : '';
        if(!empty($filename)) {
            @unlink($filename);
            echo "<html><body><script>
                if(window.opener && !window.opener.closed) {
                    window.opener.removeFileRow('".addslashes($filename)."');
                }
                window.close();
            </script></body></html>";
            exit;
        }
    } else {
        $stat = "";
        if(isset($_POST['update']) && $_POST['update'] == " S a v e ") {
            $filename = isset($_POST['file']) ? $_POST['file'] : '';
            if(!empty($filename) && is_writable($filename)) {
                $handle = @fopen($filename, "w+");
                if($handle) {
                    $isi = isset($_POST['content']) ? $_POST['content'] : '';
                    @fwrite($handle, stripslashes($isi));
                    @fclose($handle);
                    $stat = "<center><strong>edited successfully<br>";
                } else {
                    $stat = "<center><font color=red><strong>Error! Cannot open file.</font></center>";
                }
            } else {
                $stat = "<center><font color=red><strong>Error! File may not be writable.</font></center>";
            }
        }
        
        if(isset($_POST['close']) && $_POST['close'] == " C l o s e ") {
            echo "<script>window.close();</script>";
            exit;
        }
        
        $filename = isset($_GET['file']) ? $_GET['file'] : '';
        if(!empty($filename) && file_exists($filename)) {
            $vuln = isset($_GET['bug']) ? $_GET['bug'] : '';
            $handle = @fopen($filename, "r");
            if($handle) {
                $contents = @fread($handle, filesize($filename));
                ?>
                <center>
                <table>
                    <tr><td align="left" class="me"><strong><?php echo htmlspecialchars($filename); ?>&nbsp;&nbsp;>> Contains :&nbsp;<?php echo htmlspecialchars($vuln); ?></strong></td></tr>
                    <tr><td class="me">
                        <form method="post" action="">
                        <input type="hidden" name="file" value="<?php echo htmlspecialchars($filename); ?>">
                        <textarea name="content" cols="80" rows="15"><?php echo htmlspecialchars($contents); ?></textarea><br>
                    </td></tr>
                    <tr><td align="center" class="me">
                    <?php
                    if(isset($_POST['delete']) && $_POST['delete'] == " D e l e t e ") {
                        echo "Are you sure to delete ".htmlspecialchars($filename)." ?";
                        ?>
                        </td></tr>
                        <tr><td align="center" class="me">
                            <input type="submit" name="yes" value=" Y E S ">
                            <input type="submit" name="no" value=" N O ">
                        </td></tr>
                        <?php
                    } else {
                        echo $stat;
                        ?>
                        </td></tr>
                        <tr><td align="right" class="me">
                            <input type="submit" name="close" value=" C l o s e ">
                            <input type="submit" name="delete" value=" D e l e t e ">
                            <input type="submit" name="update" value=" S a v e ">
                        </td></tr>
                        <?php
                    }
                    @fclose($handle);
                    ?>
                </table>
                </form>
                <?php
            }
        } else {
            echo "<br><br><br><font color=red size=3><b><center>".htmlspecialchars($filename)." not exist...</b></font><br><br><br><br><br><br><br>";
            echo "<script>setTimeout(function() { window.close(); }, 2000);</script>";
            exit;
        }
    }
} elseif(isset($_POST['Submit']) && $_POST['Submit'] == " S T A R T  S C A N " || isset($_GET['refresh'])) {
    // Scan section
    $selected_functions = isset($_POST['functions']) ? $_POST['functions'] : array();
    $custom_keyword = isset($_POST['textV']) ? $_POST['textV'] : '';
    
    // Ambil parameter
    $target = isset($_POST['scan_dir']) ? $_POST['scan_dir'] : $_SERVER['DOCUMENT_ROOT'];
    $recursive = isset($_POST['recursive']) ? true : false;
    $ext_filter = isset($_POST['ext_filter']) ? $_POST['ext_filter'] : 'php';
    
    // Tampilkan informasi scan dengan DIV
    ?>
    <div class="scan-info">
        <b>Scanning: <?php echo htmlspecialchars($target); ?></b><br>
        Recursive: <?php echo ($recursive ? "Yes (termasuk subfolder)" : "No (hanya folder ini)"); ?> | 
        Extension: <?php echo strtoupper($ext_filter); ?>
    </div>
    <?php
    
    // Scan file
    $fileList = scanFiles($target, $recursive, $ext_filter);
    
    // HITUNG STATISTIK FILE (untuk internal, tidak ditampilkan)
    $total_files = count($fileList);
    $large_files = 0;
    $skipped_large = 0;
    
    foreach($fileList as $f) {
        if(@filesize($f) > 5 * 1024 * 1024) {
            $large_files++;
        }
    }
    
    // Hitung unique owners
    $unique_owners = getUniqueOwners($fileList, $selected_functions, $custom_keyword);
    
    // KUMPULKAN SEMUA TYPE YANG AKAN MUNCUL DI FILTER
    $unique_types = array();
    if(!empty($selected_functions)) {
        foreach($selected_functions as $func) {
            $unique_types[] = $func;
        }
    }
    if(!empty($custom_keyword)) {
        $unique_types[] = $custom_keyword;
    }
    // Type default selalu ada
    $default_types = array('c 9 9', 'r 5 7', 'hidden shell');
    $unique_types = array_merge($default_types, $unique_types);
    $unique_types = array_unique($unique_types);
    sort($unique_types);
    ?>
    
    <div class="filter-box">
        <div class="filter-item">
            <b>Filter Type:</b>
            <select id="type_filter" onchange="filterTable()">
                <option value="all">Semua Type</option>
                <?php 
                foreach($unique_types as $type) {
                    echo "<option value=\"$type\">$type</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="filter-item">
            <b>Filter Owner:</b>
            <select id="owner_filter" onchange="filterTable()">
                <option value="all">Semua Owner</option>
                <?php 
                if(!empty($unique_owners)) {
                    foreach($unique_owners as $owner) {
                        echo "<option value=\"$owner\">$owner</option>";
                    }
                }
                ?>
            </select>
        </div>
        
        <div class="filter-item">
            <button onclick="resetFilters()">Reset Filter</button>
        </div>
    </div>
    
    <table border="0" width="95%" cellpadding="5" id="result_table">
        <tr>
            <td align="center" width="30"><b>No</b></td>
            <td align="center" width="80"><b> T y p e </b></td>
            <td align="center"><b> F i l e &nbsp;&nbsp; L o c a t i o n </b></td>
            <td align="center" width="100"><b>Permission</b></td>
            <td align="center" width="120"><b>Owner:Group</b></td>
            <td align="center" width="120"><b> L a s t &nbsp;&nbsp; E d i t </b></td>
            <td align="center" width="60"><b>S i z e</b></td>
        </tr>

    <?php
    
    $i = 0;
    $file_count = 0;
    $max_file_size = 5 * 1024 * 1024; // 5MB limit
    
    if(is_array($fileList) && count($fileList) > 0) {
        foreach($fileList as $file) {
            $file_count++;
            
            // Skip file ini sendiri
            if($file == $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']) {
                continue;
            }
            
            if(!file_exists($file)) {
                continue;
            }
            
            if(connection_aborted()) break;
            
            // CEK UKURAN FILE - LEWATKAN YANG TERLALU BESAR
            $size = @filesize($file);
            if($size > $max_file_size) {
                $skipped_large++;
                continue;
            }
            
            // CEK ISI FILE DENGAN MEMORY EFFICIENT
            $handle = @fopen($file, 'r');
            if($handle) {
                // Baca 100KB pertama saja untuk efisiensi
                $ops = @fread($handle, 100 * 1024);
                @fclose($handle);
            } else {
                continue;
            }
            
            if($ops !== false) {
                $op = strtolower($ops);
                
                // CEK APAKAH MENCURIGAKAN
                $is_suspicious = false;
                $type = '';
                
                // Cek backdoor umum
                if(strpos($op, 'c99_buff_prepare') !== false) {
                    $is_suspicious = true;
                    $type = 'c 9 9';
                } elseif(strpos($op, 'abcr57') !== false) {
                    $is_suspicious = true;
                    $type = 'r 5 7';
                }
                // Cek hidden shell
                elseif(strpos($op, 'system') !== false && strpos($op, '<pre>') !== false) {
                    $is_suspicious = true;
                    $type = 'hidden shell';
                }
                // Cek fungsi yang dipilih user
                elseif(!empty($selected_functions)) {
                    foreach($selected_functions as $func) {
                        if(strpos($op, $func . '(') !== false) {
                            $is_suspicious = true;
                            $type = $func;
                            break;
                        }
                    }
                }
                // Cek custom keyword
                elseif(!empty($custom_keyword) && strpos($op, strtolower($custom_keyword)) !== false) {
                    $is_suspicious = true;
                    $type = $custom_keyword;
                }
                
                if($is_suspicious) {
                    $i++;
                    $last_modified = @filemtime($file);
                    $last = $last_modified ? date("M-d-Y H:i", $last_modified) : "Unknown";
                    $perms = getFilePermissions($file);
                    $perms_numeric = substr(sprintf('%o', fileperms($file)), -4);
                    $owner = getFileOwner($file);
                    $perm_class = getPermissionClass($perms_numeric);
                    
                    // Tentukan warna berdasarkan tipe
                    $color = '#47b2e4';
                    if($type == 'c 9 9' || $type == 'r 5 7') {
                        $color = 'red';
                    } elseif($type == 'hidden shell') {
                        $color = 'blue';
                    }
                    ?>
                    <tr style="background-color: transparent;" onmouseover="this.style.backgroundColor='#444444'" onmouseout="this.style.backgroundColor='transparent'">
                        <td align="center"><font color="<?php echo $color; ?>"><?php echo $i; ?></font></td>
                        <td align="center"><font color="<?php echo $color; ?>"><?php echo htmlspecialchars($type); ?></font></td>
                        <td align="left">
                            <a href="#" style="color: <?php echo $color; ?>;" onclick="MM_openBrWindow('?edit=file&file=<?php echo urlencode($file); ?>&bug=<?php echo urlencode($type); ?>','File view','status=yes,scrollbars=yes,width=700,height=600')"><?php echo htmlspecialchars($file); ?></a>
                        </td>
                        <td align="center"><span class="permission <?php echo $perm_class; ?>"><?php echo $perms; ?><br><?php echo $perms_numeric; ?></span></td>
                        <td align="center"><font color="<?php echo $color; ?>"><?php echo htmlspecialchars($owner); ?></font></td>
                        <td align="center"><font color="<?php echo $color; ?>"><?php echo $last; ?> GMT+9</font></td>
                        <td align="center"><font color="<?php echo $color; ?>"><?php echo $size; ?> byte</font></td>
                    </tr>
                    <?php
                }
            }
            
            // Flush output setiap 100 file
            if($file_count % 100 == 0) {
                ob_flush();
                flush();
            }
        }
    }
    
    // Tampilkan pesan jika tidak ada file
    $scanned_files = $file_count - $skipped_large;
    if($i == 0) {
        echo "<tr><td colspan='7' align='center' style='padding: 30px; color: #ffaa00;'><b>📭 TIDAK DITEMUKAN FILE MENCURIGAKAN</b><br><br>";
        echo "Total file di-scan: <b>" . number_format($scanned_files) . "</b> file<br>";
        if($skipped_large > 0) {
            echo "File >5MB yang dilewati: <b>" . number_format($skipped_large) . "</b> file (untuk mencegah memory exhaustion)<br>";
        }
        if($scanned_files == 0) {
            echo "<br><span style='color: #ff6b6b;'>⚠️ TIDAK ADA FILE YANG DI-SCAN!</span><br>";
            echo "Kemungkinan penyebab:<br>";
            echo "- Semua file berukuran >5MB<br>";
            echo "- Filter ekstensi terlalu ketat<br>";
            echo "- Tidak ada file dengan ekstensi yang dipilih";
        }
        echo "</td></tr>";
    }
    
    echo "<tr><td colspan='7' align='center' class='me'><b>Total files scanned: " . number_format($scanned_files) . " | Suspicious files found: $i | Skipped (large files): " . number_format($skipped_large) . "</b></td></tr>";
    ?>
    </table>
    
    <br>
    <form method="post" action="">
        <input type="submit" value=" « Back to Scanner " class="button">
    </form>
    <?php
} else {
    // Default form
    $functions_list = array('base64_decode', 'system', 'passthru', 'popen', 'exec', 'shell_exec', 'eval', 'move_uploaded_file');
    ?>
    <form id="fCheck" name="fCheck" method="post" action="" autocomplete="off">
    <center>
    <table class="single" width="650" border="1" cellpadding="15">
        <tr><td class="me">
            <center><b style="font-size:16px;">🔍 BACKDOOR SCANNER</b></center>
            <br>
            
            <table width="100%" cellpadding="5">
                <tr>
                    <td width="150"><b>Directory to scan:</b></td>
                    <td>
                        <input type="text" name="scan_dir" value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>" size="60" style="padding:5px; width:100%;">
                        <br><small>Contoh: /var/www/html/wordpress/ atau /home/user/public_html/</small>
                    </td>
                </tr>
                
                <tr>
                    <td><b>Scan Options:</b></td>
                    <td>
                        <input type="checkbox" name="recursive" id="recursive" checked> 
                        <label for="recursive">Recursive (scan termasuk semua subfolder)</label>
                        <br><small>Jika tidak dicentang, hanya scan folder ini saja (tanpa subfolder)</small>
                    </td>
                </tr>
                
                <tr>
                    <td><b>File Extension:</b></td>
                    <td>
                        <select name="ext_filter" style="padding:5px; width:200px;">
                            <option value="php" selected>.php (PHP files)</option>
                            <option value="js">.js (JavaScript files)</option>
                            <option value="html">.html/.htm (HTML files)</option>
                            <option value="txt">.txt (Text files)</option>
                            <option value="all">All files (semua ekstensi)</option>
                        </select>
                        <br><small>Pilih jenis file yang ingin di-scan</small>
                    </td>
                </tr>
            </table>
            
            <br>
            <b>Functions to scan:</b><br>
            <input type="checkbox" id="select_all" onclick="checkAllFunctions()"> <label for="select_all"><b>Pilih Semua Functions</b></label><br>
            <table width="100%" cellpadding="3">
                <tr>
                    <td valign="top" width="33%">
                        <?php 
                        $half1 = array_slice($functions_list, 0, 3);
                        foreach($half1 as $func) { ?>
                            <input type="checkbox" name="functions[]" value="<?php echo $func; ?>"> 
                            <label><?php echo $func; ?></label><br>
                        <?php } ?>
                    </td>
                    <td valign="top" width="33%">
                        <?php 
                        $half2 = array_slice($functions_list, 3, 3);
                        foreach($half2 as $func) { ?>
                            <input type="checkbox" name="functions[]" value="<?php echo $func; ?>"> 
                            <label><?php echo $func; ?></label><br>
                        <?php } ?>
                    </td>
                    <td valign="top" width="33%">
                        <?php 
                        $half3 = array_slice($functions_list, 6);
                        foreach($half3 as $func) { ?>
                            <input type="checkbox" name="functions[]" value="<?php echo $func; ?>"> 
                            <label><?php echo $func; ?></label><br>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            
            <br>
            <b>Custom keyword:</b><br>
            <input type="text" name="textV" value="" placeholder="Masukkan keyword sendiri" style="padding:5px; width:300px;">
            <br><small>Contoh: hack, backdoor, malware, crypto, dll</small>
            
            <br><br>
            <input type="submit" name="Submit" value=" S T A R T  S C A N " style="padding:10px 30px; font-size:18px; background-color:#4CAF50; color:white; border:none; border-radius:5px; cursor:pointer;">
        </td></tr>
    </table>
    </form>
    
    <br>
    <table width="650" class="single">
        <tr><td class="me">
            <b>Tips:</b><br>
            • Untuk scan FULL (semua file, semua subfolder): centang Recursive, pilih All files<br>
            • Untuk scan CEPAT: scan per folder spesifik (misal: wp-content/uploads/)<br>
            • Backdoor sering di: wp-content/uploads/, wp-content/themes/, wp-admin/<br>
            • Jika timeout, scan folder yang lebih kecil dulu<br>
            • Gunakan filter berdasarkan Type dan Owner setelah scan
        </td></tr>
    </table>
<?php } ?>
<br><br><hr width="300">
<center>
Backdoor Scanner ReFixed By Dzone <a href="https://github.com/Dzbackdor" target="_blank">Find Me</a>
<br><br>
</body>
</html>
